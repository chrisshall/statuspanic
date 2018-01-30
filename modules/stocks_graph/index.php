<?php

/* 
 *	Stocks Module
 */
 
try{
	$string = file_get_contents('https://www.alphavantage.co/query?function=TIME_SERIES_INTRADAY&symbol=NCR&interval=5min&outputsize=full&apikey=AZT5Q3UOFPEOCJYT');
	$data = json_decode($string, true);

	error_reporting(E_ERROR | E_PARSE);

	//Need to round current time down to 5-min interval
	date_default_timezone_set('America/New_York');
	$datetime = new DateTime();
	// If the market it open (from 9:30AM - 4:00PM)
	if (($datetime->format('H') > 9 || ($datetime->format('H') == 9 && $datetime->format('i') >= 30)) && $datetime->format('H') < 16){
		$start_price = $data['Time Series (5min)'][date('Y-m-d',time() -60*60*24).' 16:00:00']['4. close'];
		$minute = $datetime->format('i');
		$minute = $minute - $minute%5;
		$current_time = date("Y-m-d H:");
		if ($minute == 0)
			$minute = "00";
		$current_time = $current_time . $minute . ":00";
		$current_price = $data['Time Series (5min)'][$current_time]['4. close'];
		//echo $start_price;
		
	}
	//Next day before market opens
	elseif($datetime->format('H') <9 || ($datetime->format('H') == 9 && $datetime->format('i') < 30)){  

	// We will take the closing price from yesterday
		$current_price = $data['Time Series (5min)'][date('Y-m-d',time() -60*60*24).' 16:00:00']['4. close'];
		$start_price=$current_price;
	}
	//Market has closed. Take price of last close.
	else{
		$current_price = $data['Time Series (5min)'][date('Y-m-d') . ' 16:00:00']['4. close'];
		$start_price = $data['Time Series (5min)'][date('Y-m-d',time() -60*60*24).' 16:00:00']['4. close'];
	}
	$difference = number_format((float)($current_price-$start_price),2,'.','');
	$current_price = number_format($current_price,2);
	/* DISPLAY */

	if (isset($start_price)) {
		if ($start_price < $current_price) {
			$class = 'uparrow';
			$code = 'A';
		} elseif ($start_price > $current_price) {
			$class = 'downarrow';
			$code = 'A';
		} else {
			$class = 'zero-block';
			$code = 'K';
		}
	}
	//echo (array_keys($data['Time Series (5min)']))[0];
	$datakeys = array_keys($data['Time Series (5min)']);
	//print_r ($data);
	//echo date('d');
	$points_array = array();
	$i = count($datakeys);
	foreach ($datakeys as $arr){
		$timepoint = $arr;	//gets the time value in "yyyy-MM-dd HH:mm:ss" format. need to parse this to make sure day matches
		//echo $timepoint;
		//cho $timepoint;
		//echo '<br>';
		$day = mb_substr($timepoint,8,2);
		$hour = mb_substr($timepoint,-8,2);
		$min = mb_substr($timepoint,-5,2);
		$month = mb_substr($timepoint,5,2);
				
				//echo $month;
				//echo '<br>';
		$points_array[$i-1]= array(
				'month' => $month,
				'day' => $day,
				'hour' => $hour,
				'min' => $min,
				'price' => floatval($data['Time Series (5min)'][$timepoint]['4. close']));
				
			//}
			//echo $timepoint;
			$i--;
	}
	
	
	//print_r($points_array);
}
catch(Exception $e){
	$difference ="Could not retrieve stock data.";
}
?>

<div id='chart_div' style="border-radius: 20px;margin-left:5em; visibility:inheret"></div>




<!-- POP UP WINDOW Line Graph -->
 <!-- Import google chart loader since bootstrapping doesn't seem to work -->
    <!--<script type="text/javascript" src="modules/linegraph/loader.js"></script>-->
	
    <script type="text/javascript">
	  //google.charts.load('current', {'packages':['corechart']});
	  google.charts.load('current', {'packages':['annotatedtimeline']});
      google.charts.setOnLoadCallback(drawChart);
		

		
      function drawChart() {		
		  
			//document.getElementById("chart_div").parentElement.style.height = "500px";
			  // Get data Arrays from PHP
			  var valuesDecode = <?php echo $points_array?>;
			  var valuesArray = <?php echo json_encode($points_array); ?>;
			  //console.log(valuesArray);
			  //console.log(valuesArray[0]['month']);
			  
			var data = new google.visualization.DataTable();
			data.addColumn('datetime', 'Time of Day');
			data.addColumn('number', 'Stock Price');
			
/*			data.addRow([
 				new Date(2018,valuesArray[0]['month'],valuesArray[0]['day'],valuesArray[0]['hour'],valuesArray[0]['min']),valuesArray[0]['price']]);
			data.addRow([	
				new Date(2018,valuesArray[1]['month'],valuesArray[1]['day'],valuesArray[1]['hour'],valuesArray[1]['min']),valuesArray[1]['price']]);
 */
				
			//console.log(Object.keys(valuesArray).length);
			for (var i=0; i<Object.keys(valuesArray).length; i++){
				 data.addRow(
					 [new Date(2018,valuesArray[i]['month']-1,
					 valuesArray[i]['day'],
					 valuesArray[i]['hour'],
					 valuesArray[i]['min']),
					 valuesArray[i]['price']]);
					 
					// console.log(valuesArray[i]['price']);
			}
			console.log(data.getNumberOfRows());
			//console.log(valuesArray[Object.keys(valuesArray).length-1]['month']);
			var options = {
				width: 900,
				height: 500,
				legend: {position: 'none'},
				interpolateNulls: false,
				enableInteractivity: false,
				pointSize: 5,
				chartArea:{ width: '85%'},
				explorer: {
					axis: 'horizontal'
					},
				hAxis: {
					viewWindow:{
						min: new Date(2018,valuesArray[Object.keys(valuesArray).length-60]['month']-1,valuesArray[Object.keys(valuesArray).length-60]['day'],valuesArray[Object.keys(valuesArray).length-60]['hour'],valuesArray[Object.keys(valuesArray).length-60]['min']),
						max: new Date(2018,valuesArray[Object.keys(valuesArray).length-1]['month']-1,valuesArray[Object.keys(valuesArray).length-1]['day'],valuesArray[Object.keys(valuesArray).length-1]['hour'],valuesArray[Object.keys(valuesArray).length-1]['min']),
					},
					gridlines: {
						count: -1,
						units: {
							days: {format: ['MMM dd']},
							hours: {format: ['HH:mm', 'ha']},
						}
					},
					minorGridlines: {
						units: {
						hours: {format: ['hh:mm:ss a', 'ha']},
						minutes: {format: ['HH:mm a Z', ':mm']}
						}
					}
				}
				
			};
					
					for (var i = 0; i<data.getNumberOfRows(); i++){
					}
					var chart = new google.visualization.AnnotationChart(
						document.getElementById('chart_div'));
						
						chart.draw(data, options);

			
			
	  }





