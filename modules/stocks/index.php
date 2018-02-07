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

<div  id="stockdiv" style="margin-top: 1em;">    
	<span class='mega'> <?php echo 'NCR'."<br>"; if(isset($current_price)) echo $current_price; else echo "--"; ?> </span>
    <span class='<?php echo $class ?>' id='arrow_icon' style="margin:10px;"><?php echo $code ?></span>
    <span class='mega'><?php if(isset($current_price)) echo $difference; else echo "--"; ?></span>
</div>

<script type="text/javascript">
	
	var on = false;
document.getElementById('stockdiv').addEventListener('click', 
	function(event) {
		if (!on){
			document.getElementById("stocks_graph").style.visibility = "visible";
			$('#stocks_graph').animate({
				height:['500px', 'swing']}, 
				{ duration: "slow", easing: "easein-out"});
			if (document.getElementById("weather_hourly").style.visibility == "visible"){
				document.getElementById("space").style.marginTop = "10em";
			}
			
		}
		else{
				$('#stocks_graph').animate({
				height:['0px', 'swing']}, 
				{ duration: "slow", easing: "easein-out"});
			//document.getElementById("stocks_graph").style.height = "0px";
			document.getElementById("stocks_graph").style.visibility = "hidden";
			if (document.getElementById("weather_hourly").style.visibility == "visible"){
				document.getElementById("space").style.marginTop = "0em";
			}
		}
		on = !on;
	});
	
	
	



</script>