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

<html>
<table>
  <tr>
    <td>
<div>
    <div class='jumbo'>
        <?php echo displayCurrentIcon($icon_url);
		echo $data_current['temp_f'] . '&deg; F, ' . $data_current['weather'];
		?>
    </div>
    <div><?php echo $data_current['display_location']['zip'] ?> / <?php echo $data_current['display_location']['city'] ?></div>
</div>
	</td>
<td>
<div>
    <div>
        <?php echo displayIcon($data_forecast['0']);
		echo  $data_forecast['0']['high']['fahrenheit'] . '&deg; F' ?> / 
		<?php echo $data_forecast['0']['low']['fahrenheit'] . '&deg; F '?>
    </div>
    <div><?php echo $data_forecast['0']['conditions'] ?></div>
</div>
	</td>
	<td>
	<div>
    <div>
        <?php echo displayIcon($data_forecast['1']);
		echo  $data_forecast['1']['high']['fahrenheit'] . '&deg; F' ?> / 
		<?php echo  $data_forecast['1']['low']['fahrenheit'] . '&deg; F '?>
    </div>
    <div><?php echo $data_forecast['1']['conditions'] ?></div>
</div>
	</td>
	<td>
	<div>
    <div>
        <?php echo displayIcon($data_forecast['2']);
		echo $data_forecast['2']['high']['fahrenheit'] . '&deg; F' ?> / 
		<?php echo  $data_forecast['2']['low']['fahrenheit'] . '&deg; F '?>
    </div>
    <div><?php echo $data_forecast['2']['conditions'] ?></div>
</div>
	</td>
	
  </tr>
</table>



<html>