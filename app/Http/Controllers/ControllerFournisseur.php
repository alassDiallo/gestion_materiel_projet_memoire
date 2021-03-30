<?php

namespace App\Http\Controllers;

use App\Models\fournisseur;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\Rule;

class ControllerFournisseur extends Controller
{

    public function index(Request $request)
    {

        if($request->ajax()){
            $data = fournisseur::all();

            return \DataTables::of($data)
                                ->addIndexColumn()
                                ->addColumn('action',function($data){
                                $btn = '<a class="btn  btn-sm btn-primary" href="javascript:void();" data-toggle="tooltip" data-id="'.$data->id.'" data-original-title="modifier" onclick="modifier('."'".$data->reference."'".')"><i class="fa fa-edit" style="color:white;"></i></a>
                                <a class="btn  btn-sm btn-danger" href="javascript:void();" data-toggle="tooltip" data-id="'.$data->id.'" data-original-title="supprimer" onclick="supprimer('."'".$data->reference."'".')"><i class="fa fa-trash-o" style="color:white;"></i></a>';

                                return $btn;
                                })
                                ->rawColumns(['action'])
                                ->make(true);
                            }
    }

    public function create()
    {

         return (view('fournisseur.create'));
    }


    public function store(Request $request)
    {
        
        $rules = [
            'nom' => 'required',
            'telephone' => 'required|digits:9|starts_with:77,78,76,75,70,33,30|unique:fournisseurs',
            'email' => 'required|email|unique:fournisseurs',
            'adresse' => 'required'

        ];

        // 'telephone'=>[
        //     'digits:9',
        //     'starts_with:77,78,76,70,33,30',
        //     Rule::unique('eleves')->ignore($eleve),
        //     ],
        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['error'=>$error->errors()]);

        }
         fournisseur::create([
             'nom'=>$request->nom,
             'referenceFournisseur'=>referenceFournisseur(),
             'adresse'=>$request->adresse,
             'email'=>$request->email,
             'telephone'=>$request->telephone
         ]);

         return response()->json(["enregistrement reussi"]);
        //  return redirect()->route('fournisseur.index')
        //     ->with('success', 'Fournisseur crée avec succès.');

    }


    public function show($idFournisseur)
    {
       
        //
        $fournisseur=fournisseur::find($idFournisseur);
        return (view('fournisseur.show',compact('fournisseur')));
    }


    public function edit($idFournisseur)
    {
        //
        $fournisseur=fournisseur::find($idFournisseur);

         return (view('fournisseur.edit',compact('fournisseur')));
    }

    public function update(Request $request,$idFournisseur)
    {
        $request->validate([
            //'referenceFournisseur' => 'required',
            'nom' => 'required',
            'telephone'=>[
                'digits:9',
                'starts_with:77,78,76,70,33,30',
                Rule::unique('fournisseurs')->ignore('idFournisseur',$idFournisseur),
                ],
            'email' => ['required','email',Rule::unique('fournisseurs')->ignore('idFournisseur',$idFournisseur)],
            'adresse' => 'required'

        ]);
        $fournisseur = fournisseur::find($idFournisseur);
         $fournisseur->update($request->all());
         return redirect()->route('fournisseur.index')
            ->with('success', 'Fournisseur modifié avec succès.');

    }

    public function destroy($idFournisseur)
    {
        //
         $fournisseur=fournisseur::find($idFournisseur);
         $fournisseur->delete();
        // $fournisseur->materiels()->detach();
         return redirect()->route('fournisseur.index')
            ->with('success', 'Fournisseur supprimé avec succès .');
    }
}
