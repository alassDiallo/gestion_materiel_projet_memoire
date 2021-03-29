(function (){
    document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      headerToolbar:{
          left:"prev,next,today",
          center:"title"
      },
    events:[
        {
            title:"rendez-vous",
            start : "2021-03-28 11:30"
        },
        {
            title:"rendez-vous",
            start : "2021-03-28 12:30"
        }

    ]
    });
    console.log(calendar.render());
  });
})();
