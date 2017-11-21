<?php

/* Midtown Station Routes:
*	12
*	27
*	36
*	109
*/

//Get Route 12 
$file = file_get_contents('Route12N.json');
$route12N = json_decode($file,true);

//Get Route 27
$file = file_get_contents('Route27N.json');
$route27N = json_decode($file,true);

//Get Route 36
$file = file_get_contents('Route36E.json');
$route36E = json_decode($file,true);

//Get Route 109
$file = file_get_contents('Route109N.json');
$route109N = json_decode($file,true);

date_default_timezone_set('America/New_York');
$totalTime= 24;
$datetime= new DateTime();
$currentTime = ($datetime->format('G')+($datetime->format('i'))/60 + ($datetime->format('s')/3600))/$totalTime;
//echo $currentTime;
//echo $route12N[0]['Midtown Station'];

// Find time difference between now and next stop
function get_next_stop($route,$time){
	for($i=0; $i < count($route); $i++){
		if (is_numeric($route[$i]['Midtown Station'])){
			$value = ($route[$i]['Midtown Station']-$time);
			if ($value > 0 ){
				return $value;
			}
		}
	}
}
//Convert the output of the get_next_stop so that it's not a decimal
function convert_time($time){
	//echo $time . "<br>";
	$time = $time*24;
	$min = floor($time*60);
	$sec = floor((($time*60) - $min)*60);
	return $min . 'm ' . $sec . 's';
}

//Get the time before next stop
$next12N = convert_time(get_next_stop($route12N,$currentTime));
$next27N = convert_time(get_next_stop($route27N,$currentTime));
$next36E = convert_time(get_next_stop($route36E,$currentTime));
$next109N = convert_time(get_next_stop($route109N,$currentTime));


$northbound = array(
    // 'bubble' => 'line'
    '12|blue'  => $next12N,
    '27|blue'  => $next27N,
    '36|blue'  => $next36E,
    '109|blue' => $next109N
	);

?>

<ul>
    <?php foreach($northbound as $bubble => $line) { 
        $bubble = explode('|', $bubble);
        $color  = $bubble[1];
        $bubble = $bubble[0];
        ?>
        <li>
            <span class='<?php echo $color ?> marta_north'>
                <span class='background'>E</span>
                <span class='display'><?php echo $bubble ?></span>
            </span>
            <span class='content'><?php echo $line ?></span>
        </li>
    <?php } ?>
</ul>
