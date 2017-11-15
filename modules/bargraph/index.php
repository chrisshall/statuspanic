<?php

class Bar {
    function __construct($name, $height, $remaining) {
        $this->name = $name;
        $this->height = $height;
        $this->remaining = $remaining;
    }
}
// Get SCER JSON file 
$str = file_get_contents('../grid/SCERJSON.json');
$data = json_decode($str, true);

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


/* DATA */
$bars = array();
$bars[] = new Bar('Garcia',  $garcia_count,   $total_scers); 
$bars[] = new Bar('Pickard',      $pickard_count,   $total_scers); 
$bars[] = new Bar('Cohen',    $cohen_count,   $total_scers); 
$bars[] = new Bar('Stokes',   $stokes_count,   $total_scers);
$bars[] = new Bar('Hall', $hall_count,   $total_scers);
$bars[] = new Bar('Orit',   $orit_count,   $total_scers);
$bars[] = new Bar('Takagi', $takagi_count, $total_scers);
$bars[] = new Bar('No Name', $no_name_count, $total_scers);


/* DISPLAY */
$max_height = 0;
foreach($bars as $bar) {
    if ($bar->height > $max_height)
        $max_height = $bar->height;
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
?>

<div class='jumbo middle'>
	</br>SCER Analytics
</div>

<div>
  <div class="bars">
<?php for($j = 0; $j < count($bars); $j++) {
    $bar = $bars[$j];
    $count = $j + 1;
    $bar_height =  ($bar->height / $max_height) * $_GET['height'];
    $bar_height = floor($bar_height);
    $top_offset = $_GET['height'] - $bar_height;
    
?>
    <div class='bar' style='margin-top: <?php echo $top_offset . 'px; width: ' .
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
