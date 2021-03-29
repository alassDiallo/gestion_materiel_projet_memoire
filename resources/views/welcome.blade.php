<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
<link rel='stylesheet' href='main.css' />

          
</head>
<body>
<div id='calendar'></div>
<script src='moment.min.js'></script>
<script src='js/jquery-3.5.1.js'></script>
<script src='jquery-ui.min.js'></script>
<script src='main.min.js'></script>
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
     local:'fr',
     editable:true,
     selectable:true,
     selectHelper:true,
     aspectRatio:2,
     height:650,
     showNonCurrentDates:false,
     defaultView:"Month",
     yearColumns:3,
     header:{
       left:"prev,next,today",
       center:"title",
       right:"year,month,basicWeek,basicDay"
     },
     events:'/rv'
   })

 });
 </script>
    </body>
</html>
