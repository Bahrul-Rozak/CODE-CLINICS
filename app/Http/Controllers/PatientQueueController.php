<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use Illuminate\Http\Request;

class PatientQueueController extends Controller
{
    public function index()
    {
        // Ambil data medical record dengan diagnosis tidak null
        $queue_data = MedicalRecord::whereNotNull('diagnosis')->get();
        return view('admin.backend.patient-queue.index', compact('queue_data'));
    }
}
