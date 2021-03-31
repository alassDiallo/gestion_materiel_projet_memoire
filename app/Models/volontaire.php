<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class volontaire extends Model
{
    use HasFactory;

    protected $fillable = ['nom','prenom','adresse','telephone','dateDeNaissance','lieuDeNaissance','email','numeroCIN','referenceVolontaire','etat','idStructure','sexe'];

    public function getRouteKeyName()
    {
        
        return 'reference';
    }
    
    public function structures(){

        return $this->belongsToMany('App\Models\structure','durer','idVolontaire','idStructure')
                    ->withPivot("dateDebut","dateFin")
                    ->withTimestamps();
    }

    public function materiels(){

        return $this->hasMany('App\Models\materiel','idVolontaire');
    }

    public function depenses(){

        return $this->hasMany('App\Models\Depense');
    }
}
