@extends('accueilUser')

@section('content')
<div class="row mt" >
  <div class="" style="margin-top:30px; margin-left:50px;">
    <!-- CHART PANELS -->
    <div class="row">
      <div class="container">
      <div class="card col-md-3 m-4 text-center rounded" style="height: 150px;color:white;background:#DD985C">
        <div class="row text-center">
          <span style="font-size: 50px"><i class="fa fa-users" ></i></span>
          <h4>Volontaire</h4>
          <div>
            19<br/>
          
          </div>
        </div>
      </div>
      <div class="card col-md-3 m-4 bg-success"  style="height: 150px;color:white">
        <div class="row text-center">
          <span style="font-size: 50px"><i class="fa fa-plus-square" ></i></span>
          <h4>Structure</h4>
          <div>
            14
          </div>
        </div>
      </div>
      <div class="card col-md-3 m-4 bg-warning"  style="height: 150px">
        <div class="row text-center">
          <span style="font-size: 50px"><i class="fa fa-cogs" ></i></span>
          <h4>Materiel</h4>
          <div>
            19
          </div>
        </div>
      </div>
      </div>
      <div class="row mt-4">
        <div class="container">
        <div class="card col-md-3 m-4 text-center" style="height: 150px;color:white;background:#4B0082">
          <div class="row text-center">
            <span style="font-size: 50px"><i class="fa fa-users" ></i></span>
            <h4>Fournisseur</h4>
            <div>
              19<br/>
              
            </div>
          </div>
        </div>
        <div class="card col-md-3 m-4 "  style="height: 150px;background:#F9429E">
          <div class="row text-center">
            <span style="font-size: 50px"><i class="fa fa-stethoscope" ></i></span>
            <h4>Medecin</h4>
            <div>
              19
            </div>
          </div>
        </div>
        <div class="card col-md-3 m-4"  style="height: 150px;color:white;background:#463F32">
          <div class="row text-center">
            <span style="font-size: 50px"><i class="fa fa-usd" ></i></span>
            <h4>Comptabilité</h4>
            <div>
              140000000 Franc Cfa
            </div>
          </div>
        </div>
        </div>
    </div>
  </div>
</div>

@endsection
