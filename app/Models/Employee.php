<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'employee_code',
        'name',
        'address',
        'gender',
        'phone',
        'religion',
        'position'
    ];
}
