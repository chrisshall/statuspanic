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
$url_contents_current = curl('http://api.wunderground.com/api/89f006e4b4be6bbf/conditions/q/GA/Duluth.json');
$url_contents_forecast = curl('http://api.wunderground.com/api/89f006e4b4be6bbf/forecast10day/q/GA/Duluth.json');

// Conver JSON data to PHP Array 
$data_current = json_decode($url_contents_current, true);
$data_forcast = json_decode($url_contents_forecast, true);

// Get Icon of current weather
$data_current = $data_current['current_observation'];
$icon_url=$data_current['icon_url'];

$data_forcast = $data_forcast['forecast']['simpleforecast']['forecastday'];




function displayIcon($string){	
	echo '
		<html>
		<p> Currently </p> </br>
		<img src=' . $string . ' height="50" width="50" />
		<br>
		</html>
	';
}
?>

<div class="padding">
    <div class='jumbo_left'>
        <?php echo displayIcon($icon_url);
		echo $data_current['temp_f'] . '&deg; F, ' . $data_current['weather'];
		?>
    </div>
    <div><?php echo $data_current['display_location']['zip'] ?> / <?php echo $data_current['display_location']['city'] ?></div>
</div>