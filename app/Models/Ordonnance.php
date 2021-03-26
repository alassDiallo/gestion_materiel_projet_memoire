<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordonnance extends Model
{
    use HasFactory;
<<<<<<< HEAD
    protected $fillable = ['cout', 'idOrdonnance'];
=======
    protected $fillable =['cout','idOrdonnance','idMedecin'];
    protected $primaryKey = 'idOrdonnance';
>>>>>>> 682a8f0f72143615dbfd1b60c94fa39287e6dd6f

    public function medicaments()
    {

        return $this->belongsToMany('App\Models\Medicament', 'prescriptions', 'idOrdonnance', 'idMedicament')
            ->withPivot('quantite', 'indication')
            ->withTimestamps();
    }

    public function medecin()
    {

        return $this->belongsTo('App\Models\Medecin','idMedecin');
    }
}