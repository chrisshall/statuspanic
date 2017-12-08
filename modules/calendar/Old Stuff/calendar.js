//var month_year_string = document.getElementById('month').innerHTML;

function goBack(month_year){
	var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
	var date_array = month_year.split(" ");
	var month = date_array[0];
	var year = date_array[1];
	var index = months.indexOf(month);
	
	if (index-1 < 0){
		var date = "December "+ (year-1);
		index=11;
	}
	else{
		var date = months[index-1] + " " + year;
	}
	//console.log(index);
	//setMonthYear(date);
	document.getElementById('month').innerHTML = date;
	//console.log(date);
	$.post("modules/calendar/index.php",{month_year: date},function(data){
			$('#result').html(data);
	});
}
function setMonthYear(month_year){
	month_year_string = month_year;
}

function getMonthYear(){
	return month_year_string;
}
	

function goAhead(month_year){
	var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
	var date_array = month_year.split(" ");
	var month = date_array[0];
	var year = date_array[1];
	var index = months.indexOf(month);
	
	if (index+1 > 11){
		year = parseInt(year);
		var date = "January "+ (year+1);
		index = 0;
	}
	else{
		var date = months[index+1] + " " + year;
	}
	//setMonthYear(date);
	document.getElementById('month').innerHTML = date;
	$.post("modules/calendar/index.php",{month_year: date},function(data){
			$('#result').html(data);
			console.log(data);
	});
}	
/*
$('#nextmonth').click(function(){
	$.ajax({
		type: 'POST',
		url: '/modules/calendar/index.php',
		data: {'month_year': month_year_string},
		datatype: 'text',
		success: function(data){
			//console.log(month_year_string);
			$('#result').html(data);
		}
	});
});
$('#lastmonth').click(function(){
	$.ajax({
		type: 'POST',
		url: '/modules/calendar/index.php',
		data: {'month_year': month_year_string},
		datatype: 'text',
		success: function(data){
			$('#result').html(data);
		}
		
	});
});*/

/*if (window.XMLHttpRequest) {
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
      alert('form was submitted');
    }
  };
  xmlhttp.open("POST", "modules/calendar/index.php", true);
  xmlhttp.send("month_year="+month_year_string);
}*/
