@extends('accueilUser')
@section('content')
<div class="row mt" >
    <div class="" style="margin-top:100px; margin-left:50px;">
      <!-- CHART PANELS -->
      <div class="row">
        <div class="col-md-4 col-sm-4 mb">
          <div class="grey-panel pn donut-chart">
            <div class="grey-header">
              <h5>Rendez-vous</h5>
            </div>
            <canvas id="serverstatus01" height="120" width="120"></canvas>
            <script>
              var doughnutData = [{
                  value: 70,
                  color: "#FF6B6B"
                },
                {
                  value: 30,
                  color: "#fdfdfd"
                }
              ];
              var myDoughnut = new Chart(document.getElementById("serverstatus01").getContext("2d")).Doughnut(doughnutData);
            </script>
            <div class="row">
              <div class="col-sm-6 col-xs-6 goleft">
                <p>demande <br/>en attente:</p>
              </div>
              <div class="col-sm-6 col-xs-6">
                <h2>21%</h2>
              </div>
            </div>
          </div>
          <!-- /grey-panel -->
        </div>
        <!-- /col-md-4-->
        <div class="col-md-4 col-sm-4 mb">
          <div class="darkblue-panel pn">
            <div class="darkblue-header">
              <h5>Patient</h5>
            </div>
            <canvas id="serverstatus02" height="120" width="120"></canvas>
            <script>
              var doughnutData = [{
                  value: 60,
                  color: "#1c9ca7"
                },
                {
                  value: 40,
                  color: "#f68275"
                }
              ];
              var myDoughnut = new Chart(document.getElementById("serverstatus02").getContext("2d")).Doughnut(doughnutData);
            </script>
            <p>April 17, 2014</p>
            <footer>
              <div class="pull-left">
                <h5><i class="fa fa-hdd-o"></i> 17 GB</h5>
              </div>
              <div class="pull-right">
                <h5>60% Used</h5>
              </div>
            </footer>
          </div>
          <!--  /darkblue panel -->
        </div>
        <!-- /col-md-4 -->
        <div class="col-md-4 col-sm-4 mb">
          <div class="green-panel pn">
            <div class="green-header">
              <h5>Ordonnance</h5>
            </div>
            <canvas id="serverstatus03" height="120" width="120"></canvas>
            <script>
              var doughnutData = [{
                  value: 60,
                  color: "#2b2b2b"
                },
                {
                  value: 40,
                  color: "#fffffd"
                }
              ];
              var myDoughnut = new Chart(document.getElementById("serverstatus03").getContext("2d")).Doughnut(doughnutData);
            </script>
            <h3>60% USED</h3>
          </div>
        </div>
        <!-- /col-md-4 -->
      </div>
    <div class="">
      <section class="wrapper site-min-height">
        <!-- page start-->
        <div id="morris">
          <div id="hero-bar" class="graph" style="position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
            <svg height="342" version="1.1" width="459" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative; left: -0.885417px; top: -0.666667px;">
                <desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.0
                    </desc>
                    <defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs>
                    <text x="42.53125" y="268.9482899455" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal">
                        <tspan dy="3.995164945499994" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0
                            </tspan>
                        </text>
                        <path fill="none" stroke="#aaaaaa" d="M55.03125,268.5H433.885" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                            </path>
                            <text x="42.53125" y="207.961217459125" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal">
                                <tspan dy="4.0002799591250096" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">500
                                    </tspan>
                                </text>
                                <path fill="none" stroke="#aaaaaa" d="M55.03125,207.5H433.885" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                    </path>
                                    <text x="42.53125" y="146.97414497275" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal">
                                        <tspan dy="3.997582472749997" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">1,000
                                            </tspan>
                                        </text>
                                        <path fill="none" stroke="#aaaaaa" d="M55.03125,146.5H433.885" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                            </path>
                                            <text x="42.53125" y="85.98707248637498" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan dy="4.002697486374984" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">1,500
                                                </tspan>
                                            </text>
                                            <path fill="none" stroke="#aaaaaa" d="M55.03125,85.5H433.885" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                                </path>
                                                <text x="42.53125" y="25" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal">
                                                    <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2,000
                                                        </tspan>
                                                    </text>
                                                    <path fill="none" stroke="#aaaaaa" d="M55.03125,25.5H433.885" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                                        </path>
                                                        <text x="402.31385416666666" y="281.4482899455" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(0.8192,-0.5736,0.5736,0.8192,-108.0817,300.723)"><tspan dy="3.995164945499994" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">iPhone 5</tspan></text><text x="339.1715625" y="281.4482899455" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(0.8192,-0.5736,0.5736,0.8192,-122.7849,266.8013)"><tspan dy="3.995164945499994" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">iPhone 4S</tspan></text><text x="276.02927083333327" y="281.4482899455" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(0.8192,-0.5736,0.5736,0.8192,-130.9222,228.2821)"><tspan dy="3.995164945499994" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">iPhone 4</tspan></text><text x="212.88697916666666" y="281.4482899455" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(0.8192,-0.5736,0.5736,0.8192,-149.4368,197.0401)"><tspan dy="3.995164945499994" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">iPhone 3GS</tspan></text><text x="149.7446875" y="281.4482899455" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(0.8192,-0.5736,0.5736,0.8192,-157.5791,158.5298)"><tspan dy="3.995164945499994" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">iPhone 3G</tspan></text><text x="86.60239583333333" y="281.4482899455" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(0.8192,-0.5736,0.5736,0.8192,-161.083,116.7663)"><tspan dy="3.995164945499994" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">iPhone</tspan></text><rect x="62.92403645833333" y="252.359806229206" width="47.35671875" height="16.588483716294007" r="0" rx="0" ry="0" fill="#ac92ec" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="126.066328125" y="252.23783208423325" width="47.35671875" height="16.710457861266747" r="0" rx="0" ry="0" fill="#ac92ec" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="189.20861979166665" y="235.40540007799376" width="47.35671875" height="33.54288986750623" r="0" rx="0" ry="0" fill="#ac92ec" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="252.35091145833331" y="222.598114855855" width="47.35671875" height="46.350175089645006" r="0" rx="0" ry="0" fill="#ac92ec" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="315.493203125" y="189.05522498834875" width="47.35671875" height="79.89306495715124" r="0" rx="0" ry="0" fill="#ac92ec" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="378.63549479166664" y="77.32690819330975" width="47.35671875" height="191.62138175219025" r="0" rx="0" ry="0" fill="#ac92ec" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect></svg><div class="morris-hover morris-default-style" style="left: 0px; top: 170px; display: none;"><div class="morris-hover-row-label">iPhone 5</div><div class="morris-hover-point" style="color: #ac92ec">
  Geekbench:
  1,571
</div></div></div>
        </div>
        <!-- page end-->
      </section>
    </div>
 </div>
@endsection