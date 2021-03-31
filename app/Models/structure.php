<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class structure extends Model
{
    use HasFactory;
    protected $fillable = ['nomStructure','adresse','telephoneStructure','referenceStructure','region'];
    protected $primaryKey = 'idStructure';

    public function getRouteKeyName(){

        return 'reference';
    }

    public function patients(){
        return $this->BelongsToMany(' App\Models\patient','consulters','idStructure','idPatient')
                                    ->withTimestamps();
    }

    public function volontaires(){
        return $this->belongsToMany('App\Models\volontaire',"durer","idStructure","idVolontaire")
                    ->withPivot("dateDebut","dateFin")
                    ->withTimestamps();
    }

    public function medecins(){

        return $this->belongsToMany("App\Models\Medecin","periodes","idStructure","idMedecin")
                    ->withPivot("dateDebut","dateFin")
                    ->withTimestamps();
    }
}
