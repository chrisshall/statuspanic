<?php

$items = array(
    // 'bubble' => 'line'
    '4|gold'  => '1:02',
    '9|red'     => '9 min',
    '14|red'    => '5 min',
    '19|red'    => '11 min',
    '20|gold' => '3:55'
)

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
