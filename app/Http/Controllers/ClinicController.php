<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClinicController extends Controller
{
    public function index()
    {
        $clinic_data = Clinic::all();
        return view('admin.backend.clinic.index', compact('clinic_data'));
    }

    public function create()
    {
        return view('admin.backend.clinic.create');
    }

    public function store(Request $request)
    {
        // Testing dulu lah..
        // dd($request->all());

        // Validasi input

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Clinic::create([
            'name' => $request->name,
        ]);

        return redirect()->route('clinic.index')->with('message', 'Clinic Created Successfully');
    }

    public function show()
    {
        $clinic_data = Clinic::all();
        return view('clinic.index', compact('clinic_data'));
    }

    public function edit($id)
    {
        $clinic_data = Clinic::find($id);
        return view('admin.backend.clinic.edit', compact('clinic_data'));
    }

    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $clinic = Clinic::findOrFail($id);
        $clinic->update($validated);

        return redirect()->route('clinic.index')->with('success', 'Clinic updated successfully');
    }

    public function destroy($id)
    {

        $clinic = Clinic::findOrFail($id);
        $clinic->delete();

        return redirect()->route('clinic.index')->with('success', 'Clinic deleted successfully');
    }
}
