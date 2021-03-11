<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    echo "no connection";
}
?>
<?php
//echo "<a href='/folder_view/vs.php?s=" . __FILE__ . "' target='_blank' class='viewsource' style='color:#a3d0f0;'>view source</a>";
?>