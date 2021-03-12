<?php

namespace Database\Seeders;
use App\Models\Specialite;

use Illuminate\Database\Seeder;

class SpecialiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Specialite::create([
        "reference"=>referenceSpecialite(),
        "libelle"=>"OPHTALMOLOGIE",
        "prixConsultation"=>5000.00
      ]);

      Specialite::create([
        "reference"=>referenceSpecialite(),
        "libelle"=>"CARDIOLOGIE",
        "prixConsultation"=>5000.00
      ]);

      Specialite::create([
        "reference"=>referenceSpecialite(),
        "libelle"=>"NEUROLOGIE",
        "prixConsultation"=>5000.00
      ]);

      Specialite::create([
        "reference"=>referenceSpecialite(),
        "libelle"=>"PNEUMOLOGIE",
        "prixConsultation"=>5000.00
      ]);

      Specialite::create([
        "reference"=>referenceSpecialite(),
        "libelle"=>"GYNECOLOGIE",
        "prixConsultation"=>5000.00
      ]);

      Specialite::create([
        "reference"=>referenceSpecialite(),
        "libelle"=>"RADIOLOGIE",
        "prixConsultation"=>5000.00
      ]);
    }
}
