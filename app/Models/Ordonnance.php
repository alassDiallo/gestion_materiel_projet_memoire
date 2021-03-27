<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordonnance extends Model
{
    use HasFactory;
    protected $fillable = ['cout', 'idOrdonnance'];

    public function medicaments()
    {

        return $this->belongsToMany('App\Models\Medicament', 'prescriptions', 'idOrdonnance', 'idMedicament')
            ->withPivot('quantite', 'indication')
            ->withTimestamps();
    }

    public function medecin()
    {

        return $this->belongTo('App\Models\Medecin');
    }
}