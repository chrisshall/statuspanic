<?php
define('CONFIG', 'config.json');
// FIRST: read in the configuration
$config = fopen(CONFIG, 'r');
$data = fread($config, filesize(CONFIG));
$data = json_decode($data);
if (!$data) die('JSON syntax error in "'.CONFIG.'"');
function render($module) {
    $argstr = array();	
    $args = isset($module->args) ? $module->args : NULL;
	if (!isset($args))
		$args = new stdClass();
    $args->width = $module->width;
    foreach($args as $key => $val) {
        $argstr[] = "$key=" . urlencode($val);
    }
    $argstr = implode("&", $argstr);
    
    $style = "width: {$module->width}px;";
    $class = isset($module->class) ? $module->class : '';
    $style .= isset($module->height) ? " height: {$module->height}px" : NULL;
    if (!isset($module->type)) $module->type = $module->name; //backwards compatability
    return "<div class='module $class' id='$module->name' style='$style'>
    <script type='text/javascript'>activate_module('$module->name', '$module->type', $module->update, '$argstr');</script>
    </div>\r\n";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US" xml:lang="en-US" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="expires" content="-1" />
    <title><?php echo (isset($data->title) ? $data->title : 'statuspanic') ?></title>
    <link rel='stylesheet' type='text/css' href='resources/reset.css' />
    <link rel='stylesheet' type='text/css' href='resources/panic.css' />
    <style type='text/css'>
        #board { width: <?php echo isset($data->width) ? $data->width.'px' : '100%'; ?> }
    </style>
    <?php
        foreach($data->modules as $module) {
            $filename = "./modules/";
            $filename .= isset($module->type) ? $module->type."/".$module->type.".css" : $module->name."/".$module->name.".css";
            if (file_exists($filename)) echo "<link rel='stylesheet' type='text/css' href='$filename'/>";
        }
    ?>
    <script type='text/javascript' src='resources/jquery.js'></script>
    <script type='text/javascript' src='resources/board.js'></script>
</head>
<body>
    <div id='board'>
        <?php 
        foreach($data->modules as $module)
            echo render($module);
        ?>
    </div>
</body>
</html>