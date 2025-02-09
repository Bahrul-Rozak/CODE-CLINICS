<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function index()
    {
        return view('admin.backend.register.index');
    }

    public function checkpreviouspatient(Request $request)
    {
        $validated = $request->validate([
            "name" => 'required',
            "birth_date" => 'required'
        ]);
    
        $name = $validated['name'];
        $birth_date = $validated['birth_date'];
    
        // Ambil data pasien berdasarkan nama dan tanggal lahir
        $data = DB::table('patients')->where('name', $name)->where('birth_date', $birth_date)->first();
    
        if ($data) {
            return response()->json([
                'success' => 'Data ditemukan',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'failed' => 'Data tidak ditemukan'
            ]);
        }
    }
    
    
}
