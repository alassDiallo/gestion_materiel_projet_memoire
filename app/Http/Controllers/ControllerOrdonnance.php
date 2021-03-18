<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Ordonnance;
use App\Models\prescription;
use App\Models\Medicament;

class ControllerOrdonnance extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ordonnance.creerOrdonnance');
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
            'quantite'=>'required|integer|min:1|max:9',
            'indication'=>'required|string'
        ];

        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json($error->errors());
        }
            $medicament = Medicament::where('idMedicament',$request->id)->first();
            //$ordonnance = Ordonnance::where('idOrdonnance','154486ORD')->first();

            // $ordonnance =Ordonnance::where('ordonnances.idOrdonnance','154486ORD')->join('prescriptions','prescriptions.idOrdonnance','=','ordonnances.idOrdonnance')
            //             ->join('medicaments','medicaments.idMedicament','=','prescriptions.idMedicament')
            //             ->get();
            Prescription::create([
                'idMedicament'=>$medicament->idMedicament,
                'quantite'=>$request->quantite,
                'indication'=>$request->indication,
                'idOrdonnance'=>$request->idOrdonnance
            ]);
            // $medicament->ordonnances()->attach($request->idOrdonnance,[
            //     'quantite'=>$request->quantite,
            //     'indication'=>$request->indication
            // ]);
            // $ordonnance = Ordonnance::create([
            //     'idOrdonnance'=>$request->idOrdonnance,
            //     'cout'=>30000
            // ]);
       
          return response()->json($medicament);
      
    }

    public function valider(Request $request){

        return response()->json("valider");
        

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
}
