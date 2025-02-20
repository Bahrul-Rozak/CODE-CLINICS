<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'patient_code',
        'name',
        'address',
        'birth_date',
        'gender',
        'phone',
        'religion',
        'education',
        'occupation',
        'national_id',
        'doctor_id'
    ];

    public function medical()
    {
        return $this->hasMany(MedicalRecord::class, 'patient_id');
    }

    // Relasi ke model Doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}
