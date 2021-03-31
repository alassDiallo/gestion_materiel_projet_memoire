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
<div style="margin-left: 30px;">
        <a class="btn btn-success m-3" id="ajout" onclick="ajouter();"><i class="fa fa-plus ml-4"></i>Ajouter un materiel</a>
        <table class="table m-3 table-bordered table-striped text-center" id="table">
            <thead style="font-size: 14px">
                <tr>
                    <th>#reference</th>
                    <th>libelle</th>
                    <th>type</th>
                    <th>prix</th>
                    <th>Quantite fourni</th>
                    <th>fournisseur</th>
                    <th>Adresse</th>
                    <th>Telephone</th>
                    <th>email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody style="font-size: 12px">
            </tbody>
        </table>
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
            "url":"{{ route('listeDMF') }}",
            "method":"GET",

         },
         "columns":[
             {data:"reference"},
             {data:"libelle"},
             {data:"type"},
             {data:"prix"},
             {data:"quantite"},
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
        $('.modal-title').text("Ajouter un Materiel");
        $('#form')[0].reset();
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
         url="http://localhost:8000/materiel/"+id;
         meth="PUT";
       }
       else{
           url = "{{ route('materiel.store') }}";
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
                if(data.error.libelle){
                    $('#libelle').addClass("is-invalid");
                    $('#erreur_libelle').text(data.error.libelle[0]);
                }
                else{
                    $('#libelle').removeClass("is-invalid");
                    $('#erreur_libelle').text("");
                }


                if(data.error.type){
                    $('#type').addClass("is-invalid");
                    $('#erreur_type').text(data.error.type[0]);
                }
                else{
                    $('#type').removeClass("is-invalid");
                    $('#erreur_type').text("");
                }

                if(data.error.prix){
                    $('#prix').addClass("is-invalid");
                    $('#erreur_prix').text(data.error.prix[0]);
                }
                else{
                    $('#prix').removeClass("is-invalid");
                    $('#erreur_prix').text("");
                }
                if(data.error.quantite){
                    $('#quantite').addClass("is-invalid");
                    $('#erreur_quantite').text(data.error.quantite[0]);
                }
                else{
                    $('#quantite').removeClass("is-invalid");
                    $('#erreur_quantite').text("");
                }
                if(data.error.libelle){
                    $('#adresse').addClass("is-invalid");
                    $('#erreur_adresse').text(data.error.adresse[0]);
                }
                else{
                    $('#libelle').removeClass("is-invalid");
                    $('#erreur_libelle').text("");
                }
                if(data.error.nom){
                    console.log(data.error.nom[0]);
                    $('#nom').addClass("is-invalid");
                    $('#erreur_nom').text(data.error.nom[0]);
                }
                else{
                    $('#nom').removeClass("is-invalid");
                    $('#erreur_nom').text("");
                }
                if(data.error.telephone){
                    console.log(data.error.telephone[0]);
                    $('#telephone').addClass("is-invalid");
                    $('#erreur_telephone').text(data.error.telephone[0]);
                }
                else{
                    $('#telephone').removeClass("is-invalid");
                    $('#erreur_telephone').text("");
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
        $('.modal-title').text("Modifer le materiel");
        $('#form')[0].reset();
        //alert();
        $.ajax({
            url:"http://localhost:8000/materiel/"+ref,
            type:"GET",
            dataType:"JSON",
            success:function(data){
                console.log(data);
            $('.modal-title').val("Modifer le materiel");
               $('#libelle').val(data[0].libelle);
               $('#type').val(data[0].type);
               $('#prix').val(data[0].prix);
               $('#quantite').val(data[0].quantite);
               {{--  $('#nom').val(data[0].nom);  --}}
               id=data[0].reference;
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
           url:"{{ route('materiel.destroy',['materiel'=>"+ref+"]) }}",
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
              <h3 class="modal-title ">Ajouter un materiel</h3>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form class="" id="form" onsubmit="enregistrer(event);">
                @csrf
                  <div class="form-group mb-3">
                      <label for="libelle">Libelle</label>
                      <input type="text" placeholder="veuillez entrer le  libellé du materiel" name="libelle" id="libelle" class="form-control @error('libelle') is-invalid @enderror"  value="{{ old('libelle') }}" >
                      <span class="erreur" id="erreur_libelle">@error('libelle') {{ $message }}  @enderror</span>
                  </div>
                  <div class="mb-3">
                    <label for="type">Type</label>
                    <input type="text" placeholder="veuillez entrer le type de materiel" class="form-control @error('type') is-invalid @enderror"  value="{{ old('type') }}" name="type" id="type"  >
                    <span class="erreur" id="erreur_type">@error('type') {{ $message }}  @enderror</span>
                </div>

                <div class="mb-3">
                    <label for="prix">Prix</label>
                    <input type="number" maxlength="9" placeholder="veuillez entrer le prix" class="form-control @error('prix') is-invalid @enderror"  value="{{ old('prix') }}" name="prix" id="prix">
                    <span class="erreur" id="erreur_prix">@error('prix') {{ $message }}  @enderror</span>
                </div>
                <div class="mb-3">
                    <label for="quantite">Quantité</label>
                    <input type="number" maxlength="quantite" placeholder="veuillez entrer la quantite" class="form-control @error('quantite') is-invalid @enderror"  value="{{ old('quantite') }}" name="quantite" id="quantite">
                    <span class="erreur" id="erreur_quantite">@error('quantite') {{ $message }}  @enderror</span>
                </div>
                <div class="col-md-6">
                    <label for="fournisseur">fournisseur</label>
                    <select class="form-select @error('fournisseur') is-invalid @enderror"  value="{{ old('fournisseur') }}"" aria-label="Default select example" name="fournisseur" id="fournisseur" required>
                        <option value="">-----selectionner-----</option>
                        @foreach ($fournisseur as $fournisseur)
                        <option value="{{ $fournisseur->referenceFournisseur }}">{{ $fournisseur->nom }}</option>

                        @endforeach

                      </select>
                      <span class="erreur" id="erreur_specialite">@error('fournisseur') {{ $message }}  @enderror</span>
                </div>
{{--
                <div class="col-md-6">
                    <label for="fournisseur">fournisseur</label>
                    <select class="form-select @error('fournisseur') is-invalid @enderror"  value="{{ old('fournisseur') }}"" aria-label="Default select example" name="fournisseur" id="fournisseur" required>
                        <option value="">-----selectionner-----</option>

                      </select>
                      <span class="erreur" id="erreur_specialite">@error('fournisseur') {{ $message }}  @enderror</span>
                </div>  --}}

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
