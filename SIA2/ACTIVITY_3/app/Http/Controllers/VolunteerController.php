<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Volunteer;

class VolunteerController extends Controller
{
    // Show the registration form
    public function create()
    {
        return view('volunteer');
    }

    // Handle form submission
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:volunteers,email',
            'age' => 'required|numeric|min:18',
            'area' => 'required',
            'motivation' => 'required|min:10',
        ]);

        Volunteer::create($request->all());

        return redirect()->route('volunteer.create')->with('success', 'Thank you for registering!');
    }

    // Show dashboard with registered volunteers
    public function dashboard()
    {
        $volunteers = Volunteer::latest()->get(); // all volunteers
        $total = Volunteer::count(); // total count
        return view('dashboard', compact('volunteers', 'total'));
    }
}