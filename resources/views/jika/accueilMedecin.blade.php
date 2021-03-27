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
            <thead>
                <tr>
                    <th>prenom</th>
                    <th>nom</th>
                    <th>date de naissane</th>
                    <th>telephone</th>
                    <th>specialite</th>
                    <th>Structure</th>
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
    //var erreur_nom=false;
    $(document).ready(function(){
    table =  $('#table').DataTable({
         //"serverSide":true,
        // "proccessing":true,
        "ajax":{
           "url":"{{ route('medecin.index') }}",
           "method":"GET",
        //    success:function(data){
        //        console.log(data);
        //    },
        //    error:function(error){
        //        alert(error);
        //    }
         },
         "columns":[
            
             {data:"prenom"},
             {data:"nom"},
             {data:"dateDeNaissance"},
             {data:"telephone"},
             {data:"libelle"},
             {data:"nomStructure"},
             {data:"action"}
         ],
         language:{
             url:"/js/DataTables/French.json"
         }

     });
        // init datatable.
    //    var table = $('#table').DataTable({
    //         processing: true,
    //         serverSide: true,
    //         autoWidth: false,
    //         pageLength: 5,
    //         // scrollX: true,
    //         "order": [[ 0, "desc" ]],
    //         ajax: "{{ route('structure.index') }}",
    //         columns: [
    //             {data: 'idStructure'},
    //             {data: 'reference'},
    //             {data: 'nom'},
    //             {data: 'adresse'},
    //             {data: 'telephone'},
    //             {data: 'region'},
    //             {data: 'action', name: 'action',orderable:false,serachable:false,sClass:'text-center'},
    //         ],
    //         language:{
    //          url:"/js/DataTables/French.json"
    //      }
    //     });
        
        
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
         url="http://localhost:8000/structure/"+id;
         meth="PUT";
       }
       else{
           url = "{{ route('structure.store') }}";
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

                if(data.error.region){
                    $('#region').addClass("is-invalid");
                    $('#erreur_region').text(data.error.region[0]);
                }
                else{
                    $('#region').removeClass("is-invalid");
                    $('#erreur_region').text("");
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
            url:"http://localhost:8000/structure/"+ref,
            type:"GET",
            dataType:"JSON",
            success:function(data){
                console.log(data);
            $('.modal-title').val("Modifer la Structure");
               $('#nom').val(data[0].nom);
               $('#adresse').val(data[0].adresse);
               $('#telephone').val(data[0].telephone);
               $('#region').val(data[0].region);
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
       })
   
    }
</script>
<div>
    <div class="modal" tabindex="-1" id="modal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header text-center">
              <h3 class="modal-title ">Ajouter une structure</h3>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form class="" id="form" onsubmit="enregistrer(event);">
                @csrf
                  <div class="form-group mb-3">
                      <label for="nom">Nom</label>
                      <input type="text" placeholder="veuillez entrer le nom de la structure" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror"  value="{{ old('nom') }}" >
                      <span class="erreur" id="erreur_nom">@error('nom') {{ $message }}  @enderror</span>
                  </div>
                  <div class="mb-3">
                    <label for="adresse">Adresse</label>
                    <input type="text" placeholder="veuillez entrer l'adresse de la structure" class="form-control @error('adresse') is-invalid @enderror"  value="{{ old('adresse') }}" name="adresse" id="adresse"  >
                    <span class="erreur" id="erreur_adresse">@error('adresse') {{ $message }}  @enderror</span>
                </div>

                <div class="mb-3">
                    <label for="telephone">Telephone</label>
                    <input type="text" maxlength="9" placeholder="veuillez entrer le telephone de la structure" class="form-control @error('telephone') is-invalid @enderror"  value="{{ old('telephone') }}" name="telephone" id="telephone">
                    <span class="erreur" id="erreur_telephone">@error('telephone') {{ $message }}  @enderror</span>
                </div>
                <div class="mb-3">
                    <label for="region">Region</label>
                    <select class="form-select @error('region') is-invalid @enderror"  value="{{ old('region') }}"" aria-label="Default select example" name="region" id="region">
                        <option value="">-----selectionner la region-----</option>
                        <option value="Dakar" {{ old('region')==="Dakar"?"selected":"" }}>Dakar</option>
                        <option value="Thies" {{ old('region')==="Thies"?"selected":"" }}>Thies</option>
                        <option value="Diourbel" {{ old('region')==="Diourbel"?"selected":"" }}>Dioubel</option>
                        <option value="Fatick" {{ old('region')==="Fatick"?"selected":"" }}>Fatick</option>
                        <option value="St-Louis" {{ old('region')==="St-Louis"?"selected":"" }}>Saint-Louis</option>
                        <option value="Kaolack" {{ old('region')==="Kaolack"?"selected":"" }}>Kaolack</option>
                        <option value="Kolda" {{ old('region')==="Kolda"?"selected":"" }}>Kolda</option>
                        <option value="Kaffrine" {{ old('region')==="Kaffrine"?"selected":"" }}>Kaffrine</option>
                        <option value="Sedhiou" {{ old('region')==="Sedhiou"?"selected":"" }}>Sedhiou</option>
                        <option value="Ziguinchor" {{ old('region')==="Ziguinchor"?"selected":"" }}>Ziguinchor</option>
                        <option value="Kedougou" {{ old('region')==="Kedougou"?"selected":"" }}>Kedougou</option>
                        <option value="Matam" {{ old('region')==="Matam"?"selected":"" }}>Matam</option>
                        <option value="Tambacounda" {{ old('region')==="Tambacounda"?"selected":"" }}>Tambacounda</option>
                        <option value="Louga" {{ old('region')==="Louga"?"selected":"" }}>Louga</option>
                      </select>
                      <span class="erreur" id="erreur_region">@error('region') {{ $message }}  @enderror</span>
                </div>
            
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">annuler et fermer</button>
              <button type="submit" class="btn btn-primary">Enregistrer la structure</button>
            </div>
        </form>
          </div>
        </div>
      </div>
</div>
@endsection
