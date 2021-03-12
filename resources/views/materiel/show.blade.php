@extends('materiel.layout')
@section('content')
  <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>  {{ $materiel->type }}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('materiel.index') }}" title="Go back"> <i class="fas fa-arrow-alt-circle-left "></i> </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <hr>
                <strong>Type:</strong>
                {{ $materiel->type }}
                <hr>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Libelle:</strong>
                {{ $materiel->libelle }}
            </div>
        </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <hr>
                <strong>Prix:</strong>
                {{ $materiel->prix }}
                <hr>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <hr>
                <strong>Reference:</strong>
                {{ $materiel->reference }}
                <hr>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <hr>
                <strong>Quantite:</strong>
                @foreach($materiel->fournisseurs as $fournisseur)
                        {{ $fournisseur->pivot->quantite }}
                    @endforeach
                <hr>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <hr>
                <strong>Fournisseur:</strong>
                <ul>
                    @foreach($materiel->fournisseurs as $fournisseur)
                        <li>{{ $fournisseur->nom }}</li>
                    @endforeach
                </ul>
                <hr>
            </div>
        </div>
    </div>
@endsection
