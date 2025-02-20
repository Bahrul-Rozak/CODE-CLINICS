<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\MedicalRecord;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientQueueController extends Controller
{
    public function index()
    {
        $queue_data = MedicalRecord::with('patient', 'doctor')->get();
        return view('admin.backend.patient-queue.index', compact('queue_data'));
    }

    // public function create()
    // {
    //     $patients = Patient::all();
    //     $doctors = Doctor::all();
    //     $services = ['BPJS', 'Jamkesda', 'KIS', 'Jampersal', 'Prudential', 'AXA Mandiri', 'Allianz', 'Manulife', 'AIA', 'Sinarmas MSIG', 'Sequis Life', 'Jasa Raharja', 'BRI Life', 'Puskesmas', 'RSUD'];

    //     return view('admin.backend.patient-queue.create', compact('patients', 'doctors', 'services'));
    // }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'service' => 'required|string',
            'complaint' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        MedicalRecord::create($request->all());

        return redirect()->route('patient-queue.index')->with('success', 'Data antrian berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $queue_data = MedicalRecord::with('patient', 'doctor')->findOrFail($id);
        $patients = Patient::all();
        $doctors = Doctor::all();
        $services = ['BPJS', 'Jamkesda', 'KIS', 'Jampersal', 'Prudential', 'AXA Mandiri', 'Allianz', 'Manulife', 'AIA', 'Sinarmas MSIG', 'Sequis Life', 'Jasa Raharja', 'BRI Life', 'Puskesmas', 'RSUD'];

        return view('admin.backend.patient-queue.edit', compact('queue_data', 'patients', 'doctors', 'services'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'service' => 'required|string',
            'complaint' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        // Cari data berdasarkan ID
        $queue = MedicalRecord::findOrFail($id);

        // Update data
        $queue->update([
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'service' => $request->service,
            'complaint' => $request->complaint,
            'status' => $request->status,
        ]);

        return redirect()->route('patient-queue.index')->with('success', 'Data berhasil diperbarui!');
    }


    public function destroy($id)
    {
        $queue = MedicalRecord::findOrFail($id);
        $queue->delete();

        return redirect()->route('patient-queue.index')->with('success', 'Data antrian berhasil dihapus!');
    }
}
