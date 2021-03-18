<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTable;
use App\Models\Medicament;

class ControllerMedicament extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $medicament = Medicament::all();
        if($request->ajax()){

            return \DataTables::of($medicament)
                                ->addIndexColumn()
                                ->addColumn('action',function($medicament){
                                $btn = '<a class="btn btn-success" href="javascript:void();" data-toggle="tooltip" data-id="'.$medicament->idMedicament.'" data-original-title="accepter" onclick="ajouter('."'".$medicament->idMedicament."'".')"><i class="fa fa-plus"></i></a>';
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
}
