<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;

    protected $fillable=["idFacture","reference","montant","priseEC","prixP","idPatient"];

    public function patient(){

        return $this->belongsTo("App\Models\patient","idPatient");
    }
}
