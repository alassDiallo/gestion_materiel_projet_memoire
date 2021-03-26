<?php

namespace App\Http\Controllers;

use App\Models\fournisseur;
use App\Models\materiel;
use App\Models\volontaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Illuminate\Validation\Rule;

class ControllerMateriel extends Controller
{

    public function index()
    {

        $materiels = materiel::all();

        return response()->json($materiels);
        //return ( view('materiel.acceuil',compact('materiels')));
    }


    public function create()
    {
        //
        $fournisseurs = fournisseur::all();

        return (view('materiel.create', compact('fournisseurs')));
    }


    public function store(Request $request)
    {

        $rules = [
            'prix' => 'required',
            'type' => 'required',
            'libelle' => 'required',
            'quantite' => 'required'

        ];

        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            return response()->json(['error' => $error->errors()]);
        }
        $materiel = materiel::create([
            "libelle" => $request->libelle,
            "type" => $request->type,
            "prix" => $request->prix,
            "reference" => referenceMateriel()
        ]);
        $materiel->fournisseurs()->attach($request->idFournisseur, ['date' => date('Y-m-d H:i:s'), 'quantite' => $request->quantite]);
        //  return redirect()->route('materiel.index')
        //     ->with('success', 'Matériel creé avec succès.');
        return response()->json(["success" => "material enregistrer avec succé"]);
    }


    public function show($idMateriel)
    {
        //
        $materiel = materiel::find($idMateriel);
        $materiel->with('fournisseurs')->get();
        return (view('materiel.show', compact('materiel')));
    }


    public function edit($idMateriel)
    {
        //
        $materiel = materiel::find($idMateriel);
        $fournisseurs = fournisseur::all();
        return (view('materiel.edit', compact('materiel', 'fournisseurs')));
    }


    public function update(Request $request, $idMateriel)
    {
        //
        $request->validate([
            'reference' => 'required',
            'prix' => 'required',
            'type' => 'required',
            'libelle' => 'required',
            'quantite' => 'required'
        ]);
        $materiel = materiel::find($idMateriel);
        $materiel->update($request->all());
        $materiel->fournisseurs()->sync([$request->idFournisseur => ['date' => date('Y-m-d H:i:s'), 'quantite' => $request->quantite]]);
        // $materiel->fournisseurs()->sync($request->idFournisseur,['date'=>date('Y-m-d H:i:s'),'quantite'=>$request->quantite]);
        //$materiel->fournisseurs()->sync(['date'=>date('Y-m-d H:i:s'),'quantite'=>$request->quantite]);
        return redirect()->route('materiel.index')
            ->with('success', 'Matériel modifié avec succès.');
    }


    public function destroy($idMateriel)
    {
        //
        $materiel = materiel::find($idMateriel);
        $materiel->delete();
        $materiel->fournisseurs()->detach();

        return redirect()->route('materiel.index')
            ->with('success', 'Matériel supprimé avec succès .');
    }
    public function materielsVolontaire($id)
    {
        $materielsV = materiel::where('idVolontaire', $id)->get();
        return response()->json($materielsV);
    }
}