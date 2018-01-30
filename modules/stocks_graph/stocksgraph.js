	  google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
		

		
      function drawChart() {		
		  
		  
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
				
			console.log(Object.keys(valuesArray).length);
			for (var i=0; i<Object.keys(valuesArray).length; i++){
				 data.addRow(
					 [new Date(2018,valuesArray[i]['month']-1,
					 valuesArray[i]['day'],
					 valuesArray[i]['hour'],
					 valuesArray[i]['min']),
					 valuesArray[i]['price']]);
					 
					 console.log(valuesArray[i]['price']);
			}
			//console.log(data);
			var options = {
				width: 900,
				height: 500,
				legend: {position: 'none'},
				enableInteractivity: false,
				chartArea:{ width: '85%'},
				hAxis: {
					viewWindow:{
						//max: new Date(2018,valuesArray[0]['month'],valuesArray[0]['day'],valuesArray[0]['hour'],valuesArray[0]['min']),
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
						
					var chart = new google.visualization.LineChart(
						document.getElementById('chart_div'));
						
						chart.draw(data, options);

			
			
	  }




