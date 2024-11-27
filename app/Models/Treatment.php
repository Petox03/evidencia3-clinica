<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    protected $fillable = ['pet_id', 'medicine_id', 'dose', 'administration_time'];

    // Relación con el modelo Pet
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    // Relación con el modelo Medicine
    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
}

