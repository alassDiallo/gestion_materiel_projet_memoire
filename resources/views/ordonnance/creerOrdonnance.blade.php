@extends('accueilUser')
@section('content')
<div class="card" style="margin-top:10px;margin-left:30px;height:100%">
<div class="card-body">
<div class="row" style="margin-top:20px;margin-left:30px">
<div class="col-md-5" style="padding:10px;">
    <table id="table" class="table table-bordered text-center mt-4">
        <thead  style="color:white;background:black">
        <tr>
            <th>Libelle</th>
            <th>Prix</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<div class="container col-md-6 b-danger " style="">
<div>
<h4  class="text-center">Ordonnance</h4><hr/>
<div id="contenu">
</div>
<div style="margin-top: 50px;" class="col-md-12">
<div class=" row mb-4">
<div class="pull-left" style="font-size: 14px;font-weight:bold">
Total : <span id="coup"></span>
</div>
<div class="pull-center" style="font-size: 14px;font-weight:bold">
Prise en charge(80%) : <span id="pec"></span>
</div>
<div class="pull-right" style="font-size: 14px;font-weight:bold">
patient(20%) : <span id="patient"></span>
</div>
</div>
<div id="formulaire">
<Form action="{{ route('prescription.store') }}" method="POST">
   @csrf
    <div>
    <input type="hidden" name="idord" id="idord" />
    <input type="hidden" name="coup" id="total" value="0"/>
    <input type="text" name="reference" id="reference" class="form-control mt-4" placeholder="entrer la reference ou le numero de telephone du patient" maxlength="12" required/>
    <span id="erreur" style="color: red"></span> 
    <input type="submit" value="valider la prescription" class="btn btn-primary col-md-4 form-control mt-4" />
    <div>
</form>
    </div>
</div>
</div>
</div>
</div>
@endsection
@section('ajax')
<script>
    
    var table;
    var save;
    var id;
    //var id;
    //var erreur_nom=false;
    $(document).ready(function(){

        function orde(){
            return $('#idordonnance').val();
        }

      //  $('#idord').val($('#idordonnance').val());

    table =  $('#table').DataTable({
        //  "serverSide":true,
        // "proccessing":true,
        "ajax":{
           "url":"{{route('medicament.index')}}",
           "method":"GET",
        //    success:function(data){
        //        console.log(data);
        //    }
         },
         "columns":[
             {data:"libelle"},
             {data:"prix"},
             {data:"action"},
         ],
         language:{
             url:"/js/DataTables/French.json"
         }

     });
      $('#quantite').on('keypress',function(e){
         console.log(e.keyCode);
         if(e.keyCode<48 || e.keyCode>57){
             return false;
         }
     });

    //  $('#verif').on('blur',function(e){
    //      console.log(e.target.value);
    //      $.ajax({
    //          url:"http://localhost:8000/rechercher/"+e.target.value,
    //          method:"GET",
    //          success:function(data){
    //              console.log(data);
    //          },
    //          error:function(textStatus,error){
    //              alert(error);
    //          }
    //      })
    //  })

     $('#idord').attr('value',$('#idordonnance').val());

     $('#formulaire').hide();

     $('#quantite').on('input',function(e){
         console.log(e.target.value);
         if(e.target.value<1){
             console.log('null');
        $('#quantite').addClass("is-invalid");
      $('#erreur_quantite').text("la quantite doit etre superieur a 0");
         }
         else{
             console.log('valide');
            $('#quantite').removeClass("is-invalid");
            $('#erreur_quantite').text("");
         }
     })
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
                $('#indication').val(data[0].indication);
                data[0].quantite.split('h');
                var h = data[0].quantite.split('h');
               $('#id').val(data[0].id);
               console.log($('#id').val());
                $('#quantite').val(h[0]+":"+h[1]);
                
            }
        })
       
        $('#modal').modal('show');

        
    }

    function ajouter(id){
        $('#id').val(id);
        $('#modal').modal('show');
    }

    function valider(e){
        e.preventDefault();
        console.log($('#enr').serialize());
        $.ajax({
            url:"{{ route('prescription.store') }}",
            method:"POST",
            data:$('#enr').serialize(),
            success:function(data){
                if(data.error){
                  $('#reference').addClass('is-invalid');
                    $('#erreur').text(data.error);
                }
                else{
                    $('#reference').removeClass('is-invalid');
                    $('#erreur').text("");
                    $('#contenu').children().remove();
                    $('#total').attr('value',"");
                    $('#coup').text("");
                    $('#pec').text("");
                    $('#patient').text("");  
                    $('#formulaire').hide();
                    $('#enr')[0].reset();
                }
            },
            error:function(statusText,error){
                alert(error);
            }
        });
      
    }

    function enregistrer(e){
        var erreur=false;
        e.preventDefault();
        if(parseInt($('#quantite').val())<1){
            erreur=true;
            $('#quantite').addClass("is-invalid");
            $('#erreur_quantite').text("la quantite doit etre superieur a 0");

   }
   else{
    erreur=false;
    $('#quantite').removeClass("is-invalid");
    $('#quantite_err').text("");
   }
   if(erreur){
  console.log("erreur");
  }
  else{
  
  console.log($('#form').serialize());
    //console.log($('#idordonnance').val());
        $.ajax({
         url:"{{  route('ordonnance.store') }}",
         method:"POST",
         data:$('#form').serialize(),
         success:function(data){
             console.log(data);
            var div="<div class='row'><h4 class='col-md-6'>"+data.libelle+"</h4><span class='col-md-3'>prix : "+data.prix+"</span><span class='col-md-3'>quantité : "+$('#quantite').val()+"</span></div><div>"+$('#indication').val()+"</div><hr/>";
            $('#contenu').append(div);
            $('#total').attr('value',(parseInt($('#total').attr("value")))+(data.prix*parseInt($('#quantite').val())));
            $('#coup').text(($('#total').val())+"  .00 Franc CFA");
            $('#pec').text((parseInt($('#total').val())*0.8)+"  .00 Franc CFA");
            $('#patient').text((parseInt($('#total').val())*0.2)+"  .00 Franc CFA");             
            //  info();
            //  reload();
            $('#form')[0].reset();
            $('#formulaire').show();
            $('#modal').modal('hide');
         },
         error:function(textStatus,error){
             alert(error);
         }

      });
    }
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
              <h4 class="modal-title ">Indication du medicament</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="" id="form" onsubmit="enregistrer(event);">
                    @csrf
                    <input type="hidden" name="id" id="id"/>
                    <input type="hidden" name="idOrdonnance" id="idordonnance" value="{{ referenceOrdonnance() }}"/>
                      <div class="form-group mb-3">
                          <label for="indication">indication</label>
                         <textarea name="indication" class="form-control" id="indication" maxlength="150" required>{{ old('indication')}}</textarea>
                          <span class="erreur" id="erreur_indication">@error('indication') {{ $message }}  @enderror</span>
                      </div>
                      <div class="mb-3">
                        <label for="quantite">Quantite</label>
                        <input type="text" placeholder="veuillez choisir la quantité" class="form-control @error('quantite') is-invalid @enderror"  value="{{ old('quantite') }}" name="quantite" id="quantite" maxlength="1" required >
                        <span class="erreur" style="color: red" id="erreur_quantite">@error('quantite') {{ $message }}  @enderror</span>
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
    
        </div>
        </div></div></div>
     @endsection
     