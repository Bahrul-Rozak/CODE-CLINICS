<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $table = 'medical_records'; // Nama tabel di database

    protected $fillable = [
        'patient_id',
        'queue_number',
        'examination_date',
        'service',
        'complaint',
        'doctor_id',
        'diagnosis',
        'medication_id',
        'medication_quantity',
        'notes',
        'treatment',
        'new_entry',
        'blood_type',
        'height',
        'weight',
        'waist',
        'clinic_id',
        'status'
    ];

    protected $guarded = ['id'];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function medication()
    {
        return $this->belongsTo(Medication::class, 'medication_id');
    }

    public function clinic()
    {
        return $this->belongsTo(Clinic::class, 'clinic_id');
    }
}
