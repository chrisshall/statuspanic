<?php

date_default_timezone_set('America/New_York');
$format = 'g:i a';

if (!empty($_GET['timezone'])) 
    date_default_timezone_set($_GET['timezone']); 

if (!empty($_GET['format'])) 
    $format = $_GET['format']; 
    

/* DATA */
$time = date($format);
$datetime = date("D M. j"); 

/* DISPLAY */
?>

<div class='time vertical-center'>
    <?php echo $time;?>
</div>

<div class='date'>
	<?php echo $datetime;?>
</div>
