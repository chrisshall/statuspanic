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

//Get Route 27
$file = file_get_contents('Route27S.json');
$route27S = json_decode($file,true);

//Get Route 36
$file = file_get_contents('Route36W.json');
$route36W = json_decode($file,true);

//Get Route 109
$file = file_get_contents('Route109S.json');
$route109S = json_decode($file,true);

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
	$time = $time*24;
	$min = floor($time*60);
	$sec = floor((($time*60) - $min)*60);
	//return $min . 'm ' . $sec . 's';	//old return value. need to get only seconds. 
	return ($min*60 + $sec);
}



//Get the time before next stop
$next12S = convert_time(get_next_stop($route12S,$currentTime));
$next27S = convert_time(get_next_stop($route27S,$currentTime));
$next36W = convert_time(get_next_stop($route36W,$currentTime));
$next109S = convert_time(get_next_stop($route109S,$currentTime));

$southbound = array(
    // 'bubble' => 'line'
	'12S|red'   => $next12S,
	'27S|red'   => $next27S,
    '36W|red'   => $next36W,
    '109S|red'  => $next109S
	);

	echo "Southbound Buses";
?>

<html>
	<head>
		<!-- <link rel="stylesheet" href="modules/marta_south/FlipClock-master/compiled/flipclockS.css"> -->

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

		<script src="modules/marta_north/FlipClock-master/compiled/Marta.js"></script>		
	</head>
	<body>
		<!--<div class="clock2" data-countdown="<?php echo $next12S ?>" style="margin:1em;"></div>
		<div class="clock2" data-countdown="<?php echo $next27S ?>" style="margin:1em"></div>
		<div class="clock2" data-countdown="<?php echo $next36W ?>" style="margin:1em;"></div>
		<div class="clock2" data-countdown="<?php echo $next109S ?>" style="margin:1em"></div>-->
	</body>


<ul id='list'>
    <?php foreach($southbound as $bubble => $line) { 
        $bubble = explode('|', $bubble);
        $color  = $bubble[1];
        $bubble = $bubble[0];
        ?>
        <li style="width:500px">
            <span class='<?php echo $color ?> marta_south'>
                <span class='background'>E</span>
                <span class='display'><?php echo $bubble ?></span>
            </span>
		   <span id="south" class="marta" data-countdown="<?php echo $line ?>"</span>
        </li>
    <?php } ?>
</ul>
</html>
		
		<script type="text/javascript">
			
			
			$(document).ready(function() {
				var clocks = [];
				
				$('.marta').each(function(){
					var clock = $(this);
					var data = clock.data('countdown');
				clock.FlipClock(data,{
					clockFace: 'MinuteCounter',
					countdown: true,
					autoStart: true,
					callbacks:{
						stop: function(){
							window.location.reload();
						}
					}
				});
				clocks.push(clock);
				});
				
			});
			
		</script>
		
