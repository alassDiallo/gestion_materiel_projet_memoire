<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class consultation extends Model
{
    use HasFactory;
    protected $fillable = ['nomMedecin','telephoneMedecin','referenceConsultation','date','prixConsultation'];

    public function getRouteKeyName()
    {
        
        return 'referenceConsultation';
    }

    public function patient(){

        return $this->belongsTo('App\Models\patient','idPatient');
    }
}
