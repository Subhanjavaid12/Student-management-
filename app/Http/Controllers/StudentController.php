<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    // DISPLAY ALL STUDENTS + SEARCH

    public function index(Request $request)
    {
        $search = $request->input('search');

        $students = Student::with(['subjects', 'department'])
            ->when($search, function ($query) use ($search) {

                $query->where('name', 'like', '%'.$search.'%')
                    ->orWhere('cnic', 'like', '%'.$search.'%')
                    ->orWhere('phone', 'like', '%'.$search.'%');

            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('students.index', compact('students', 'search'));
    }
    // SHOW ADD STUDENT FORM

    public function create()
    {
        return view('students.create', ['departments' => Department::orderBy('name')->get()]);
    }

    // STORE NEW STUDENT
    public function store(Request $request)
    {
        // Validation
        $data = $request->validate([

            'name' => 'required|string|max:255',

            'age' => 'required|integer|min:3|max:100',

            'cnic' => 'required|digits:13|unique:students,cnic',

            'email' => 'required|email|unique:students,email',

            'phone' => 'required|digits:11|unique:students,phone',

            'address' => 'nullable|string',
            'department_id' => ['nullable', 'exists:departments,id'],

            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'pdf_file' => 'nullable|file|mimes:pdf|max:5120',

        ], [

            'cnic.unique' => 'This CNIC is already registered.',

            'phone.unique' => 'This phone number is already registered.',

            'cnic.digits' => 'CNIC must contain exactly 13 digits.',

            'phone.digits' => 'Phone number must contain exactly 11 digits.',

            'profile_picture.image' => 'The profile picture must be an image.',

            'profile_picture.mimes' => 'Profile picture must be JPG, JPEG, or PNG.',

            'profile_picture.max' => 'Profile picture must not be larger than 2MB.',

            'pdf_file.mimes' => 'Only PDF files are allowed.',

            'pdf_file.max' => 'PDF file must not be larger than 5MB.',

        ]);

        // Uploaded files are stored separately; only validated fields reach the model.
        unset($data['profile_picture'], $data['pdf_file']);
        // UPLOAD PROFILE PICTURE

        if ($request->hasFile('profile_picture')) {

            $data['profile_picture'] = $request
                ->file('profile_picture')
                ->store('students');
        }
        // UPLOAD PDF

        if ($request->hasFile('pdf_file')) {

            $data['pdf_file'] = $request
                ->file('pdf_file')
                ->store('students');
        }

        // CREATE STUDENT

        Student::create($data);

        // Redirect
        return redirect()
            ->route('students.index')
            ->with('success', 'Student added successfully.');
    }

    // DISPLAY ONE STUDENT

    public function show(string $id)
    {
        $student = Student::with(['subjects', 'department'])->findOrFail($id);

        return view('students.show', compact('student'));
    }

    /** Download private student documents. This action is routed through admin middleware. */
    public function download(Student $student)
    {
        abort_unless(request()->user()?->isAdmin(), 403);
        abort_unless($student->pdf_file && Storage::exists($student->pdf_file), 404);

        return Storage::download($student->pdf_file, 'student-'.$student->id.'.pdf');
    }

    /** Serve private profile images to authenticated users. */
    public function profilePicture(Student $student)
    {
        abort_unless($student->profile_picture && Storage::exists($student->profile_picture), 404);

        return Storage::response($student->profile_picture);
    }

    //Download a student's profile image 
    public function downloadProfilePicture(Student $student)
    {
        abort_unless($student->profile_picture && Storage::exists($student->profile_picture), 404);

        $extension = pathinfo($student->profile_picture, PATHINFO_EXTENSION);

        return Storage::download(
            $student->profile_picture,
            'student-'.$student->id.'-profile-picture.'.$extension
        );
    }

    // SHOW EDIT STUDENT FORM

    public function edit(string $id)
    {
        $student = Student::findOrFail($id);

        return view('students.edit', [
            'student' => $student,
            'departments' => Department::orderBy('name')->get(),
        ]);
    }

    // UPDATE STUDENT

    public function update(Request $request, string $id)
    {
        $student = Student::findOrFail($id);

        // Validation
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:1|max:110',
            'cnic' => 'required|digits:13|unique:students,cnic,'.$id,
            'email' => ['required', 'email', Rule::unique('students', 'email')->ignore($id)],
            'phone' => 'required|digits:11|unique:students,phone,'.$id,
            'address' => 'nullable|string',
            'department_id' => ['nullable', 'exists:departments,id'],
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'pdf_file' => 'nullable|file|mimes:pdf|max:5120',

        ], [
            'cnic.unique' => 'This CNIC is already registered.',
            'phone.unique' => 'This phone number is already registered.',
            'cnic.digits' => 'CNIC must contain exactly 13 digits.',
            'phone.digits' => 'Phone number must contain exactly 11 digits.',
            'profile_picture.image' => 'The profile picture must be an image.',
            'profile_picture.mimes' => 'Profile picture must be JPG, JPEG, or PNG.',
            'profile_picture.max' => 'Profile picture must not be larger than 2MB.',
            'pdf_file.mimes' => 'Only PDF files are allowed.',
            'pdf_file.max' => 'PDF file must not be larger than 5MB.',
        ]);

        unset($data['profile_picture'], $data['pdf_file']);

        // REPLACE PROFILE PICTURE

        if ($request->hasFile('profile_picture')) {

            // Delete old profile picture
            if ($student->profile_picture) {

                Storage::delete($student->profile_picture);
            }

            // Store new profile picture
            $data['profile_picture'] = $request
                ->file('profile_picture')
                ->store('students');
        }

        // REPLACE PDF

        if ($request->hasFile('pdf_file')) {

            // Delete old PDF
            if ($student->pdf_file) {

                Storage::delete($student->pdf_file);
            }

            // Store new PDF
            $data['pdf_file'] = $request
                ->file('pdf_file')
                ->store('students');
        }

        // UPDATE STUDENT

        $student->update($data);

        // Redirect
        return redirect()
            ->route('students.index')
            ->with('success', 'Student updated successfully.');
    }

    // PERMANENTLY DELETE STUDENT

    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);

        // DELETE PROFILE PICTURE

        if ($student->profile_picture) {

            Storage::delete($student->profile_picture);
        }

        // DELETE PDF

        if ($student->pdf_file) {

            Storage::delete($student->pdf_file);
        }

        // PERMANENT DATABASE DELETE

        $student->delete();

        // Redirect
        return redirect()
            ->route('students.index')
            ->with('success', 'Student and all associated files permanently deleted.');
    }

    /** Display only the authenticated student's pre-authorized record. */
    public function myProfile(Request $request)
    {
        $student = $this->currentStudent($request)->load(['subjects', 'department']);

        return view('user.profile', compact('student'));
    }

    public function editMyProfile(Request $request)
    {
        return view('user.edit-profile', ['student' => $this->currentStudent($request)]);
    }

    public function myProfilePicture(Request $request)
    {
        $student = $this->currentStudent($request);
        abort_unless($student->profile_picture && Storage::exists($student->profile_picture), 404);

        return Storage::response($student->profile_picture);
    }

    /** Download only the authenticated student's own profile picture. */
    public function downloadMyProfilePicture(Request $request)
    {
        $student = $this->currentStudent($request);
        abort_unless($student->profile_picture && Storage::exists($student->profile_picture), 404);

        $extension = pathinfo($student->profile_picture, PATHINFO_EXTENSION);

        return Storage::download($student->profile_picture, 'my-profile-picture.'.$extension);
    }

    /** Download only the authenticated student's own document. */
    public function myDocument(Request $request)
    {
        $student = $this->currentStudent($request);
        abort_unless($student->pdf_file && Storage::exists($student->pdf_file), 404);

        return Storage::download($student->pdf_file, 'my-document.pdf');
    }

    /** Upload or replace only the authenticated student's own PDF document. */
    public function updateMyDocument(Request $request)
    {
        $student = $this->currentStudent($request);
        $data = $request->validate([
            'pdf_file' => ['required', 'file', 'mimes:pdf', 'max:5120'],
        ]);

        $newPdfFile = $data['pdf_file']->store('students');
        if ($student->pdf_file) {
            Storage::delete($student->pdf_file);
        }

        $student->update(['pdf_file' => $newPdfFile]);

        return back()->with('success', 'Your PDF document has been uploaded.');
    }

    /** Remove only the authenticated student's own PDF document. */
    public function destroyMyDocument(Request $request)
    {
        $student = $this->currentStudent($request);
        abort_unless($student->pdf_file, 404);

        Storage::delete($student->pdf_file);
        $student->update(['pdf_file' => null]);

        return back()->with('success', 'Your PDF document has been removed.');
    }

    /** Update only the authenticated student's record; no route ID is accepted. */
    public function updateMyProfile(Request $request)
    {
        $student = $this->currentStudent($request);
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:3', 'max:100'],
            'cnic' => ['required', 'digits:13', Rule::unique('students', 'cnic')->ignore($student->id)],
            'phone' => ['required', 'digits:11', Rule::unique('students', 'phone')->ignore($student->id)],
            'address' => ['nullable', 'string', 'max:1000'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'pdf_file' => ['nullable', 'file', 'mimes:pdf', 'max:5120'],
        ]);

        unset($data['profile_picture'], $data['pdf_file']);
        if ($request->hasFile('profile_picture')) {
            $newProfilePicture = $request->file('profile_picture')->store('students');

            if ($student->profile_picture) {
                Storage::delete($student->profile_picture);
            }

            $data['profile_picture'] = $newProfilePicture;
        }

        if ($request->hasFile('pdf_file')) {
            $newPdfFile = $request->file('pdf_file')->store('students');

            if ($student->pdf_file) {
                Storage::delete($student->pdf_file);
            }

            $data['pdf_file'] = $newPdfFile;
        }

        $student->update($data);
        // Keep the account display name consistent; login email remains the
        // administrator-approved address and cannot be changed here.
        $request->user()->update(['name' => $data['name']]);

        return redirect()->route('profile.show')->with('success', 'Your profile has been updated.');
    }

    private function currentStudent(Request $request): Student
    {
        $student = $request->user()->student;
        abort_unless($student, 403, 'Your account is not linked to a student profile.');

        return $student;
    }
}
