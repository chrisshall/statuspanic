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
$data_forecast = json_decode($url_contents_forecast, true);

// Get Icon of current weather
$data_current = $data_current['current_observation'];
$icon_url=$data_current['icon_url'];

$data_forecast = $data_forecast['forecast']['simpleforecast']['forecastday'];


function displayCurrentIcon($string){	
	echo '
		<html>
		<p> Currently </p> 
		<img src=' . $string . ' height="75" width="75" />
		<br>
		</html>
	';
}

function displayIcon($array){	
	echo '
		<html>
		<p> ' . $array['date']['weekday_short'] . ' </p> 
		<img src=' . $array['icon_url'] . ' height="50" width="50" />
		<br>
		</html>
	';
}

?>

<html style="overflow-x: scroll">
	<div  style="margin-top:2em; margin-left:0.5em; float: left">
		<div class='mega'>
			<?php echo displayCurrentIcon($icon_url);
			echo $data_current['temp_f'] . '&deg; F, ' . $data_current['weather'];
			?>
		</div>
		<div style="margin-left:2px;font-size: 20px"><?php echo $data_current['display_location']['zip'] ?> / <?php echo $data_current['display_location']['city'] ?></div>
	</div>
<table style="margin-left:15em; float: left; position:absolute;margin-top:20px; ">
	<tr style="overflow-x:scroll; overflow-y:hidden">
		<td style="margin:10px;font-size:26px;display:inline-block;">
		<div>
			<?php echo displayIcon($data_forecast['0']);
			echo  $data_forecast['0']['high']['fahrenheit'] . '&deg; F' ?> / 
			<?php echo $data_forecast['0']['low']['fahrenheit'] . '&deg; F '?>
		</div>
	
		<div><?php echo $data_forecast['0']['conditions'] ?></div>
	</td>
	<td style="margin:10px;font-size:26px;display:inline-block;">
		<div>
			<?php echo displayIcon($data_forecast['1']);
			echo  $data_forecast['1']['high']['fahrenheit'] . '&deg; F' ?> / 
			<?php echo  $data_forecast['1']['low']['fahrenheit'] . '&deg; F '?>
		</div>
		<div><?php echo $data_forecast['1']['conditions'] ?></div>
	</td>
	<td style="margin:10px;font-size:26px;display:inline-block;">
		<div>
			<?php echo displayIcon($data_forecast['2']);
			echo $data_forecast['2']['high']['fahrenheit'] . '&deg; F' ?> / 
			<?php echo  $data_forecast['2']['low']['fahrenheit'] . '&deg; F '?>
		</div>
		<div><?php echo $data_forecast['2']['conditions'] ?></div>
	</td>
	<td style="margin:10px;font-size:26px;display:inline-block;">
		<div>
			<?php echo displayIcon($data_forecast['3']);
			echo $data_forecast['3']['high']['fahrenheit'] . '&deg; F' ?> / 
			<?php echo  $data_forecast['3']['low']['fahrenheit'] . '&deg; F '?>
		</div>
		<div><?php echo $data_forecast['3']['conditions'] ?></div>
	</td>
	<td style="margin:10px;font-size:26px;display:inline-block;">
		<div>
			<?php echo displayIcon($data_forecast['4']);
			echo $data_forecast['4']['high']['fahrenheit'] . '&deg; F' ?> / 
			<?php echo  $data_forecast['4']['low']['fahrenheit'] . '&deg; F '?>
		</div>
		<div><?php echo $data_forecast['4']['conditions'] ?></div>
	</td>
	</tr>
</table>
<html>