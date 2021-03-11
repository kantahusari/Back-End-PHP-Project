<?php
header('REFRESH:3;URL=index.php');
session_start();
echo "Goodbye ".$_SESSION['username']." Come Again Soon!!";
session_unset();
session_destroy();

?>
<?php
//echo "<a href='/folder_view/vs.php?s=" . __FILE__ . "' target='_blank' class='viewsource' style='color:#a3d0f0;'>view source</a>";
?>