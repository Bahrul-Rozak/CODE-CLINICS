<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\MedicalRecord;
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

    // public function store(Request $request)
    // {

    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'address' => 'nullable|string|max:255',
    //         'birth_date' => 'required|date',
    //         'gender' => 'required|string|in:male,female',
    //         'phone' => 'required|string|max:20',
    //         'religion' => 'required|in:islam,kristen,hindu,budha,konghucu',
    //         'education' => 'nullable|string|max:100',
    //         'occupation' => 'nullable|string|max:100',
    //         'national_id' => 'nullable|string|max:15',
    //         'doctor_id' => 'required|exists:doctors,id', 
    //         'complaint' => 'required'
    //     ]);

    //     // Ambil tanggal hari ini
    //     $date = now()->format('Ymd');

    //     // Hitung jumlah pasien yang terdaftar hari ini
    //     $countToday = Patient::whereDate('created_at', now()->toDateString())->count() + 1;

    //     // Buat kode pasien
    //     $patient_code = 'PAT' . $date . str_pad($countToday, 4, '0', STR_PAD_LEFT);

    //     Patient::create([
    //         'patient_code' => $patient_code, // Simpan kode pasien
    //         'name' => $request->name,
    //         'address' => $request->address,
    //         'birth_date' => $request->birth_date,
    //         'gender' => $request->gender,
    //         'phone' => $request->phone,
    //         'religion' => $request->religion,
    //         'education' => $request->education,
    //         'occupation' => $request->occupation,
    //         'national_id' => $request->national_id,
    //         'doctor_id' => $request->doctor_id,
    //         'complaint' => $request->complaint
    //     ]);

    //     return redirect()->route('patient.index')->with('message', 'Patient Created Successfully');
    // }

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


    public function edit($id)
    {
        $patient_data = Patient::findOrFail($id);
        $medical_record = MedicalRecord::where('patient_id', $id)->first(); // Ambil medical record terkait

        $doctors = Doctor::with('clinic')->get(); // Fetch doctors with clinic details

        return view('admin.backend.patient.edit', compact('patient_data', 'medical_record', 'doctors'));
    }


    // public function update(Request $request, $id)
    // {

    //     $validated = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'address' => 'nullable|string|max:255',
    //         'birth_date' => 'required|date',
    //         'gender' => 'required|string|in:male,female',
    //         'phone' => 'required|string|max:20',
    //         'religion' => 'required|in:islam,kristen,hindu,budha,konghucu',
    //         'education' => 'nullable|string|max:100',
    //         'occupation' => 'nullable|string|max:100',
    //         'national_id' => 'nullable|string|max:15',
    //         'doctor_id' => 'required|exists:doctors,id', // Ensure the doctor exists
    //     ]);

    //     $patient = Patient::findOrFail($id);
    //     $patient->update($validated);

    //     return redirect()->route('patient.index')->with('success', 'Patient updated successfully');
    // }

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
}
