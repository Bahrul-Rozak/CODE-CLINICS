<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Medication;
use App\Models\Clinic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicalRecordController extends Controller
{
    public function index()
    {
        $medical_data = MedicalRecord::with(['patient', 'doctor', 'medication', 'clinic'])->get();
        return view('admin.backend.medical-record.index', compact('medical_data'));
    }

    public function create()
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        $medications = Medication::all();
        $clinics = Clinic::all();

        return view('admin.backend.medical-record.create', compact('patients', 'doctors', 'medications', 'clinics'));
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'patient_id' => 'required|exists:patients,id',
    //         'doctor_id' => 'required|exists:doctors,id',
    //         'medication_id' => 'nullable|exists:medications,id',
    //         'clinic_id' => 'required|exists:clinics,id',
    //         'queue_number' => 'required|integer',
    //         'examination_date' => 'required|date',
    //         'service' => 'required|string|max:255',
    //         'complaint' => 'required|string|max:500',
    //         'diagnosis' => 'nullable|string|max:500',
    //         'medication_quantity' => 'nullable|integer',
    //         'notes' => 'nullable|string|max:500',
    //         'treatment' => 'nullable|string|max:500',
    //         'new_entry' => 'boolean',
    //         'blood_type' => 'nullable|string|max:3',
    //         'height' => 'nullable|numeric',
    //         'weight' => 'nullable|numeric',
    //         'waist' => 'nullable|numeric',
    //     ]);

    //     // Simpan medical record
    //     MedicalRecord::create($request->all());

    //     // Kurangin stok obat
    //     if ($request->medication_id && $request->medication_quantity) {
    //         $medication = Medication::find($request->medication_id);
    //         if ($medication) {
    //             $medication->amount -= $request->medication_quantity;
    //             $medication->save();
    //         }
    //     }

    //     return redirect()->route('medical-records.index')->with('success', 'Medical record created successfully.');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'medication_id' => 'nullable|exists:medications,id',
            'clinic_id' => 'required|exists:clinics,id',
            'queue_number' => 'required|integer',
            'examination_date' => 'required|date',
            'service' => 'required|string|max:255',
            'complaint' => 'required|string|max:500',
            'diagnosis' => 'nullable|string|max:500',
            'medication_quantity' => 'nullable|integer|min:1',
            'notes' => 'nullable|string|max:500',
            'treatment' => 'nullable|string|max:500',
            'new_entry' => 'boolean',
            'blood_type' => 'nullable|string|max:3',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'waist' => 'nullable|numeric',
        ]);

        DB::beginTransaction(); // Mulai transaksi biar kalau error rollback

        try {
            // Simpan data rekam medis
            $medicalRecord = MedicalRecord::create($request->all());

            // Kurangi stok obat jika ada
            if ($request->medication_id && $request->medication_quantity) {
                $medication = Medication::find($request->medication_id);

                if ($medication && $medication->amount >= $request->medication_quantity) {
                    $medication->decrement('amount', $request->medication_quantity);
                } else {
                    return back()->with('error', 'Stok obat tidak mencukupi!');
                }
            }

            DB::commit(); // Simpan perubahan di database

            return redirect()->route('medical-records.index')->with('success', 'Medical record created successfully.');
        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua perubahan kalau ada error
            return back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }



    public function edit(MedicalRecord $medicalRecord)
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        $medications = Medication::all();
        $clinics = Clinic::all();

        return view('admin.backend.medical-record.edit', compact('medicalRecord', 'patients', 'doctors', 'medications', 'clinics'));
    }

    // public function update(Request $request, MedicalRecord $medicalRecord)
    // {
    //     $validatedData = $request->validate([
    //         'complaint' => 'nullable|string|max:500',
    //         'diagnosis' => 'nullable|string|max:500',
    //         'treatment' => 'nullable|string|max:100',
    //         'medication_id' => 'nullable|exists:medications,id',
    //         'medication_quantity' => 'nullable|integer|min:1',
    //         'notes' => 'nullable|string|max:500',
    //         'blood_type' => 'nullable|string|max:2',
    //         'height' => 'nullable|integer|min:50|max:250',
    //         'weight' => 'nullable|integer|min:10|max:300',
    //     ]);


    //     $medicalRecord->update($validatedData);

    //     return redirect()->route('medical-record.index')->with('success', 'Medical record updated successfully.');
    // }
    
    public function update(Request $request, MedicalRecord $medicalRecord)
    {
        $validatedData = $request->validate([
            'complaint' => 'nullable|string|max:500',
            'diagnosis' => 'nullable|string|max:500',
            'treatment' => 'nullable|string|max:100',
            'medication_id' => 'nullable|exists:medications,id',
            'medication_quantity' => 'nullable|integer|min:1',
            'notes' => 'nullable|string|max:500',
            'blood_type' => 'nullable|string|max:2',
            'height' => 'nullable|integer|min:50|max:250',
            'weight' => 'nullable|integer|min:10|max:300',
            'waist' => 'nullable|integer|min:10|max:300',
        ]);

        DB::transaction(function () use ($request, $medicalRecord, $validatedData) {
            // Balikin stok obat lama kalau ada
            if ($medicalRecord->medication_id && $medicalRecord->medication_quantity) {
                $oldMedication = Medication::find($medicalRecord->medication_id);
                if ($oldMedication) {
                    $oldMedication->increment('stock', $medicalRecord->medication_quantity); // Ganti 'amount' jadi 'stock'
                }
            }

            // Update rekam medis
            $medicalRecord->update($validatedData);

            // Kurangi stok obat baru kalau ada
            if ($request->medication_id && $request->medication_quantity) {
                $newMedication = Medication::find($request->medication_id);
                if ($newMedication && $newMedication->stock >= $request->medication_quantity) {
                    $newMedication->decrement('stock', $request->medication_quantity); // Ganti 'amount' jadi 'stock'
                } else {
                    throw new \Exception('Stock not sufficient');
                }
            }
        });

        return redirect()->route('medical-record.index')->with('success', 'Medical record updated successfully.');
    }




    public function destroy(MedicalRecord $medicalRecord)
    {
        $medicalRecord->delete();
        return redirect()->route('medical-records.index')->with('success', 'Medical record deleted successfully.');
    }
}
