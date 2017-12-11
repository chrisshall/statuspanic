<?php 

//Get SCERs in Array
$str = file_get_contents('./SCER.json');
// Need to change encoding to UTF-8
$str = utf8_encode($str);
$scer_array = json_decode($str,true);
error_reporting(E_ALL & ~E_NOTICE);

//print_r($scer_array);

//For Getting only this year's SCERs
$jan_first = 42736; //The number of days after 12/30/1899
$jan = 0;
$feb = 0;
$mar = 0;
$apr = 0;
$may = 0;
$jun = 0;
$jul = 0;
$aug = 0;
$sep = 0;
$oct = 0;
$nov = 0;
$dec = 0;



if (is_array($scer_array)){
	foreach ($scer_array as $scer){
		try{
			if ($scer['date_recvd'] > $jan_first){
				if ($scer['date_recvd'] < 42767)
					$jan++;
				elseif ($scer['date_recvd'] < 42795)
					$feb++;
				elseif ($scer['date_recvd'] < 42826)
					$mar++;
				elseif ($scer['date_recvd'] < 42856)
					$apr++;
				elseif ($scer['date_recvd'] < 42887)
					$may++;
				elseif ($scer['date_recvd'] < 42917)
					$jun++;
				elseif ($scer['date_recvd'] < 42948)
					$jul++;
				elseif ($scer['date_recvd'] < 42979)
					$aug++;
				elseif ($scer['date_recvd'] < 43009)
					$sep++;
				elseif ($scer['date_recvd'] < 43040)
					$oct++;
				elseif ($scer['date_recvd'] < 43070)
					$nov++;
				elseif ($scer['date_recvd'] < 43101)
					$dec++;
			}
		} catch(Exception $e){
			//Do nothing
		}
	}
}
$opened_array = array($jan, $feb, $mar, $apr, $may, $jun, $jul, $aug, $sep, $oct, $nov, $dec);

// Get Number of SCERs CLOSED/REJECTED this year
$jan = 0;
$feb = 0;
$mar = 0;
$apr = 0;
$may = 0;
$jun = 0;
$jul = 0;
$aug = 0;
$sep = 0;
$oct = 0;
$nov = 0;
$dec = 0;
if (is_array($scer_array)){
	foreach ($scer_array as $scer){
		try{
			if ($scer['date_recvd'] > $jan_first){
				// if we received the scer this year and it is closed or rejected OR
				// if the "Need_Date" is set for this year
				if ($scer['date_recvd'] < 42767 && ($scer['status_code'] == 'c' || $scer['status_code'] == 'r'))
					$jan++;
				elseif ($scer['date_recvd'] < 42795 && ($scer['status_code'] == 'c' || $scer['status_code'] == 'r'))
					$feb++;
				elseif ($scer['date_recvd'] < 42826 && ($scer['status_code'] == 'c' || $scer['status_code'] == 'r'))
					$mar++;
				elseif ($scer['date_recvd'] < 42856 && ($scer['status_code'] == 'c' || $scer['status_code'] == 'r'))
					$apr++;
				elseif ($scer['date_recvd'] < 42887 && ($scer['status_code'] == 'c' || $scer['status_code'] == 'r'))
					$may++;
				elseif ($scer['date_recvd'] < 42917 && ($scer['status_code'] == 'c' || $scer['status_code'] == 'r'))
					$jun++;
				elseif ($scer['date_recvd'] < 42948 && ($scer['status_code'] == 'c' || $scer['status_code'] == 'r'))
					$jul++;
				elseif ($scer['date_recvd'] < 42979 && ($scer['status_code'] == 'c' || $scer['status_code'] == 'r'))
					$aug++;
				elseif ($scer['date_recvd'] < 43009 && ($scer['status_code'] == 'c' || $scer['status_code'] == 'r'))
					$sep++;
				elseif ($scer['date_recvd'] < 43040 && ($scer['status_code'] == 'c' || $scer['status_code'] == 'r'))
					$oct++;
				elseif ($scer['date_recvd'] < 43070 && ($scer['status_code'] == 'c' || $scer['status_code'] == 'r'))
					$nov++;
				elseif ($scer['date_recvd'] < 43101 && ($scer['status_code'] == 'c' || $scer['status_code'] == 'r'))
					$dec++;
			}
		} catch(Exception $e){
			//Do nothing
		}
	}
}
$closed_array = array($jan, $feb, $mar, $apr, $may, $jun, $jul, $aug, $sep, $oct, $nov, $dec);

?>

  <head>
  <!-- Import google chart loader since bootstrapping doesn't seem to work -->
    <script type="text/javascript" src="modules/linegraph/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
	
      function drawChart() {
		  var valuesArray = <?php echo json_encode($opened_array); ?>;
		  var closedArray = <?php echo json_encode($closed_array); ?>;
		  
        var data = google.visualization.arrayToDataTable([
		<!-- Shows all open SCERS for the year -->
          ['Year', 'SCERs Opened', 'SCERS Closed'],
          ['Jan',  valuesArray[0], closedArray[0]],
          ['Feb',  valuesArray[1], closedArray[1]],
          ['Mar',  valuesArray[2], closedArray[2]],
          ['Apr',  valuesArray[3], closedArray[3]],
		  ['May',  valuesArray[4], closedArray[4]],
          ['Jun',  valuesArray[5], closedArray[5]],
          ['Jul',  valuesArray[6], closedArray[6]],
          ['Aug',  valuesArray[7], closedArray[7]],
          ['Sep',  valuesArray[8], closedArray[8]],
		  ['Oct',  valuesArray[9], closedArray[9]],
          ['Nov',  valuesArray[10], closedArray[10]],
          ['Dec',  valuesArray[11], closedArray[11]]
        ]);

        var options = {
          title: 'Number of SCERs Opened vs. Closed in 2017',
		  titleTextStyle: {
			  color: 'black',
			  fontSize: 26,
			  bold: false,
			  italic: false
			  },
          curveType: 'function',
          legend: { position: 'bottom' },
		  colors: ['#000000', '#f00000'],
		  backgroundColor: {
		    stroke: '#5a5a5a',
			strokeWidth: 10,
			fill: 'white'
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