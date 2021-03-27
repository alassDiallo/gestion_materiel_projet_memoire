@extends('accueilUser')
@section('content') 
<style>
    .erreur{
        color:red;
    }
    thead{
        background: black;
        color: aliceblue;
    }
    #modal{
        width: 100%;
    }
    #corps{
        width: 800px;
    }

    #titre{
        background: blue;
        color:white;
    }
</style>
<div style="margin-left: 30px;" >
        <h1 class="text-center">Les Volontaires</h1><hr/>
        <a class="btn btn-success m-3" id="ajout" onclick="ajouter();"><i class="fa fa-plus ml-4"></i>Ajouter un volontaire</a>
        <table class="table m-3 table-bordered table-striped text-center" id="table">
            <thead>
                <tr>
                    <th>Prenom</th>
                    <th>Nom</th>
                    <th>Date de Naissance</th>
                    <th>Adresse</th>
                    <th>Telephone</th>
                    <th>E-mail</th>
                    <th>Structure</th>
                    <th>region</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@endsection
@section('ajax')
<script>
    var table;
    var save;
    $(document).ready(function(){
       table=$('#table').DataTable({
           "ajax":{
               "url":"{{ route('listeVolontaire') }}",
               "method":"GET",
            //    success:function(data){
            //        console.log(data);
            //    },
            //    error:function(error){
            //        alert(error);
            //    }
               
           },
           
            columns: [    
                {data: 'prenom'},
                {data: 'nom'},
                {date:'dateDeNaissance'},
                {data: 'adresse'},
                {data: 'telephone'},
                {data: 'email'},
                {data: 'nomStructure'},
                {data: 'region'},
                {data:"action"}
         ],
         language:{
             url:"/js/DataTables/French.json"
         }
       });

        $('#telephone').on('keypress',function(e){
         console.log(e.keyCode);
         if(e.keyCode<48 || e.keyCode>57){
             return false;
         }
     });

     $('#telephone').on('keypress',function(e){
         console.log(e.keyCode);
         if(e.keyCode<48 || e.keyCode>57){
             return false;
         }
     });

    });
    var ref;
    function ajouter(){
        save="ajouter";
        
        $('#form')[0].reset();
        $('.modal-title').val("Ajouter un volontaire");
        $('#modal').modal('show');

    }

    /*function reload(){
        table.ajax.reload(null,false);
    }*/
    function reload(){
        $('#table').DataTable().ajax.reload();
    }

    function enregistrer(e){
       e.preventDefault();
       var url;
       var meth;

       if(save==="modifier"){
         url="http://localhost:8000/volontaire/"+id;
         meth="PUT";
       }
       else{
           url = "{{ route('volontaire.store') }}";
           meth="POST";
       }
       $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
       
       $.ajax({
           url:url,
           type:meth,
           data:$('#form').serialize(),
           dataType:"JSON",
           success:function(data){
              if(data.error){
                console.log(data.error)
                if(data.error.nom){
                    console.log(data.error.nom[0]);
                    $('#nom').addClass("is-invalid");
                    $('#erreur_nom').text(data.error.nom[0]);
                }
                else{
                    $('#nom').removeClass("is-invalid");
                    $('#erreur_nom').text("");
                }

                if(data.error.prenom){
                    console.log(data.error.prenom[0]);
                    $('#prenom').addClass("is-invalid");
                    $('#erreur_prenom').text(data.error.prenom[0]);
                }
                else{
                    $('#prenom').removeClass("is-invalid");
                    $('#erreur_prenom').text("");
                }

                if(data.error.adresse){
                    $('#adresse').addClass("is-invalid");
                    $('#erreur_adresse').text(data.error.adresse[0]);
                }
                else{
                    $('#adresse').removeClass("is-invalid");
                    $('#erreur_adresse').text("");
                }
                if(data.error.telephone){
                    $('#telephone').addClass("is-invalid");
                    $('#erreur_telephone').text(data.error.telephone[0]);
                }
                else{
                    $('#telephone').removeClass("is-invalid");
                    $('#erreur_telephone').text("");
                }

                if(data.error.structure){
                    $('#structure').addClass("is-invalid");
                    $('#erreur_structure').text(data.error.structure[0]);
                }
                else{
                    $('#structure').removeClass("is-invalid");
                    $('#erreur_structure').text("");
                }

                if(data.error.cin){
                    console.log(data.error.cin[0]);
                    $('#cin').addClass("is-invalid");
                    $('#erreur_cin').text(data.error.cin[0]);
                }
                else{
                    $('#cin').removeClass("is-invalid");
                    $('#erreur_cin').text("");
                }

                if(data.error.dateDeNaissance){
                    console.log(data.error.dateDeNaissance[0]);
                    $('#dateDeNaissance').addClass("is-invalid");
                    $('#erreur_dateDeNaissance').text(data.error.dateDeNaissance[0]);
                }
                else{
                    $('#dateDeNaissance').removeClass("is-invalid");
                    $('#erreur_dateDeNaissance').text("");
                }

                if(data.error.lieuDeNaissance){
                    console.log(data.error.lieuDeNaissance[0]);
                    $('#lieuDeNaissance').addClass("is-invalid");
                    $('#erreur_lieuDeNaissance').text(data.error.lieuDeNaissance[0]);
                }
                else{
                    $('#lieuDeNaissance').removeClass("is-invalid");
                    $('#erreur_lieuDeNaissance').text("");
                }

                if(data.error.email){
                    console.log(data.error.email[0]);
                    $('#email').addClass("is-invalid");
                    $('#erreur_email').text(data.error.email[0]);
                }
                else{
                    $('#email').removeClass("is-invalid");
                    $('#erreur_email').text("");
                }

                if(data.error.materiel){
                    console.log(data.error.materiel[0]);
                    $('#materiel').addClass("is-invalid");
                    $('#erreur_materiel').text(data.error.materiel[0]);
                }
                else{
                    $('#materiel').removeClass("is-invalid");
                    $('#erreur_materiel').text("");
                }
                console.log(data.error);
              }
              else{
               console.log(data.success);
               $('#modal').modal('hide');
               reload();}
           },
           error:function(xhr,statusText,error){
               alert("error");
           }
       })
    }

    function modifier(ref){
      
      
        save="modifier";
        $('.modal-title').text("Modifer la structure");
        $('#form')[0].reset();
        //alert();
        $.ajax({
            url:"http://localhost:8000/volontaire/"+ref,
            type:"GET",
            dataType:"JSON",
            success:function(data){
                console.log(data);
            $('.modal-title').val("Modifer le volontaire");
               $('#nom').val(data.nom);
               $('#adresse').val(data.adresse);
               $('#telephone').val(data.telephone);

               $('#prenom').val(data.prenom);
               $('#email').val(data.email);
               $('#cin').val(data.numeroCIN);

               $('#materiel').val(data.materiel);
               $('#structure').val(data.idStructure);
               $('#dateDeNaissance').val(data.dateDeNaissance);
               $('#lieuDeNaissance').val(data.lieuDeNaissance);
              
               id=data.reference;
               $('#modal').modal('show');
            },
            error:function(xhr,statusText,error){
                alert(error);
            }
        })
   
    }

    function supprimer(ref){
       alert(ref);
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

       $.ajax({
           url:"{{ route('structure.destroy',['structure'=>"+ref+"]) }}",
           method:"DELETE",
           dataType:"JSON",
           success:function(data){
               console.log(data.donnee);
               reload();
           },
           error:function(xhr,statusText,error){
               alert(error);
           }
       });
    }
</script>
<div>
    <div class="modal" tabindex="-1" id="modal">
        <div class="modal-dialog" id="c" >
          <div class="modal-content" id="corps">
            <div class="modal-header" id="titre">
              <h3 class="modal-title">Ajouter un Volontaire</h3>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" >
              <form class="" id="form" onsubmit="enregistrer(event);">
                @csrf
                  <div class="form-group mb-3 row">
                      <div class="col-md-6">
                            <label for="nom">Nom</label>
                            <input type="text" placeholder="veuillez entrer le nom du volontaire" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror"  value="{{ old('nom') }}" >
                            <span class="erreur" id="erreur_nom">@error('nom') {{ $message }}  @enderror</span>
                      </div>
                      <div class="col-md-6">
                            <label for="prenom">Prenom</label>
                            <input type="text" placeholder="veuillez entrer le prenom du volontaire" name="prenom" id="prenom" class="form-control @error('prenom') is-invalid @enderror"  value="{{ old('prenom') }}" >
                            <span class="erreur" id="erreur_prenom">@error('prenom') {{ $message }}  @enderror</span>
                      </div>
                    </div>
                    <div class="form-group mb-3 row">
                        <div class="col-md-6">
                              <label for="dateDeNaissance">Date de Naissance</label>
                              <input type="date" placeholder="" name="dateDeNaissance" id="dateDeNaissance" class="form-control @error('dateDeNaissance') is-invalid @enderror"  value="{{ old('dateDeNaissance') }}" min="{{ Date('Y-m-d',strtotime(date('Y-m-d') . "-50 years"))}}" max="{{  date('Y-m-d', strtotime(date('Y-m-d') . "-18 years")) }}" >
                              <span class="erreur" id="erreur_dateDeNaissance">@error('dateDeNaissance') {{ $message }}  @enderror</span>
                        </div>
                        <div class="col-md-6">
                              <label for="lieuDeNaissance">Lieu de Naissance</label>
                              <input type="text" placeholder="veuillez entrer le lieu de naissance" name="lieuDeNaissance" id="lieuDeNaissance" class="form-control @error('lieuDeNaissance') is-invalid @enderror"  value="{{ old('lieuDeNaissance') }}" >
                              <span class="erreur" id="erreur_lieuDeNaissance">@error('lieuDeNaissance') {{ $message }}  @enderror</span>
                        </div>
                      </div>
                  <div class="mb-3 row">
                      <div class="col-md-6">
                        <label for="adresse">Adresse</label>
                        <input type="text" placeholder="veuillez entrer l'adresse du volontaire" class="form-control @error('adresse') is-invalid @enderror"  value="{{ old('adresse') }}" name="adresse" id="adresse"  >
                        <span class="erreur" id="erreur_adresse">@error('adresse') {{ $message }}  @enderror</span>
                     </div>

                <div class="col-md-6">
                    <label for="telephone">Telephone</label>
                    <input type="text" maxlength="9" placeholder="veuillez entrer le telephone du volontaire" class="form-control @error('telephone') is-invalid @enderror"  value="{{ old('telephone') }}" name="telephone" id="telephone">
                    <span class="erreur" id="erreur_telephone">@error('telephone') {{ $message }}  @enderror</span>
                </div>
                  </div>
                  <div class="mb-3 row">
                    <div class="col-md-6">
                      <label for="email">E-mail</label>
                      <input type="email" placeholder="veuillez entrer l'email du volontaire" class="form-control @error('email') is-invalid @enderror"  value="{{ old('email') }}" name="email" id="email"  >
                      <span class="erreur" id="erreur_email">@error('email') {{ $message }}  @enderror</span>
                   </div>

              <div class="col-md-6">
                  <label for="cin">Numero CIN / Passeport</label>
                  <input type="text" maxlength="12" placeholder="veuillez entrer le numero de cin/passeport" class="form-control @error('cin') is-invalid @enderror"  value="{{ old('cin') }}" name="cin" id="cin">
                  <span class="erreur" id="erreur_cin">@error('cin') {{ $message }}  @enderror</span>
              </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-md-6">
                    <label for="structure">Structure</label>
                    <select class="form-select @error('structure') is-invalid @enderror"  value="{{ old('structure') }}"" aria-label="Default select example" name="structure" id="structure">
                        <option value="">-----selectionner la structure-----</option>
                        @foreach ($structure as $structure )
                           <option value="{{ $structure->idStructure }}">{{ $structure->nomStructure }}</option> 
                        @endforeach
                        
                      </select>
                      <span class="erreur" id="erreur_structure">@error('structure') {{ $message }}  @enderror</span>
                </div>
                <div class="col-md-6">
                    <label for="materiel">Materiel</label>
                    <select class="form-select @error('materiel') is-invalid @enderror"  value="{{ old('materiel') }}"" aria-label="Default select example" name="materiel" id="materiel">
                        <option value="">-----selectionner la materiel-----</option>
                        @foreach ($materiel as $materiel)
                        <option value="{{ $materiel->reference }}">{{ $materiel->libelle }}</option>
                            
                        @endforeach
                        
                      </select>
                      <span class="erreur" id="erreur_materiel">@error('materiel') {{ $message }}  @enderror</span>
                </div>
                </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">annuler et fermer</button>
              <button type="submit" class="btn btn-primary">Enregistrer le volontaire</button>
            </div>
        </form>
          </div>
        </div>
      </div>
</div>
@endsection
       