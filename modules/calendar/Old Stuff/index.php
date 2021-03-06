<?php
/*
 *	Calendar Module
 */
$count=0;
$calendar = Array();
date_default_timezone_set('America/New_York');
$date = new DateTime();


//Get month and year of what's in the calendar title via ajax
if (isset($_POST['month_year']) && !empty($_POST['month_year'])){
		$month_year = $_POST['month_year'];
	$month_year = explode(' ',$month_year);
	$month = $month_year[0];
	$year = $month_year[1];
	//echo "<script type='text/javascript'> console.log('".$month_year[0]."');</script>";
	//print_r($month_year);
	//echo "<script type='text/javascript'> console.log('$month_year');</script>";
	
	//first day of month needs to be converted to int
	$first_day_string = $month . ' 1 ' . $year;
	$first_day_int = date('U', strtotime($first_day_string));
	//echo "<script type='text/javascript'>alert('$first_day_int');</script>";
	$first = $first_day_int;
	
}
 else{
	$month = date('F');
	$year = date('Y');
	// return today's date as an int (i.e 24)
	$today = $date -> format('d');

	//subtract 23 days
	$first = date('U',time()-60*60*24*($today-1));
	//echo $first
 }
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
	for ($i=$first_day; $i<=6; $i++){
		$date = getdate($day[0]+(60*60*24)*($i-$first_day));
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
 
?>



<html>
<div id="result">
<div class='calendar'>
	<script src="modules/calendar/calendar.js","resources/jquery.js"></script>	
		<button class="button" id="lastmonth" style="float: left" onclick="goBack(document.getElementById('month').innerHTML)"> < </button>
		<button class="button" onclick="goAhead(document.getElementById('month').innerHTML)" id="nextmonth" style="float: right"> > </button>
		<div id="month" style="font-size: 30px"><?php echo $month . " " . $year?></div>	
		
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
					if (($calendar[$row][$col] > 7 && $row == 0) || ($calendar[$row][$col] < 22 && $row == 4)){
						echo "<td class='td_grey'>
							" . $calendar[$row][$col] . "</td>";		
					}
					else{
						if (($calendar[$row][$col] == getdate(time())['mday'])&& $month == date('F') && $year == date('Y')){
							echo "<td class='td'>
								<button class='today'>
								" . $calendar[$row][$col] . "</button></td>";
						}
						else{	
							echo "<td class='td'>
							" . $calendar[$row][$col] . "</td>";
						}
					}
				}
				echo "</tr>";
			}
			?>
				
	</table>
	</div>
</html>