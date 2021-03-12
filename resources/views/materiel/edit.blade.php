@extends('materiel.layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edition du Materiel') }}</div>
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

                        <form action="{{route('materiel.update',$materiel->idMateriel)}}" method="POST">

                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <input class="form-control"type="hidden" name="idMateriel" id="idMateriel" value="{{$materiel->idMateriel}}">
                            </div>
                            <div class="form-group">
                                <label class="control-label"for="reference">Reference</label>
                                <input class="form-control"type="text" name="reference" id="reference" value="{{$materiel->reference}}">
                            </div>
                            <div class="form-group">
                                <label class="control-label"for="type">Type</label>
                                <input class="form-control"type="text" name="type" id="type" value="{{$materiel->type}}">
                            </div>
                              <div class="form-group">
                                <label class="control-label"for="libelle">Libelle</label>
                                <input class="form-control"type="text" name="libelle" id="libelle" value="{{$materiel->libelle}}">
                            </div>
                            <div class="form-group">
                                <label class="control-label"for="prix">Prix</label>
                                <input class="form-control"type="number" name="prix" id="prix" value="{{$materiel->prix}}">
                            </div>
                              <div class="form-group">
                                <label class="control-label"for="quantite">Quantite</label>
                                <input class="form-control"type="text" name="quantite" id="quantite"
                                @foreach ($materiel->fournisseurs as $item)
                                    value="{{$item->pivot->quantite}}"
                                @endforeach
                                 >
                            </div>
                          {{--   <div class="form-group">
                                <label class="control-label"for="idFournisseur">Fournisseur</label>
                                <input class="form-control"type="text" name="idFournisseur" id="idFournisseur" value="">
                            </div> --}}
                            <div class="form-group">
                            <label class="control-label"for="idFournisseur">Fournisseur</label>
                            <select class=" form-control custom-select" name="idFournisseur" id="idFournisseur" required>
                                 @foreach ($materiel->fournisseurs as $item)
                                    <option value="{{$item->idFournisseur}}">{{$item->nom}}  </option>
                                @endforeach
                                 @foreach ($fournisseurs as $item)
                                    <option value="{{$item->idFournisseur}}">{{$item->nom}}  </option>
                                @endforeach
                            </select>
                        </div>
                            <div class="form-group">
                            <input type="submit" class="btn btn-success"value="Envoyer"name="envoyer"id="envoyer">
                            <a class="btn btn-danger" href="{{route('materiel.index')}}">annuler</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

