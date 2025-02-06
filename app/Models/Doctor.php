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
        'phone_number',
        'practice_schedule',
        'clinic_id'
    ];
}
