<?php

$dbserver="localhost";
$dbusername="f9217294";
$dbpassword="KaHu12345";
$dbname="f9217294_application";

/*
$dbserver="localhost";
$dbusername="root";
$dbpassword="";
$dbname="application";
*/
//$conn= mysqli_connect($dbserver,$dbusername,$dbpassword,$dbname);
if (mysqli_connect_errno()>0) {
    echo "Database Connection Error";
}
?>
<?php
//echo "<a href='/folder_view/vs.php?s=" . __FILE__ . "' target='_blank' class='viewsource' style='color:#a3d0f0;'>view source</a>";
?>