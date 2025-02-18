<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientQueueController extends Controller
{
    public function index(){
        return view('admin.backend.patient-queue.index');
    }
}
