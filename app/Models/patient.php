<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class patient extends Model
{
    use HasFactory;
<<<<<<< HEAD
    protected $fillable = ['nom', 'prenom', 'adresse', 'telephone', 'dateDeNaissance', 'lieuDeNaissance', 'sexe', 'numeroCIN', 'referencePatient'];

<<<<<<< HEAD
=======
    protected $fillable = ['nom','prenom','adresse','telephone','dateDeNaissance','lieuDeNaissance','sexe','numeroCIN','referencePatient'];
    protected $primaryKey = 'idPatient';
>>>>>>> 682a8f0f72143615dbfd1b60c94fa39287e6dd6f
   public function getRouteKeyName(){
=======
    public function getRouteKeyName()
    {
>>>>>>> sbd

        return 'referencePatient';
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