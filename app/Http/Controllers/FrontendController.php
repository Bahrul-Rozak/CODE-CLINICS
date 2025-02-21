<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\MedicalRecord;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function index()
    {
        // Ambil semua dokter dari database
        $doctors = Doctor::with('clinic')->get();

        // Kirim ke view frontend.index
        return view('frontend.index', compact('doctors'));
    }
    public function patientSignUp(Request $request)
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
            'complaint' => 'required|string|max:255',
            'national_id' => 'required|string|max:50',
            'doctor_id' => 'required|exists:doctors,id', // Pastikan dokter ada di DB
        ]);

        // Generate patient code
        $date = now()->format('Ymd');
        $countToday = Patient::whereDate('created_at', now()->toDateString())->count() + 1;
        $patient_code = 'PAT' . $date . str_pad($countToday, 4, '0', STR_PAD_LEFT);

        // Simpan data pasien
        $patient = Patient::create([
            'patient_code' => $patient_code,
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
            'complaint' => $request->complaint,
        ]);

        // Generate queue number
        $today = date('Y-m-d');
        $queueNumber = 1;
        $lastRecord = MedicalRecord::where(DB::raw('DATE(created_at)'), $today)->latest()->first();

        if ($lastRecord) {
            $queueNumber = $lastRecord->queue_number + 1;
        }

        // Simpan rekam medis
        MedicalRecord::create([
            'patient_id' => $patient->id,
            'complaint' => $request->complaint,
            'doctor_id' => $request->doctor_id,
            'queue_number' => str_pad($queueNumber, 3, '0', STR_PAD_LEFT),
        ]);

        return redirect('/')->with('success', 'Pendaftaran berhasil! Silakan tunggu antrian.');
    }
}
