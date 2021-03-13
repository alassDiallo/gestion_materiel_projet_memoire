<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    public $donne;
    use HasFactory, Notifiable;
   

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'profil',
        'email',
        'password',
        'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullNameAttribute(){
      
        switch($this->profil){
            case "medecin":
                $this->donnee = Medecin::where('email',$this->email)->firstOrFail();
              
                break;
            case "volontaire":
                $donnee = volontaire::where('email',$this->email)->firstOrFail();
            break;
            case "admin":
                $donnee = User::where('email',$this->email)->firstOrFail();
                break;
                default :$donne=[];
                break;
        }

        return $this->donne;

    }
}
