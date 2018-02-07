<?php
error_reporting(E_ALL & ~E_NOTICE);
class Bar {
    function __construct($name, $height, $remaining) {
        $this->name = $name;
        $this->height = $height;
        $this->remaining = $remaining;
    }
}
// Get SCER JSON file 
$str = file_get_contents('SCER.json');
$str = utf8_encode($str);
$data = json_decode($str, TRUE);

$string = file_get_contents('SCER.json');
$datum = json_decode($str, true);
print_r($dataum);
$string = utf8_encode($string);
$scer_array = json_decode($string ,true);

//echo '<script>console.log("<'.print_r($scer_array).'")</script>';

// Set SCER count to 0 before processing 
$garcia_count=0;
$pickard_count=0;
$cohen_count=0;
$stokes_count=0;
$hall_count=0;
$orit_count=0;
$takagi_count=0;
$no_name_count=0;

foreach ($data as $row){
	if ($row['assigned_to'] != null){
		$temp_str= strtolower($row['assigned_to']);
		//echo $temp_str;
		if (strpos($temp_str,'garcia') !== false) 
			$garcia_count++;
		if ($temp_str == 'pickard') 
			$pickard_count++;
		if (strpos($temp_str,'stokes') !== false)
			$stokes_count++;
		if (strpos($temp_str,'cohen') !== false)
			$cohen_count++;
		if (strpos($temp_str,'hap') !== false)
			$cohen_count++;
		if (strpos($temp_str,'hall') !== false)
			$hall_count++;
		if (strpos($temp_str,'selagea') !== false)
			$hall_count++;	
		if (strpos($temp_str,'orit') !== false)
			$orit_count++;
		if (strpos($temp_str,'takagi') !== false)
			$takagi_count++;
	}
	else
		$no_name_count++;

}
$total_scers = count($data);

// Compare active SCERS and Closed SCERs for this Year
	$active = 0;
	$closed = 0;
	$jan_first_2017 = 42736;
	for( $i=0; $i<count($scer_array);$i++){
		if ($scer_array[$i]['date_recvd'] > $jan_first_2017){
			if ($scer_array[$i]['status_code'] == 'c' || $scer_array[$i]['status_code'] == 'r'){
				$closed++;
			}
			else
				$active++;
		}
	}


/* DATA */
$bars = array();
$bars[] = new Bar('Garcia',  $garcia_count,   $total_scers); 
$bars[] = new Bar('Pickard',      $pickard_count,   $total_scers); 
$bars[] = new Bar('Cohen',    $cohen_count,   $total_scers); 
$bars[] = new Bar('Stokes',   $stokes_count,   $total_scers);
$bars[] = new Bar('Hall', $hall_count,   $total_scers);
$bars[] = new Bar('Orit',   $orit_count,   $total_scers);
$bars[] = new Bar('Takagi', $takagi_count, $total_scers);
$bars[] = new Bar('Unassigned', $no_name_count, $total_scers);

$bars2 = array();
$bars2[] = new Bar('Closed SCERS', $closed, $closed+$active);
$bars2[] = new Bar('Active SCERS', $active, $closed+$active);

/* DISPLAY */
$max_height = 0;
foreach($bars as $bar) {
    if ($bar->height > $max_height)
        $max_height = $bar->height;
}
$max_height2 = 0;
foreach($bars2 as $bar) {
    if ($bar->height > $max_height2)
        $max_height2 = $bar->height;
}

// change these
$max_bar_width = 250;
$default_padding = 10;

// don't change these
$total_outer = ($default_padding * 2); // (paddings + borders)
$max_width = $_GET['width'];
$num_bars = count($bars);
$bar_width = floor(min($max_bar_width, ($max_width - ($total_outer * $num_bars)) / $num_bars));
$final_padding = max($default_padding, ($max_width - (($bar_width + $total_outer) * $num_bars)) / $num_bars / 2);


$total_outer2 = ($default_padding * 2); // (paddings + borders)
$max_width2 = $_GET['width'];
$num_bars2 = count($bars2);
$bar_width2 = floor(min($max_bar_width, ($max_width2 - ($total_outer2 * $num_bars2)) / $num_bars2));
$final_padding2 = max($default_padding, ($max_width2 - (($bar_width2 + $total_outer2) * $num_bars2)) / $num_bars2 / 2)

?>
<table style="display:inline-block; whitespace: nowrap; height: 600px; overflow-x:scroll: overflow-y:hidden>
	<tr>
		<td>
			<div style="font-size: 48px; text-align:center; margin-bottom:1em;" >
				SCER Analytics
			</div>
				<div>
				  <div style="font-size: 30px; text-align:center">
						SCERs Assigned
					</div>
				  <div class="bars">
					<?php for($j = 0; $j < count($bars); $j++) {
						$bar = $bars[$j];
						$count = $j + 1;
						$bar_height =  ($bar->height / $max_height) * $_GET['height'];
						$bar_height = floor($bar_height);
						$top_offset = $_GET['height'] - $bar_height;
						?>
					<div class='bar' style='margin-top: <?php echo ($top_offset) . 'px; width: ' .
											$bar_width . 'px; padding: 0 ' . $final_padding . 'px;' ?>'>
						<div class='header'><?php echo '<span class="total">'. $bar->height .'</span> / <span class="remaining">'. $bar->remaining .'</span>'; ?></div>
						<div class='view' id='bar_<?php echo $count ?>' style='height: <?php echo $bar_height; ?>px;'></div>

					</div>

				<?php } ?>
				  </div>
				<?php for($j = 0; $j < count($bars); $j++) {
					$bar = $bars[$j]; 
				?>  
					<div class='bar-title' style='width: <?php echo $bar_width . 'px; padding: 0 ' . $final_padding . 'px;' ?>'>
						<span class='title'><?php echo $bar->name ?></span>
					</div>
					
				<?php } ?>        
				<div style='clear:both'></div>
				</div>
		</td>
		<td>
				<!-- Bar Graph #2 -->
				<div style="font-size: 30px; text-align:center; margin-top:2em; margin-bottom:1em;">
					Closed vs. Active 2017
				</div>
				
				<div style="display: inline-block">
					<div class="bars">
					<?php for($j = 0; $j < count($bars2); $j++) {
						$bar2 = $bars2[$j];
						$count2 = $j + 1;
						$bar_height2 =  ($bar2->height / $max_height2) * $_GET['height'];
						$bar_height2 = floor($bar_height2);
						$top_offset2 = $_GET['height'] - $bar_height2;
						?>
							<div class='bar' style='margin-top: <?php echo ($top_offset2) . 'px; width: ' .
											$bar_width2 . 'px; padding: 0 ' . $final_padding2 . 'px;' ?>'>
							<div class='header'><?php echo '<span class="total">'. $bar2->height .'</span> / <span class="remaining">'. $bar2->remaining .'</span>'; ?></div>
							<div class='view' id='bar2_<?php echo $count2 ?>' style='height: <?php echo $bar_height2; ?>px;'></div>
							</div>
						<?php } ?>
					</div>
					<?php for($j = 0; $j < count($bars2); $j++) {
					$bar2 = $bars2[$j]; 
					?>  
					<div class='bar-title' style='width: <?php echo $bar_width2 . 'px; padding: 0 ' . $final_padding2 . 'px;' ?>'>
						<span class='title'><?php echo $bar2->name ?></span>
					</div>
				<?php } ?>        
				<div style='clear:both'></div>
			</div>
		</td></tr></table>
<script>

var garcia_on = false;
var pickard_on = false;
var cohen_on = false;
var stokes_on = false;
var hall_on = false;
var orit_on = false;
var takagi_on = false;
var unassigned_on = false;

function checkOthersOn(){
	//need to check if other bar's details are already being displayed,
	//if so, we need to close them out before switching to the new bar details
	if (garcia_on){
		$('#grid_detailed').animate({
				height:'0px', 
				marginBottom: "0px"});
				$('#Garcia').animate({
				height:'0px', 
				marginBottom: "0px"});
				document.getElementById("Garcia").style.visibility = "hidden";
		garcia_on = false;
	}
	if (pickard_on){
		$('#grid_detailed').animate({
				height:'0px', 
				marginBottom: "0px"});
				$('#Pickard').animate({
				height:'0px', 
				marginBottom: "0px"});
				document.getElementById("Pickard").style.visibility = "hidden";
		pickard_on = false;
	}
	if (cohen_on){
		$('#grid_detailed').animate({
				height:'0px', 
				marginBottom: "0px"});
				$('#Cohen').animate({
				height:'0px', 
				marginBottom: "0px"});
				document.getElementById("Cohen").style.visibility = "hidden";
		cohen_on = false;
	}
	if (stokes_on){
		$('#grid_detailed').animate({
				height:'0px', 
				marginBottom: "0px"});
				$('#Stokes').animate({
				height:'0px', 
				marginBottom: "0px"});
				document.getElementById("Stokes").style.visibility = "hidden";
		stokes_on = false;
	}
	if (hall_on){
		$('#grid_detailed').animate({
				height:'0px', 
				marginBottom: "0px"});
				$('#Hall').animate({
				height:'0px', 
				marginBottom: "0px"});
				document.getElementById("Hall").style.visibility = "hidden";
		hall_on = false;
	}
	if (orit_on){
		$('#grid_detailed').animate({
				height:'0px', 
				marginBottom: "0px"});
				$('#Orit').animate({
				height:'0px', 
				marginBottom: "0px"});
				document.getElementById("Orit").style.visibility = "hidden";
		orit_on = false;
	}
	if (takagi_on){
		$('#grid_detailed').animate({
				height:'0px', 
				marginBottom: "0px"});
				$('#Takagi').animate({
				height:'0px', 
				marginBottom: "0px"});
				document.getElementById("Takagi").style.visibility = "hidden";
		takagi_on = false;
	}
	if (unassigned_on){
		$('#grid_detailed').animate({
				height:'0px', 
				marginBottom: "0px"});
				$('#Unassigned').animate({
				height:'0px', 
				marginBottom: "0px"});
				document.getElementById("Unassigned").style.visibility = "hidden";
		unassigned_on = false;
	}
	
	
}

// Need to add listeners to each bar individually. If done in a for-loop, each bar will get "clicked" -> not good.
//Bar #1
document.getElementById('bar_1').addEventListener('click', 
	function(event) {
		if (!garcia_on){
			checkOthersOn();
			document.getElementById("Garcia").style.visibility = "visible";
			$('#grid_detailed').animate({
				height:'600px'/* ,
			marginBottom:'600px' */});

			
		}
		else{
				$('#grid_detailed').animate({
				height:'0px', 
				marginBottom: "0px"});
				$('#Garcia').animate({
				height:'0px', 
				marginBottom: "0px"});
				document.getElementById("Garcia").style.visibility = "hidden";
				//$('#Garcia').style.visibility = "hidden";
		}
		garcia_on = !garcia_on;
	});
	

document.getElementById('bar_2').addEventListener('click', 
	function(event) {
		if (!pickard_on){
			checkOthersOn();
			document.getElementById("Pickard").style.visibility = "visible";
			$('#grid_detailed').animate({
				height:'600px'/* ,
			marginBottom:'600px' */});

			
		}
		else{
				$('#grid_detailed').animate({
				height:'0px', 
				marginBottom: "0px"});
				document.getElementById("Pickard").style.visibility = "hidden";
		}
		pickard_on = !pickard_on;
	});	
	
	document.getElementById('bar_3').addEventListener('click', 
	function(event) {
		if (!cohen_on){
			checkOthersOn();
			document.getElementById("Cohen").style.visibility = "visible";
			$('#grid_detailed').animate({
				height:'600px'/* ,
			marginBottom:'600px' */});

			
		}
		else{
				$('#grid_detailed').animate({
				height:'0px', 
				marginBottom: "0px"});
				document.getElementById("Cohen").style.visibility = "hidden";
		}
		cohen_on = !cohen_on;
	});	
	
	document.getElementById('bar_4').addEventListener('click', 
	function(event) {
		if (!stokes_on){
			checkOthersOn();
			document.getElementById("Stokes").style.visibility = "visible";
			$('#grid_detailed').animate({
				height:'600px'/* ,
			marginBottom:'600px' */});

			
		}
		else{
				$('#grid_detailed').animate({
				height:'0px', 
				marginBottom: "0px"});
				document.getElementById("Stokes").style.visibility = "hidden";
		}
		stokes_on = !stokes_on;
	});	
	
	document.getElementById('bar_5').addEventListener('click', 
	function(event) {
		if (!hall_on){
			checkOthersOn();
			document.getElementById("Hall").style.visibility = "visible";
			$('#grid_detailed').animate({
				height:'600px'/* ,
			marginBottom:'600px' */});

			
		}
		else{
				$('#grid_detailed').animate({
				height:'0px', 
				marginBottom: "0px"});
				document.getElementById("Hall").style.visibility = "hidden";
		}
		hall_on = !hall_on;
	});	
	
	document.getElementById('bar_6').addEventListener('click', 
	function(event) {
		if (!orit_on){
			checkOthersOn();
			document.getElementById("Orit").style.visibility = "visible";
			$('#grid_detailed').animate({
				height:'600px'/* ,
			marginBottom:'600px' */});

			
		}
		else{
				$('#grid_detailed').animate({
				height:'0px', 
				marginBottom: "0px"});
				document.getElementById("Orit").style.visibility = "hidden";
		}
		orit_on = !orit_on;
	});	
	
	document.getElementById('bar_7').addEventListener('click', 
	function(event) {
		if (!takagi_on){
			checkOthersOn();
			document.getElementById("Takagi").style.visibility = "visible";
			$('#grid_detailed').animate({
				height:'600px'/* ,
			marginBottom:'600px' */});

			
		}
		else{
				$('#grid_detailed').animate({
				height:'0px', 
				marginBottom: "0px"});
				document.getElementById("Takagi").style.visibility = "hidden";
		}
		takagi_on = !takagi_on;
	});	
	
		document.getElementById('bar_8').addEventListener('click', 
	function(event) {
		if (!unassigned_on){
			checkOthersOn();
			document.getElementById("Unassigned").style.visibility = "visible";
			$('#grid_detailed').animate({
				height:'600px'/* ,
			marginBottom:'600px' */});

			
		}
		else{
				$('#grid_detailed').animate({
				height:'0px', 
				marginBottom: "0px"});
				document.getElementById("Unassigned").style.visibility = "hidden";
		}
			unassigned_on= !unassigned_on;
	});	
	</script>

