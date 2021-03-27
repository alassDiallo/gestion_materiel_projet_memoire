@extends('accueilUser')
@section('content')
<div class="card col-md-8" style="margin-top:10px;margin-left:150px;height:100%">
    <div class="m-4" style="">
        <a href="{{ route('valider',['ordonnance'=>$idOrdonnance,'patient'=>$patient,'medecin'=>$medecin[0]]) }}" class="btn btn-primary">imprimer</a>
        </div>
    <div class="card-body">
        <div class="container col-md-11 pull-left-1" style="margin-left:20px;margin-right:100px;border:2px solid black;padding:20px;border-radius:10px;margin-bottom:50px">
        <div class="row">
            <div class="container">
        <div class="pull-left" style="font-size: 14px">
        {{ ucwords($medecin[0]->nomStructure) }}<br/>
        region : {{ ucfirst($medecin[0]->region) }}<br/>
        telephone : {{ $medecin[0]->telephoneStructure }}<br/>
        </div>
        <div class="pull-right ml-4" style="font-size: 14px">
            {{ ucwords($patient->prenom."  ".$patient->nom) }}<br/>
            age : {{   explode('/',date('d/m/Y'))[2] - explode('-',$patient->dateDeNaissance)[0] }} ans<br/>
            {{-- age : {{ date('d/m/Y')-$patient->dateDeNaissance }}<br/> --}}
            Tel : {{ $patient->telephone }}<br/>
            Adresse : {{ $patient->adresse }}<br/>
            date: {{ date_format(now(),"d/m/Y H:i:s") }}
        </div>
    </div>
</div>
    <div class="row">
    <h1 class="text-center m-4">Ordonnance</h1><hr/>
    </div>
<div>
@foreach ($ordonnance->medicaments as $medicament)
<div class="row">
   
    <div class="col-md-8"><h4>{{ $medicament->libelle }}</h4></div>
    <div class="col-md-4" style="font-size: 12px;font-weight:bold">{{ $medicament->prix }}  x  {{ $medicament->pivot->quantite }}</div>
</div>
<div class="mb-4"  style="font-size: 14px">
    {{ $medicament->pivot->indication }}
</div>
    
@endforeach
</div>
<div class="row" style="font-size: 12px;font-weight:bold;margin-top:80px">
    <div class="col-md-3">
        Total : {{ $ordonnance->cout }}  Franc Cfa
    </div>
    <div class="col-md-5">
        Prise en charge(80%) : {{ $ordonnance->cout * 0.8 }} Franc Cfa
    </div>
    <div class="col-md-4">
        Patient : {{ $ordonnance->cout * 0.2 }}  Franc Cfa
    </div>
</div>
    <div class="row pull-right col-md-4" style="margin-top: 100px;">
        <div style="font-size: 12px;font-weight:bold">
           Dr. {{ ucwords($medecin[0]->prenom."  ".$medecin[0]->nom ) }}<br/>
            Telephone : {{ $medecin[0]->telephone }}
        </div>
    </div>
   </div></div>
</div>
@endsection