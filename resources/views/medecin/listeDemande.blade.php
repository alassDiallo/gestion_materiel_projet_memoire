@extends('accueilUser')
@section('content')
<div style="margin-top: 100px;" class="col-md-12">
   <table class="table table-bordered text-center" id="table">
    <thead>
        <th>#</th>
        <th>Prenom</th>
        <th>Nom</th>
        <th>Adresse</th>
        <th>Telephone</th>
        <th>Date</th>
        <th>heure</th>
        <th>etat</th>
        <th>Action</th>
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
           "url":"/listeRendezvous",
           "method":"GET",
        //    success:function(data){
        //        console.log(data);
        //    }
         },
         "columns":[
             {data:"id"},
             {data:"nom"},
             {data:"prenom"},
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
     </script>
     @endsection