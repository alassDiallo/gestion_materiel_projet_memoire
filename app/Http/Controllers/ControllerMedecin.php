<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Medecin;
use App\Models\Specialite;
use App\Models\Periode;
use App\Models\RendezVous;
use App\Models\Structure;
use Illuminate\Support\Facades\Auth;
use DataTable;

class ControllerMedecin extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $specialites=Specialite::all();
        $periodes= Periode::all();
        $structures=Structure::all();
        $medecins = DB::table('medecins')
                    ->join('specialites','medecins.idSpecialite','=','specialites.idSpecialite')
                    ->join('periodes','medecins.idMedecin','=','periodes.idMedecin')
                    ->join('structures','structures.idStructure','=','periodes.idStructure')
                    ->get();
        return response()->json($medecins);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    //    $structures = Structure::all();
    //    $periodes = Periode::all();
    //    $medecins = Medecin::all();
    //    $specialites=Specialite::where('libelle',$id)
    //             ->join('medecins','medecins.idSpecialite','=','specialites.idSpecialite')
    //             ->join('periodes','periodes.idMedecin','=','medecins.idMedecin')
    //             ->join('structures','structures.idStructure','=','periodes.idStructure')
    //                     ->get();
    // //    $medecins = DB::table('medecins')
    // //                 ->join('specialites','medecins.idSpecialite','=','specialites.idSpecialite','and','specialites.libelle','=',$id)
    // //                 ->join('periodes','medecins.idMedecin','=','periodes.idMedecin')
    // //                 ->join('structures','structures.idStructure','=','periodes.idStructure')
    // //                 ->get();
    //     return response()->json($specialites);
    }

    public function liste(Request $request){
        $rendez = Medecin::where('email',Auth::user()->email)->first()->idMedecin;
        $rv = RendezVous::where('idMedecin',$rendez)->where('rendez_vouses.etat','en attente')
        ->join('patients','rendez_vouses.idPatient','=','patients.idPatient')
        ->get();

        if($request->ajax()){

            return \DataTables::of($rv)
                                ->addIndexColumn()
                                ->addColumn('action',function($rv){
                                $btn = '<a class="btn  btn-sm btn-success" href="javascript:void();" data-toggle="tooltip" data-id="'.$rv->id.'" data-original-title="modifier" onclick="modifier('."'".$rv->id."'".')"><i class="fa fa-check" style="color:white;"></i></a>
                                <a class="btn  btn-sm btn-primary" href="javascript:void();" data-toggle="tooltip" data-id="'.$rv->id.'" data-original-title="modifier" onclick="modifier('."'".$rv->id."'".')"><i class="fa fa-edit" style="color:white;"></i></a>
                                <a class="btn  btn-sm btn-danger" href="javascript:void();" data-toggle="tooltip" data-id="'.$rv->id.'" data-original-title="supprimer" onclick="supprimer('."'".$rv->id."'".')"><i class="fa fa-trash-o" style="color:white;"></i></a>';

                                return $btn;
                                })
                                ->rawColumns(['action'])
                                ->make(true);
                            }

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
