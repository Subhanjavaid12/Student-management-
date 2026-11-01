<?php

namespace App\Http\Controllers;
use App\Models\Subject;
use App\Models\Student;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    // Show all subjects
    public function index()
    {
        $subjects = Subject::with('students')->latest()->get();

        return view('subjects.index', compact('subjects'));
    }

    // Show create form
    public function create()
    {
        return view('subjects.create');
    }

    // Store new subject
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:subjects,name',
            'description' => 'nullable|string',
        ]);

        Subject::create($data);

        return redirect()
            ->route('subjects.index')   
            ->with('success', 'Subject created successfully.');
    }

    // Show edit form
    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    // Update subject
    public function update(Request $request, Subject $subject)
    {
        $data = $request->validate([    
            'name' => 'required|string|max:255|unique:subjects,name,' . $subject->id,
            'description' => 'nullable|string',
        ]);
        $subject->update($data);
        return redirect()
            ->route('subjects.index')
            ->with('success', 'Subject updated successfully.');
    }

    // Delete subject
    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()
            ->route('subjects.index')
            ->with('success', 'Subject deleted successfully.');
    }

    // Show assign subject form
    public function assign(Subject $subject)
    {
        $students = Student::all();

        return view('subjects.assign', compact('subject', 'students'));
    }

    // Store subject assignment
    public function storeAssignment(Request $request, Subject $subject)
    {
        $request->validate([
            'students' => 'required|array',
            'students.*' => 'exists:students,id',
        ]);
        $subject->students()->syncWithoutDetaching($request->students);
        return redirect()
            ->route('subjects.index')
            ->with('success', 'Subject assigned successfully.');
    }
    // Unassign subject from student
    public function unassignSubject($subjectId, $studentId)
    {
        $subject = Subject::findOrFail($subjectId);
        $student = Student::findOrFail($studentId);
        $subject->students()->detach($student->id);
        return redirect()
            ->back()
            ->with('success', 'Subject unassigned successfully.');
    }
}