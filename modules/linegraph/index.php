<?php 

//Get SCERs in Array
$scer_array = json_decode("SCER.json",true);

print_r($scer_array);



?>

  <head>
  <!-- Import google chart loader since bootstrapping doesn't seem to work -->
    <script type="text/javascript" src="modules/linegraph/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
		<!-- Shows all open SCERS for the year -->
          ['Year', 'Open SCERS'],
          ['Jan',  1000],
          ['Feb',  1170],
          ['Mar',   660],
          ['Apr',  1030],
		  ['May',   944],
          ['Jun',  1000],
          ['Jul',  1170],
          ['Aug',   660],
          ['Sep',  1030],
		  ['Oct',   399],
          ['Nov',  1000],
          ['Dec',  1170]
        ]);

        var options = {
          title: 'Company Performance',
          curveType: 'function',
          legend: { position: 'bottom' },
		  colors: ['#000000', '#f00000'],
		  backgroundColor: {
		    stroke: '#5a5a5a',
			strokeWidth: 10,
			fill: 'grey'
			}
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div  class="chart" id="curve_chart" style=
	"width: 950px; 
	height: 500px;
	border-radius: 10px;
	background: -webkit-gradient(linear, left top, left bottom, from(#333), to(#222), color-stop(0.5, #222), color-stop(0.5, #333));

	
	"></div>
  </body>
</html>