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
}