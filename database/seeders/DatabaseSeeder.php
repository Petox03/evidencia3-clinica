<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Alberto Sosa',
            'email' => 'admin@filamentphp.com',
            'password' => '$2y$12$p9Krjec/15cAth90GisgVe3uHCucUuYWrxNmN74dc8/xO1dtlxoii'
        ]);

        $this->call([PetTypeSeeder::class, CustomerSeeder::class, PetSeeder::class, MedicineSeeder::class, TreatmentSeeder::class,]);
    }
}
