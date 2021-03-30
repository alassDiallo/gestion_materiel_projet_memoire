<?php

namespace App\Http\Controllers;

use App\Models\Medecin;
use App\Models\periode;
use App\Models\Specialite;
use App\Models\structure;
use Illuminate\Http\Request;
use DataTable;
use Validator;
use Image;

class ControllerSpecialite extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data =Specialite::all();

            return \DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<a class="btn  btn-sm btn-primary" href="javascript:void();" data-toggle="tooltip" data-id="' . $data->referenceSpecialite . '" data-original-title="modifier" onclick="modifier(' . "'" . $data->referenceSpecialite . "'" . ')"><i class="fa fa-edit" style="color:white;"></i></a>
                                <a class="btn  btn-sm btn-danger" href="javascript:void();" data-toggle="tooltip" data-id="' . $data->referenceSpecialite . '" data-original-title="supprimer" onclick="supprimer(' . "'" . $data->referenceSpecialite . "'" . ')"><i class="fa fa-trash-o" style="color:white;"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
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
        
        $rule=[
            "libelle"=>"required|min:3|max:50",
            "prix"=>'required|integer|min:1|max:100000',
            "image"=>'required|image'
        ];
        $error = Validator::make($request->all(),$rule);
        if($error->fails()){

            return response()->json(['error'=>$error->errors()]);
        }
        if($request->hasFile('image')){
           $file=$request->image;
           $filename = time() . "." .$file->getClientOriginalExtension();
           Image::make($file)->save(public_path("/").$filename);

           Specialite::create([
               'libelle'=>$request->libelle,
               'prixConsultation'=>$request->prix,
               'image'=>$filename,
               'referenceSpecialite'=>referenceSpecialite()
           ]);

           return (['success'=>'enregistrement reussi']);
      
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    //     $structures = Structure::all();
    //    $periodes = Periode::all();
    //    $medecins = Medecin::all();
       $specialite=Specialite::where('referenceSpecialite',$id)->first();
                return response()->json($specialite);
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
        $spacialite = Specialite::where('referenceSpecialite',$id)->first();
        $rule=[
            "libelle"=>"required|min:3|max:50",
            "prix"=>'required|integer|min:1|max:100000',
            "image"=>'required|image'
        ];
        $error = Validator::make($request->all(),$rule);
        if($error->fails()){

            return response()->json(['error'=>$error->errors()]);
        }
        if($request->hasFile('image')){
           $file=$request->image;
           $filename = time() . "." .$file->getClientOriginalExtension();
           Image::make($file)->save(public_path("/").$filename);

        $spacialite->update([
               'libelle'=>$request->libelle,
               'prixConsultation'=>$request->prix,
               'image'=>$filename,
           ]);

           return (['success'=>'enregistrement reussi']);
      
        }
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
