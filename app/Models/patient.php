<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class patient extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'prenom', 'adresse', 'telephone', 'dateDeNaissance', 'lieuDeNaissance', 'sexe', 'numeroCIN', 'referencePatient'];

    public function getRouteKeyName()
    {

        return 'referencePatient';
    }
    public function patients()
    {

        return $this->belongsToMany('App\Models\Analyse', 'effectuers', 'idPatient', 'idAnalyse');
    }

    public function structures()
    {

        return $this->belongsToMany('App\Models\structure', 'consulters', 'idPatient', 'idStructure')
            ->withTimestamps();
    }

    public function consultations()
    {

        return $this->hasMany('App\Models\consultation')
            ->withTimestamps();
    }

    public function factures()
    {

        return $this->hasMany("App\Models\Facture");
    }
    public function analyses()
    {

        return $this->hasMany("App\Models\Analyse");
    }

    public function medecins()
    {

        return $this->belongsToMany("App\Models\Medecin", "consulters", "idPatient", "idMedecin")
            ->withPivot("date")
            ->withTimestamps();
    }
}