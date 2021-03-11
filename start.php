<?php
session_start();
defined('APPLICATION_PATH')||
define('APPLICATION_PATH', realpath(dirname(__FILE__).'/app'));

const DS= DIRECTORY_SEPARATOR;
require APPLICATION_PATH.DS.'config'.DS.'config.php';

if (isset($_SESSION['username'])):   
$page= get('page','home');
$model=$config['MODEL_PATH'].$page.'.php';
$view=$config['VIEW_PATH'].$page.'.phtml';
$_404=$config['VIEW_PATH'].'404.phtml';

    if (file_exists($model)) {
        require $model;
    }
    $main_content=$_404;
    if (file_exists($view)) {
        //require $view;
        $main_content=$view;
    }
// echo "<a href='/folder_view/vs.php?s=" . __FILE__ . "' target='_blank'>View Source</a>";
    include $config['VIEW_PATH'].'layout.phtml';
    ?>

<?php else:
echo "<h2>You Are Not Permitted to Access This Area Directly</h2>";?>
<a href='index.php'>Back</a><br>
    <?php 
//header('REFRESH:3;URL=index.php');
endif; 
?>

<?php
//echo "<a href='/folder_view/vs.php?s=" . __FILE__ . "' target='_blank' class='viewsource' style='color:#a3d0f0;'>view source</a>";
?>

