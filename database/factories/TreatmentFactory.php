<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TreatmentFactory extends Factory
{
    protected $model = \App\Models\Treatment::class;

    public function definition()
    {
        return [
            'pet_id' => \App\Models\Pet::all()->random()->id,
            'medicine_id' => \App\Models\Medicine::all()->random()->id,
            'dose' => $this->faker->numberBetween(1, 3),
            'administration_time' => $this->faker->time,
        ];
    }
}
