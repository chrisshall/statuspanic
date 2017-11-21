<?php

/* Midtown Station Routes:
*	12
*	27
*	36
*	109
*/

//Get Route 12 




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
