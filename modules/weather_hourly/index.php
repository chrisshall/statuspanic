<?php

function curl($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	$info = curl_exec($ch);
	curl_close($ch);
	
	return $info;
}
// Get JSON data from Wunderground
$url_contents_current = curl('http://api.wunderground.com/api/89f006e4b4be6bbf/hourly/q/GA/Duluth.json');


// Conver JSON data to PHP Array 
$data_hourly = json_decode($url_contents_current, true);
$data_hourly = $data_hourly['hourly_forecast'];


// echo $data_hourly[0]['icon_url'];
?>

<div id="hourly_div" style="height:0px">
	
	<table id="hourly_row" style="overflow-x: scroll; overflow-y: hidden; width=850px; display:block">
		<tr>
		<?php foreach($data_hourly as $hour){
			echo '
			<td>
					<div style="margin: 10px; margin-top:50px">
					';
						if ($hour["FCTTIME"]["hour"] == "0"){
							echo '<p style="margin-top:-1em"> '. $hour["FCTTIME"]["mon_abbrev"] . " " .$hour["FCTTIME"]["mday"];
						}
			echo '
						<p> ' . $hour["FCTTIME"]["civil"] . ' </p>
						<img src=' . $hour['icon_url'] . ' height="100" width="100"/>
						<p> ' . $hour["temp"]["english"] . '&deg; F</p>
					</div>
			</td>'
		;}?>
		</tr>
	</table>
</div>
<div id="line_div" style="height:0px; margin-top:7em;float:right">

</div>

	
<!-- POP UP WINDOW Line Graph -->
 <!-- Import google chart loader since bootstrapping doesn't seem to work -->
    <!--<script type="text/javascript" src="modules/linegraph/loader.js"></script>-->
	
    <script type="text/javascript">
	  google.charts.load('current', {'packages':['corechart']});
	  //google.charts.load('current', {'packages':['annotatedtimeline']});
      google.charts.setOnLoadCallback(drawChart);
		
		/* $('#line_div').on('scroll', function(){
			$('#hourly_div').scrollTop($(this).scrollTop());
		}); */

		$('#hourly_row').scroll(function(){
			var x = $(this).scrollLeft()
			if ( x >= 120 && x < 240) {
				panChart(1);
			}
			else if ( x >= 240 && x < 360) {
				panChart(2);
			}
			else if ( x >= 360 && x < 480) {
				panChart(3);
			}
			else if ( x >= 480 && x < 600) {
				panChart(4);
			}
			else if ( x >= 600 && x < 720) {
				panChart(5);
			}
			else if ( x >= 720 && x < 840) {
				panChart(6);
			}
			else if ( x >= 840 && x < 960) {
				panChart(7);
			}
			else if ( x >= 960 && x < 1080) {
				panChart(8);
			}
			else if ( x >= 1080 && x < 1200) {
				panChart(9);
			}
			else if ( x >= 1200 && x < 1320) {
				panChart(10);
			}
			else if ( x >= 1320 && x < 1440) {
				panChart(11);
			}
			else if ( x >= 1440 && x < 1560) {
				panChart(12);
			}
			else if ( x >= 1560 && x < 1680) {
				panChart(13);
			}
			else if ( x >= 1680 && x < 1800) {
				panChart(14);
			}
			else if ( x >= 1800 && x < 1920) {
				panChart(15);
			}
			else if ( x >= 1920 && x < 2040) {
				panChart(16);
			}
			else if ( x >= 2040 && x < 2160) {
				panChart(17);
			}
			else if ( x >= 2160 && x < 2280) {
				panChart(18);
			}
			else if ( x >= 2280 && x < 2400) {
				panChart(19);
			}
			else if ( x >= 2400 && x < 2520) {
				panChart(20);
			}
			else if ( x >= 2520 && x < 2640) {
				panChart(21);
			}
			else if ( x >= 2640 && x < 2760) {
				panChart(22);
			}
			else if ( x >= 2760 && x < 2880) {
				panChart(23);
			}
			else if ( x >= 2880 && x < 3000) {
				panChart(24);
			}
			else if ( x >= 3000 && x < 3120) {
				panChart(25);
			}
			else if ( x >= 3120 && x < 3240) {
				panChart(26);
			}
			else if ( x >= 3240 && x < 3360) {
				panChart(27);
			}
			else if ( x >= 3360 && x < 3480) {
				panChart(28);
			}
			else if ( x >= 3480 && x < 3600) {
				panChart(29);
			}
			else if ( x >= 3600 && x < 3720) {
				panChart(30);
			}
			else if ( x >= 3720 && x < 3840) {
				panChart(31);
			}
			else if ( x >= 3840 && x < 3960) {
				panChart(32);
			}
			
		});
		
		function panChart(index){
			options = {
				width: 850,
				height: 375,
				legend: {position: 'none'},
				interpolateNulls: false,
				enableInteractivity: false,
				pointSize: 0,
				colors: ["#FF3333", "#0099FF"],
				fill: 50,
				thickness: 3,
				series: {
					0: {
					areaOpacity: 0 }
				},
				backgroundColor: ["black"],
				chartArea:{ width: '85%',
							backgroundColor: '#eeeeee'},
				explorer: {
					axis: 'horizontal',
					keepInBounds: true
					},
				hAxis: {
					viewWindow:{
						min: new Date(2018,temp[index]['FCTTIME']['mon']-1,temp[index]['FCTTIME']['mday'],temp[index]['FCTTIME']['hour']),
						max: new Date(2018,temp[6+index]['FCTTIME']['mon']-1,temp[6+index]['FCTTIME']['mday'],temp[6+index]['FCTTIME']['hour'])
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
			chart.draw(data,options);

		}		
		
		var chart;
		var data;
		var options;
		var temp = <?php echo json_encode($data_hourly) ?>;
		
      function drawChart() {		
		  
			//document.getElementById("chart_div").parentElement.style.height = "500px";
			  // Get data Arrays from PHP
			  
			 
			  //console.log(valuesArray);
			  //console.log(valuesArray[0]['month']);
			  
			data = new google.visualization.DataTable();
			data.addColumn('datetime', 'Time of Day');
			data.addColumn('number', 'Temperature');
			data.addColumn('number', 'Chance of Rain');
			
/*			data.addRow([
 				new Date(2018,valuesArray[0]['month'],valuesArray[0]['day'],valuesArray[0]['hour'],valuesArray[0]['min']),valuesArray[0]['price']]);
			data.addRow([	
				new Date(2018,valuesArray[1]['month'],valuesArray[1]['day'],valuesArray[1]['hour'],valuesArray[1]['min']),valuesArray[1]['price']]);
 */			//console.log(temp[0]['temp']['english']);
			//console.log(temp.length);
		
			//console.log(Object.keys(valuesArray).length);
			for (var i=0; i<temp.length; i++){
				 data.addRow(
					 [new Date(2018,temp[i]['FCTTIME']['mon']-1,
					 temp[i]['FCTTIME']['mday'],
					 temp[i]['FCTTIME']['hour']),
					 Number(temp[i]['temp']['english']),
					 Number(temp[i]['pop'])]);
					 
					// console.log(valuesArray[i]['price']);
			}
			//console.log(data.getNumberOfRows());
			//console.log(valuesArray[Object.keys(valuesArray).length-1]['month']);
			//console.log(new Date(2018,temp[0]['FCTTIME']['mon']-1,temp[0]['FCTTIME']['mday'],temp[0]['FCTTIME']['hour']));
			options = {
				width: 850,
				height: 375,
				legend: {position: 'none'},
				interpolateNulls: false,
				enableInteractivity: false,
				pointSize: 0,
				colors: ["#FF3333", "#0099FF"],
				fill: 50,
				thickness: 3,
				series: {
					0: {
					areaOpacity: 0 }
				},
				backgroundColor: ["black"],
				chartArea:{ width: '85%',
							backgroundColor: '#eeeeee'},
				explorer: {
					axis: 'horizontal',
					keepInBounds: true
					},
				hAxis: {
					viewWindow:{
						min: new Date(2018,temp[0]['FCTTIME']['mon']-1,temp[0]['FCTTIME']['mday'],temp[0]['FCTTIME']['hour']),
						max: new Date(2018,temp[6]['FCTTIME']['mon']-1,temp[6]['FCTTIME']['mday'],temp[6]['FCTTIME']['hour'])
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
					chart = new google.visualization.AreaChart(
						document.getElementById('line_div'));
						
						chart.draw(data, options);

			
			
	  }