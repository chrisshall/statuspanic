<?php

$travel = file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/json?origins=860+Spring+St+NW,+Atlanta,+GA&destinations=Duluth,+GA|Mall+of+GA+Buford,+GA|Athens,+GA|&departure_time=now&traffic_model=best_guess&key=AIzaSyD0WVEFw7a4V7zgEAdHkr5YbDu3fTw4RW8');
$data = json_decode($travel, true);

$time_duluth= $data['rows'][0]['elements'][0]['duration_in_traffic']["text"];
$time_buford= $data['rows'][0]['elements'][1]['duration_in_traffic']["text"];
$time_athens= $data['rows'][0]['elements'][2]['duration_in_traffic']["text"];

?>
<html>
<iframe
  width="600"
  height="450"
  frameborder="0" style="border:0"
  src="https://www.google.com/maps/embed/v1/search?key=AIzaSyD0WVEFw7a4V7zgEAdHkr5YbDu3fTw4RW8
    &q=NCR,Atlanta+GA" allowfullscreen>
</iframe>


</html>