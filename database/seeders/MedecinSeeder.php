<?php

namespace Database\Seeders;
use App\Models\Medecin;

use Illuminate\Database\Seeder;

class MedecinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Medecin::create([
            "reference"=>referenceMedecin(),
            "nom"=>"diallo",
            "prenom"=>"assane",
            "dateDeNaissance"=>Date("Y/m/d"),
            "lieuDeNaissance"=>"dakar",
            "adresse"=>"dakar",
            "telephone"=>"777777777",
            "email"=>"al@gmail.com",
            "sexe"=>"homme",
            "idSpecialite"=>rand(1,5)
       ]);

       Medecin::create([
        "reference"=>referenceMedecin(),
        "nom"=>"ndiaye",
        "prenom"=>"laye",
        "dateDeNaissance"=>Date("Y/m/d"),
        "lieuDeNaissance"=>"dakar",
        "adresse"=>"dakar",
        "telephone"=>"777777770",
        "email"=>"al0@gmail.com",
        "sexe"=>"homme",
        "idSpecialite"=>rand(1,5)
   ]);

   Medecin::create([
    "reference"=>referenceMedecin(),
    "nom"=>"dabo",
    "prenom"=>"bass",
    "dateDeNaissance"=>Date("Y/m/d"),
    "lieuDeNaissance"=>"dakar",
    "adresse"=>"dakar",
    "telephone"=>"777777771",
    "email"=>"al1@gmail.com",
    "sexe"=>"homme",
    "idSpecialite"=>rand(1,5)
])->structures()->attach([rand(1,5)],["dateDebut"=>date("Y/m/d")]);;

Medecin::create([
    "reference"=>referenceMedecin(),
    "nom"=>"cisse",
    "prenom"=>"yakhouba",
    "dateDeNaissance"=>Date("Y/m/d"),
    "lieuDeNaissance"=>"dakar",
    "adresse"=>"dakar",
    "telephone"=>"777777772",
    "email"=>"al2@gmail.com",
    "sexe"=>"homme",
    "idSpecialite"=>rand(1,5)
])->structures()->attach([rand(1,5)],["dateDebut"=>date("Y/m/d")]);;

Medecin::create([
    "reference"=>referenceMedecin(),
    "nom"=>"traore",
    "prenom"=>"makhan",
    "dateDeNaissance"=>Date("Y/m/d"),
    "lieuDeNaissance"=>"dakar",
    "adresse"=>"dakar",
    "telephone"=>"777777773",
    "email"=>"al3@gmail.com",
    "sexe"=>"homme",
    "idSpecialite"=>rand(1,5)
])->structures()->attach([rand(1,5)],["dateDebut"=>date("Y/m/d")]);
    }
}
