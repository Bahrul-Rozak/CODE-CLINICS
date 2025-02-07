<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    // protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'address',
        'phone',
        'schedule_id',
        'clinic_id'
    ];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class, 'clinic_id');
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id'); // <-- Relasi ke Schedule
    }
}
