<?php

namespace Database\Seeders;

use App\Models\Analyse;
use Illuminate\Database\Seeder;

class AnalyseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Analyse::create([
            "libelle" => "TEST SANGUINE",
            "prix" => 10000.0,
           
        ]);
        Analyse::create([
            "libelle" => "SCANNER",
            "prix" => 15000.0,
           
        ]);
        Analyse::create([
            "libelle" => "analyse",
            "prix" => 6500.0,
            
        ]);
    }
}