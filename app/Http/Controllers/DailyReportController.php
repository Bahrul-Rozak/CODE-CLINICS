<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use Illuminate\Http\Request;

class DailyReportController extends Controller
{
    public function index()
    {
        // Ambil data medical record dengan report = 1 dan diagnosis tidak null
        $reports = Medicalrecord::where('report', 1)->whereNotNull('diagnosis')->get();
        return view('admin.backend.daily-report.index', compact('reports'));
    }
}
