<?php

namespace Database\Seeders;

use App\Models\fournisseur;
use Illuminate\Database\Seeder;

class FournisseurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        fournisseur::create(
            [
                "referenceFournisseur" => referenceFournisseur(),
                "nom" => "SenTech",
                "telephone" => "755555555",
                "email" => "sentech@gmail.com",
                "adresse" => "DAKAR",
            ]
        );
        fournisseur::create(
            [
                "referenceFournisseur" => referenceFournisseur(),
                "nom" => "DialloInformatique",
                "telephone" => "777774777",
                "email" => "dialloinf@gmail.com",
                "adresse" => "DAKAR",
            ]
        );
        fournisseur::create(
            [
                "referenceFournisseur" => referenceFournisseur(),
                "nom" => "CYCMultimedia",
                "telephone" => "777723777",
                "email" => "cyc@gmail.com",
                "adresse" => "Keur Ndiaye Lo",
            ]
        );
        fournisseur::create(
            [
                "referenceFournisseur" => referenceFournisseur(),
                "nom" => "GALSENDEV",
                "telephone" => "788888888",
                "email" => "GAlsen@gmail.com",
                "adresse" => "THIES",
            ]
        );
        fournisseur::create(
            [
                "referenceFournisseur" => referenceFournisseur(),
                "nom" => "TechSN",
                "telephone" => "777777777",
                "email" => "sensn@gmail.com",
                "adresse" => "DAKAR",
            ]
        );
    }
}