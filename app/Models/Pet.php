<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'pet_type_id', 'age', 'customer_id'];

    // Relación con el modelo PetType
    public function petType()
    {
        return $this->belongsTo(PetType::class);
    }

    // Relación con el modelo Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relación con el modelo Treatment
    public function treatments()
    {
        return $this->hasMany(Treatment::class);
    }
}

