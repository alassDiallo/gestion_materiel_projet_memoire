<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medecin extends Model
{
    use HasFactory;
    protected $fillable = ["idMedecin","reference","nom","prenom","dateDeNaissance","lieuDeNaissance","sexe","adresse","telephone","email","description","idSpecialite"];

    protected $primaryKey='idMedecin';
    public function specialite(){

        return $this->belongsTo("App\Models\Specialite");
    }

    public function structures(){

        return $this->belongsToMany("App\Models\Medecin","periodes","idMedecin","idStructure")
                    ->withPivot("dateDebut","dateFin")
                    ->withTimestamps();
    }

    public function patients(){

        return $this->belongsToMany("App\Models\patient","consulters","idMedecin","idPatient")
                    ->withPivot("date")
                    ->withTimestamps();
    }

    public function ordonnances(){

        return $this->belongsToMany('App\Models\Ordonnance','idMedecin');
    }
    
}
