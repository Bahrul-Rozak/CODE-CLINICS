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
        'national_id'
    ];
}
