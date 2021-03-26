<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Medecin;
use PDF;
use App\Models\Ordonnance;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControllerPrescription extends Controller
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
        $medecin = Medecin::where('email',Auth::user()->email)
                            ->join('specialites','medecins.idSpecialite','=','specialites.idSpecialite')
                            ->join('periodes','medecins.idMedecin','=','periodes.idMedecin')
                            ->join('structures','structures.idStructure','=','periodes.idStructure')
                            ->get();
        $patient = Patient::where('referencePatient',$request->reference)
        ->orWhere('telephone',$request->reference)
        ->orWhere('numeroCIN',$request->reference)
        ->first();
        if(!$patient){
            return response()->json(["error"=>"il n'y a pas de patient avec ces informations"]);
        }
        Ordonnance::create([
            'cout'=>$request->coup,
            'idOrdonnance'=>$request->idord,
            'idMedecin'=>$medecin[0]->idMedecin
        ]);
        Facture::create([
            'reference'=>referenceFacture(),
            'montant'=>$request->coup,
            'priseEC'=>$request->coup*0.8,
            'prixP'=>$request->coup*0.2,
            'idPatient'=>$patient->idPatient

        ]);
        $ordonnance = Ordonnance::where('idOrdonnance',$request->idord)->first();
          
        // $this->voir();
        // $pdf = PDF::loadView('ordonnance.generer');
        // $pdf = PDF::loadView('ordonnance.generer');
        // return  $pdf->download("assane.pdf");
        
       return view("ordonnance.detail",['patient'=>$patient,'ordonnance'=>$ordonnance,'medecin'=>$medecin,'idOrdonnance'=>$request->idord]);
    // $pdf->download("/ordonnance/assane".date("d/m/Y h:m:s").".pdf");
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
