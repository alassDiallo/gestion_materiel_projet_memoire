@extends('accueilUser')
@section('content')
<div class="" style="margin-left: 30px">
<div class="row">
    <div class="col-md-6">
        <div class="card col-md-6 m-2 text-center" style="height: 180px; background:orange">
            <span style="font-size: 50px"><i class="fa fa-cogs"></i></span>
<h4>Achat de materiel</h4>
<h6 class="text-right mt-4">14567899 cfa franc</h6>
        </div>
        <div class="card col-md-5 m-2 text-center bg-success" style="height: 180px;color:white">
            <span style="font-size: 50px"><i class="fa fa-stethoscope"></i></span>
<div class="text-left">
            <h4>Analyse</h4> 
<h4>Ordonnance</h4>
<h4>Consultation</h4>
</div>
<h6 class="text-right mt-2">14567899 cfa franc</h6>
        </div>
    </div>
    <div class="col-md-6">
                    <div class="card col-md-5 m-2 text-center bg-primary" style="height: 150px;">
                       <span style="font-size: 50px"> <i class="fa fa-dollar"></i></span>
                        <h4 class="text-left">Depense volontaire</h4><h4 class="text-left">Depense interne</h4>
                        <h6 class="text-right mt-2 mb-4">1203030 franc Cfa</h6>
                    </div>
                    <div class="card col-md-6 m-2 bg-danger" style="height: 150px;color:white">
                        <span class="text-center" style="font-size: 50px"><img src="{{ asset('img/comptabilite.png') }}" width="50px" height="50px" /></span>
                        <h4 class="text-left">Comptabilité Finance</h4>
                        <h6 class="text-right mt-2 mb-4">12020000 franc Cfa</h6>
                    </div>
    </div>
</div>
<hr/>
</div>
@endsection