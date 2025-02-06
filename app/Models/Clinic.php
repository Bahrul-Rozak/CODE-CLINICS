<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    protected $guarded =['id'];

    public function doctor()
    {
        return $this->hasMany(Doctor::class);
    }
}
