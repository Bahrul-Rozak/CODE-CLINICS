<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    public function index(){
        return view('admin.backend.medical-record.index');
    }
}
