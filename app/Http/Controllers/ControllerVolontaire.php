<?php

namespace App\Http\Controllers;

use App\Models\materiel;
use App\Models\structure;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\volontaire;
use Validator;
use DataTables;
use Hash;
use DB;
use Illuminate\Validation\Rule;

class ControllerVolontaire extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $volontaires = volontaire::all();
        $structure = structure::all();
        $materiel = materiel::all();

        return view('volontaire.accueil_volontaire', ['structure' => $structure, 'materiel' => $materiel]);
    }

    public function accueil()
    {
        $volontaires = volontaire::all();
        $structure = structure::all();
        $materiel = materiel::all();

        return view('volontaire.accueil', ['structure' => $structure, 'materiel' => $materiel]);
    }

    public function liste(Request $request)
    {

        if ($request->ajax()) {
            $data = DB::table('volontaires')
                ->join('durer', 'durer.idVolontaire', '=', 'volontaires.idVolontaire')
                ->join('structures', 'structures.idStructure', '=', 'durer.idStructure')
                ->get();
            return \DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<a class="btn  btn-sm btn-warning" href="javascript:void();" data-toggle="tooltip" data-id="' . $data->referenceVolontaire . '" data-original-title="modifier" onclick="voir(' . "'" . $data->referenceVolontaire . "'" . ')"><i class="fa fa-eye" style="color:white;"></i></a>
                                <a class="btn  btn-sm btn-primary" href="javascript:void();" data-toggle="tooltip" data-id="' . $data->referenceVolontaire . '" data-original-title="modifier" onclick="modifier(' . "'" . $data->referenceVolontaire . "'" . ')"><i class="fa fa-edit" style="color:white;"></i></a>
                                <a class="btn  btn-sm btn-danger" href="javascript:void();" data-toggle="tooltip" data-id="' . $data->referenceVolontaire . '" data-original-title="supprimer" onclick="supprimer(' . "'" . $data->referenceVolontaire . "'" . ')"><i class="fa fa-trash-o" style="color:white;"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $annee = date('d-m-Y', strtotime(date('Y-m-d') . "-18 years"));
        $rule = [
            'nom' => 'required | string | min :2',
            'prenom' => 'required| string | min:2',
            'dateDeNaissance' => 'required| date | before_or_equal:' . $annee,
            'lieuDeNaissance' => 'required|string |min:2',
            'adresse' => 'required|string',
            'sexe' => 'required',
            'telephone' => 'required|digits:9|starts_with:78,77,76,75,70,33,30| unique:volontaires',
            'email' => 'required|email|unique:users',
            'numeroCIN' => 'required|alpha_num|unique:volontaires',
            'structure' => 'required',
            'materiel' => 'required'

        ];
        $error = Validator::make($request->all(), $rule);
        if ($error->fails()) {
            return response()->json(['error' => $error->errors()]);
        }

        User::create([
            'email' => $request->email,
            'password' => Hash::make('12345678'),
            'profil' => 'volontaire',
        ]);

        volontaire::create([
            'referenceVolontaire' => referenceVolontaire(),
            'etat' => 1,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'adresse' => $request->adresse,
            'dateDeNaissance' => $request->dateDeNaissance,
            'lieuDeNaissance' => $request->lieuDeNaissance,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'numeroCIN' => $request->numeroCIN,
            'sexe' => $request->sexe,


        ])->structures()->attach($request->structure, ["dateDebut" => Date("Y/m/d")]);
        $volontaire = volontaire::all()->last();
        materiel::where('reference', $request->materiel)->update([
            'idVolontaire' => $volontaire->idVolontaire
        ]);
        return response()->json(['success' => 'reussi']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $volontaire = volontaire::where('referenceVolontaire', $id)
            ->join('durer', 'durer.idVolontaire', '=', 'volontaires.idVolontaire')
            ->join('structures', 'structures.idStructure', '=', 'durer.idStructure')
            ->join('materiels', 'materiels.idVolontaire', 'volontaires.idVolontaire')
            ->get();
        return response()->json($volontaire);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $volontaire = volontaire::where('referenceVolontaire', $id)->first();
        $annee = date('d-m-Y', strtotime(date('Y-m-d') . "-18 years"));
        $rule = [
            'nom' => 'required | string | min :2',
            'prenom' => 'required| string | min:2',
            'dateDeNaissance' => 'required| date | before_or_equal:' . $annee,
            'lieuDeNaissance' => 'required|string |min:2',
            'adresse' => 'required|string',
            'sexe' => 'required',
            'telephone' => ['required', 'digits:9', 'starts_with:78,77,76,75,70,33,30', Rule::unique('volontaires')->ignore($volontaire->idVolontaire, 'idVolontaire')],
            'email' => ['required', 'email', Rule::unique('volontaires')->ignore($volontaire, 'idVolontaire')],
            'numeroCIN' => ['required', 'alpha_num', Rule::unique('volontaires')->ignore($volontaire, 'idVolontaire')],
            'structure' => 'required',
            'materiel' => 'required'

        ];
        $error = Validator::make($request->all(), $rule);
        if ($error->fails()) {
            return response()->json(['error' => $error->errors()]);
        }


        $volontaire->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'adresse' => $request->adresse,
            'dateDeNaissance' => $request->dateDeNaissance,
            'lieuDeNaissance' => $request->lieuDeNaissance,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'numeroCIN' => $request->numeroCIN,
            'sexe' => $request->sexe,


        ]);

        materiel::where('idMateriel', $request->materiel)->update([
            'idVolontaire' => $volontaire->idVolontaire
        ]);
        return response()->json(['success' => 'reussi']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}