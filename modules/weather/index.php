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

<html >
	<div  id="weather_div" style="margin-top:2em; margin-left:2em; float: left">
		<div class='mega'>
			<?php echo displayCurrentIcon($icon_url);
			echo $data_current['temp_f'] . '&deg; F, <br />' . $data_current['weather'];
			?>
		</div>
		<div style="margin-left:2px;font-size: 20px"><?php echo $data_current['display_location']['zip'] ?> / <?php echo $data_current['display_location']['city'] ?></div>
	</div>
<div style="white-space:nowrap;margin-left:13em;margin-top:-12em; height:250px; width:600px;display:inline-block; overflow-x:scroll; overflow-y:hidden">

		<div style="margin:10px;font-size:26px;display:inline-block; ">
		<div>
			<?php echo displayIcon($data_forecast['0']);
			echo  $data_forecast['0']['high']['fahrenheit'] . '&deg; F' ?> / 
			<?php echo $data_forecast['0']['low']['fahrenheit'] . '&deg; F '?>
		</div>
		<div><?php echo $data_forecast['0']['conditions'] ?></div>
	</div>
	
	<div style="margin:10px;font-size:26px;display:inline-block;">
		<div>
			<?php echo displayIcon($data_forecast['1']);
			echo  $data_forecast['1']['high']['fahrenheit'] . '&deg; F' ?> / 
			<?php echo  $data_forecast['1']['low']['fahrenheit'] . '&deg; F '?>
		</div>
		<div><?php echo $data_forecast['1']['conditions'] ?></div>
	</div>
	
	<div style="margin:10px;font-size:26px;display:inline-block;">
		<div>
			<?php echo displayIcon($data_forecast['2']);
			echo $data_forecast['2']['high']['fahrenheit'] . '&deg; F' ?> / 
			<?php echo  $data_forecast['2']['low']['fahrenheit'] . '&deg; F '?>
		</div>
		<div><?php echo $data_forecast['2']['conditions'] ?></div>
	</div>
	
	<div style="margin:10px;font-size:26px;display:inline-block;">
		<div>
			<?php echo displayIcon($data_forecast['3']);
			echo $data_forecast['3']['high']['fahrenheit'] . '&deg; F' ?> / 
			<?php echo  $data_forecast['3']['low']['fahrenheit'] . '&deg; F '?>
		</div>
		<div><?php echo $data_forecast['3']['conditions'] ?></div>
	</div>
	
	<div style="margin:10px;font-size:26px;display:inline-block;">
		<div>
			<?php echo displayIcon($data_forecast['4']);
			echo $data_forecast['4']['high']['fahrenheit'] . '&deg; F' ?> / 
			<?php echo  $data_forecast['4']['low']['fahrenheit'] . '&deg; F '?>
		</div>
		<div><?php echo $data_forecast['4']['conditions'] ?></div>
	</div>
	
		<div style="margin:10px;font-size:26px;display:inline-block;">
		<div>
			<?php echo displayIcon($data_forecast['5']);
			echo $data_forecast['5']['high']['fahrenheit'] . '&deg; F' ?> / 
			<?php echo  $data_forecast['5']['low']['fahrenheit'] . '&deg; F '?>
		</div>
		<div><?php echo $data_forecast['5']['conditions'] ?></div>
	</div>
	
		<div style="margin:10px;font-size:26px;display:inline-block;">
		<div>
			<?php echo displayIcon($data_forecast['6']);
			echo $data_forecast['6']['high']['fahrenheit'] . '&deg; F' ?> / 
			<?php echo  $data_forecast['6']['low']['fahrenheit'] . '&deg; F '?>
		</div>
		<div><?php echo $data_forecast['6']['conditions'] ?></div>
	</div>
	
		<div style="margin:10px;font-size:26px;display:inline-block;">
		<div>
			<?php echo displayIcon($data_forecast['7']);
			echo $data_forecast['7']['high']['fahrenheit'] . '&deg; F' ?> / 
			<?php echo  $data_forecast['7']['low']['fahrenheit'] . '&deg; F '?>
		</div>
		<div><?php echo $data_forecast['7']['conditions'] ?></div>
	</div>

		<div style="margin:10px;font-size:26px;display:inline-block;">
		<div>
			<?php echo displayIcon($data_forecast['8']);
			echo $data_forecast['8']['high']['fahrenheit'] . '&deg; F' ?> / 
			<?php echo  $data_forecast['8']['low']['fahrenheit'] . '&deg; F '?>
		</div>
		<div><?php echo $data_forecast['8']['conditions'] ?></div>
	</div>
	
		<div style="margin:10px;font-size:26px;display:inline-block;">
		<div>
			<?php echo displayIcon($data_forecast['9']);
			echo $data_forecast['9']['high']['fahrenheit'] . '&deg; F' ?> / 
			<?php echo  $data_forecast['9']['low']['fahrenheit'] . '&deg; F '?>
		</div>
		<div><?php echo $data_forecast['9']['conditions'] ?></div>
	</div>
</span>
<html>


<script>
	
	var on= false;

	document.getElementById("weather_div").addEventListener("click", function(e){
		
		if (!on){
			document.getElementById("line_div").style.marginTop = "7em";
			document.getElementById("weather_hourly").style.visibility= "visible";
			$('#weather_hourly').animate({
				height:['300px', 'swing']}, 
				{ duration: "slow", easing: "easein-out"});
				if (document.getElementById("stocks_graph").style.visibility == "visible"){
				document.getElementById("space").style.marginTop = "10em";
			}
		}
		else{
				$('#weather_hourly').animate({
				height:['0px', 'swing']}, 
				{ duration: "slow", easing: "easein-out"});
			//document.getElementById("stocks_graph").style.height = "0px";
			document.getElementById("weather_hourly").style.visibility = "hidden";
			document.getElementById("line_div").style.marginTop = "0em";
			if (document.getElementById("stocks_graph").style.visibility == "visible"){
				document.getElementById("space").style.marginTop = "0em";
			}
		}
		on = !on;
	});


</script>
