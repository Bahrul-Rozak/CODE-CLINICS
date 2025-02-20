<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\MedicalRecord;
use App\Models\Medication;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $doctors = Doctor::with('clinic')->get(); // Fetch doctors with clinic details
        return view('admin.backend.patient.create', compact('doctors'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|string|in:male,female',
            'phone' => 'required|string|max:20',
            'religion' => 'required|in:islam,kristen,hindu,budha,konghucu',
            'education' => 'nullable|string|max:100',
            'occupation' => 'nullable|string|max:100',
            'complaint' => 'required|string|max:255', // Validasi untuk complaint
        ]);

        // Ambil tanggal hari ini
        $date = now()->format('Ymd');

        // Hitung jumlah pasien yang terdaftar hari ini
        $countToday = Patient::whereDate('created_at', now()->toDateString())->count() + 1;

        // Buat kode pasien
        $patient_code = 'PAT' . $date . str_pad($countToday, 4, '0', STR_PAD_LEFT);

        // Simpan data pasien
        $patient = Patient::create([
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
            'doctor_id' => $request->doctor_id,
            'complaint' => $request->complaint
        ]);

        // Ambil tanggal hari ini untuk nomor antrian
        $today = date('Y-m-d');
        $queueNumber = 1;
        $lastRecord = MedicalRecord::where(DB::raw('DATE(created_at)'), $today)->latest()->first();

        if ($lastRecord) {
            $queueNumber = $lastRecord->queue_number + 1;
        }

        // Simpan data rekam medis
        MedicalRecord::create([
            'patient_id' => $patient->id,
            'complaint' => $request->complaint,
            'doctor_id' => $request->doctor_id, // Pastikan ada input untuk doctor_id
            'queue_number' => str_pad($queueNumber, 3, '0', STR_PAD_LEFT), // Format nomor antrian
        ]);

        return redirect()->route('patient.index')->with('success', 'Record added successfully.');
    }


    public function show()
    {
        $patient_data = Patient::all();
        return view('patient.index', compact('patient_data'));
    }


    // public function edit($id)
    // {
    //     $patient_data = Patient::with('doctor')->findOrFail($id); // Ambil patient beserta dokter
    //     $medical_record = MedicalRecord::where('patient_id', $id)->first();
    //     $doctors = Doctor::with('clinic')->get(); // Ambil semua dokter dengan data klinik

    //     return view('admin.backend.patient.edit', compact('patient_data', 'medical_record', 'doctors'));
    // }

    // public function edit($id)
    // {
    //     $patient_data = Patient::findOrFail($id);
    //     $doctors = Doctor::all();

    //     // Ambil semua rekam medis pasien berdasarkan patient_id
    //     $medical_records = MedicalRecord::where('patient_id', $id)->orderBy('created_at', 'desc')->get();

    //     return view('admin.backend.patient.edit', compact('patient_data', 'doctors', 'medical_records'));
    // }

    public function edit($id)
    {
        $patient_data = Patient::findOrFail($id);
        $medical_record = MedicalRecord::where('patient_id', $id)->latest()->first();
        $medical_records = MedicalRecord::where('patient_id', $id)->get();
        $doctors = Doctor::all();

        return view('admin.backend.patient.edit', compact('patient_data', 'medical_record', 'medical_records', 'doctors'));
    }



    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|string|in:male,female',
            'phone' => 'required|string|max:20',
            'religion' => 'required|in:islam,kristen,hindu,budha,konghucu',
            'complaint' => 'nullable|string|max:255', // Validasi untuk complaint
            'doctor_id' => 'required|exists:doctors,id', // Pastikan ini ada
        ]);

        // Temukan pasien berdasarkan ID
        $patient = Patient::findOrFail($id);

        // Perbarui data pasien
        $patient->update($validated);

        // Temukan MedicalRecord yang terkait
        $medicalRecord = MedicalRecord::where('patient_id', $id)->first();

        // Perbarui complaint jika ada
        if ($medicalRecord) {
            $medicalRecord->update([
                'complaint' => $request->input('complaint'),
            ]);
        }

        return redirect()->route('patient.index')->with('success', 'Patient updated successfully.');
    }


    public function destroy($id)
    {

        $patient = Patient::findOrFail($id);
        $patient->delete();

        return redirect()->route('patient.index')->with('success', 'Patient deleted successfully');
    }

    // public function createMedicalRecord($id)
    // {
    //     $medications = Medication::all(); // Ambil semua data obat dari tabel medications
    //     $patient = Patient::findOrFail($id); // Pastikan pasien ada

    //     return view('medical_records.create', compact('medications', 'patient'));
    // }


    public function storeMedicalRecord(Request $request, $id)
    {
        $request->validate([
            'examination_date' => 'required|date',
            'complaint' => 'required|string',
            'diagnosis' => 'required|string',
            'doctor_id' => 'required|exists:doctors,id', // Pastikan dokter ada di database
            // 'medications' => 'required|nullable'
            'service' => 'required|string|max:255',
            'notes' => 'nullable|string|max:500',
            'treatment' => 'nullable|string|max:500',
            'blood_type' => 'nullable|string|max:3',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'waist' => 'nullable|numeric',
        ]);

        MedicalRecord::create([
            'patient_id' => $id,
            'doctor_id' => $request->doctor_id, // Pastikan ini ada!
            'examination_date' => $request->examination_date,
            'complaint' => $request->complaint,
            'diagnosis' => $request->diagnosis,
            'service' => $request->service,
            'notes' => $request->notes,
            'treatment' => $request->treatment,
            'blood_type' => $request->blood_type,
            'height' => $request->height,
            'weight' => $request->weight,
            'waits' => $request->waist,
            // 'medications' => $request->medications
        ]);

        return redirect()->back()->with('success', 'Medical record added successfully');
    }

    public function destroyMedicalRecord($id)
    {
        $record = MedicalRecord::findOrFail($id);
        $record->delete();

        return redirect()->back()->with('success', 'Medical record deleted successfully');
    }
}
