@extends('fournisseur.layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edition du Fournisseur') }}</div>
                    <div class="row">
                        <div class="col-lg-10 margin-tb">
                            <div class="pull-right">
                            <a class="btn btn-primary" href="{{ route('fournisseur.index') }}" title="Go back"> <i class="fas fa-arrow-alt-circle-left "></i> </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                        <form action="{{route('fournisseur.update',$fournisseur->idFournisseur)}}" method="POST">

                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <input class="form-control"type="hidden" name="idFournisseur" id="idFournisseur" value="{{$fournisseur->idFournisseur}}">
                            </div>
                            <div class="form-group">
                                <label class="control-label"for="referenceFournisseur">Reference</label>
                                <input class="form-control"type="tex" name="referenceFournisseur" id="referenceFournisseur" value="{{$fournisseur->referenceFournisseur}}">
                            </div>
                            <div class="form-group">
                                <label class="control-label"for="nom">nom</label>
                                <input class="form-control"type="text" name="nom" id="nom" value="{{$fournisseur->nom}}">
                            </div>
                              <div class="form-group">
                                <label class="control-label"for="telephone">Telephone</label>
                                <input class="form-control"type="number" name="telephone" id="telephone" value="{{$fournisseur->telephone}}">
                            </div>
                            <div class="form-group">
                                <label class="control-label"for="email">Email</label>
                                <input class="form-control"type="email" name="email" id="email" value="{{$fournisseur->email}}">
                            </div>
                              <div class="form-group">
                                <label class="control-label"for="adresse">Adresse</label>
                                <input class="form-control"type="text" name="adresse" id="adresse" value="{{$fournisseur->adresse}}">
                            </div>
                            <div class="form-group">
                            <input type="submit" class="btn btn-success"value="Envoyer"name="envoyer"id="envoyer">
                            <a class="btn btn-danger" href="{{route('fournisseur.index')}}">annuler</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

