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
</style>
<div style="margin-left: 30px;height:100%" class="card">
    <div class="card-body">
        <a class="btn btn-success m-3" id="ajout" onclick="ajouter();"><i class="fa fa-plus ml-4"></i>Ajouter un fournisseur</a>
        <table class="table m-3 table-bordered table-striped text-center" id="table">
            <thead>
                <tr>
                    <th>Information</th>
                    <th>adresse</th>
                    <th>telephone</th>
                    <th>email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('ajax')
<script>
    var table;
    var save;
    //var erreur_nom=false;
    $(document).ready(function(){
    table =  $('#table').DataTable({
         //"serverSide":true,
        // "proccessing":true,
        "ajax":{
           "url":"{{ route('fournisseur.index') }}",
           "method":"GET",
        //    success:function(data){
        //        console.log(data);
        //    }
         },
         "columns":[

             {data:"nom"},
             {data:"adresse"},
             {data:"telephone"},
             {data:"email"},
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
    })
    var ref;
    function ajouter(){
        save="ajouter";
        $('#form')[0].reset();
        $('.modal-title').text("Ajouter un fournisseur");
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
         url="http://localhost:8000/fournisseur/"+id;
         meth="PUT";
       }
       else{
           url = "{{ route('fournisseur.store') }}";
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

                if(data.error.nom){
                    console.log(data.error.nom[0]);
                    $('#nom').addClass("is-invalid");
                    $('#erreur_nom').text(data.error.nom[0]);
                }
                else{
                    $('#nom').removeClass("is-invalid");
                    $('#erreur_nom').text("");
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

                if(data.error.mail){
                    $('#mail').addClass("is-invalid");
                    $('#erreur_mail').text(data.error.mail[0]);
                }
                else{
                    $('#mail').removeClass("is-invalid");
                    $('#erreur_mail').text("");
                }
                console.log(data.error);
              }
              else{
               console.log(data);
               $('#modal').modal('hide');
               reload();}
           },
           error:function(xhr,statusText,error){
               alert(error);
           }
       })
    }

    function modifier(ref){


        save="modifier";
        $('.modal-title').text("Modifier les informations du fournisseur");
        $('#form')[0].reset();
        //alert();
        $.ajax({
            url:"http://localhost:8000/fournisseur/"+ref,
            type:"GET",
            dataType:"JSON",
            success:function(data){
                console.log(data);
            $('.modal-title').val("Modifer le fournisseur");
               $('#nom').val(data[0].nom);
               $('#adresse').val(data[0].adresse);
               $('#telephone').val(data[0].telephone);
               $('#mail').val(data[0].mail);
               id=data[0].referenceFournisseur;
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
           url:"('fournisseur.destroy',['fournisseur'=>"+ref+"]) }}",
           method:"DELETE",
           dataType:"JSON",
           success:function(data){
               console.log(data.donnee);
               reload();
           },
           error:function(xhr,statusText,error){
               alert(error);
           }
       })

    }
</script>
<div>
    <div class="modal" tabindex="-1" id="modal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header text-center">
              <h3 class="modal-title ">Ajouter un fournisseur</h3>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form class="" id="form" onsubmit="enregistrer(event);">
                @csrf
                  <div class="form-group mb-3">
                      <label for="nom">Nom</label>
                      <input type="text" placeholder="veuillez entrer le nom du fournisseur" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror"  value="{{ old('nom') }}" >
                      <span class="erreur" id="erreur_nom">@error('nom') {{ $message }}  @enderror</span>
                  </div>
                  <div class="mb-3">
                    <label for="adresse">Adresse</label>
                    <input type="text" placeholder="veuillez entrer l'adresse du fournisseur" class="form-control @error('adresse') is-invalid @enderror"  value="{{ old('adresse') }}" name="adresse" id="adresse"  >
                    <span class="erreur" id="erreur_adresse">@error('adresse') {{ $message }}  @enderror</span>
                </div>

                <div class="mb-3">
                    <label for="telephone">Telephone</label>
                    <input type="text" maxlength="9" placeholder="veuillez entrer le telephone du fournisseur" class="form-control @error('telephone') is-invalid @enderror"  value="{{ old('telephone') }}" name="telephone" id="telephone">
                    <span class="erreur" id="erreur_telephone">@error('telephone') {{ $message }}  @enderror</span>
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" placeholder="veuillez entrer l'email du fournisseur" class="form-control @error('email') is-invalid @enderror"  value="{{ old('email') }}" name="email" id="email">
                    <span class="erreur" id="erreur_email">@error('email') {{ $message }}  @enderror</span>
                </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">annuler et fermer</button>
              <button type="submit" class="btn btn-primary">Enregistrer </button>
            </div>
        </form>
          </div>
        </div>
      </div>
</div>
@endsection
