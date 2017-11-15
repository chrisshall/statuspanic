<?php

/* DATA */

/*$num = rand(-99, 99);

if (rand(0,4) == 0) {
    $num = 0;
}

if (!empty($_GET['value'])) 
    $num = $_GET['value'];
*/
$username_key = 'fdf625991e77c7207ee9167235405781';
$password_key = '7392c7238335493c203f8c529c51bf4d';

/*
$process = curl_init('https://' . $username_key . ':' . $password_key . '@api.intrinio.com/companies?ticker=NCR');
curl_setopt($process, CURLOPT_HTTPHEADER, array('Content-Type: application/xml', $additionalHeaders));
curl_setopt($process, CURLOPT_HEADER, 1);
curl_setopt($process, CURLOPT_USERPWD, $username_key . ":" . $password_key);
curl_setopt($process, CURLOPT_TIMEOUT, 30);
curl_setopt($process, CURLOPT_POST, 1);
curl_setopt($process, CURLOPT_POSTFIELDS, $payloadName);
curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
$return = curl_exec($process);
curl_close($process);
*/


$string = file_get_contents("https://fdf625991e77c7207ee9167235405781:7392c7238335493c203f8c529c51bf4d@api.intrinio.com/companies?ticker=NCR");
//$arrMatches = explode('// ', $string); // get uncommented json string
$data = json_decode($string, true); // decode json
//$price = $assJson["l"];
//echo $price;
//print_r($data);

$num = 0;
/* DISPLAY */
if ($num > 0) {
    $class = 'uparrow';
    $code = 'A';
} elseif ($num < 0) {
    $class = 'downarrow';
    $code = 'A';
} else {
    $class = 'zero-block';
    $code = 'K';
}
?>

<div>    
    <span class='<?php echo $class ?>' id='arrow_icon'><?php echo $code ?></span>
    <span class='mega'><?php echo $num ?>%</span>
</div>
