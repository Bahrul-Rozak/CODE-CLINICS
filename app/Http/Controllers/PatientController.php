<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    public function index()
    {
        $patient_data = Patient::all();
        return view('admin.backend.patient.index', compact('patient_data'));
    }

    public function create()
    {
        return view('admin.backend.patient.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|string|in:male,female',
            'phone' => 'required|string|max:20',
            'religion' => 'required|in:islam,kristen,hindu,budha,konghucu',
            'education' => 'nullable|string|max:100',
            'occupation' => 'nullable|string|max:100',
            'national_id' => 'nullable|string|max:15',
        ]);

        // Ambil tanggal hari ini
        $date = now()->format('Ymd');

        // Hitung jumlah pasien yang terdaftar hari ini
        $countToday = Patient::whereDate('created_at', now()->toDateString())->count() + 1;

        // Buat kode pasien
        $patient_code = 'PAT' . $date . str_pad($countToday, 4, '0', STR_PAD_LEFT);

        Patient::create([
            'patient_code' => $patient_code, // Simpan kode pasien
            'name' => $request->name,
            'address' => $request->address,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'religion' => $request->religion,
            'education' => $request->education,
            'occupation' => $request->occupation,
            'national_id' => $request->national_id,
        ]);

        return redirect()->route('patient.index')->with('message', 'Patient Created Successfully');
    }

    public function show()
    {
        $patient_data = Patient::all();
        return view('patient.index', compact('patient_data'));
    }

    public function edit($id)
    {
        $patient_data = Patient::find($id);
        return view('admin.backend.patient.edit', compact('patient_data'));
    }

    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|string|in:male,female',
            'phone' => 'required|string|max:20',
            'religion' => 'required|in:islam,kristen,hindu,budha,konghucu',
            'education' => 'nullable|string|max:100',
            'occupation' => 'nullable|string|max:100',
            'national_id' => 'nullable|string|max:15',
        ]);

        $patient = Patient::findOrFail($id);
        $patient->update($validated);

        return redirect()->route('patient.index')->with('success', 'Patient updated successfully');
    }

    public function destroy($id)
    {

        $patient = Patient::findOrFail($id);
        $patient->delete();

        return redirect()->route('patient.index')->with('success', 'Patient deleted successfully');
    }
}
