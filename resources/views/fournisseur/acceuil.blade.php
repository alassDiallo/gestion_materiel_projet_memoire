@extends('fournisseur.layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-13">
                <div class="card">
                    <div class="card-header">{{ __('Liste des fournisseurs') }}</div>
                     <div class="row">
                        <div class="col-lg-10 margin-tb">
                            <div class="pull-right">
                            <a class="btn btn-success" href="{{ route('fournisseur.create') }}" title="Ajout"> <i class="fas fa-plus-circle "></i> Ajouter fournisseur</a>
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
                        <table class="table table-hover table-striped table-bordered ">
                            <thead class="thead-light">
                            <tr>
                                <th>Reference Fournisseur</th>
                                <th>Nom</th>
                                <th>Telephone</th>
                                <th>Email</th>
                                <th>Adresse</th>
                                <th width="100px"colspan="2"class="text-center">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                                @foreach ($fournisseurs as $item)
                            <tr>
                                <td>{{$item->referenceFournisseur}}</td>
                                <td>{{$item->nom}}</td>
                                <td>{{$item->telephone}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->adresse}}</td>
                                 <td>
                                    <form action="{{route('fournisseur.destroy',$item->idFournisseur)}}" method="POST">
                                         <a class=" btn btn-secondary " href="{{route('fournisseur.show',$item->idFournisseur)}}">
                                            <i class="fas fa-eye  fa-lg"></i>Voir</a>
                                         <a class=" btn btn-info " title="show"href="{{route('fournisseur.edit',$item->idFournisseur)}}">
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
