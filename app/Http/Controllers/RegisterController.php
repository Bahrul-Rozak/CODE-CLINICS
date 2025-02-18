<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\MedicalRecord;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function index()
    {
        $services = MedicalRecord::select('service')->distinct()->get();
        // $doctors = Doctor::all();
        $doctors = Doctor::with('clinic')->get();
        $patient = Patient::first();

        return view('admin.backend.register.index', compact('services', 'doctors', 'patient'));
    }

    public function checkpreviouspatient(Request $request)
    {
        $validated = $request->validate([
            "name" => 'required',
            "birth_date" => 'required'
        ]);

        $name = $validated['name'];
        $birth_date = $validated['birth_date'];

        $data = DB::table('patients')->where('name', $name)->where('birth_date', $birth_date)->first();

        if ($data) {
            return response()->json([
                'success' => 'Success : Data Found :D',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'failed' => 'Failed : Data not Found!'
            ]);
        }
    }

    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'patient_id' => 'required',
    //         'service' => 'required',
    //         'complaint' => 'required',
    //         'doctor_id' => 'required'
    //     ]);

    //     // dd($validatedData);

    //     // Store the medical record
    //     MedicalRecord::create([
    //         'patient_id' => $validatedData['patient_id'],
    //         'service' => $validatedData['service'],
    //         'complaint' => $validatedData['complaint'],
    //         'doctor_id' => $validatedData['doctor_id']
    //     ]);

    //     return redirect()->route('patient-register.index')->with('success', 'Record added successfully.');
    // }


    public function store(Request $request)
    {
        dd($request->all()); // Debug: cek apakah request masuk dengan benar
        $validatedData = $request->validate([
            'patient_id' => 'required',
            'service' => 'required',
            'complaint' => 'required',
            'doctor_id' => 'required'
        ]);

        // Ambil tanggal hari ini
        $today = date('Y-m-d');

        // Cek nomor antrian terakhir untuk hari ini
        $queueNumber = 1;
        $lastRecord = MedicalRecord::where(DB::raw('DATE(created_at)'), $today)->latest()->first();

        if ($lastRecord) {
            $queueNumber = $lastRecord->queue_number + 1;
        }

        // Simpan data rekam medis dengan nomor antrian
        MedicalRecord::create([
            'queue_number' => str_pad($queueNumber, 3, '0', STR_PAD_LEFT), // Format "001", "002", dst.
            'patient_id' => $validatedData['patient_id'],
            'service' => $validatedData['service'],
            'complaint' => $validatedData['complaint'],
            'doctor_id' => $validatedData['doctor_id']
        ]);

        return redirect()->route('patient-register.index')->with('success', 'Record added successfully.');
    }
}
