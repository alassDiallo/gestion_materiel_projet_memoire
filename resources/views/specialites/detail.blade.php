@extends('accueilUser')
@section('content')
<div class="" style="margin-left: 25px;margin-top:10px">

    <h1>{{ $specialite->nom }}</h1>
    <img src="{{ asset($specialite->image) }}" />
    <h3>Prix consultation : {{ $specialite->prixConsultation }}</h3>

</div>
@endsection