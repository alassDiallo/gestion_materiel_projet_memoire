<?php

namespace App\Http\Controllers;

use App\Models\consulter;
use App\Models\durer;
use App\Models\Medecin;
use App\Models\periode;
use App\Models\Specialite;
use App\Models\structure;
use Illuminate\Http\Request;

class ControllerConsultation extends Controller
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
    public function prixConsultation()
    {
        $medecins = Medecin::all();
        $specialite = Specialite::all();
        $periodes = periode::all();
        $structure = structure::all();
        $durers = durer::all();
        $consultations = consulter::where('idVolontaire', 3)
            // ->where('date', '<=', Date("Y/m/d"))
            // ->where('heure','>',Date("H h:m"))
            ->join("durers", 'volontaires.idVolontaires', '=', 'durers.idVolontaires')
            ->join('structures', 'structures.idStructure', '=', 'periodes.idStructure')
            ->join('periodes', 'medecins.idMedecin', '=', 'periodes.idMedecin')
            ->join("medecins", 'medecins.idMedecin', '=', 'consulters.idMedecin')
            ->join('specialites', 'specialites.idSpecialite', '=', 'medecins.idMedecin')
            // ->orderBy('date', 'desc')
            ->get();

        return response()->json($consultations);
    }
}