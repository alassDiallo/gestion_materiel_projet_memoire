<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    use HasFactory;
    protected $fillable = ["idDepense","description","cout","idVolontaire"];

    public function volontaire(){

        return $this->belongsTo("App\Models\volontaire",'idVolontaire');
    }
}
