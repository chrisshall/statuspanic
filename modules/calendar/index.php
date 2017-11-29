<?php

$count=0;
$calendar = Array();
date_default_timezone_set('America/New_York');
$date = new DateTime();

// return today's date as an int (i.e 24)
$today = $date -> format('d');

//subtract 23 days
$first = date('U',time()-60*60*24*($today-1));
//echo $first;
$day = getdate($first);
//print_r($day);

//Return the weekday of the first day of the month, so we know where to put start the 2D array
$first_day = $day['wday']; // 0 for Sunday, 6 for Saturday

//Now that we have the weekday, we can add the entire week's numbers by subtracting for going back into last month's or adding +1 for next elements. words are hard.
$calendar[0][$first_day]='1';
for ($i=1; $i<=$first_day; $i++){
	$date = getdate($day[0]-(60*60*24*$i));
	$calendar[0][$first_day-$i]=$date['mday'];
}
// Next, we'll get the rest of this week's
for ($i=3; $i<=6; $i++){
	$date = getdate($day[0]+(60*60*24)*($i-3));
	$calendar[0][$i] = $date['mday'];
}

//Now set $day to int value of first day of next week
$day = getdate(date('U', $date[0]+60*60*24));
//echo (getdate($day)) ['mday'];

//print_r($day);
for ($col=0;$col<=6;$col++){	
	for ($row=1; $row <= 4; $row++){
		$date=getdate($day[0]+(60*60*24)*(7*($row-1)+$col));
		$calendar[$row][$col] = $date['mday'];
		//echo $date['mday'] . ", ";
	}
	//echo "<br>";
}

//print_r($calendar);

?>




<div class='calendar'>
		<button  class="button" id="lastmonth" style="float: left"> < </button>

			November 2017	
			
		<button class="button" id="nextmonth" style="float: right"> > </button>

</div>

<div class='calendar'>
	<table>
		<tr>
			<td class="td"> 
				Sun
				</td>
			<td class="td"> 
				Mon
				</td>
			<td class="td"> 
				Tue
				</td>
			<td class="td"> 
				Wed
				</td>
			<td class="td"> 
				Thu
				</td>
			<td class="td"> 
				Fri
				</td>
			<td class="td"> 
				Sat
			</td>
		</tr>
			<?php for($row=0; $row <= 4; $row++){
				echo "<tr class='alt'>";
				for ($col=0; $col <=6 ; $col++){
					if ($calendar[$row][$col] == getdate(time())['mday']){
						echo "<td class='td'>
								<button class='today'>
								" . $calendar[$row][$col] . "</button></td>";
						}
					else{	
						echo "<td class='td'>
							" . $calendar[$row][$col] . "</td>";
					}
				}
				echo "</tr>";
			}
			?>
				
	</table>
