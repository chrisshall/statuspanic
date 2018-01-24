<?php
//Get Travel Times
$travel = file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/json?destinations=860+Spring+St+NW,+Atlanta,+GA&origins=Duluth,+GA|Mall+of+GA+Buford,+GA|Athens,+GA|&departure_time=now&traffic_model=best_guess&key=AIzaSyBQ_PLwliFdOCBWiIed_s4IBrZc1q7DZYo');
$data = json_decode($travel, true);

//With Traffic as int in seconds
$traffic_time_duluth_int= $data['rows'][0]['elements'][0]['duration_in_traffic']["value"];
$traffic_time_buford_int= $data['rows'][1]['elements'][0]['duration_in_traffic']["value"];
$traffic_time_athens_int= $data['rows'][2]['elements'][0]['duration_in_traffic']["value"];

//With Traffic as text in minutes
$traffic_time_duluth_text= $data['rows'][0]['elements'][0]['duration_in_traffic']["text"];
$traffic_time_buford_text= $data['rows'][1]['elements'][0]['duration_in_traffic']["text"];
$traffic_time_athens_text= $data['rows'][2]['elements'][0]['duration_in_traffic']["text"];

//Without Traffic as int in seconds
$time_duluth= $data['rows'][0]['elements'][0]['duration']["value"];
$time_buford= $data['rows'][1]['elements'][0]['duration']["value"];
$time_athens= $data['rows'][2]['elements'][0]['duration']["value"];

//if traffic adds 1-5min, color is green
//if traffic adds 5+ min, change color to yellow
//if traffic adds 10+ min, change color to red
if ($traffic_time_duluth_int-$time_duluth < 300)
	$duluth_color='green';
elseif ($traffic_time_duluth_int-$time_duluth < 600)
	$duluth_color='yellow';
else
	$duluth_color='red';

if ($traffic_time_buford_int-$time_buford < 300)
	$buford_color='green';
elseif ($traffic_time_buford_int-$time_buford < 600)
	$buford_color='yellow';
else
	$buford_color='red';

if ($traffic_time_athens_int-$time_athens < 300)
	$athens_color='green';
elseif ($traffic_time_athens_int-$time_athens < 600)
	$athens_color='yellow';
else
	$athens_color='red';

$items = array(
    // 'bubble' => 'line'
	 'd|' . $duluth_color => $traffic_time_duluth_text . ' from Duluth',
	 'b|' . $buford_color => $traffic_time_buford_text . ' from Mall of GA',
	 'a|' . $athens_color => $traffic_time_athens_text . ' from Athens'
	 );

?>

<div class="travel" style="height:45px;display:inline-block; overflow-y:hidden;">
	<span class="travel">Home</span> <span style="margin-left:0.5em; margin-right:0.5em;" class="background">I</span> <span class="travel"> NCR </span>
</div>
<ul>
    <?php foreach($items as $bubble => $line) { 
        $bubble = explode('|', $bubble);
        $color  = $bubble[1];
        $bubble = $bubble[0];
		?>
        <li>
            <span class='<?php echo $color ?> travel'>
                <span class='background'>E</span>
                <!--<span class='display'><?php echo $bubble ?></span>-->
            </span>
            <span style="margin-left:1em" class='travel'><?php echo $line ?></span>
        </li>
    <?php } ?>

</ul>
