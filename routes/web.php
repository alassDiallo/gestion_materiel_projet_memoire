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
Route::get('/test-contact', function () {
    ini_set('SMTP', "smtp.gmail.com");
    return new App\Mail\Contact([
        'nom' => 'Durand',
        'email' => 'alassdiallo58@gmail.com',
        'message' => 'Je voulais vous dire que votre site est magnifique !'
    ]);
});
Route::get('/', function () {

    $pdf = PDF::loadView('ordonnance.generer');
    return  $pdf->download("/assane.pdf");
    // User::create([
    // 'email'=>'patient@gmail.com',
    // 'password'=>Hash::make('12345678'),
    // 'profil'=>'patient',
    // ]);

    // User::create([
    //     'email'=>'vol@gmail.com',
    //     'password'=>Hash::make('12345678'),
    //     'profil'=>'volontaire',
    //     ]);

    //     User::create([
    //         'email'=>'sbd@gmail.com',
    //         'password'=>Hash::make('12345678'),
    //         'profil'=>'medecin',
    //         ]);

    //dd(RendezVous::all()->groupBy('date'));
    //     $pdf = PDF::loadView('ordonnance.generer');
    //   return  $pdf->download("/ordonnance/assane.pdf");
    //return view('ordonnance.generer');


});

Route::get('sendbasicemail', [App\Http\Controllers\MailController::class, 'basic_email']);
Route::post('/modifierRV', [App\Http\Controllers\ControllerMedecin::class, 'modifierRv']);
Route::get('/valider/{id}', [App\Http\Controllers\ControllerMedecin::class, 'valider']);
Route::get('/vol', function () {
    return view('volontaire.accueil_volontaire');
});

Route::get('/test-contact', function () {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    $from = "azoistar10@gmail.com";
    $to = "alassdiallo58@gmail.Com";
    $subject = "Essai de PHP Mail";
    $message = "PHP Mail fonctionne parfaitement";
    $headers = "De :" . $from;
    mail($to, $subject, $message, $headers);
    return "L'email a été envoyé.";
});

<<<<<<< HEAD
Route::get('/listeRendezvous', [App\Http\Controllers\ControllerMedecin::class, 'liste']);
=======
Route::get('/listeRendezvous',[App\Http\Controllers\ControllerMedecin::class,'liste']);
Route::get('/accueiljica',function(){
    return view('jika.accueilJika');
});
>>>>>>> 682a8f0f72143615dbfd1b60c94fa39287e6dd6f

Route::get('/lm', function () {
    return view('medecin.listeDemande');
});
Route::get('/s', function () {
    return view('structure.accueil_structure');
});

Route::get("/m", function () {

    return view("medecin.accueilMedecin");
});

Route::get('/accueilMateriel', function () {
    return view('materiel.acceuil');
});
Route::get('/accueilFournisseur', function () {
    return view('fournisseur.acceuil');
});

Route::get('/str', function () {
    return view('structure.accueil_structure');
});
<<<<<<< HEAD
Route::get('/calendrier', function () {
    return view('medecin.calendrier');
});

Route::resource('prescription', App\Http\Controllers\ControllerPrescription::class);
Route::post("/valider", [App\Http\Controllers\ControllerOrdonnance::class, 'valider'])->name('valider');
Route::resource('medicament', App\Http\Controllers\ControllerMedicament::class);
Route::get('liste', [App\Http\Controllers\ControllerVolontaire::class, 'liste'])->name('listeVolontaire');
Route::get("rendezvous", [App\Http\Controllers\ControllerRendezVous::class, 'index']);
Route::resource('volontaire', App\Http\Controllers\ControllerVolontaire::class);
Route::resource('structure', App\Http\Controllers\ControllerStructure::class);
Route::resource('ordonnance', App\Http\Controllers\ControllerOrdonnance::class);

Route::resource('materiel', App\Http\Controllers\ControllerMateriel::class);
Route::resource('patient', App\Http\Controllers\ControllerPatient::class);
Route::resource('fournisseur', App\Http\Controllers\ControllerFournisseur::class);
Route::resource('rendezvous', App\Http\Controllers\ControllerRendezVous::class);
=======
Route::get('/calendrier',function(){
    return view('medecin.calendrier');
});

Route::resource('prescription',App\Http\Controllers\ControllerPrescription::class);
Route::get("/valider",[App\Http\Controllers\ControllerOrdonnance::class,'valider'])->name('valider');
Route::resource('medicament',App\Http\Controllers\ControllerMedicament::class);
Route::get('liste',[App\Http\Controllers\ControllerVolontaire::class,'liste'])->name('listeVolontaire');
Route::get("rendezvous",[App\Http\Controllers\ControllerRendezVous::class,'index']);
Route::resource('volontaire',App\Http\Controllers\ControllerVolontaire::class);
Route::resource('structure',App\Http\Controllers\ControllerStructure::class);
Route::resource('ordonnance',App\Http\Controllers\ControllerOrdonnance::class);

Route::resource('materiel',App\Http\Controllers\ControllerMateriel::class);
Route::resource('patient',App\Http\Controllers\ControllerPatient::class);
Route::resource('fournisseur',App\Http\Controllers\ControllerFournisseur::class);
Route::resource('rendezvous',App\Http\Controllers\ControllerRendezVous::class);
>>>>>>> 682a8f0f72143615dbfd1b60c94fa39287e6dd6f


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');