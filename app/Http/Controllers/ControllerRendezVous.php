<?php

namespace App\Http\Controllers;

use App\Models\Medecin;
use App\Models\periode;
use App\Models\RendezVous;
use App\Models\Specialite;
use App\Models\structure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Validator;
class ControllerRendezVous extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medecins = Medecin::all();
        $specialite = Specialite::all();
        $periodes = periode::all();
        $structure = structure::all(); 
        $rv = RendezVous::where('idPatient',2)
                    ->where('date','>',Date("Y/m/d"))
                    // ->where('heure','>',Date("H h:m"))
                    ->join("medecins",'medecins.idMedecin','=','rendez_vouses.idMedecin')
                    ->join('specialites','specialites.idSpecialite','=','medecins.idMedecin')
                    ->join('periodes','medecins.idMedecin','=','periodes.idMedecin')
                    ->join('structures','structures.idStructure','=','periodes.idStructure')
                    ->orderBy('date','desc')
                    ->get();


        return response()->json($rv);
    //     RendezVous::create([
    //         "idMedecin"=>1,
    //         "idPatient"=>2,
    //         "date"=>date("Y/m/d"),
    //         "heure"=>date("H:m"),
    //         "etat"=>"en attente"
    //     ]);
    //    return response()->json("bonjour");
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
        $rules = [
            "date"=>'required',
            "heure"=>'required',
            "idMedecin"=>'required',
            "idPatient"=>'required'
        ];
        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json($error->errors());
        }
        RendezVous::create([
            "idMedecin"=>$request->idMedecin,
            "idPatient"=>$request->idPatient,
            "date"=>$request->date,
            "heure"=>$request->heure,
            "etat"=>"en attente"
        ]);
        return response()->json($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
       dd("je suis la");
    }

    public function historique(){
        $medecins = Medecin::all();
        $specialite = Specialite::all();
        $periodes = periode::all();
        $structure = structure::all(); 
        $rv = RendezVous::where('idPatient',2)
                    ->where('date','<=',Date("Y/m/d"))
                    // ->where('heure','>',Date("H h:m"))
                    ->join("medecins",'medecins.idMedecin','=','rendez_vouses.idMedecin')
                    ->join('specialites','specialites.idSpecialite','=','medecins.idMedecin')
                    ->join('periodes','medecins.idMedecin','=','periodes.idMedecin')
                    ->join('structures','structures.idStructure','=','periodes.idStructure')
                    ->orderBy('date','desc')
                    ->get();

                return response()->json($rv);
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
