<?php

/* DATA */
/*$data = array(
  array('ATL2832 - X5 Debian',      '9/23/17', 'Chris H.', 'In Progress'),
  array('UNISON',       'Blurb', 'Blarb', 'Z@statuspanic, L@statuspanic, I@statuspanic'),
  array('CODA',         'Blurb', 'Blarb', 'Z@statuspanic, H@statuspanic, P@statuspanic'),
  array('OTHER THING',  'Blurb', 'Blarb', 'G@statuspanic, L@statuspanic'),
  array('EXCITING',     'Blurb', 'Blarb', 'L@statuspanic, G@statuspanic, I@statuspanic')
);*/

$str = file_get_contents('./SCER.json');
$str = utf8_encode($str);
$data = json_decode($str, true);



/* DISPLAY */

?>

<div class='grid' style="position:relative">
    <table  class=' grid table' border='0' width='100%' cellpadding='0' cellspacing='10'>
		<th class='grid th'>SCER#</th>
		<th class='grid th'>Assigned</th>
		<th class='grid th'>Customer</th>
		<th class='grid th'>Need Date</th>
    <?php
    foreach($data as $row) {
		echo "<tr class='tr'>";
            echo "<td class='td'> " . 'ATL' . $row['scer #'] . "</td>";
			echo "<td class='td'> " . $row['assigned_to'] . "</td>";
			echo "<td class='td'> " . $row['Customer'] . "</td>";
			echo "<td class='td'> " . $row['need_date'] . "</td>";
        echo '</tr>';
    }
    
    ?>
    
    </table>
</div>
