<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Comment\Doc;

class DoctorController extends Controller
{
    public function index()
    {
        // $doctor_data = Doctor::all();
        // return view('admin.backend.doctor.index', compact('doctor_data'));

        // Load relasi schedule dan clinic
        $doctor_data = Doctor::with(['schedule', 'clinic'])->get();

        return view('admin.backend.doctor.index', compact('doctor_data'));
    }

    public function create()
    {
        $clinics = Clinic::all();
        $schedules = Schedule::all();
        return view('admin.backend.doctor.create', compact('clinics', 'schedules'));
    }

    public function store(Request $request)
    {
        // Testing dulu lah..
        // dd($request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'required|string|max:15',
            'schedule_id' => 'required|exists:schedules,id',
            'clinic_id' => 'required|exists:clinics,id',
        ]);

        Doctor::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'schedule_id' => $request->schedule_id,
            'clinic_id' => $request->clinic_id,
        ]);

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
        $clinics = Clinic::all();
        $schedules = Schedule::all();
        return view('admin.backend.doctor.edit', compact('doctor_data', 'clinics', 'schedules'));
    }

    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'required|string|max:15',
            'schedule_id' => 'required|exists:schedules,id',
            'clinic_id' => 'required|exists:clinics,id',
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
