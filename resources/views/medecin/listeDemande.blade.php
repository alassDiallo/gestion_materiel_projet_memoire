@extends('accueilUser')
@section('content')
<div style="margin-top: 15px;margin-left:25px;" class="">
    <div class="card " style="height:100%">
        <div class="card-header">
           <h3 class="pull-left">Mes demandes de rendez-vous</h3>
            <div class="pull-right">
                <a href="#" class="btn mr-4 text-center" style="background: #6610f2;color:white;border-radius:100%;"><i class="fa fa-plus" style="" onclick="ajouteR();"></i></a>
                <a href="#" class="btn btn-success ml-4" style="background: #6610f2;color:white;border-radius:100%" onclick="reload();"><i class="fa fa-refresh"></i></a>
            </div>
            
        </div>
        <div class="card-body">
   <table class="table table-bordered text-center" id="table" style="margin-top: 20px">
    <thead style="font-size: 15px;background:black;color:white">
       
        <th>Prenom</th>
        <th>Nom</th>
        <th>Adresse</th>
        <th>Telephone</th>
        <th>Date</th>
        <th>heure</th>
        <th>etat</th>
        <th>Action</th>
    </thead>
    <tbody style="font-size: 12px">
    </tbody>
   </table>
        </div>
</div>
</div>  
@endsection
@section('ajax')
<script>
    var date = Date();
    var table;
    var save;
    var id;
    //var id;
    //var erreur_nom=false;
    $(document).ready(function(){
    table =  $('#table').DataTable({
        //  "serverSide":true,
        // "proccessing":true,
        "ajax":{
           "url":"/listeRendezvous",
           "method":"GET",
        //    success:function(data){
        //        console.log(data);
        //    }
         },
         "columns":[
           
             {data:"prenom"},
             {data:"nom"},
             {data:"adresse"},
             {data:"telephone"},
             {data:"date"},
             {data:"heure"},
             {data:"etat"},
             {data:"action"}
         ],
         language:{
             url:"/js/DataTables/French.json"
         }

     });
    });

    function info(){
        var unique_id = $.gritter.add({
        // (string | mandatory) the heading of the notification
        title: 'Vous avez accepter la demande de rendez-vous',
        // (string | mandatory) the text inside the notification
        text: 'le patient sera notifier',
        // (string | optional) the image to display on the left
        image: 'img/vol.png',
        // (bool | optional) if you want it to fade out on its own or just sit there
        sticky: false,
        // (int | optional) the time you want it to be alive for before fading out
        time: 8000,
        // (string | optional) the class name you want to apply to that specific message
        class_name: 'my-sticky-class'
      });

      return false;
    }

    function reload(){
        $('#table').DataTable().ajax.reload();
    }

    var id;

    function modifier(id){
        $.ajax({
            url:"rendezvous/"+id,
            method:"GET",
            success:function(data){
                console.log(data);
                $('#date').val(data[0].date);
                data[0].heure.split('h');
                var h = data[0].heure.split('h');
               $('#id').val(data[0].id);
               console.log($('#id').val());
                $('#heure').val(h[0]+":"+h[1]);
                
            }
        })
       
        $('#modal').modal('show');

        
    }

    function ajouteR(){
        $('#ajout').modal('show');
    }

    function accepter(id){

        $.ajax({
            url:"/valider/"+id,
            method:"GET",
            success:function(data){

                console.log(data);
                info();
                reload();
                
            },
            error:function(statusText,error){
                alert(error);
            }


        })
      
      

    }

    function enregistrer(e){
        e.preventDefault();
        $.ajax({
         url:"http://localhost:8000/rendezvous/"+id,
         method:"PUT",
         data:$('#form').serialize(),
         success:function(data){
             $('#modal').modal('hide');
             info();
             reload();
         },
         error:function(textStatus,error){
             alert(error);
         }

      });
    }

    function refuser(id){
      
      reload();
    }
     </script>

<div>
    <div class="modal" tabindex="-1" id="modal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header text-center">
              <h4 class="modal-title ">Modifier la demande de rendez-vous</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="" id="form" onsubmit="enregistrer(event);">
                    @csrf
                    <input type="hidden" name="id" id="id"/>
                      <div class="form-group mb-3">
                          <label for="date">Date</label>
                          <input type="date" placeholder="veuillez choisir la date" min="{{ Date('Y-m-d')}}" max="{{  date('Y-m-d', strtotime(date('Y-m-d') . "+1 years")) }}" name="date" id="date" class="form-control @error('date') is-invalid @enderror"  value="{{ old('date') }}" required >
                          <span class="erreur" id="erreur_date">@error('date') {{ $message }}  @enderror</span>
                      </div>
                      <div class="mb-3">
                        <label for="heure">Heure</label>
                        <input type="time" placeholder="veuillez choisir l'heure" class="form-control @error('heure') is-invalid @enderror"  value="{{ old('heure') }}" name="heure" id="heure" required >
                        <span class="erreur" id="erreur_heure">@error('heure') {{ $message }}  @enderror</span>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">annuler</button>
                      </div>
                </form>    
            </div>
        </div>
        </div></div></div>

        <!--  formulaire ajout rendez-vous  !-->
        <div>
    <div class="modal" tabindex="-1" id="ajout">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header text-center">
              <h4 class="modal-title ">Ajouter un rendez-vous</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="" id="forma" onsubmit="ajouter(event);">
                    @csrf
                    <div class="form-group mb-3">
                          <label for="date">Information patient(Telephone/reference/numeroCIN/email)</label>
                          <input type="text" placeholder="veuillez entrez les informations du patient" name="info" id="info" class="form-control @error('info') is-invalid @enderror"  value="{{ old('info') }}" required >
                          <span class="erreur" id="erreur_date">@error('info') {{ $message }}  @enderror</span>
                      </div>
                      <div class="form-group mb-3">
                          <label for="date">Date</label>
                          <input type="date" placeholder="veuillez choisir la date" min="{{ Date('Y-m-d')}}" max="{{  date('Y-m-d', strtotime(date('Y-m-d') . "+1 years")) }}" name="dater" id="dater" class="form-control @error('dater') is-invalid @enderror"  value="{{ old('dater') }}" required>
                          <span class="erreur" id="erreur_dater">@error('dater') {{ $message }}  @enderror</span>
                      </div>
                      <div class="mb-3">
                        <label for="heure">Heure</label>
                        <input type="time" placeholder="veuillez choisir l'heure" class="form-control @error('heurer') is-invalid @enderror"  value="{{ old('heurer') }}" name="heurer" id="heurer" required >
                        <span class="erreur" id="erreur_heurer">@error('heurer') {{ $message }}  @enderror</span>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">annuler</button>
                        
                      </div>
                </form>    
            </div>
        </div>
        </div></div></div>

     @endsection