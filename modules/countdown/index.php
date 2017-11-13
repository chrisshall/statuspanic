<?php

/* DEFAULTS */
date_default_timezone_set('America/New_York');
$stop = time(); 

/* DATA */
// http://php.net/manual/en/function.mktime.php
if (!empty($_GET['stop'])) 
    $stop = $_GET['stop'];

if (!empty($_GET['timezone'])) 
    date_default_timezone_set($_GET['timezone']);    

/* DISPLAY */
$diff = $stop - time();
$days = floor($diff/(60*60*24));

if ($days <= 0) {
    $result = 'COUNTDOWN FINISHED!';
} else {
    $result = "$days DAYS <span class='event'>{$_GET['event']}</span>";
}


?>

<div class='mega'>
    <span class='icon'>H</span><?php echo $result; ?>
</div>
