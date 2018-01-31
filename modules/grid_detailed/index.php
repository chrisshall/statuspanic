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

<div id="Garcia" class='grid' style="height:0px">
	<div style="font-size:34px"> Garcia  </div><br>
    <table  class=' grid table' border='0' width='100%' cellpadding='0' cellspacing='10'>
		<thead>
		<tr>
			<th>SCER#</th>
			<th>Customer</th>
			<th>Need Date</th>
			<th>Details</th>
		</tr>
		</thead>
    <?php	
    foreach($data as $row) {
		if (strpos(strtolower($row['assigned_to']),'garcia') !== false){
			echo "<tr class='tr'>";
				echo "<td class='td'> " . 'ATL' . $row['scer #'] . "</td>";
				echo "<td class='td'> " . $row['Customer'] . "</td>";
				echo "<td class='td'> " . $row['need_date'] . "</td>";
				echo "<td class='td'> " . $row['details'] . "</td>";	
			echo '</tr>';
		}
	}
    ?>
    
    </table>
</div>

<div id="Pickard" class='grid' style="height:0px">
	<div style="font-size:34px"> Pickard </div><br>
    <table  class=' grid table' border='0' width='100%' cellpadding='0' cellspacing='10'>
		<thead>
		<tr>
			<th>SCER#</th>
			<th>Customer</th>
			<th>Need Date</th>
			<th>Details</th>
		</tr>
		</thead>
    <?php	
    foreach($data as $row) {
		if (strpos(strtolower($row['assigned_to']),'pickard') !== false){
			echo "<tr class='tr'>";
				echo "<td class='td'> " . 'ATL' . $row['scer #'] . "</td>";
				echo "<td class='td'> " . $row['Customer'] . "</td>";
				echo "<td class='td'> " . $row['need_date'] . "</td>";
				echo "<td class='td'> " . $row['details'] . "</td>";	
			echo '</tr>';
		}
	}
    ?>
    
    </table>
</div>

<div id="Cohen" class='grid' style="height:0px">
	<div style="font-size:34px"> Cohen </div><br>
    <table  class=' grid table' border='0' width='100%' cellpadding='0' cellspacing='10'>
		<thead>
		<tr>
			<th>SCER#</th>
			<th>Customer</th>
			<th>Need Date</th>
			<th>Details</th>
		</tr>
		</thead>
    <?php	
    foreach($data as $row) {
		if (strpos(strtolower($row['assigned_to']),'cohen') !== false || strpos(strtolower($row['assigned_to']),'hap') !== false){
			echo "<tr class='tr'>";
				echo "<td class='td'> " . 'ATL' . $row['scer #'] . "</td>";
				echo "<td class='td'> " . $row['Customer'] . "</td>";
				echo "<td class='td'> " . $row['need_date'] . "</td>";
				echo "<td class='td'> " . $row['details'] . "</td>";	
			echo '</tr>';
		}
	}
    ?>
    
    </table>
</div>

<div id="Stokes" class='grid' style="height:0px">
	<div style="font-size:34px"> Stokes </div><br>
    <table  class=' grid table' border='0' width='100%' cellpadding='0' cellspacing='10'>
		<thead>
		<tr>
			<th>SCER#</th>
			<th>Customer</th>
			<th>Need Date</th>
			<th>Details</th>
		</tr>
		</thead>
    <?php	
    foreach($data as $row) {
		if (strpos(strtolower($row['assigned_to']),'stokes') !== false){
			echo "<tr class='tr'>";
				echo "<td class='td'> " . 'ATL' . $row['scer #'] . "</td>";
				echo "<td class='td'> " . $row['Customer'] . "</td>";
				echo "<td class='td'> " . $row['need_date'] . "</td>";
				echo "<td class='td'> " . $row['details'] . "</td>";	
			echo '</tr>';
		}
	}
    ?>
    
    </table>
</div>

<div id="Hall" class='grid' style="height:0px">
	<div style="font-size:34px"> Hall </div><br>
    <table  class=' grid table' border='0' width='100%' cellpadding='0' cellspacing='10'>
		<thead>
		<tr>
			<th>SCER#</th>
			<th>Customer</th>
			<th>Need Date</th>
			<th>Details</th>
		</tr>
		</thead>
    <?php	
    foreach($data as $row) {
		if (strpos(strtolower($row['assigned_to']),'hall') !== false || strpos(strtolower($row['assigned_to']),'selagea') !== false){
			echo "<tr class='tr'>";
				echo "<td class='td'> " . 'ATL' . $row['scer #'] . "</td>";
				echo "<td class='td'> " . $row['Customer'] . "</td>";
				echo "<td class='td'> " . $row['need_date'] . "</td>";
				echo "<td class='td'> " . $row['details'] . "</td>";	
			echo '</tr>';
		}
	}
    ?>
    
    </table>
</div>

<div id="Orit" class='grid' style="height:0px">
	<div style="font-size:34px"> Orit </div><br>
    <table  class=' grid table' border='0' width='100%' cellpadding='0' cellspacing='10'>
		<thead>
		<tr>
			<th>SCER#</th>
			<th>Customer</th>
			<th>Need Date</th>
			<th>Details</th>
		</tr>
		</thead>
    <?php	
    foreach($data as $row) {
		if (strpos(strtolower($row['assigned_to']),'orit') !== false){
			echo "<tr class='tr'>";
				echo "<td class='td'> " . 'ATL' . $row['scer #'] . "</td>";
				echo "<td class='td'> " . $row['Customer'] . "</td>";
				echo "<td class='td'> " . $row['need_date'] . "</td>";
				echo "<td class='td'> " . $row['details'] . "</td>";	
			echo '</tr>';
		}
	}
    ?>
    
    </table>
</div>

<div id="Takagi" class='grid' style="height:0px">
	<div style="font-size:34px"> Takagi </div><br>
    <table  class=' grid table' border='0' width='100%' cellpadding='0' cellspacing='10'>
		<thead>
		<tr>
			<th>SCER#</th>
			<th>Customer</th>
			<th>Need Date</th>
			<th>Details</th>
		</tr>
		</thead>
    <?php	
    foreach($data as $row) {
		if (strpos(strtolower($row['assigned_to']),'takagi') !== false){
			echo "<tr class='tr'>";
				echo "<td class='td'> " . 'ATL' . $row['scer #'] . "</td>";
				echo "<td class='td'> " . $row['Customer'] . "</td>";
				echo "<td class='td'> " . $row['need_date'] . "</td>";
				echo "<td class='td'> " . $row['details'] . "</td>";	
			echo '</tr>';
		}
	}
    ?>
    
    </table>
</div>

<div id="Unassigned" class='grid' style="height:0px">
	<div style="font-size:34px"> Unassigned </div><br>
    <table  class=' grid table' border='0' width='100%' cellpadding='0' cellspacing='10'>
		<thead>
		<tr>
			<th>SCER#</th>
			<th>Customer</th>
			<th>Need Date</th>
			<th>Details</th>
		</tr>
		</thead>
    <?php	
    foreach($data as $row) {
		if (strpos(strtolower($row['assigned_to']),"") !== false){
			echo "<tr class='tr'>";
				echo "<td class='td'> " . 'ATL' . $row['scer #'] . "</td>";
				echo "<td class='td'> " . $row['Customer'] . "</td>";
				echo "<td class='td'> " . $row['need_date'] . "</td>";
				echo "<td class='td'> " . $row['details'] . "</td>";	
			echo '</tr>';
		}
	}
    ?>
    
    </table>
</div>