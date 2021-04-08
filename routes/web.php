<?php

use App\Models\fournisseur;
use App\Models\Medecin;
use App\Models\RendezVous;
use App\Models\Specialite;
use App\Models\structure;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Mail;

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
// Route::get('/test-contact', function () {
//     ini_set('SMTP', "smtp.gmail.com");
//     return new App\Mail\Contact([
//         'nom' => 'Durand',
//         'email' => 'alassdiallo58@gmail.com',
//         'message' => 'Je voulais vous dire que votre site est magnifique !'
//     ]);
// });

// Route::post('/accorder', [App\Http\Controllers\ControllerRendezVous::class, 'accorder'])->name('accorder');

Route::get('/', function () {

    return redirect('/login');
    // $pdf = PDF::loadView('ordonnance.generer');
    // return  $pdf->download("/assane.pdf");
    // User::create([
    //     'email' => 'patient@gmail.com',
    //     'password' => Hash::make('12345678'),
    //     'profil' => 'patient',
    // ]);

    // User::create([

    //     'email' => 'vol@gmail.com',
    //     'password' => Hash::make('12345678'),
    //     'profil' => 'volontaire',
    // ]);

    // User::create([
    //     'email' => 'sbd@gmail.com',
    //     'password' => Hash::make('12345678'),
    //     'profil' => 'medecin',
    // ]);
    // User::create([
    //     'email' => 'assane@gmail.com',
    //     'password' => Hash::make('12345678'),
    //     'profil' => 'admin',
    // ]);

    //dd(RendezVous::all()->groupBy('date'));
    //     $pdf = PDF::loadView('ordonnance.generer');
    //   return  $pdf->download("/ordonnance/assane.pdf");
    //return view('ordonnance.generer');


});

// Route::get('sendbasicemail', [App\Http\Controllers\MailController::class, 'basic_email']);
// Route::post('/modifierRV', [App\Http\Controllers\ControllerMedecin::class, 'modifierRv']);
// Route::get('/valider/{id}', [App\Http\Controllers\ControllerMedecin::class, 'valider']);
// Route::get('/accueilvolontaire', [App\Http\Controllers\ControllerVolontaire::class, 'accueil']);
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




Route::get('/f/{fn}', function (Request $request) {
    return response()->json($request);
});


Route::group(['middleware' => 'auth'], function ($route) {
    
    Route::get('/str', function () {
        return view('structure.accueil_structure');
    });
    Route::get("/monCalendrier", [App\Http\Controllers\ControllerMedecin::class, 'calendrier']);
    Route::get('/calendrier', function () {
        return view('medecin.calendrier');
    });
    Route::get('/specialites', function () {
        return view('specialites.accueilSpecialite');
    });
    Route::get('/rv', function () {
        $medecin = Medecin::where('email', Auth::user()->email)->first();
        $rev = RendezVous::where('idMedecin', $medecin->idMedecin)->where('etat', 'accepter')
            ->join('patients', 'patients.idPatient', '=', 'rendez_vouses.idPatient')
            ->get();
        foreach ($rev as $r) {
            $data[] = array(
                'id' => $r->id,
                'start' => $r->date . " " . str_replace('h', ':', $r->heure),
                'title' => $r->prenom . "  " . $r->nom

            );
        }

        return response()->json($data);
    });
    Route::post('/accorder', [App\Http\Controllers\ControllerRendezVous::class, 'accorder'])->name('accorder');
    Route::resource('specialite', App\Http\Controllers\ControllerSpecialite::class);
    Route::get('sendbasicemail', [App\Http\Controllers\MailController::class, 'basic_email']);
    Route::post('/modifierRV', [App\Http\Controllers\ControllerMedecin::class, 'modifierRv']);
    Route::get('/valider/{id}', [App\Http\Controllers\ControllerMedecin::class, 'valider']);
    Route::get('/accueilvolontaire', [App\Http\Controllers\ControllerVolontaire::class, 'accueil']);


    Route::get('/comptabilite', function () {
        return view('comptabilite.comptabilite');
    });

    Route::get('/statistique', function () {
        return view('statistique.statistique');
    });

    Route::get('/listeRendezvous', [App\Http\Controllers\ControllerMedecin::class, 'liste']);
    Route::get('/medecins', function () {
        $specialite = Specialite::all();
        $structure = Structure::all();

        return view('jika.accueilMedecin', ['structure' => $structure, 'specialite' => $specialite]);
    });
    Route::get('/accueiljica', function () {
        return view('jika.accueilJika');
    });

    Route::get('/lm', function () {
        return view('medecin.listeDemande');
    });
    Route::get('/s', function () {
        return view('structure.accueil_structure');
    });

    Route::get("/accueilmedecin", function () {

        return view("medecin.accueilMedecin");
    });

    Route::get('/accueilMateriel', function () {
        $fournisseur = fournisseur::all();
        return view('materiel.acceuil',['fournisseur'=>$fournisseur]);
    });
    Route::get('/accueilFournisseur', function () {
        return view('fournisseur.acceuil');
    });

    Route::get('/str', function () {
        return view('structure.accueil_structure');
    });
    Route::get("/monCalendrier", [App\Http\Controllers\ControllerMedecin::class, 'calendrier']);
    Route::get('/calendrier', function () {
        return view('medecin.calendrier');
    });

    Route::resource('prescription', App\Http\Controllers\ControllerPrescription::class);
    Route::resource('analyse', App\Http\Controllers\ControllerAnalyse::class);
    Route::get("/valider", [App\Http\Controllers\ControllerOrdonnance::class, 'valider'])->name('valider');
    Route::resource('medicament', App\Http\Controllers\ControllerMedicament::class);
    Route::get('listeData', [App\Http\Controllers\ControllerMateriel::class, 'listeDatatableMaterielFournisseur'])->name('listeDMF');
    Route::get('liste', [App\Http\Controllers\ControllerVolontaire::class, 'liste'])->name('listeVolontaire');
    Route::get("rendezvous", [App\Http\Controllers\ControllerRendezVous::class, 'index']);
    Route::resource('volontaire', App\Http\Controllers\ControllerVolontaire::class);
    Route::resource('structure', App\Http\Controllers\ControllerStructure::class);
    Route::resource('ordonnance', App\Http\Controllers\ControllerOrdonnance::class);
    Route::resource('medecin', App\Http\Controllers\ControllerMedecin::class);
    Route::resource('materiel', App\Http\Controllers\ControllerMateriel::class);
    Route::resource('patient', App\Http\Controllers\ControllerPatient::class);
    Route::resource('fournisseur', App\Http\Controllers\ControllerFournisseur::class);
    Route::resource('rendezvous', App\Http\Controllers\ControllerRendezVous::class);
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');