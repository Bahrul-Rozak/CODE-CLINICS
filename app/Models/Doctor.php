<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    // protected $guarded = ['id'];

    protected $fillable = [
        'id',
        'name',
        'address',
        'phone',
        'practice_schedule',
        'clinic_id'
    ];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class, 'clinic_id');
    }
}
