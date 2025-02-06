<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data masukan
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|string|in:male,female',
            'phone' => 'required|string|max:20',
            'religion' => 'required|string|max:50',
            'education' => 'nullable|string|max:100',
            'occupation' => 'nullable|string|max:100',
            'national_id' => 'nullable|string|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $patient = Patient::create([
            'patient_code' => $request->input('patient_code'),
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'birth_date' => $request->input('birth_date'),
            'gender' => $request->input('gender'),
            'phone' => $request->input('phone'),
            'religion' => $request->input('religion'),
            'education' => $request->input('education'),
            'occupation' => $request->input('occupation'),
            'national_id' => $request->input('national_id'),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Patient created successfully',
            'data' => $patient,
        ], 201);
    }
}
