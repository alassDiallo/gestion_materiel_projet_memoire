<?php

namespace App\Http\Controllers;
use App\Models\structure;
use DataTables;
use Validator;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationServiceProvider;

class ControllerStructure extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = structure::all();

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
        //return response()->json(Structure::all());

                                //return view('structure.accueil_structure',compact($data));
           
       // }
       /* $structure = structure::all();
       // dd($structure->count());
        //dd(response()->json($structure));
        $d=array();
        $i=1;
      foreach($structure as $t){
        $row=array();
        $row[]=$i++;
        $row[]=$t->reference;
        $row[]=$t->nom;
        $row[]=$t->adresse;
        $row[]=$t->telephone;
        $row[]=$t->region;
        $row[]='<a class="btn  btn-sm btn-primary" href="javascript:void();" title="modifier" onclick="modifier('."'".$t->reference."'".');">modifier</a>
                <a class="btn  btn-sm btn-danger" href="javascript:void();" title="supprimer" onclick="supprimer('."'".$t->reference."'".');">supprimer</a>';
        $d[]=$row;
      }
$data = array(
    "draw"=>1,
    "recordsTotal"=>count($d),
    "recordsFiltered"=>count($d),
    "data"=>$d
);
return response()->json($data);*/
       

     // return view('structure.accueil_structure');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getStructures(Request $request, structure $structure)
    {
        $data = $structure::all();
        return \DataTables::of($data)
            ->addColumn('Actions', function($data) {
                return '<button type="button" class="btn btn-success btn-sm" id="getEditArticleData" data-id="'.$data->id.'">Edit</button>
                    <button type="button" data-id="'.$data->id.'" data-toggle="modal" data-target="#DeleteArticleModal" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';
            })
            ->rawColumns(['Actions'])
            ->make(true);
           return response()->json();
    }

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
            "nom"=>"required | string | min : 2",
           "adresse"=>"required | string | min : 3",
           "telephone"=>"required | digits:9| unique:structures",
            "region"=>"required"
        ];

        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['error'=>$error->errors()]);
        }
        
        structure::create([
            "nomStructure"=>$request->nom,
            "adresse"=>$request->adresse,
            "telephone"=>$request->telephone,
            "region"=>$request->region,
            "reference"=>referenceStructure()
        ]);

       return response()->json(['success'=>'enregistrement effectuer avec succé']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = structure::where('reference',$id)->get();
        return response()->json($data);
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
        $rules = [
            "nom"=>"required | string | min : 2",
           "adresse"=>"required | string | min : 3",
           "telephone"=>"required | digits:9| unique:structures",
            "region"=>"required"
        ];
        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['error'=>$error->errors()]);
        }
        //return response()->json($request);
        structure::where('reference',$id)->update([
            "nom"=>$request->nom,
            "adresse"=>$request->adresse,
            "telephone"=>$request->telephone,
            "region"=>$request->region,
            //Rule::unique('structures')->ignore($id)
            
        ]);

       return response()->json(['success'=>'enregistrement effectuer avec succé']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        structure::where('reference',$id)->delete();
        return response()->json(["donnee"=>"suppression reussi"]);
    }
}
