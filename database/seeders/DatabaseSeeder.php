<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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

        DB::table('roles')->insert([ 'name' => 'admin', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(), ]);
        DB::table('roles')->insert([ 'name' => 'empleado', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(), ]);
        DB::table('roles')->insert([ 'name' => 'recepcionista', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(), ]);

        DB::table('model_has_roles')->insert([ 'role_id' => 1, 'model_type' => 'App\Models\User', 'model_id' => 1, ]);

        $this->call([PetTypeSeeder::class, CustomerSeeder::class, PetSeeder::class, MedicineSeeder::class, TreatmentSeeder::class,]);
    }
}
