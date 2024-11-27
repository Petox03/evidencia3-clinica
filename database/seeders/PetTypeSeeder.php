<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PetType;

class PetTypeSeeder extends Seeder
{
    public function run()
    {
        PetType::create(['type' => 'Perro']);
        PetType::create(['type' => 'Gato']);
        PetType::create(['type' => 'Ave']);
        // Agrega más tipos de mascotas según sea necesario
    }
}
