<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Comment\Doc;

class DoctorController extends Controller
{
    public function index()
    {
        $doctor_data = Doctor::all();
        return view('admin.backend.doctor.index', compact('doctor_data'));
    }

    public function create()
    {
        return view('admin.backend.doctor.create');
    }

    public function store(Request $request)
    {
        // Testing dulu lah..
        // dd($request->all());

        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'required|string|max:15',
            'practice_schedule' => 'required|string|max:255',
        ]);

        // Jika validasi gagal, kembalikan respons dengan error
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Simpan data dengan clinic_id sementara
        $doctor = new Doctor();
        $doctor->name = $request->input('name');
        $doctor->address = $request->input('address');
        $doctor->phone = $request->input('phone');
        $doctor->practice_schedule = $request->input('practice_schedule');
        $doctor->clinic_id = 0; // Atau null, jika Anda ingin menggunakan null
        $doctor->save();

        return redirect()->route('doctor.index')->with('message', 'Doctor Created Successfully');
    }

    public function show()
    {
        $doctor_data = Doctor::all();
        return view('doctor.index', compact('doctor_data'));
    }

    public function edit($id)
    {
        $doctor_data = Doctor::find($id);
        return view('admin.backend.doctor.edit', compact('doctor_data'));
    }

    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'required|string|max:15',
            'practice_schedule' => 'required|string|max:255',
        ]);

        $doctor = Doctor::findOrFail($id);
        $doctor->update($validated);

        return redirect()->route('doctor.index')->with('success', 'Doctor updated successfully');
    }

    public function destroy($id)
    {

        $doctor = Doctor::findOrFail($id);
        $doctor->delete();

        return redirect()->route('doctor.index')->with('success', 'Doctor deleted successfully');
    }
}
