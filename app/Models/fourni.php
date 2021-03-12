<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fourni extends Model
{
    use HasFactory;
    protected $fillable = ['date','quantite'];
}
