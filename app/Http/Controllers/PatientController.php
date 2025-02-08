<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data masukan menggunakan validate() dari Laravel
        $validatedData = $request->validate([
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

        // Membuat data patient setelah validasi berhasil
        $patient = Patient::create($validatedData);

        // Mengembalikan respons JSON setelah data berhasil disimpan
        return response()->json([
            'status' => 'success',
            'message' => 'Patient created successfully',
            'data' => $patient,
        ], 201);
    }
}
