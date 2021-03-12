@extends('fournisseur.layout')
@section('content')
  <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>  {{ $fournisseur->nom }}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('fournisseur.index') }}" title="Go back"> <i class="fas fa-arrow-alt-circle-left "></i> </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <hr>
            <div class="form-group">
                <strong>Nom:</strong>
                {{ $fournisseur->nom }}
            </div>
            <hr>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <hr>
            <div class="form-group">
                <strong>Telephone:</strong>
                {{ $fournisseur->telephone }}
            </div>
            <hr>
        </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
             <hr>
            <div class="form-group">
                <strong>Email:</strong>
                {{ $fournisseur->email }}
            </div>
            <hr>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <hr>
            <div class="form-group">
                <strong>Reference:</strong>
                {{ $fournisseur->referenceFournisseur }}
            </div>
            <hr>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <hr>
            <div class="form-group">
                <strong>Adresse:</strong>
                 {{ $fournisseur->adresse}}
            </div>
            <hr>
        </div>
    </div>
@endsection
