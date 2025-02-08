<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    protected $table = 'medications'; // Nama tabel di database
    protected $guarded = ['id'];


    protected $fillable = [
        'medication_code',
        'stock',
        'type_id',
        'name',
        'dosage',
        'price',
        'expiration_date',
        'photo',
    ];

    // Relasi ke tabel MedicationType
    public function type()
    {
        return $this->belongsTo(MedicationType::class, 'type_id');
    }
}
