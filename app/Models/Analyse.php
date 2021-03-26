<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analyse extends Model
{
    use HasFactory;
<<<<<<< HEAD
    protected $fillable = ['idAnalyse', 'libelle', 'prix', 'idPatient'];
    public function patient()
    {
        return $this->belongsTo("App\Models\patient");
    }
}
=======
    protected $fillable=['idAnalyse','libelle','prix'];
    protected $primaryKey = 'idAnalyse';

    
}
>>>>>>> 682a8f0f72143615dbfd1b60c94fa39287e6dd6f
