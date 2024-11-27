<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PetType;

class PetTypeSeeder extends Seeder
{
    public function run()
    {
        PetType::create(['type' => 'Dog']);
        PetType::create(['type' => 'Cat']);
        PetType::create(['type' => 'Bird']);
        // Agrega más tipos de mascotas según sea necesario
    }
}
