<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Analyse extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ana
        Analyse::create([
            "libelle"=>"Ammoniémie",
            "prix"=>5000
        ]);
    }
}
