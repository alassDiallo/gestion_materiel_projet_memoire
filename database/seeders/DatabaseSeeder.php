<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SpecialiteSeeder::class);
        $this->call(PatientSeeder::class);
        $this->call(MedecinSeeder::class);
        $this->call(FournisseurSeeder::class);
        $this->call(DepenseSeeder::class);
        $this->call(AnalyseSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}