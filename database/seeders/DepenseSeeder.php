<?php

namespace Database\Seeders;

use App\Models\Depense;
use Illuminate\Database\Seeder;

class DepenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Depense::create([
            "description" => "Achat de materiel",
            "cout" => 10000.0,
            "idVolontaire" => rand(1, 3)
        ]);
        Depense::create([
            "description" => "Frais de voyage",
            "cout" => 10000.0,
            "idVolontaire" => rand(1, 3)
        ]);
        Depense::create([
            "description" => "Frais de voyage",
            "cout" => 10000.0,
            "idVolontaire" => rand(1, 3)
        ]);
    }
}