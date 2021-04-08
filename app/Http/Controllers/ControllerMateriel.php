<?php

namespace App\Http\Controllers;

use App\Models\fournisseur;
use App\Models\materiel;
use App\Models\volontaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;
use DB;
use DataTable;
use Illuminate\Validation\Rule;


class ControllerMateriel extends Controller
{

    public function index()
    {
        $fournisseur = fournisseur::all();
        //$materiels = materiel::all();
        // return view("materiel.acceuil", compact('fournisseur'));
        return view("materiel.acceuil", ['fournisseur' => $fournisseur]);
    }
    public function listeDatatableMaterielFournisseur(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('materiels')
                ->join('fournis', 'fournis.idMateriel', '=', 'materiels.idMateriel')
                ->join('fournisseurs', 'fournisseurs.idFournisseur', '=', 'fournis.idFournisseur')
                ->get();

            return \DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<a class="btn  btn-sm btn-primary" href="javascript:void();" data-toggle="tooltip" data-id="' . $data->id . '" data-original-title="modifier" onclick="modifier(' . "'" . $data->reference . "'" . ')"><i class="fa fa-edit" style="color:white;"></i></a>
                                <a class="btn  btn-sm btn-danger" href="javascript:void();" data-toggle="tooltip" data-id="' . $data->id . '" data-original-title="supprimer" onclick="supprimer(' . "'" . $data->reference . "'" . ')"><i class="fa fa-trash-o" style="color:white;"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function create()
    {
        //
        // $fournisseurs = fournisseur::all();

        // return (view('materiel.create', compact('fournisseurs')));
    }


    public function store(Request $request)
    {

        $rules = [
            'prix' => 'required|double|min:1|max:1000000',
            'type' => 'required|string|min:3|max:40',
            'libelle' => 'required|string|min:3|max:40',
            'quantite' => 'required|integer|min:1|max:100'

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
        // $materiel = materiel::find($idMateriel);
        // $materiel->with('fournisseurs')->get();
        // return (view('materiel.show', compact('materiel')));
        $data = materiel::where('reference', $idMateriel)->with('fournisseurs')->get();
        return response()->json($data);
    }


    public function edit($idMateriel)
    {
        // //
        // $materiel = materiel::find($idMateriel);
        // $fournisseurs = fournisseur::all();
        // return (view('materiel.edit', compact('materiel', 'fournisseurs')));
    }


    public function update(Request $request, $idMateriel)
    {
        //

        $materiel = fournisseur::where('reference', $idMateriel)->first();
        $rules = [
            'prix' => 'required|double|min:1|max:1000000',
            'type' => 'required|string|min:3|max:40',
            'libelle' => 'required|string|min:3|max:40',
            'quantite' => 'required|integer|min:1|max:100'

        ];
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            return response()->json(['error' => $error->errors()]);
        }
        //return response()->json($request);
        $materiel->update([
            "prix" => $request->prix,
            "type" => $request->type,
            "libelle" => $request->libelle,
            "quantite" => $request->quantite,
            //Rule::unique('structures')->ignore($id)

        ]);

        $materiel->fournisseurs()->sync([$request->idFournisseur => ['date' => date('Y-m-d H:i:s'), 'quantite' => $request->quantite]]);
        return response()->json(['success' => 'enregistrement effectuer avec succé']);
    }


    public function destroy($idMateriel)
    {

        materiel::where('reference', $idMateriel)->delete();
        return response()->json(["donnee" => "suppression reussi"]);

        // $materiel = materiel::find($idMateriel);
        // $materiel->delete();
        // $materiel->fournisseurs()->detach();

        // return redirect()->route('materiel.index')
        //     ->with('success', 'Matériel supprimé avec succès .');
    }
    public function materielsVolontaire($id)
    {
        $materielsV = materiel::where('idVolontaire', $id)->get();
        return response()->json($materielsV);
    }
}