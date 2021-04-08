@extends('accueilUser')
@section('css')
<link rel='stylesheet' href='main.css' />
@endsection
@section('content')
<div class="container col-md-11" style="margin-left:100px;margin-top:20px;font-size:14px;color:black;">
<div id='calendar' style="color: black;margin-top:10px;"></div>
</div>
@endsection
@section('calendrier')
<script src='moment.min.js'></script>
<script src='js/jquery-3.5.1.js'></script>
<script src='jquery-ui.min.js'></script>
<script src='main.min.js'></script>
<script src="fr.js"></script>
<script>
  d=[];
 $(document).ready(function(){
  
   $.ajax({
     url:"/rv",
     method:"GET",
     success:function(data){
       console.log(data);
         d=data;
         console.log(d);
     }
   });
   console.log(d);

   var calendar = $('#calendar').fullCalendar({
    locale:"fr",   
     timeZone:"UTC",
    
     selectable:true,
     selectHelper:true,
     aspectRatio:2,
     height:650,
     showNonCurrentDates:false,
     defaultView:"Month",
     yearColumns:3,
     themeSystem: 'bootstrap',
     header:{
       left:"prev,next,today",
       center:"title",
       right:"year,month,basicWeek,basicDay"
     },
     events:'/rv',
     select:function(start,end,allday){
      var data = moment(start, 'DD.MM.YYYY').format('YYYY-MM-DD');
      var d = new Date();
      var a = d.getMonth() <10?"0":"";
      var b = d.getDate()<10?"0":"";
      var today = d.getFullYear()+"-"+(a+(d.getMonth()+1))+"-"+(b+d.getDate());
      console.log(today);
     
      if(data < today){
        alert("vous ne pouvez pas prendre cette date");
      }
      else{
      ajouteR(data);
      }
     
     },
     editable:true,
     eventResize:function(event){
       var data = $.fullCalendar.formatDate(event.start,"Y-MM-DD");
     // var data = moment(event.start, 'DD.MM.YYYY').format('YYYY-MM-DD');
      console.log("assane");
     }
   })

 });
 
 function reloadC(){
   
 }

 function ajouter(event){
  event.preventDefault();
  console.log($('#forma').serialize());
  $.ajax({
      url : "{{ route('accorder') }}",
      method:"POST",
      data:$('#forma').serialize(),
      success:function(data){
         if(data.error){
             console.log(data.error);
             $('#info').addClass('is-invalid');
             $('#erreur_info').text(data.error);
         }
         else{
          $('#info').removeClass('is-invalid');
             $('#erreur_info').text("");
            $('#calendar').fullCalendar('refetchEvents');
             $('#forma')[0].reset();
             $('#ajout').modal('hide');
            
            
         }
      },
      error:function(textStatus,error){
          alert(error);
      }

  })

}

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

function ajouteR(start){
  $('#dater').val(start);
  $('#ajout').modal('show');
  console.log(start);
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
                    <input type="date" min="{{ Date('Y-m-d')}}" max="{{  date('Y-m-d', strtotime(date('Y-m-d') . "+1 years")) }}" name="date" id="date" class="form-control @error('date') is-invalid @enderror"  value="{{ old('date') }}" required >
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
                    <input type="text" placeholder="veuillez entrez les informations du patient" name="info" id="info" class="form-control @error('info') is-invalid @enderror" maxlength="12"  value="{{ old('info') }}" required >
                    <span class="erreur" id="erreur_info" style="color: red">@error('info') {{ $message }}  @enderror</span>
                </div>
                <div class="form-group mb-3">
                    {{-- <label for="date">Date</label> --}}
                    <input type="hidden"  name="dater" id="dater" />
                    {{-- <span class="erreur" id="erreur_dater">@error('dater') {{ $message }}  @enderror</span> --}}
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

