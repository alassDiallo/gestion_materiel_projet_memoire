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
        <a class="btn btn-success m-3" id="ajout" onclick="ajouter();"><i class="fa fa-plus ml-4"></i>Ajouter un medecin</a>
        <table class="table m-3 table-bordered table-striped text-center" id="table">
            <thead style="font-size: 14px">
                <tr>
                    <th>#Reference</th>
                    <th>prenom</th>
                    <th>nom</th>
                    <th>Date et Lieu de naissane</th>
                    <th>telephone</th>
                    <th>specialite</th>
                    <th>Structure</th>
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
            {data:"referenceMedecin"},
             {data:"prenom"},
             {data:"nom"},
             {
                "render":function(data,type,jsonD,meta){
                    var t = jsonD.dateDeNaissance.split('-');
                        return t[2]+"/"+t[1]+"/"+t[0]+" à "+jsonD.lieuDeNaissance;
                }
             },
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
         url="http://localhost:8000/medecin/"+id;
         meth="PUT";
       }
       else{
           url = "{{ route('medecin.store') }}";
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

                // if(data.error.numeroCIN){
                //     console.log(data.error.numeroCIN[0]);
                //     $('#numeroCIN').addClass("is-invalid");
                //     $('#erreur_numeroCIN').text(data.error.numeroCIN[0]);
                // }
                // else{
                //     $('#numeroCIN').removeClass("is-invalid");
                //     $('#erreur_numeroCIN').text("");
                // }

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

                if(data.error.specilite){
                    console.log(data.error.specialite[0]);
                    $('#specialite').addClass("is-invalid");
                    $('#erreur_specialite').text(data.error.specialite[0]);
                }
                else{
                    $('#specialite').removeClass("is-invalid");
                    $('#erreur_specialite').text("");
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

    function supprimer(ref){
       alert(ref);
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

       $.ajax({
           url:"{{ route('medecin.destroy',['medecin'=>"+ref+"]) }}",
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

    function modifier(ref){
      
      console.log("http://localhost:8000/medecin/"+ref);
        save="modifier";
        $('.modal-title').text("Modifer le medecin");
        $('#form')[0].reset();
        //alert();
        $.ajax({
            url:"http://localhost:8000/medecin/"+ref,
            type:"GET",
            dataType:"JSON",
            success:function(data){
                console.log(data);
            $('.modal-title').val("Modifer le medecin");
               $('#nom').val(data[0].nom);
               $('#adresse').val(data[0].adresse);
               $('#telephone').val(data[0].telephone);

               $('#prenom').val(data[0].prenom);
               $('#email').val(data[0].email);
               //$('#cin').val(data[0].numeroCIN);
               $('#sexe').val(data[0].sexe);
               $('#specialite').val(data[0].idSpecialite);
               $('#structure').val(data[0].idStructure);
               $('#dateDeNaissance').val(data[0].dateDeNaissance);
               $('#lieuDeNaissance').val(data[0].lieuDeNaissance);
              
               id=data[0].referenceMedecin;
               $('#modal').modal('show');
            },
            error:function(xhr,statusText,error){
                alert(error);
            }
        })
   
    }
</script>
<div>
    <div class="modal" tabindex="-1" id="modal" >
        <div class="modal-dialog" id="c" >
          <div class="modal-content" id="corps" style="width:800px;font-size:14px;">
            <div class="modal-header" id="titre">
              <h2 class="modal-title">Ajouter un medecin</h2>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" >
              <form class="" id="form" onsubmit="enregistrer(event);">
                @csrf
                  <div class="form-group mb-3 row">
                      <div class="col-md-6">
                            <label for="nom">Nom</label>
                            <input type="text" placeholder="veuillez entrer le nom du medecin" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror"  value="{{ old('nom') }}" required>
                            <span class="erreur" id="erreur_nom">@error('nom') {{ $message }}  @enderror</span>
                      </div>
                      <div class="col-md-6">
                            <label for="prenom">Prenom</label>
                            <input type="text" placeholder="veuillez entrer le prenom du medecin" name="prenom" id="prenom" class="form-control @error('prenom') is-invalid @enderror"  value="{{ old('prenom') }}" required >
                            <span class="erreur" id="erreur_prenom">@error('prenom') {{ $message }}  @enderror</span>
                      </div>
                    </div>
                    <div class="form-group mb-3 row">
                        <div class="col-md-6">
                              <label for="dateDeNaissance">Date de Naissance</label>
                              <input type="date" placeholder="" name="dateDeNaissance" id="dateDeNaissance" class="form-control @error('dateDeNaissance') is-invalid @enderror"  value="{{ old('dateDeNaissance') }}" min="{{ Date('Y-m-d',strtotime(date('Y-m-d') . "-50 years"))}}" max="{{  date('Y-m-d', strtotime(date('Y-m-d') . "-18 years")) }}" required >
                              <span class="erreur" id="erreur_dateDeNaissance">@error('dateDeNaissance') {{ $message }}  @enderror</span>
                        </div>
                        <div class="col-md-6">
                              <label for="lieuDeNaissance">Lieu de Naissance</label>
                              <input type="text" placeholder="veuillez entrer le lieu de naissance" name="lieuDeNaissance" id="lieuDeNaissance" class="form-control @error('lieuDeNaissance') is-invalid @enderror"  value="{{ old('lieuDeNaissance') }}" required >
                              <span class="erreur" id="erreur_lieuDeNaissance">@error('lieuDeNaissance') {{ $message }}  @enderror</span>
                        </div>
                      </div>

                      <div class="mb-3 row">
                        <div class="col-md-6">
                          <label for="adresse">Sexe</label>
                         <select name="sexe" class="form-select" required>
                             <option value="">------selectionner---------</option>
                             <option value="homme">homme</option>
                             <option value="femme">femme</option>
                         </select> 
                          <span class="erreur" id="erreur_sexe">@error('sexe') {{ $message }}  @enderror</span>
                       </div>
                      
                        <div class="col-md-6">
                          <label for="experience">Experience</label>
                          <input type="text" placeholder="veuillez entrer l'experience du medecin" class="form-control @error('experience') is-invalid @enderror"  value="{{ old('experience') }}" name="experience" id="experience" required >
                          <span class="erreur" id="erreur_experience">@error('experience') {{ $message }}  @enderror</span>
                       
                      </div>
                      </div>
                  <div class="mb-3 row">
                      <div class="col-md-6">
                        <label for="adresse">Adresse</label>
                        <input type="text" placeholder="veuillez entrer l'adresse du medecin" class="form-control @error('adresse') is-invalid @enderror"  value="{{ old('adresse') }}" name="adresse" id="adresse" required >
                        <span class="erreur" id="erreur_adresse">@error('adresse') {{ $message }}  @enderror</span>
                     </div>

                <div class="col-md-6">
                    <label for="telephone">Telephone</label>
                    <input type="text" maxlength="9" placeholder="veuillez entrer le telephone du medecin" class="form-control @error('telephone') is-invalid @enderror"  value="{{ old('telephone') }}" name="telephone" id="telephone" required>
                    <span class="erreur" id="erreur_telephone">@error('telephone') {{ $message }}  @enderror</span>
                </div>
                  </div>
                  <div class="mb-3 row">
                    <div class="col-md-6">
                      <label for="email">E-mail</label>
                      <input type="email" placeholder="veuillez entrer l'email du medecin" class="form-control @error('email') is-invalid @enderror"  value="{{ old('email') }}" name="email" id="email" required >
                      <span class="erreur" id="erreur_email">@error('email') {{ $message }}  @enderror</span>
                   </div>

              <div class="col-md-6">
                  <label for="numeroCIN">Numero numeroCIN / Passeport</label>
                  <input type="text" maxlength="12" placeholder="veuillez entrer le numero de numeroCIN/passeport" class="form-control @error('numeroCIN') is-invalid @enderror"  value="{{ old('numeroCIN') }}" name="numeroCIN" id="numeroCIN" required>
                  <span class="erreur" id="erreur_numeroCIN">@error('numeroCIN') {{ $message }}  @enderror</span>
              </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-md-6">
                    <label for="structure">Structure</label>
                    <select class="form-select @error('structure') is-invalid @enderror"  value="{{ old('structure') }}"" aria-label="Default select example" name="structure" id="structure" required>
                        <option value="">-----selectionner la structure-----</option>
                        @foreach ($structure as $structure )
                           <option value="{{ $structure->idStructure }}">{{ $structure->nomStructure }}</option> 
                        @endforeach
                        
                      </select>
                      <span class="erreur" id="erreur_structure">@error('structure') {{ $message }}  @enderror</span>
                </div>
                <div class="col-md-6">
                    <label for="specialite">specialite</label>
                    <select class="form-select @error('specialite') is-invalid @enderror"  value="{{ old('specialite') }}"" aria-label="Default select example" name="specialite" id="specialite" required>
                        <option value="">-----selectionner-----</option>
                        @foreach ($specialite as $specialite)
                        <option value="{{ $specialite->idSpecialite }}">{{ $specialite->libelle }}</option>
                            
                        @endforeach
                        
                      </select>
                      <span class="erreur" id="erreur_specialite">@error('specialite') {{ $message }}  @enderror</span>
                </div>
                </div>
            <div class="modal-footer">
              
              <button type="submit" class="btn btn-success">Enregistrer le medecin</button>
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">annuler et fermer</button>
            </div>
        </form>
          </div>
        </div>
      </div>
</div>
@endsection
