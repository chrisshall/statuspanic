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
				if ($scer['date_recvd'] < 42767 && (mb_strtolower($scer['status_code']) == 'c' || $scer['status_code'] == 'r'))
					$jan++;
				elseif ($scer['date_recvd'] < 42795 && (mb_strtolower($scer['status_code']) == 'c' || $scer['status_code'] == 'r'))
					$feb++;
				elseif ($scer['date_recvd'] < 42826 && (mb_strtolower($scer['status_code']) == 'c' || $scer['status_code'] == 'r'))
					$mar++;
				elseif ($scer['date_recvd'] < 42856 && (mb_strtolower($scer['status_code']) == 'c' || $scer['status_code'] == 'r'))
					$apr++;
				elseif ($scer['date_recvd'] < 42887 && (mb_strtolower($scer['status_code']) == 'c' || $scer['status_code'] == 'r'))
					$may++;
				elseif ($scer['date_recvd'] < 42917 && (mb_strtolower($scer['status_code']) == 'c' || $scer['status_code'] == 'r'))
					$jun++;
				elseif ($scer['date_recvd'] < 42948 && (mb_strtolower($scer['status_code']) == 'c' || $scer['status_code'] == 'r'))
					$jul++;
				elseif ($scer['date_recvd'] < 42979 && (mb_strtolower($scer['status_code']) == 'c' || $scer['status_code'] == 'r'))
					$aug++;
				elseif ($scer['date_recvd'] < 43009 && (mb_strtolower($scer['status_code']) == 'c' || $scer['status_code'] == 'r'))
					$sep++;
				elseif ($scer['date_recvd'] < 43040 && (mb_strtolower($scer['status_code']) == 'c' || $scer['status_code'] == 'r'))
					$oct++;
				elseif ($scer['date_recvd'] < 43070 && (mb_strtolower($scer['status_code']) == 'c' || $scer['status_code'] == 'r'))
					$nov++;
				elseif ($scer['date_recvd'] < 43101 && (mb_strtolower($scer['status_code']) == 'c' || $scer['status_code'] == 'r'))
					$dec++;
			}
		} catch(Exception $e){
			//Do nothing
		}
	}
}
$closed_array = array($jan, $feb, $mar, $apr, $may, $jun, $jul, $aug, $sep, $oct, $nov, $dec);


/*
**	Get Number of SCERs opened in 2015
*/

$jan_first = 42005; //The number of days after 12/30/1899
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
				if ($scer['date_recvd'] < 42036)
					$jan++;
				elseif ($scer['date_recvd'] < 42064)
					$feb++;
				elseif ($scer['date_recvd'] < 42095)
					$mar++;
				elseif ($scer['date_recvd'] < 42125)
					$apr++;
				elseif ($scer['date_recvd'] < 42156)
					$may++;
				elseif ($scer['date_recvd'] < 42186)
					$jun++;
				elseif ($scer['date_recvd'] < 42217)
					$jul++;
				elseif ($scer['date_recvd'] < 42248)
					$aug++;
				elseif ($scer['date_recvd'] < 42278)
					$sep++;
				elseif ($scer['date_recvd'] < 42309)
					$oct++;
				elseif ($scer['date_recvd'] < 42339)
					$nov++;
				elseif ($scer['date_recvd'] < 42369)
					$dec++;
			}
		} catch(Exception $e){
			//Do nothing
		}
	}
}
$opened_array_2015 = array($jan, $feb, $mar, $apr, $may, $jun, $jul, $aug, $sep, $oct, $nov, $dec);

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
				if ($scer['date_recvd'] < 42036 && (mb_strtolower($scer['status_code']) == 'c' || $scer['status_code'] == 'r'))
					$jan++;
				elseif ($scer['date_recvd'] < 42064 && (mb_strtolower($scer['status_code']) == 'c' || $scer['status_code'] == 'r'))
					$feb++;
				elseif ($scer['date_recvd'] <  42095&& (mb_strtolower($scer['status_code']) == 'c' || $scer['status_code'] == 'r'))
					$mar++;
				elseif ($scer['date_recvd'] < 42125 && (mb_strtolower($scer['status_code']) == 'c' || $scer['status_code'] == 'r'))
					$apr++;
				elseif ($scer['date_recvd'] <  42156 && (mb_strtolower($scer['status_code']) == 'c' || $scer['status_code'] == 'r'))
					$may++;
				elseif ($scer['date_recvd'] < 42186&& (mb_strtolower($scer['status_code']) == 'c' || $scer['status_code'] == 'r'))
					$jun++;
				elseif ($scer['date_recvd'] <  42217&& (mb_strtolower($scer['status_code']) == 'c' || $scer['status_code'] == 'r'))
					$jul++;
				elseif ($scer['date_recvd'] < 42248 && (mb_strtolower($scer['status_code']) == 'c' || $scer['status_code'] == 'r'))
					$aug++;
				elseif ($scer['date_recvd'] <  42278&& (mb_strtolower($scer['status_code']) == 'c' || $scer['status_code'] == 'r'))
					$sep++;
				elseif ($scer['date_recvd'] < 42309 && (mb_strtolower($scer['status_code']) == 'c' || $scer['status_code'] == 'r'))
					$oct++;
				elseif ($scer['date_recvd'] < 42339 && (mb_strtolower($scer['status_code']) == 'c' || $scer['status_code'] == 'r'))
					$nov++;
				elseif ($scer['date_recvd'] < 42369 && (mb_strtolower($scer['status_code']) == 'c' || $scer['status_code'] == 'r'))
					$dec++;
			}
		} catch(Exception $e){
			//Do nothing
		}
	}
	$closed_array_2015 = array($jan, $feb, $mar, $apr, $may, $jun, $jul, $aug, $sep, $oct, $nov, $dec);

}

/*
**	Get Number of SCERs opened in 2016
*/

$jan_first = 42370; //The number of days after 12/30/1899
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
				if ($scer['date_recvd'] < 42401)
					$jan++;
				elseif ($scer['date_recvd'] < 42430)
					$feb++;
				elseif ($scer['date_recvd'] < 42461)
					$mar++;
				elseif ($scer['date_recvd'] < 42491)
					$apr++;
				elseif ($scer['date_recvd'] < 42522)
					$may++;
				elseif ($scer['date_recvd'] < 42552)
					$jun++;
				elseif ($scer['date_recvd'] < 42583)
					$jul++;
				elseif ($scer['date_recvd'] < 42614)
					$aug++;
				elseif ($scer['date_recvd'] < 42644)
					$sep++;
				elseif ($scer['date_recvd'] < 42675)
					$oct++;
				elseif ($scer['date_recvd'] < 42705)
					$nov++;
				elseif ($scer['date_recvd'] < 42735)
					$dec++;
			}
		} catch(Exception $e){
			//Do nothing
		}
	}
}
$opened_array_2016 = array($jan, $feb, $mar, $apr, $may, $jun, $jul, $aug, $sep, $oct, $nov, $dec);

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
				if ($scer['date_recvd'] < 42401 && (mb_strtolower($scer['status_code']) == 'c' || $scer['status_code'] == 'r'))
					$jan++;
				elseif ($scer['date_recvd'] < 42430 && (mb_strtolower($scer['status_code']) == 'c' || $scer['status_code'] == 'r'))
					$feb++;
				elseif ($scer['date_recvd'] < 42461 && (mb_strtolower($scer['status_,code']) == 'c' || $scer['status_code'] == 'r'))
					$mar++;
				elseif ($scer['date_recvd'] < 42491 && (mb_strtolower($scer['status_code']) == 'c' || $scer['status_code'] == 'r'))
					$apr++;
				elseif ($scer['date_recvd'] < 42522 && (mb_strtolower($scer['status_code']) == 'c' || $scer['status_code'] == 'r'))
					$may++;
				elseif ($scer['date_recvd'] < 42552 && (mb_strtolower($scer['status_code']) == 'c' || $scer['status_code'] == 'r'))
					$jun++;
				elseif ($scer['date_recvd'] < 42583 && (mb_strtolower($scer['status_code']) == 'c' || $scer['status_code'] == 'r'))
					$jul++;
				elseif ($scer['date_recvd'] < 42614 && (mb_strtolower($scer['status_code']) == 'c' || $scer['status_code'] == 'r'))
					$aug++;
				elseif ($scer['date_recvd'] < 42644 && (mb_strtolower($scer['status_code']) == 'c' || $scer['status_code'] == 'r'))
					$sep++;
				elseif ($scer['date_recvd'] < 42675 && (mb_strtolower($scer['status_code']) == 'c' || $scer['status_code'] == 'r'))
					$oct++;
				elseif ($scer['date_recvd'] < 42705 && (mb_strtolower($scer['status_code']) == 'c' || $scer['status_code'] == 'r'))
					$nov++;
				elseif ($scer['date_recvd'] < 42732 && (mb_strtolower($scer['status_code']) == 'c' || $scer['status_code'] == 'r'))
					$dec++;
			}
		} catch(Exception $e){
			//Do nothing
		}
	}
	$closed_array_2016 = array($jan, $feb, $mar, $apr, $may, $jun, $jul, $aug, $sep, $oct, $nov, $dec);

}

?>

  <head>
  <!-- Import google chart loader since bootstrapping doesn't seem to work -->
    <script type="text/javascript" src="modules/linegraph/loader.js"></script>
    <script type="text/javascript">
	  google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
		

		
		var b2017_clicked = true;	//default to show this year's SCER comparisons
		var b2016_clicked = false;
		var b2015_clicked = false;
		
		var button2017 = document.getElementById("b2017");
		var button2016 = document.getElementById("b2016");
		var button2015 = document.getElementById("b2015");
		
      function drawChart() {		
		  
		  if (b2017_clicked)
			  document.getElementById("b2017").innerHTML = "Hide 2017";
		  else
			  document.getElementById("b2017").innerHTML = "Show 2017";
		  if (b2016_clicked)
			  document.getElementById("b2016").innerHTML = "Hide 2016";
		  else
			  document.getElementById("b2016").innerHTML = "Show 2016";
		  if (b2015_clicked)
			  document.getElementById("b2015").innerHTML = "Hide 2015";
		  else
			  document.getElementById("b2015").innerHTML = "Show 2015";
		  
		  
			  // Get data Arrays from PHP
			  var valuesArray = <?php echo json_encode($opened_array); ?>;
			  var closedArray = <?php echo json_encode($closed_array); ?>;
			  
			  var valuesArray_2016 = <?php echo json_encode($opened_array_2016); ?>;
			  var closedArray_2016 = <?php echo json_encode($closed_array_2016); ?>;
			  
			  var valuesArray_2015 = <?php echo json_encode($opened_array_2015); ?>;
			  var closedArray_2015 = <?php echo json_encode($closed_array_2015); ?>;
			  
			var data_2017 = google.visualization.arrayToDataTable([
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
			
			var data_2016 = google.visualization.arrayToDataTable([
			<!-- Shows all open SCERS for the year -->
			  ['Year', 'SCERs Opened', 'SCERS Closed'],
			  ['Jan',  valuesArray_2016[0], closedArray_2016[0]],
			  ['Feb',  valuesArray_2016[1], closedArray_2016[1]],
			  ['Mar',  valuesArray_2016[2], closedArray_2016[2]],
			  ['Apr',  valuesArray_2016[3], closedArray_2016[3]],
			  ['May',  valuesArray_2016[4], closedArray_2016[4]],
			  ['Jun',  valuesArray_2016[5], closedArray_2016[5]],
			  ['Jul',  valuesArray_2016[6], closedArray_2016[6]],
			  ['Aug',  valuesArray_2016[7], closedArray_2016[7]],
			  ['Sep',  valuesArray_2016[8], closedArray_2016[8]],
			  ['Oct',  valuesArray_2016[9], closedArray_2016[9]],
			  ['Nov',  valuesArray_2016[10], closedArray_2016[10]],
			  ['Dec',  valuesArray_2016[11], closedArray_2016[11]]
			]);
			var data_2015 = google.visualization.arrayToDataTable([
			<!-- Shows all open SCERS for the year -->
			  ['Year', 'SCERs Opened', 'SCERS Closed'],
			  ['Jan',  valuesArray_2015[0], closedArray_2015[0]],
			  ['Feb',  valuesArray_2015[1], closedArray_2015[1]],
			  ['Mar',  valuesArray_2015[2], closedArray_2015[2]],
			  ['Apr',  valuesArray_2015[3], closedArray_2015[3]],
			  ['May',  valuesArray_2015[4], closedArray_2015[4]],
			  ['Jun',  valuesArray_2015[5], closedArray_2015[5]],
			  ['Jul',  valuesArray_2015[6], closedArray_2015[6]],
			  ['Aug',  valuesArray_2015[7], closedArray_2015[7]],
			  ['Sep',  valuesArray_2015[8], closedArray_2015[8]],
			  ['Oct',  valuesArray_2015[9], closedArray_2015[9]],
			  ['Nov',  valuesArray_2015[10], closedArray_2015[10]],
			  ['Dec',  valuesArray_2015[11], closedArray_2015[11]]
			]);
			
			
			var data_2017_2016 = google.visualization.arrayToDataTable([
			<!-- Shows all open SCERS for the year -->
			  ['Year', 'Opened 2017', 'Closed 2017', 'Opened 2016', 'Closed 2016'],
			  ['Jan',  valuesArray[0], closedArray[0], valuesArray_2016[0], closedArray_2016[0]],
			  ['Feb',  valuesArray[1], closedArray[1], valuesArray_2016[1], closedArray_2016[1]],
			  ['Mar',  valuesArray[2], closedArray[2], valuesArray_2016[2], closedArray_2016[2]],
			  ['Apr',  valuesArray[3], closedArray[3], valuesArray_2016[3], closedArray_2016[3]],
			  ['May',  valuesArray[4], closedArray[4], valuesArray_2016[4], closedArray_2016[4]],
			  ['Jun',  valuesArray[5], closedArray[5], valuesArray_2016[5], closedArray_2016[5]],
			  ['Jul',  valuesArray[6], closedArray[6], valuesArray_2016[6], closedArray_2016[6]],
			  ['Aug',  valuesArray[7], closedArray[7], valuesArray_2016[7], closedArray_2016[7]],
			  ['Sep',  valuesArray[8], closedArray[8], valuesArray_2016[8], closedArray_2016[8]],
			  ['Oct',  valuesArray[9], closedArray[9], valuesArray_2016[9], closedArray_2016[9]],
			  ['Nov',  valuesArray[10], closedArray[10], valuesArray_2016[10], closedArray_2016[10]],
			  ['Dec',  valuesArray[11], closedArray[11], valuesArray_2016[11], closedArray_2016[11]]
			]);
			
			var data_2017_2015 = google.visualization.arrayToDataTable([
			<!-- Shows all open SCERS for the year -->
			  ['Year', 'Opened 2017', 'Closed 2017', 'Opened 2015', 'Closed 2015'],
			  ['Jan',  valuesArray[0], closedArray[0], valuesArray_2015[0], closedArray_2015[0]],
			  ['Feb',  valuesArray[1], closedArray[1], valuesArray_2015[1], closedArray_2015[1]],
			  ['Mar',  valuesArray[2], closedArray[2], valuesArray_2015[2], closedArray_2015[2]],
			  ['Apr',  valuesArray[3], closedArray[3], valuesArray_2015[3], closedArray_2015[3]],
			  ['May',  valuesArray[4], closedArray[4], valuesArray_2015[4], closedArray_2015[4]],
			  ['Jun',  valuesArray[5], closedArray[5], valuesArray_2015[5], closedArray_2015[5]],
			  ['Jul',  valuesArray[6], closedArray[6], valuesArray_2015[6], closedArray_2015[6]],
			  ['Aug',  valuesArray[7], closedArray[7], valuesArray_2015[7], closedArray_2015[7]],
			  ['Sep',  valuesArray[8], closedArray[8], valuesArray_2015[8], closedArray_2015[8]],
			  ['Oct',  valuesArray[9], closedArray[9], valuesArray_2015[9], closedArray_2015[9]],
			  ['Nov',  valuesArray[10], closedArray[10], valuesArray_2015[10], closedArray_2015[10]],
			  ['Dec',  valuesArray[11], closedArray[11], valuesArray_2015[11], closedArray_2015[11]]
			]);
			var data_2016_2015 = google.visualization.arrayToDataTable([
			<!-- Shows all open SCERS for the year -->
			 ['Year', 'Opened 2016', 'Closed 2016', 'Opened 2015', 'Closed 2015'],
			  ['Jan',  valuesArray_2016[0], closedArray_2016[0], valuesArray_2015[0], closedArray_2015[0]],
			  ['Feb',  valuesArray_2016[1], closedArray_2016[1], valuesArray_2015[1], closedArray_2015[1]],
			  ['Mar',  valuesArray_2016[2], closedArray_2016[2], valuesArray_2015[2], closedArray_2015[2]],
			  ['Apr',  valuesArray_2016[3], closedArray_2016[3], valuesArray_2015[3], closedArray_2015[3]],
			  ['May',  valuesArray_2016[4], closedArray_2016[4], valuesArray_2015[4], closedArray_2015[4]],
			  ['Jun',  valuesArray_2016[5], closedArray_2016[5], valuesArray_2015[5], closedArray_2015[5]],
			  ['Jul',  valuesArray_2016[6], closedArray_2016[6], valuesArray_2015[6], closedArray_2015[6]],
			  ['Aug',  valuesArray_2016[7], closedArray_2016[7], valuesArray_2015[7], closedArray_2015[7]],
			  ['Sep',  valuesArray_2016[8], closedArray_2016[8], valuesArray_2015[8], closedArray_2015[8]],
			  ['Oct',  valuesArray_2016[9], closedArray_2016[9], valuesArray_2015[9], closedArray_2015[9]],
			  ['Nov',  valuesArray_2016[10], closedArray_2016[10], valuesArray_2015[10], closedArray_2015[10]],
			  ['Dec',  valuesArray_2016[11], closedArray_2016[11], valuesArray_2015[11], closedArray_2015[11]]
			]);
			var data_2017_2016_2015 = google.visualization.arrayToDataTable([
			<!-- Shows all open SCERS for the year -->
			  ['Year', 'Opened 2017', 'Closed 2017', 'Opened 2016', 'Closed 2016', 'Opened 2015', 'Closed 2015'],
			  ['Jan',  valuesArray[0], closedArray[0], valuesArray_2016[0], closedArray_2016[0], valuesArray_2015[0], closedArray_2015[0]],
			  ['Feb',  valuesArray[1], closedArray[1], valuesArray_2016[1], closedArray_2016[1], valuesArray_2015[1], closedArray_2015[1]],
			  ['Mar',  valuesArray[2], closedArray[2], valuesArray_2016[2], closedArray_2016[2], valuesArray_2015[2], closedArray_2015[2]],
			  ['Apr',  valuesArray[3], closedArray[3], valuesArray_2016[3], closedArray_2016[3], valuesArray_2015[3], closedArray_2015[3]],
			  ['May',  valuesArray[4], closedArray[4], valuesArray_2016[4], closedArray_2016[4], valuesArray_2015[4], closedArray_2015[4]],
			  ['Jun',  valuesArray[5], closedArray[5], valuesArray_2016[5], closedArray_2016[5], valuesArray_2015[5], closedArray_2015[5]],
			  ['Jul',  valuesArray[6], closedArray[6], valuesArray_2016[6], closedArray_2016[6], valuesArray_2015[6], closedArray_2015[6]],
			  ['Aug',  valuesArray[7], closedArray[7], valuesArray_2016[7], closedArray_2016[7], valuesArray_2015[7], closedArray_2015[7]],
			  ['Sep',  valuesArray[8], closedArray[8], valuesArray_2016[8], closedArray_2016[8], valuesArray_2015[8], closedArray_2015[8]],
			  ['Oct',  valuesArray[9], closedArray[9], valuesArray_2016[9], closedArray_2016[9], valuesArray_2015[9], closedArray_2015[9]],
			  ['Nov',  valuesArray[10], closedArray[10], valuesArray_2016[10], closedArray_2016[10], valuesArray_2015[10], closedArray_2015[10]],
			  ['Dec',  valuesArray[11], closedArray[11], valuesArray_2016[11], closedArray_2016[11], valuesArray_2015[11], closedArray_2015[11]]
			]);
			
			var data_empty = google.visualization.arrayToDataTable([
			<!-- Shows all open SCERS for the year -->
			  ['Year', 'None Selected'],
			  ['Jan',  0],
			  ['Feb',  0],
			  ['Mar',  0],
			  ['Apr',  0],
			  ['May',  0],
			  ['Jun',  0],
			  ['Jul',  0],
			  ['Aug',  0],
			  ['Sep',  0],
			  ['Oct',  0],
			  ['Nov',  0],
			  ['Dec',  0]
			]);
			
			
			

			var options_2017_only = {
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
			  pointSize:10,
			  backgroundColor: {
				stroke: '#5a5a5a',
				strokeWidth: 10,
				fill: 'white'
				},
			  animation: {
				  duration: 1500,
				  easing: 'inAndOut',
			  "startup": true}	
			};
			var options_2016_only = {
			  title: 'Number of SCERs Opened vs. Closed in 2016',
			  titleTextStyle: {
				  color: 'black',
				  fontSize: 26,
				  bold: false,
				  italic: false
				  },
			  curveType: 'function',
			  legend: { position: 'bottom' },
			  colors: ['green', 'orange'],
			  pointSize:10,
			  backgroundColor: {
				stroke: '#5a5a5a',
				strokeWidth: 10,
				fill: 'white'
				},
			  animation: {
				  duration: 1500,
				  easing: 'inAndOut',
			  "startup": true}	
			};
			
			var options_2015_only = {
			  title: 'Number of SCERs Opened vs. Closed in 2015',
			  titleTextStyle: {
				  color: 'black',
				  fontSize: 26,
				  bold: false,
				  italic: false
				  },
			  curveType: 'function',
			  legend: { position: 'bottom' },
			  colors: ['cyan', 'grey'],
			  pointSize:10,
			  backgroundColor: {
				stroke: '#5a5a5a',
				strokeWidth: 10,
				fill: 'white'
				},
			  animation: {
				  duration: 1500,
				  easing: 'inAndOut',
			  "startup": true}	
			};
			
			var options_2017_2016 = {
			  title: 'Number of SCERs Opened and Closed in 2017 vs. 2016',
			  titleTextStyle: {
				  color: 'black',
				  fontSize: 26,
				  bold: false,
				  italic: false
				  },
			  curveType: 'function',
			  legend: { position: 'bottom' },
			  colors: ['#000000', '#f00000', 'green', 'orange'],
			  pointSize:10,
			  backgroundColor: {
				stroke: '#5a5a5a',
				strokeWidth: 10,
				fill: 'white'
				},
			  animation: {
				  duration: 1500,
				  easing: 'inAndOut',
			  "startup": true}	
			};
			
			var options_2017_2015 = {
			  title: 'Number of SCERs Opened and Closed in 2017 vs. 2015',
			  titleTextStyle: {
				  color: 'black',
				  fontSize: 26,
				  bold: false,
				  italic: false
				  },
			  curveType: 'function',
			  legend: { position: 'bottom' },
			  colors: ['#000000', '#f00000', 'grey', 'cyan'],
			  pointSize:10,
			  backgroundColor: {
				stroke: '#5a5a5a',
				strokeWidth: 10,
				fill: 'white'
				},
			  animation: {
				  duration: 1500,
				  easing: 'inAndOut',
			  "startup": true}	
			};
			
			var options_2016_2015 = {
			  title: 'Number of SCERs Opened and Closed in 2017 vs. 2016',
			  titleTextStyle: {
				  color: 'black',
				  fontSize: 26,
				  bold: false,
				  italic: false
				  },
			  curveType: 'function',
			  legend: { position: 'bottom' },
			  colors: ['green', 'orange','cyan','grey'],
			  pointSize:10,
			  backgroundColor: {
				stroke: '#5a5a5a',
				strokeWidth: 10,
				fill: 'white'
				},
			  animation: {
				  duration: 1500,
				  easing: 'inAndOut',
			  "startup": true}	
			};
			
			var options_2017_2016_2015 = {
			  title: 'Number of SCERs Opened and Closed in 2017 vs. 2016 vs. 2015',
			  titleTextStyle: {
				  color: 'black',
				  fontSize: 26,
				  bold: false,
				  italic: false
				  },
			  curveType: 'function',
			  legend: { position: 'bottom' },
			  colors: ['#000000', '#f00000', 'green', 'orange', 'cyan', 'grey'],
			  pointSize:10,
			  backgroundColor: {
				stroke: '#5a5a5a',
				strokeWidth: 10,
				fill: 'white'
				},
			  animation: {
				  duration: 1500,
				  easing: 'inAndOut',
			  "startup": true}	
			};
			
			var options_2017_2016_opened = {
			  title: 'Number of SCERs Opened in 2017 vs. 2016',
			  titleTextStyle: {
				  color: 'black',
				  fontSize: 26,
				  bold: false,
				  italic: false
				  },
			  curveType: 'function',
			  legend: { position: 'bottom' },
			  colors: ['#000000', 'green'],
			  pointSize:10,
			  backgroundColor: {
				stroke: '#5a5a5a',
				strokeWidth: 10,
				fill: 'white'
				},
			  animation: {
				  duration: 1500,
				  easing: 'inAndOut',
			  "startup": true}	
			};
			
			var options_2017_2015_opened = {
			  title: 'Number of SCERs Opened in 2017 vs. 2015',
			  titleTextStyle: {
				  color: 'black',
				  fontSize: 26,
				  bold: false,
				  italic: false
				  },
			  curveType: 'function',
			  legend: { position: 'bottom' },
			  colors: ['#000000', 'cyan'],
			  pointSize:10,
			  backgroundColor: {
				stroke: '#5a5a5a',
				strokeWidth: 10,
				fill: 'white'
				},
			  animation: {
				  duration: 1500,
				  easing: 'inAndOut',
			  "startup": true}	
			};
			
			var options_2016_2015_opened = {
			  title: 'Number of SCERs Opened in 2016 vs. 2015',
			  titleTextStyle: {
				  color: 'black',
				  fontSize: 26,
				  bold: false,
				  italic: false
				  },
			  curveType: 'function',
			  legend: { position: 'bottom' },
			  colors: ['green','cyan'],
			  pointSize:10,
			  backgroundColor: {
				stroke: '#5a5a5a',
				strokeWidth: 10,
				fill: 'white'
				},
			  animation: {
				  duration: 1500,
				  easing: 'inAndOut',
			  "startup": true}	
			};
			
			var options_2017_2016_2015_opened = {
			  title: 'Number of SCERs Opened in 2017 vs.2016 vs. 2015',
			  titleTextStyle: {
				  color: 'black',
				  fontSize: 26,
				  bold: false,
				  italic: false
				  },
			  curveType: 'function',
			  legend: { position: 'bottom' },
			  colors: ['black','green','cyan'],
			  pointSize:10,
			  backgroundColor: {
				stroke: '#5a5a5a',
				strokeWidth: 10,
				fill: 'white'
				},
			  animation: {
				  duration: 1500,
				  easing: 'inAndOut',
			  "startup": true}	
			};
			
			var options_2017_2016_opened = {
			  title: 'Number of SCERs Opened in 2017 vs. 2016',
			  titleTextStyle: {
				  color: 'black',
				  fontSize: 26,
				  bold: false,
				  italic: false
				  },
			  curveType: 'function',
			  legend: { position: 'bottom' },
			  colors: ['#F00000', 'orange'],
			  pointSize:10,
			  backgroundColor: {
				stroke: '#5a5a5a',
				strokeWidth: 10,
				fill: 'white'
				},
			  animation: {
				  duration: 1500,
				  easing: 'inAndOut',
			  "startup": true}	
			};
			
			var options_2017_2015_closed = {
			  title: 'Number of SCERs Opened in 2017 vs. 2015',
			  titleTextStyle: {
				  color: 'black',
				  fontSize: 26,
				  bold: false,
				  italic: false
				  },
			  curveType: 'function',
			  legend: { position: 'bottom' },
			  colors: ['#F00000', 'grey'],
			  pointSize:10,
			  backgroundColor: {
				stroke: '#5a5a5a',
				strokeWidth: 10,
				fill: 'white'
				},
			  animation: {
				  duration: 1500,
				  easing: 'inAndOut',
			  "startup": true}	
			};
			
			var options_2016_2015_closed = {
			  title: 'Number of SCERs Opened in 2016 vs. 2015',
			  titleTextStyle: {
				  color: 'black',
				  fontSize: 26,
				  bold: false,
				  italic: false
				  },
			  curveType: 'function',
			  legend: { position: 'bottom' },
			  colors: ['orange','grey'],
			  pointSize:10,
			  backgroundColor: {
				stroke: '#5a5a5a',
				strokeWidth: 10,
				fill: 'white'
				},
			  animation: {
				  duration: 1500,
				  easing: 'inAndOut',
			  "startup": true}	
			};
			
			var options_2017_2016_2015_closed = {
			  title: 'Number of SCERs Opened in 2017 vs.2016 vs. 2015',
			  titleTextStyle: {
				  color: 'black',
				  fontSize: 26,
				  bold: false,
				  italic: false
				  },
			  curveType: 'function',
			  legend: { position: 'bottom' },
			  colors: ['#f00000','orange','grey'],
			  pointSize:10,
			  backgroundColor: {
				stroke: '#5a5a5a',
				strokeWidth: 10,
				fill: 'white'
				},
			  animation: {
				  duration: 1500,
				  easing: 'inAndOut',
			  "startup": true}	
			};
			
			var options_empty = {
			  title: 'Number of SCERs Opened vs. Closed in 2017',
			  titleTextStyle: {
				  color: 'black',
				  fontSize: 26,
				  bold: false,
				  italic: false
				  },
			  curveType: 'function',
			  legend: { position: 'bottom' },
			  colors: ['#000000'],
			  pointSize:10,
			  backgroundColor: {
				stroke: '#5a5a5a',
				strokeWidth: 10,
				fill: 'white'
				},
			  animation: {
				  duration: 1500,
				  easing: 'inAndOut',
			  "startup": true}	
			};
			var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));


			var options;	//what will actually be displayed
			var data;
			
			google.visualization.events.addListener(chart, 'ready', 
				function() {
				});	

			if (b2017_clicked){
				if (b2016_clicked){
					if(b2015_clicked){
						options = options_2017_2016_2015;
						data = data_2017_2016_2015;
					}
					else{
						options = options_2017_2016;
						data = data_2017_2016;
					}
				}
				else if (b2015_clicked){
					options = options_2017_2015;
					data = data_2017_2015;
				}
				else{
					options = options_2017_only;
					data = data_2017;
				}
			}
			else if (b2016_clicked){
				if (b2015_clicked){
					options = options_2016_2015;
					data = data_2016_2015;
				}
				else{
					options = options_2016_only;
					data= data_2016;
				}
			}
			else if (b2015_clicked){
				options =  options_2015_only;
				data = data_2015;
			}
			else{
				data = data_empty;
				options =  options_empty;
			}

			chart.draw(data, options);
				
		  }
	  function btn2016Clicked(){
		  b2016_clicked=!b2016_clicked;
		  //console.log("2017: " + b2017_clicked + "\n2016: " + b2016_clicked + "\n2015: " + b2015_clicked);
		  drawChart();
	  }
	  function btn2015Clicked(){
		  b2015_clicked=!b2015_clicked;
		 // console.log("2017: " + b2017_clicked + "\n2016: " + b2016_clicked + "\n2015: " + b2015_clicked);
		  drawChart();
	  }
	  function btn2017Clicked(){
		  b2017_clicked=!b2017_clicked;		  
		  //console.log("2017: " + b2017_clicked + "\n2016: " + b2016_clicked + "\n2015: " + b2015_clicked);
		  drawChart();
	  }
	  
	  
	  
	  
</script>
  </head>
  <body class="chart">
		<div  class="chart" id="curve_chart" style=
			"width: 960px; 
			height: 500px;
			padding: 20px;
			border-radius: 10px;
			background: -webkit-gradient(linear, left top, left bottom, from(#333), to(#222), color-stop(0.5, #222), color-stop(0.5, #333));">
		</div> 
		
		<button id="b2017" class="button" onclick="btn2017Clicked()" style=
			"background: -webkit-gradient(linear, left top, left bottom, from(#333), to(#222), color-stop(0.5, #222), color-stop(0.5, #333));
			color:white;
			-webkit-border-radius: 10px;
			-moz-border-radius: 10px;
			margin-top: 1em;
			padding: 10px;
			border-radius: 5px;
			font-size: 30px">
			Show 2017</button>
		<button id="b2016" class="button" onclick="btn2016Clicked()" style=
			"background: -webkit-gradient(linear, left top, left bottom, from(#333), to(#222), color-stop(0.5, #222), color-stop(0.5, #333));
			color:white;
			-webkit-border-radius: 10px;
			-moz-border-radius: 10px
			margin-top: 1em;
			padding: 10px;
			border-radius: 5px;
			font-size: 30px">
			Show 2016</button>
		<button id="b2015" class="button" onclick="btn2015Clicked()"style=
			"background: -webkit-gradient(linear, left top, left bottom, from(#333), to(#222), color-stop(0.5, #222), color-stop(0.5, #333));
			color:white;
			-webkit-border-radius: 10px;
			-moz-border-radius: 10px;
			margin-top: 1em;
			padding: 10px;
			border-radius: 5px;
			font-size: 30px">
			Show 2015</button>
		
  </body>
</html>