<?php

namespace App\Http\Controllers;
use App\Models\Department;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::withCount('students')->latest()->paginate(10);
        return view('admin.departments.index', compact('departments'));
    }
    public function create()
    {
        return view('admin.departments.create');
    }

    public function store(Request $request)
    {
        $this->normalizeInput($request);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:departments,name'],
            'code' => ['required', 'string', 'max:50', 'unique:departments,code'],
        ]);

        Department::create($validated);

        return redirect()->route('admin.departments.index')
                         ->with('success', 'Department created successfully.');
    }

    public function edit(Department $department)
    {
        return view('admin.departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $this->normalizeInput($request);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('departments')->ignore($department->id)],
            'code' => ['required', 'string', 'max:50', Rule::unique('departments')->ignore($department->id)],
        ]);

        $department->update($validated);

        return redirect()->route('admin.departments.index')
                         ->with('success', 'Department updated successfully.');
    }

    public function destroy(Department $department)
    {
        $department->students()->update(['department_id' => null]);
        $department->delete();

        return redirect()->route('admin.departments.index')
                         ->with('success', 'Department deleted successfully.');
    }

    public function enroll(Department $department)
    {
        $department->load('students');
        $availableStudents = Student::whereNull('department_id')->orderBy('name')->get();

        return view('admin.departments.enroll', compact('department', 'availableStudents'));
    }

    public function storeEnrollment(Request $request, Department $department)
    {
        $studentIds = $request->input('student_ids', $request->input('student_id'));
        $studentIds = is_array($studentIds) ? $studentIds : ($studentIds !== null ? [$studentIds] : []);

        $request->validate([
            'student_ids' => ['required_without:student_id', 'array', 'min:1'],
            'student_ids.*' => ['integer', 'distinct', 'exists:students,id'],
            'student_id' => ['required_without:student_ids', 'integer', 'exists:students,id'],
        ]);

        $normalizedIds = array_values(array_unique(array_filter(array_map('intval', $studentIds))));

        if ($normalizedIds === []) {
            return back()->withErrors([
                'student_ids' => 'Please select at least one student to enroll.',
            ]);
        }

        $students = Student::whereIn('id', $normalizedIds)
            ->whereNull('department_id')
            ->get();

        if ($students->count() !== count($normalizedIds)) {
            return back()->withErrors([
                'student_ids' => 'One or more selected students are already assigned to a department.',
            ]);
        }

        foreach ($students as $student) {
            $student->update(['department_id' => $department->id]);
        }

        return redirect()->route('admin.departments.index')
            ->with('success', $students->count() === 1
                ? "Student {$students->first()->name} has been enrolled into {$department->name}."
                : "Students have been enrolled into {$department->name}.");
    }

    public function unenroll(Department $department, Student $student)
    {
        abort_unless($student->department_id === $department->id, 404);

        $student->update(['department_id' => null]);

        return redirect()->route('admin.departments.enroll', $department)
            ->with('success', "Student {$student->name} has been unenrolled from {$department->name}.");
    }

    private function normalizeInput(Request $request): void
    {
        $request->merge([
            'name' => trim((string) $request->input('name')),
            'code' => strtoupper(trim((string) $request->input('code'))),
        ]);
    }

    // Search Funtion
    public function departmentRoster(Request $request)
         {
    $search = trim((string) $request->input('search'));
    $searchedDepartment = null;
             if ($search !== '') {
        $searchedDepartment = Department::with('students')
            ->where('name', 'like', "%{$search}%")
            ->orWhere('code', 'like', "%{$search}%")
            ->first();
    }

    $departments = Department::withCount('students')
        ->orderBy('name')
        ->paginate(10)
        ->withQueryString();

        return view('admin.departments.index',
     compact('departments', 'searchedDepartment', 'search'));
    }
}