@extends('materiel.layout')
@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ajouter Materiel') }}</div>
                <div class="row">
                    <div class="col-lg-10 margin-tb">
                        <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('materiel.index') }}" title="Go back"> <i class="fas fa-arrow-alt-circle-left "></i> </a>
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

                    <form action="{{route('materiel.store')}}" method="POST" class="was-validated">

                        @csrf

                        <div class="form-group">
                            <label class="control-label"for="date">REFERENCE</label>
                            <input class="form-control" type="text" name="reference" id="reference" required>
                        </div>
                         <div class="form-group">
                            <label class="control-label"for="date">TYPE</label>
                            <input class="form-control" type="text" name="type" id="type" required>
                        </div>
                         <div class="form-group">
                            <label class="control-label"for="libelle">LIBELLE</label>
                            <input class="form-control"type="textarea" name="libelle" id="libelle" required>
                        </div>
                         <div class="form-group">
                            <label class="control-label"for="prix">PRIX</label>
                            <input class="form-control" type="number" name="prix" id="prix" required>
                        </div>
                          <div class="form-group">
                            <label class="control-label"for="quantite">QUANTITE</label>
                            <input class="form-control" type="number" name="quantite" id="quantite" required>
                        </div>

                        <div class="form-group">
                            <label class="control-label"for="idFournisseur">Fournisseur</label>
                            <select class=" form-control custom-select" name="idFournisseur" id="idFournisseur" required>
                                <option value="0">Faites un choix</option>
                                @foreach ($fournisseurs as $item)
                                    <option value="{{$item->idFournisseur}}">{{$item->nom}}  </option>
                                @endforeach
                            </select>
                        </div>
                       {{--   <div class="form-group">
                            <label class="control-label"for="idVolontaire">Volontaire</label>
                            <select class=" form-control custom-select" name="idVolontaire" id="idVolontaire" required >
                                <option value="0">Faites un choix</option>
                                @foreach ($volontaires as $item)
                                    <option value="{{$item->idVolontaire}}"> {{$item->prenom}}  {{$item->nom}}  </option>
                                @endforeach
                            </select>
                        </div> --}}
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
