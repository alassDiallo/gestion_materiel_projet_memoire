@extends('accueilUser')
@section('content')
<div class="section__content section__content--p30" style="background: blue">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
              <div class="au-card">
                <div id="calendar"></div>
              </div>
            </div><!-- .col -->
        </div>
@endsection
@section('ajax')
     <script>
     var tues = moment().day(2).hour(19);

  // build trival night events for example data
  var events = [
    {
      title: "Special Conference",
      start: moment().format('YYYY-MM-DD'),
      url: '#'
    },
    {
      title: "Doctor Appt",
      start: moment().hour(9).add(2, 'days').toISOString(),
      url: '#'
    }

  ];

  var trivia_nights = []

  for(var i = 1; i <= 4; i++) {
    var n = tues.clone().add(i, 'weeks');
    console.log("isoString: " + n.toISOString());
    trivia_nights.push({
      title: 'Trival Night @ Pub XYZ',
      start: n.toISOString(),
      allDay: false,
      url: '#'
    });
  }

  // setup a few events
  $('#calendar').fullCalendar({
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,agendaWeek,agendaDay,listWeek'
    },
    events: events.concat(trivia_nights)
  });
});
    </script>
     @endsection