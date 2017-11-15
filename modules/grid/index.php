<?php

/* DATA */
/*$data = array(
  array('ATL2832 - X5 Debian',      '9/23/17', 'Chris H.', 'In Progress'),
  array('UNISON',       'Blurb', 'Blarb', 'Z@statuspanic, L@statuspanic, I@statuspanic'),
  array('CODA',         'Blurb', 'Blarb', 'Z@statuspanic, H@statuspanic, P@statuspanic'),
  array('OTHER THING',  'Blurb', 'Blarb', 'G@statuspanic, L@statuspanic'),
  array('EXCITING',     'Blurb', 'Blarb', 'L@statuspanic, G@statuspanic, I@statuspanic')
);*/

$str = file_get_contents('./SCERJSON.json');
$data = json_decode($str, true);



/* DISPLAY */

?>

<div class='grid'>
    <table  class=' grid table' border='0' width='100%' cellpadding='0' cellspacing='10'>
		<th class='grid th'>SCER#</th>
		<th class='grid th'>Assigned</th>
		<th class='grid th'>Customer</th>
		<th class='grid th'>Need Date</th>
    <?php
    foreach($data as $row) {
			echo "<tr class='r'>";
            echo "<td class='td'> " . 'ATL' . $row['scer #'] . "</td>";
			echo "<td class='td'> " . $row['assigned_to'] . "</td>";
			echo "<td class='td'> " . $row['Customer'] . "</td>";
			echo "<td class='td'> " . $row['need_date'] . "</td>";
			
			
			/*if ($j!=3) {
                echo "<td class='cell_$j'>$row[$j]</td>";
             }else {
                $gravatar = ''; 
                $array = preg_split('/,/', $row[$j], -1, PREG_SPLIT_NO_EMPTY);
                foreach ($array as $email) {
                    $gravatar .= '<img src="http://www.gravatar.com/avatar.php?gravatar_id='. md5($email) .'&s=40&d=monsterid"> ';            
                }
                echo "<td class='cell_$j'>$gravatar</td>";
            }*/
        echo '</tr>';
    }
    
    ?>
    
    </table>
</div>
