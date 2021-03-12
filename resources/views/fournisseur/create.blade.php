@extends('fournisseur.layout')
@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ajouter fournisseur') }}</div>
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

                    <form action="{{route('fournisseur.store')}}" method="POST" class="was-validated">

                        @csrf

                        <div class="form-group">
                            <label class="control-label"for="referenceFournisseur">REFERENCE</label>
                            <input class="form-control" type="text" name="referenceFournisseur" id="referenceFournisseur" required>
                        </div>
                         <div class="form-group">
                            <label class="control-label"for="nom">NOM</label>
                            <input class="form-control" type="text" name="nom" id="nom" required>
                        </div>
                         <div class="form-group">
                            <label class="control-label"for="telephone">TELEPHONE</label>
                            <input class="form-control"type="number" name="telephone" id="telephone" required>
                        </div>
                         <div class="form-group">
                            <label class="control-label"for="email">EMAIL</label>
                            <input class="form-control" type="email" name="email" id="email" required>
                        </div>
                          <div class="form-group">
                            <label class="control-label"for="adresse">ADRESSE</label>
                            <input class="form-control" type="text" name="adresse" id="adresse" required>
                        </div>
                        <div class="form-group">
                        <input type="submit" class="btn btn-success"value="Envoyer"name="envoyer"id="envoyer">
                        <input type="reset" class="btn btn-danger"value="Annuler"name="annuler"id="annuler">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
