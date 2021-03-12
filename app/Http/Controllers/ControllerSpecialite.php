<?php

namespace App\Http\Controllers;

use App\Models\Medecin;
use App\Models\periode;
use App\Models\Specialite;
use App\Models\structure;
use Illuminate\Http\Request;

class ControllerSpecialite extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $structures = Structure::all();
       $periodes = Periode::all();
       $medecins = Medecin::all();
       $specialites=Specialite::where('libelle',$id)
                ->join('medecins','medecins.idSpecialite','=','specialites.idSpecialite')
                ->join('periodes','periodes.idMedecin','=','medecins.idMedecin')
                ->join('structures','structures.idStructure','=','periodes.idStructure')
                ->get();
                return response()->json($specialites);
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
