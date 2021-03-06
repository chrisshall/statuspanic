<?php

/* Midtown Station Routes:
*	12
*	27
*	36
*	109
*/

//Get Route 12 
$file = file_get_contents('Route12S.json');
$route12S = json_decode($file,true);
$file = file_get_contents('Route12N.json');
$route12N = json_decode($file,true);

//Get Route 27
$file = file_get_contents('Route27S.json');
$route27S = json_decode($file,true);
$file = file_get_contents('Route27N.json');
$route27N = json_decode($file,true);

//Get Route 36
$file = file_get_contents('Route36E.json');
$route36E = json_decode($file,true);
$file = file_get_contents('Route36W.json');
$route36W = json_decode($file,true);

//Get Route 109
$file = file_get_contents('Route109S.json');
$route109S = json_decode($file,true);
$file = file_get_contents('Route109N.json');
$route109N = json_decode($file,true);

date_default_timezone_set('America/New_York');
$totalTime= 24*60;
$datetime= new DateTime();
$currentTime = ($datetime->format('G')*60+($datetime->format('i')))/$totalTime;
//echo $currentTime;
//echo $route12N[0]['Midtown Station'];

// Find time difference between now and next stop
function get_next_stop($route,$time){
	for($i=0; $i < count($route); $i++){
		if (is_numeric($route[$i]['Midtown Station'])){
			$value = $route[$i]['Midtown Station']-$time;
			if ($value > 0 ){
				echo $value . "<br>" . $time;
				return $value*60;
			}
		}
	}
}
//Convert the output of the get_next_stop so that it's not a decimal
function convert_time($time){
	$min = (Int)($time);
	if ($time > 1)
		$sec= (Int)(($time-1)*60);
	else
		$sec = (Int)((1-$time)*60);
	
	return $min . 'm ' . $sec . 's';
}

//Get the time before next stop
$next12N = convert_time(get_next_stop($route12N,$currentTime));
$next12S = convert_time(get_next_stop($route12S,$currentTime));
$next27N = convert_time(get_next_stop($route27N,$currentTime));
$next27S = convert_time(get_next_stop($route27S,$currentTime));
$next36E = convert_time(get_next_stop($route36E,$currentTime));
$next36W = convert_time(get_next_stop($route36W,$currentTime));
$next109N = convert_time(get_next_stop($route109N,$currentTime));
$next109S = convert_time(get_next_stop($route109S,$currentTime));





$northbound = array(
    // 'bubble' => 'line'
    '12|blue'  => $next12N,
    '27|blue'  => $next27N,
    '36|blue'  => $next36E,
    '109|blue' => $next109N
	);
$southbound = array(
    // 'bubble' => 'line'
	'12|red'   => $next12S,
	'27|red'   => $next27S,
    '36|red'   => $next36W,
    '109|red'  => $next109S
	);

?>

<ul>
    <?php foreach($northbound as $bubble => $line) { 
        $bubble = explode('|', $bubble);
        $color  = $bubble[1];
        $bubble = $bubble[0];
        ?>
        <li>
            <span class='<?php echo $color ?> marta'>
                <span class='background'>E</span>
                <span class='display'><?php echo $bubble ?></span>
            </span>
            <span class='content'><?php echo $line ?></span>
        </li>
    <?php } ?>
</ul>
