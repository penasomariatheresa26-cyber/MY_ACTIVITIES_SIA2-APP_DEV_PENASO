<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plant;

class PlantController extends Controller
{
    // Display all plants
    public function index(Request $request)
    {
        $query = Plant::query();

        // Bonus: search/filter by name
        if ($request->has('search')) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        $plants = $query->paginate(5); // pagination

        return view('plants.index', compact('plants'));
    }

    // Show create form
    public function create()
    {
        return view('plants.create');
    }

    // Save new plant
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'water_frequency' => 'required|integer|min:1',
            'sunlight' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048', // optional image
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('plants', 'public');
        }

        Plant::create($data);

        return redirect()->route('plants.index')->with('success', 'Plant added successfully!');
    }

    // Show single plant
    public function show(Plant $plant)
    {
        return view('plants.show', compact('plant'));
    }

    // Show edit form
    public function edit(Plant $plant)
    {
        return view('plants.edit', compact('plant'));
    }

    // Update plant
    public function update(Request $request, Plant $plant)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'water_frequency' => 'required|integer|min:1',
            'sunlight' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('plants', 'public');
        }

        $plant->update($data);

        return redirect()->route('plants.index')->with('success', 'Plant updated successfully!');
    }

    // Delete plant
    public function destroy(Plant $plant)
    {
        $plant->delete();
        return redirect()->route('plants.index')->with('success', 'Plant deleted successfully!');
    }
}