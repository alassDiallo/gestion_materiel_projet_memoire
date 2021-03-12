@extends('materiel.layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-13">
                <div class="card">
                    <div class="card-header ">{{ __('Liste des Materiels') }}</div>
                    <div class="row">
                        <div class="col-lg-10 margin-tb">
                            <div class="pull-right">
                            <a class="btn btn-success" href="{{ route('materiel.create') }}" title="Ajout"> <i class="fas fa-plus-circle "></i> Ajouter materiel</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div >
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <p>{{ $message }}</p>
                                </div>
                             @endif
                        <table class="table table-hover table-striped table-bordered table-responsive-lg">
                            <thead class="thead-light">
                            <tr>
                                <th>Reference</th>
                                <th>Type</th>
                                <th>Libelle</th>
                                <th>Prix</th>
                                <th>Quantite</th>
                                <th>Fournisseur</th>
                                <th width="100px"colspan="2"class="text-center">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                                @foreach ($materiels as $item)
                            <tr>
                                <td>{{$item->reference}}</td>
                                <td>{{$item->type}}</td>
                                <td>{{$item->libelle}}</td>
                                <td>{{$item->prix}}</td>
                                @foreach ($item->fournisseurs as $fourn)
                                <td>{{$fourn->pivot->quantite}}</td>
                                <td>{{$fourn->nom}}</td>
                                @endforeach
                                 <td>
                                    <form action="{{route('materiel.destroy',$item->idMateriel)}}" method="POST">
                                         <a class=" btn btn-secondary " href="{{route('materiel.show',$item->idMateriel)}}">
                                            <i class="fas fa-eye  fa-lg"></i>Voir</a>
                                         <a class=" btn btn-info " title="show"href="{{route('materiel.edit',$item->idMateriel)}}">
                                            <i class="fas fa-edit  fa-lg"></i>Editer</a>
                                         @csrf
                                         @method('DELETE')

                                          <button type="submit"class="btn btn-danger"title="delete"style="border: none; ">
                                              <i class="fas fa-trash fa-lg "></i>Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                             @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
