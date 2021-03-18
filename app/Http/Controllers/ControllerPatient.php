<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class ControllerPatient extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $patient = Patient::all();

       return response()->json($patient);
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
        $patient = Patient::where('referencePatient',$id)
                        ->orWhere('telephone',$id)
                        ->orWhere('numeroCIN',$id)
                        ->firstOrFail();
                        if($patient->count() <1){
                            return response()->json('aucun');
                        }
                        return response()->json("correcte");
    }

    public function recherche(Request $request){

        $patient = Patient::where('referencePatient',$request->id)
                        ->orWhere('telephone',$request->id)
                        ->orWhere('numeroCIN',$request->id)
                        ->firstOrFail();
                        if($patient->count() <1){
                            return response()->json('aucun');
                        }
                        return response()->json("correcte");
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
