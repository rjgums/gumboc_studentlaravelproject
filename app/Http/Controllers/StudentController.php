<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StudentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $student = Student::create($validated);

        Http::post('https://hook.us2.make.com/fl36kemegnf5hgf7e2i87fntrszljcud', [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
        ]);

        return redirect()->route('dashboard')->with([
            'success' => 'Student added successfully',
            'newStudent' => $student,
        ]);
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('dashboard')->with('success_deleted', 'Student deleted successfully');
    }

    public function edit(Student $student)
    {
        return view('edit-student', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone' => 'required',
            'address' => 'required',
        ]);

        $student->update($validated);

        return redirect()->route('dashboard')->with(
            'success',
            'Student updated successfully',
            'newStudent'
        );
    }
}
