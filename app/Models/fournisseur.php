<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fournisseur extends Model
{
    use HasFactory;
    protected $fillable = ['referenceFournisseur','nom','telephone','email','adresse'];
    protected $primaryKey = 'idFournisseur';

    public function getRouteKeyName()
    {

        return 'referenceFournisseur';
    }

    public function materiels(){


        return $this->belongsToMany('App\Models\materiel','fournis',' idFournisseur','idMateriel')
                                    ->withPivot('quantite','date')
                                    ->withTimestamps();
    }
    //protected $primaryKey ='idFournisseur';
}
