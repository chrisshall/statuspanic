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
    for($i = 0; $i < count($data) -1; $i++) {
		//print_r(array_keys($row));
		$row = $data[$i];
		echo "<tr class='tr' id='tr_row_" . $i ."'>";
            echo "<td class='td'> " . 'ATL' . $row['scer #'] . "</td>";
			echo "<td class='td'> " . $row['assigned_to'] . "</td>";
			echo "<td class='td'> " . $row['Customer'] . "</td>";
			echo "<td class='td'> " . $row['need_date'] . "</td>";
        echo '</tr>';	
		echo "<tr style='visibility:hidden;height:0px;display:table-column;' id='tr_" . $i . "'> <td></td><td></td><td></td><td> <table style='visibility:hidden; height=0;' id='scer_" . $i . "'>";

		foreach(array_keys($row) as $keys){
		 
			echo "<tr class='tr'>";
				echo "<td class = 'alt td'> " . $keys . "</td>";		// display key first
				echo "<td class = 'alt td'> " . $row[$keys] . "</td>";	//now display value
			echo '</tr>';
		
		}
		echo '</table></td></tr>';
	}
	echo '</table>';
    ?>
	
</div>

<script>
<?php 
	
	for ($i = 0; $i< count($data); $i++){
?>	
		var open_<?php echo $i ?> = false;
<?php
				}
?>
	
	function checkOthersOn(target){
<?php 
		
		for ($i = 0; $i< count($data); $i++){
?>	
			if (open_<?php echo $i ?> == true){
					open_<?php echo $i ?> = false;
					document.getElementById("scer_<?php echo $i ?>").style.visibility= "hidden";
					document.getElementById("tr_<?php echo $i ?>").style.display= "table-column";
					document.getElementById("tr_<?php echo $i ?>").style.visibility= "hidden";
			}
			
			
<?php
		}
?>
	}
		
<?php  
	for ($i = 0; $i<count($data) -1; $i++){
?>
	//console.log(document.getElementById('tr_row<?php echo $i?>'));
		document.getElementById('tr_row_<?php echo $i?>').addEventListener('click', 
		function(event) {
			if (!open_<?php echo $i?>){
				checkOthersOn(event.target);
				console.log(event.target);
				document.getElementById(("scer_<?php echo $i ?>")).style.visibility = "visible";
				document.getElementById("tr_<?php echo $i ?>").style.visibility = "visible";
				document.getElementById("tr_<?php echo $i?>").style.display = "";
			}
			
			else{
					document.getElementById("scer_<?php echo $i ?>").style.visibility= "hidden";
					document.getElementById("tr_<?php echo $i ?>").style.display= "table-column";
					document.getElementById("tr_<?php echo $i ?>").style.visibility= "hidden";
			}
			
			open_<?php echo $i?> = !open_<?php echo $i?>;
			
		});	
<?php
	}
?>	


	
	
</script>



