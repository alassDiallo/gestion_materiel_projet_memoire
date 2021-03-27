@extends('accueilUser')
@section('content')
<script src="js/chartjs.js">
</script>
<div class="row mt" >
    <div class="" style="margin-top:30px; margin-left:50px;">
      <!-- CHART PANELS -->
      <div class="row text-center">
        <div class="container">
        <div class="card col-md-3 m-4 text-center bg-success border-4" style="height: 150px;color:white">
          <div class="row text-center">
            <span style="font-size: 50px"><i class="fa fa-calendar" ></i></span>
            <h4>Rendez-vous</h4>
            <div>
              8<br/>
              demande en attente
            </div>
          </div>
        </div>
        <div class="card col-md-3 m-4 bg-danger border-4"  style="height: 150px;color:white">
          <div class="row text-center">
            <span style="font-size: 50px"><i class="fa fa-files-o" ></i></span>
            <h4>Ordonnances</h4>
            <div>
              19
            </div>
          </div>
        </div>
        <div class="card col-md-3 m-4 bg-primary border-4"  style="height: 150px">
          <div class="row text-center">
            <span style="font-size: 50px"><i class="fa fa-users" ></i></span>
            <h4>Patients</h4>
            <div>
              2
            </div>
          </div>
        </div>
        </div>
      </div>
            <div style="height: 500px;" class="col-md-6">

              <canvas id="myChart" width="400" height="300"></canvas>
          </div>
          <script>
              var ctx = document.getElementById('myChart').getContext('2d');
              var myChart = new Chart(ctx, {
                  type: 'line',
                  data: {
                      labels: ['janvier', 'fevrier', 'Mars', 'Avril', 'Mai', 'Juin','Juillet','Aout','Septembre','Octobre','Novembre','decembre'],
                      datasets: [{
                          // label: '# of Votes',
                          data: [2, 5, 9, 3, 10, 13,20,25,18],
                          backgroundColor: [
                              'rgba(255, 99, 132, 0.2)',
                              'rgba(54, 162, 235, 0.2)',
                              'rgba(255, 206, 86, 0.2)',
                              'rgba(75, 192, 192, 0.2)',
                              'rgba(153, 102, 255, 0.2)',
                              'rgba(255, 159, 64, 0.2)',
                              'rgba(255, 122, 64, 0.2)'
                          ],
                          borderColor: [
                              'rgba(255, 99, 132, 1)',
                              'rgba(54, 162, 235, 1)',
                              'rgba(255, 206, 86, 1)',
                              'rgba(75, 192, 192, 1)',
                              'rgba(153, 102, 255, 1)',
                              'rgba(255, 159, 64, 1)'
                          ],
                          borderWidth: 1
                      }]
                  },
                  options: {
                    title: {
            display: true,
            text: 'Sondage demande de rensez-vous'
        },
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero: true
                              }
                          }]
                      }
                  }
              });
              </script>
</div></div></div>
        </div>
        <!-- page end-->
      </section>
    </div>
 </div>
@endsection