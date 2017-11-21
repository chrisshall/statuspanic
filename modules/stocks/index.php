<?php

/* DATA */

/*$num = rand(-99, 99);

if (rand(0,4) == 0) {
    $num = 0;
}

if (!empty($_GET['value'])) 
    $num = $_GET['value'];
*/
//$username_key = 'fdf625991e77c7207ee9167235405781';
//$password_key = '7392c7238335493c203f8c529c51bf4d';

$string = file_get_contents('https://www.alphavantage.co/query?function=TIME_SERIES_INTRADAY&symbol=NCR&interval=5min&outputsize=full&apikey=AZT5Q3UOFPEOCJYT');
$data = json_decode($string, true);


//Need to round current time down to 5-min interval
date_default_timezone_set('America/New_York');
$datetime = new DateTime();
// If the market it open (from 9:30AM - 4:00PM)
if ($datetime->format('H') > 9 || ($datetime->format('H') == 9 && $datetime->format('i') >= 30)){
	$start_price = $data['Time Series (5min)'][date("Y-m-d") . ' 09:30:00']['1. open'];
	$minute = $datetime->format('i');
	$minute = $minute - $minute%5;
	$current_time = date("Y-m-d H:");
	if ($minute == 0)
		$minute = "00";
	$current_time = $current_time . $minute . ":00";
	$current_price = $data['Time Series (5min)'][$current_time]['4. close'];
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
	$start_price = $data['Time Series (5min)'][date("Y-m-d") . ' 09:30:00']['1. open'];
}

/* DISPLAY */
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
?>

<div>    
	<span class='jumbo'> <?php echo 'NCR'."<br>".$current_price ?> </span>
    <span class='<?php echo $class ?>' id='arrow_icon'><?php echo $code ?></span>
    <span class='mega'><?php echo number_format((float)($current_price-$start_price),2,'.','') ?></span>
</div>
