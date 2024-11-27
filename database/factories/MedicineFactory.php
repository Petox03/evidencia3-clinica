<?php

namespace Database\Factories;

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MedicineFactory extends Factory
{
    protected $model = \App\Models\Medicine::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'administration' => $this->faker->randomElement(['Oral', 'Injection']),
            'amount' => $this->faker->numberBetween(5, 30),
        ];
    }
}

