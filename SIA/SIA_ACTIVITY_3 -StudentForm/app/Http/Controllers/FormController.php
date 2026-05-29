<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class FormController extends Controller
{
    // Show registration form
    public function create()
    {
        return view('student_form')->with('activeTab', 'register');
    }

    // Store student and redirect to view
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:students,email',
            'age' => 'required|numeric|min:18',
            'course' => 'required',
            'mobile' => 'required|digits:11',
            'barangay' => 'required|min:3',
            'emergency_contact' => 'required|digits:11',
            'gender' => 'required',
            'guardian_name' => 'required|min:3',
            'guardian_contact' => 'required|digits:11',
            'notes' => 'nullable|max:255'
        ]);

        Student::create($request->all());

        // Redirect directly to view students tab
        return redirect()->route('form.view')->with('success', 'Student Registered Successfully!');
    }

    // View all students
    public function view()
    {
        $students = Student::all();
        return view('student_form', compact('students'))->with('activeTab', 'view');
    }

    // Dashboard
    public function dashboard()
    {
        $total = Student::count();
        $averageAge = Student::avg('age');
        return view('student_form', compact('total','averageAge'))->with('activeTab', 'dashboard');
    }
}