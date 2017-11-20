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
$start_price = $data['Time Series (5min)'][date("Y-m-d") . ' 09:30:00']['1. open'];

//Need to round current time down to 5-min interval
date_default_timezone_set('America/New_York');
$datetime = new DateTime();
$minute = $datetime->format('i');
$minute = $minute - $minute%5;
$current_time = date("Y-m-d H:");
if ($minute == 0)
	$minute = "00";
$current_time = $current_time . $minute . ":00";

$current_price = $data['Time Series (5min)'][$current_time]['4. close'];


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
    <span class='mega'><?php echo ($current_price-$start_price) ?></span>
</div>
