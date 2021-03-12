<?php

namespace Database\Seeders;
use App\Models\Patient;

use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Patient::create([
            "referencePatient"=>referencePatient(),
            "nom"=>"datte",
            "prenom"=>"ibou",
            "dateDeNaissance"=>Date("Y/m/d"),
            "lieuDeNaissance"=>"dakar",
            "adresse"=>"dakar",
            "telephone"=>"777777779",
            "sexe"=>"homme",
            "numeroCIN"=>"numCIN".rand(1000,100000),
            "etat"=>"enRegle"
           
       ]);

       Patient::create([
        "referencePatient"=>referencePatient(),
        "nom"=>"dia",
        "prenom"=>"laye",
        "dateDeNaissance"=>Date("Y/m/d"),
        "lieuDeNaissance"=>"dakar",
        "adresse"=>"dakar",
        "telephone"=>"777777778",
        "sexe"=>"homme",
        "numeroCIN"=>"numCIN".rand(1000,100000),
        "etat"=>"enRegle"
       
   ]);

   Patient::create([
    "referencePatient"=>referencePatient(),
    "nom"=>"ndiaye",
    "prenom"=>"ousmane",
    "dateDeNaissance"=>Date("Y/m/d"),
    "lieuDeNaissance"=>"dakar",
    "adresse"=>"dakar",
    "telephone"=>"777777774",
    "sexe"=>"homme",
    "numeroCIN"=>"numCIN".rand(1000,100000),
    "etat"=>"enRegle"
   
]);

Patient::create([
    "referencePatient"=>referencePatient(),
    "nom"=>"sankare",
    "prenom"=>"djibi",
    "dateDeNaissance"=>Date("Y/m/d"),
    "lieuDeNaissance"=>"dakar",
    "adresse"=>"dakar",
    "telephone"=>"777777776",
    "sexe"=>"homme",
    "numeroCIN"=>"numCIN".rand(1000,100000),
    "etat"=>"enRegle"
   
]);

Patient::create([
    "referencePatient"=>referencePatient(),
    "nom"=>"diagne",
    "prenom"=>"modou",
    "dateDeNaissance"=>Date("Y/m/d"),
    "lieuDeNaissance"=>"dakar",
    "adresse"=>"dakar",
    "telephone"=>"777777775",
    "sexe"=>"homme",
    "numeroCIN"=>"numCIN".rand(1000,100000),
    "etat"=>"enRegle"
   
]);
    }
}
