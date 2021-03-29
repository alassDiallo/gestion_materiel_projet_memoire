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
        <a class="btn btn-success m-3" id="ajout" onclick="ajouter();"><i class="fa fa-plus ml-4"></i>Ajouter une specialité</a>
        <table class="table m-3 table-bordered table-striped text-center" id="table">
            <thead style="font-size: 14px">
                <tr>
                    <th>Reference</th>
                    <th>libelle</th>
                    <th>prix consultation</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody style="font-size: 12px">
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('ajax')
<script>
    var table;
    var save;
    //var erreur_libelle=false;
    $(document).ready(function(){
    table =  $('#table').DataTable({
         //"serverSide":true,
        // "proccessing":true,
        "ajax":{
           "url":"{{ route('specialite.index') }}",
           "method":"GET",
        //    success:function(data){
        //        console.log(data);
        //    }
         },
         "columns":[
            
             {data:"reference"},
             {data:"libelle"},
             {data:"prixConsultation"},
             {
                        "render": function (image, type, JsonResultRow, meta) {
                            return '<img src="'+JsonResultRow.image+'" width="100px" height="60px"/>';
                        }
                    },
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
    //             {data: 'libelle'},
    //             {data: 'prix'},
    //             {data: 'image'},
    //             {data: 'region'},
    //             {data: 'action', name: 'action',orderable:false,serachable:false,sClass:'text-center'},
    //         ],
    //         language:{
    //          url:"/js/DataTables/French.json"
    //      }
    //     });
        
        
     $('#image').on('keypress',function(e){
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
         url="http://localhost:8000/specialite/"+id;
         meth="PUT";
       }
       else{
           url = "{{ route('specialite.store') }}";
           meth="POST";
       }
       $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            console.log($('#image').val());
       $.ajax({
           url:url,
           type:meth,
           data:$('#form').serialize(),
           dataType:"JSON",
           success:function(data){
              if(data.error){
                
                if(data.error.libelle){
                    console.log(data.error.libelle[0]);
                    $('#libelle').addClass("is-invalid");
                    $('#erreur_libelle').text(data.error.libelle[0]);
                }
                else{
                    $('#libelle').removeClass("is-invalid");
                    $('#erreur_libelle').text("");
                }
                if(data.error.prix){
                    $('#prix').addClass("is-invalid");
                    $('#erreur_prix').text(data.error.prix[0]);
                }
                else{
                    $('#prix').removeClass("is-invalid");
                    $('#erreur_prix').text("");
                }
                if(data.error.image){
                    $('#image').addClass("is-invalid");
                    $('#erreur_image').text(data.error.image[0]);
                }
                else{
                    $('#image').removeClass("is-invalid");
                    $('#erreur_image').text("");
                }

                console.log(data.error);
              }
              else{
                  console.log(data);
            //    console.log(data.success);
            //    $('#modal').modal('hide');
            //    reload();
               }
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
            url:"http://localhost:8000/specialite/"+ref,
            type:"GET",
            dataType:"JSON",
            success:function(data){
                console.log(data);
            $('.modal-title').val("Modifer la Structure");
               $('#libelle').val(data[0].libelle);
               $('#prix').val(data[0].prix);
               $('#image').val(data[0].image);
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
              <form class="" id="form"  enctype="multipart/form-data" action="{{ route('specialite.store') }}" method="POST">
                @csrf
                  <div class="form-group mb-3">
                      <label for="libelle">libelle de l'specialité</label>
                      <input type="text" placeholder="veuillez entrer le libelle de la specialité" name="libelle" id="libelle" class="form-control @error('libelle') is-invalid @enderror"  value="{{ old('libelle') }}" >
                      <span class="erreur" id="erreur_libelle">@error('libelle') {{ $message }}  @enderror</span>
                  </div>
                  <div class="mb-3">
                    <label for="prix">prix</label>
                    <input type="text" placeholder="veuillez entrer l'prix de la structure" class="form-control @error('prix') is-invalid @enderror"  value="{{ old('prix') }}" name="prix" id="prix"  >
                    <span class="erreur" id="erreur_prix">@error('prix') {{ $message }}  @enderror</span>
                </div>

                <div class="mb-3">
                    <label for="image">image</label>
                    <input type="file"  class="form-control @error('image') is-invalid @enderror"  value="{{ old('image') }}" name="image" id="image">
                    <span class="erreur" id="erreur_image">@error('image') {{ $message }}  @enderror</span>
                </div>
            
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">annuler et fermer</button>
              <button type="submit" class="btn btn-primary">Enregistrer la specialité</button>
            </div>
        </form>
          </div>
        </div>
      </div>
</div>
@endsection
