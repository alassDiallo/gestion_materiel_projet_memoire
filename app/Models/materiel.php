<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class materiel extends Model
{
    use HasFactory;
    protected $fillable = ['reference','type','prix','libelle'];
    protected $primaryKey = 'idMateriel';

    public function getRouteKeyName(){

        return 'reference';
    }

    public function volontaire(){

        return $this->belongsTo('App\Models\volontaire');
    }

    public function fournisseurs(){

        return $this->belongsToMany('App\Models\fournisseur','fournis','idMateriel','idFournisseur')
                                    ->withPivot('date','quantite')
                                    ->withTimestamps();
    }
   // protected $primaryKey ='idMateriel';
}
