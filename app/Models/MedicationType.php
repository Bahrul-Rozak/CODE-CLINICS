<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicationType extends Model
{
    // protected $fillable = ['medication_type'];

    protected $fillable = ['medication_type'];
    protected $table = 'medications_type'; // Tentukan nama tabel secara eksplisit

    protected $guarded = ['id'];
}
