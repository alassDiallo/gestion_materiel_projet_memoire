<?php

use App\Models\Medecin;
use App\Models\RendezVous;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {

    // User::create([
    // 'email'=>'assane@gmail.com',
    // 'password'=>Hash::make('12345678'),
    // 'profil'=>'admin',
    // ]);

    // User::create([
    //     'email'=>'dabo@gmail.com',
    //     'password'=>Hash::make('12345678'),
    //     'profil'=>'volontaire',
    //     ]);

    //     User::create([
    //         'email'=>'sbd@gmail.com',
    //         'password'=>Hash::make('12345678'),
    //         'profil'=>'medecin',
    //         ]);

        dd(RendezVous::all()->groupBy('date'));
    //return view('jika.accueilJika');

});
Route::get('/vol', function () {
    return view('volontaire.accueil_volontaire');
    
});

Route::get('/listeRendezvous',[App\Http\Controllers\ControllerMedecin::class,'liste']);

Route::get('/lm',function(){
    return view('medecin.listeDemande');
});
Route::get('/s', function () {
    return view('structure.accueil_structure');
    
});

Route::get("/m",function(){

    return view("medecin.accueilMedecin");
});

Route::get('/str',function(){
    return view('structure.accueil_structure');
});
Route::get('liste',[App\Http\Controllers\ControllerVolontaire::class,'liste'])->name('listeVolontaire');
Route::get("rendezvous",[App\Http\Controllers\ControllerRendezVous::class,'index']);
Route::resource('volontaire',App\Http\Controllers\ControllerVolontaire::class);
Route::resource('structure',App\Http\Controllers\ControllerStructure::class);

Route::resource('materiel',App\Http\Controllers\ControllerMateriel::class);
Route::resource('fournisseur',App\Http\Controllers\ControllerFournisseur::class);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
