<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analyse extends Model
{
    use HasFactory;
    protected $fillable = ['idAnalyse', 'libelle', 'prix', 'idPatient'];
    public function patient()
    {
        return $this->belongsTo("App\Models\patient");
    }
    protected $primaryKey = 'idAnalyse';
<<<<<<< HEAD
}
=======

    public function patients(){

        return $this->belongsToMany('App\Models\Patient','effectuers','idAnalyse','idPatient');
    }

    
}
>>>>>>> ba9d4fe5d15b5f73a425f584a92af5333bcc47ea
