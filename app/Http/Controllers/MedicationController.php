<?php

namespace App\Http\Controllers;

use App\Models\Medication;
use App\Models\MedicationType;
use Illuminate\Http\Request;

class MedicationController extends Controller
{
    public function index()
    {
        $medication_data = Medication::with('type')->get();
        return view('admin.backend.medication.index', compact('medication_data'));
    }

    public function create()
    {
        $medication_types = MedicationType::all();
        return view('admin.backend.medication.create', compact('medication_types'));
    }

    public function store(Request $request)
    {
        // Validasi data masukan
        $request->validate([
            'medication_code' => 'nullable|string|max:255',
            'stock' => 'required|integer|min:0',
            'type_id' => 'nullable|exists:medications_type,id',
            'name' => 'required|string|max:255',
            'dosage' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'expiration_date' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Default value untuk path dan filename
        $path = '';
        $filename = '';

        // Cek jika ada foto yang diupload
        if ($request->has('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();

            // Membuat nama file unik
            $filename = time() . '.' . $extension;
            $path = 'uploads/medication/';

            // Pindahkan file ke folder yang ditentukan
            $file->move(public_path($path), $filename);
        }

        // Simpan data ke database
        Medication::create([
            'medication_code' => $request->medication_code,
            'stock' => $request->stock,
            'type_id' => $request->type_id,
            'name' => $request->name,
            'dosage' => $request->dosage,
            'price' => $request->price,
            'expiration_date' => $request->input('expiration_date'),
            'photo' => $path . $filename,  // Menyimpan path foto
        ]);

        return redirect()->route('medication.index')->with('success', 'Medication added successfully!');
    }


    public function show()
    {
        $medication_data = Medication::all();
        return view('medication.index', compact('medication_data'));
    }

    public function edit($id)
    {
        $medication_data = Medication::find($id);
        $medication_types = MedicationType::all();
        return view('admin.backend.medication.edit', compact('medication_data', 'medication_types'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data masukan
        $validated = $request->validate([
            'medication_code' => 'nullable|string|max:255',
            'stock' => 'required|integer|min:0',
            'type_id' => 'nullable|exists:medications_type,id',
            'name' => 'required|string|max:255',
            'dosage' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'expiration_date' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $medication = Medication::findOrFail($id);
        $medication->update($validated);

        return redirect()->route('medication.index')->with('success', 'Medication updated successfully');
    }

    public function destroy($id)
    {

        $medication = Medication::findOrFail($id);
        $medication->delete();

        return redirect()->route('medication.index')->with('success', 'Medication deleted successfully');
    }

    // Stock Obat
    public function editstock($id)
    {
        $medication_data = Medication::findOrFail($id);
        return view('admin.backend.medication.edit-stock', compact('medication_data'));
    }

    public function addstock(Request $request, $id)
    {
        $validated = $request->validate([
            'add_stock' => 'required|integer|min:1'
        ]);

        $medication = Medication::findOrFail($id);
        $medication->stock += $validated['add_stock'];

        if ($request->expiration_date) {
            $medication->expiration_date = $request->expiration_date;
        }

        $medication->save();

        return redirect()->route('medication.index')->with('success', 'Stok terupdate!');
    }
}
