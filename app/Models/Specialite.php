<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialite extends Model
{
    use HasFactory;

    protected $fillable = ["idSpecialite","reference","libelle","prixConsultation"];
    protected $primaryKey = 'idSpecialite';

    public function medecins(){

        return $this->hasMany("App\Models\Medecin","idSpecialite");
    }

    
}
