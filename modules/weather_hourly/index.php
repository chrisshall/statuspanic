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
$url_contents_current = curl('http://api.wunderground.com/api/89f006e4b4be6bbf/hourly/q/GA/Duluth.json');


// Conver JSON data to PHP Array 
$data_hourly = json_decode($url_contents_current, true);
$data_hourly = $data_hourly['hourly_forecast'];


// echo $data_hourly[0]['icon_url'];
?>

<div id="hourly_div" style="height:0px">
	
	<table style="overflow-x: scroll; overflow-y: hidden; width=850px; display:block">
		<tr>
		<?php foreach($data_hourly as $hour){
			echo '
			<td>
					<div style="margin: 10px; margin-top:50px">
					';
						if ($hour["FCTTIME"]["hour"] == "0"){
							echo '<p style="margin-top:-1em"> '. $hour["FCTTIME"]["mon_abbrev"] . " " .$hour["FCTTIME"]["mday"];
						}
			echo '
						<p> ' . $hour["FCTTIME"]["civil"] . ' </p>
						<img src=' . $hour['icon_url'] . ' height="100" width="100"/>
						<p> ' . $hour["temp"]["english"] . '&deg; F</p>
					</div>
			</td>'
		;}?>
		</tr>
	</table>
</div>


	
