<?php
function get($name,$def='')
{
    return isset($_REQUEST[$name])?$_REQUEST[$name]:$def;
}

$filename=$config['DATA_PATH'].'ids';
$notes=$config['DATA_PATH'].'nids';
$cnotes=$config['DATA_PATH'].'cnids';



//echo "<a href='/folder_view/vs.php?s=" . __FILE__ . "' target='_blank' class='viewsource' style='color:#a3d0f0;'>view source</a>";
?>