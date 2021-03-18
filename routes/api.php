<?php

use App\Models\RendezVous;
use App\Models\structure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/', function () {
       return response()->json(RendezVous::all()->groupBy('date'));
    
});
Route::get('/historique',[App\Http\Controllers\ControllerRendezVous::class,'historique']);
Route::apiResource('rendezvous',App\Http\Controllers\ControllerRendezVous::class);
Route::apiResource('volontaire',App\Http\Controllers\ControllerVolontaire::class);
Route::apiResource('structure',App\Http\Controllers\ControllerStructure::class);
Route::apiResource('materiel',App\Http\Controllers\ControllerMateriel::class);
Route::apiResource('fournisseur',App\Http\Controllers\ControllerFournisseur::class);
Route::apiResource('patient',App\Http\Controllers\ControllerPatient::class);
Route::apiResource('medecin',App\Http\Controllers\ControllerMedecin::class);
Route::apiResource('specialite',App\Http\Controllers\ControllerSpecialite::class);
Route::get('/a', function () {
    $structure = Structure::all();
    return response()->json($structure);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [App\Http\Controllers\UsersController::class, 'login']);
    Route::post('/register', [App\Http\Controllers\UsersController::class, 'register']);
    Route::post('/logout', [App\Http\Controllers\UsersController::class, 'logout']);
    Route::post('/refresh', [App\Http\Controllers\UsersController::class, 'refresh']);
    Route::get('/user-profile', [App\Http\Controllers\UsersController::class, 'userProfile']);    
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
