<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    public function index()
    {
        // Ambil data MedicalRecord dengan relasi ke Patient dan Doctor
        $medical_data = MedicalRecord::with(['patient', 'doctor'])->get();

        // Kirim data ke view
        return view('admin.backend.medical-record.index', compact('medical_data'));
    }
}
