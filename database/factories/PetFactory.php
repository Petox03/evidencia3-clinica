<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PetFactory extends Factory
{
    protected $model = \App\Models\Pet::class;

    public function definition()
    {
        return [
            'name' => $this->faker->firstName,
            'pet_type_id' => \App\Models\PetType::all()->random()->id,
            'age' => $this->faker->numberBetween(1, 15),
            'customer_id' => \App\Models\Customer::all()->random()->id,
            'is_hospitalized' => true
        ];
    }
}

