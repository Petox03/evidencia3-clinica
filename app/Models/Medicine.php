<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'administration', 'amount'];

    // Relación con el modelo Treatment
    public function treatments()
    {
        return $this->hasMany(Treatment::class);
    }
}
