<?php

namespace App\Http\Controllers;

use App\Models\materiel;
use App\Models\structure;
use Illuminate\Http\Request;
use App\Models\volontaire;
use Validator;
use DataTables;

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

    public function liste( request $request)
    {
        $data = volontaire::all();
        if($request->ajax){
        return \DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $btn = '<a class="btn  btn-sm btn-warning" href="javascript:void();" data-toggle="tooltip" data-id="' . $data->id . '" data-original-title="modifier" onclick="voir(' . "'" . $data->reference . "'" . ')"><i class="fa fa-eye" style="color:white;"></i></a>
                                <a class="btn  btn-sm btn-primary" href="javascript:void();" data-toggle="tooltip" data-id="' . $data->id . '" data-original-title="modifier" onclick="modifier(' . "'" . $data->reference . "'" . ')"><i class="fa fa-edit" style="color:white;"></i></a>
                                <a class="btn  btn-sm btn-danger" href="javascript:void();" data-toggle="tooltip" data-id="' . $data->id . '" data-original-title="supprimer" onclick="supprimer(' . "'" . $data->reference . "'" . ')"><i class="fa fa-trash-o" style="color:white;"></i></a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }}

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
        $annee = date('d-m-Y', strtotime(date('Y-m-d') . "-20 years"));
        $rule = [
            'nom' => 'required | string | min :2',
            'prenom' => 'required| string | min:2',
            'dateDeNaissance' => 'required| date | before_or_equal:' . $annee,
            'lieuDeNaissance' => 'required|string |min:2',
            'adresse' => 'required|string',
            'telephone' => 'required|digits:9 | unique:volontaires',
            'email' => 'required|email|unique:volontaires',
            'cin' => 'required|alpha_num',
            'structure' => 'required',
            'materiel' => 'required'

        ];
        $error = Validator::make($request->all(), $rule);
        if ($error->fails()) {
            return response()->json(['error' => $error->errors()]);
        }

        volontaire::create([
            'reference' => referenceVolontaire(),
            'etat' => 1,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'adresse' => $request->adresse,
            'dateDeNaissance' => $request->dateDeNaissance,
            'lieuDeNaissance' => $request->lieuDeNaissance,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'numeroCIN' => $request->cin,
            //'idStructure' => $request->structure,


        ])->structures()->attach($request->structure,["dateDebut"=>Date("Y/m/d")]);
        materiel::where('idMateriel', $request->materiel)->update([
            'idVolontaire' => 1
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
        $volontaire = volontaire::where('reference', $id)->first();
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
        //
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