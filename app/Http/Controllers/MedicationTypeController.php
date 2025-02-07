<?php

namespace App\Http\Controllers;

use App\Models\MedicationType;
use Illuminate\Http\Request;

class MedicationTypeController extends Controller
{
    public function index(){
        $medication_type_data = MedicationType::all();
        return view('admin.backend.medication-type.index', compact('medication_type_data'));
    }

    public function create(){
        return view('admin.backend.medication-type.create');
    }

    public function store(Request $request)
    {
        // Testing dulu lah..
        // dd($request->all());

        // Validasi input

        $request->validate([
            'medication_type' => 'required|string|max:255',
        ]);

        MedicationType::create([
            'medication_type' => $request->medication_type,
        ]);

        return redirect()->route('medication-types.index')->with('message', 'Type Created Successfully');
    }

    public function show()
    {
        $medication_type_data = MedicationType::all();
        return view('medication-types.index', compact('medication_type_data'));
    }

    public function edit($id)
    {
        $medication_type_data = MedicationType::find($id);
        return view('admin.backend.medication-type.edit', compact('medication_type_data'));
    }

    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'medication_type' => 'required|string|max:255',
        ]);

        $medication = MedicationType::findOrFail($id);
        $medication->update($validated);

        return redirect()->route('medication-types.index')->with('success', 'Type updated successfully');
    }

    public function destroy($id)
    {

        $medication = MedicationType::findOrFail($id);
        $medication->delete();

        return redirect()->route('medication-types.index')->with('success', 'Type deleted successfully');
    }
}
