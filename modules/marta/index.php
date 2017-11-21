<?php

/* Midtown Station Routes:
*	12
*	27
*	36
*	109
*/

//Get Route 12 
$file = file_get_contents('Route12S.json');
$route12S = json_decode($file);
$file = file_get_contents('Route12N.json');
$route12N = json_decode($file);

//Get Route 27
$file = file_get_contents('Route27S.json');
$route27S = json_decode($file)
$file = file_get_contents('Route27N.json');
$route27N = json_decode($file);

//Get Route 36
$file = file_get_contents('Route36E.json');
$route36E = json_decode($file);
$file = file_get_contents('Route36W.json');
$route36W = json_decode($file);

//Get Route 109
$file = file_get_contents('Route109S.json');
$route109S = json_decode($file);
$file = file_get_contents('Route109N.json');
$route109N = json_decode($file);

function get_next_bus(route, direction);


$items = array(
    // 'bubble' => 'line'
    '12|gold'  => '1:02',
    '27|red'     => '9 min',
    '36|red'    => '5 min',
    '109|red'    => '11 min')

//$bus_array = array();


?>

<ul>
    <?php foreach($items as $bubble => $line) { 
        $bubble = explode('|', $bubble);
        $color  = $bubble[1];
        $bubble = $bubble[0];
        ?>
        <li>
            <span class='<?php echo $color ?> marta'>
                <span class='background'>E</span>
                <span class='display'><?php echo $bubble ?></span>
            </span>
            <span class='content'><?php echo $line ?></span>
        </li>
    <?php } ?>
</ul>
