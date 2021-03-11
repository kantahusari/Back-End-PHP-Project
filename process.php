<?php
session_start();
header('REFRESH:5;URL=start.php');
//$_SESSION['message1']='';
if ($_SERVER['REQUEST_METHOD'] == "POST") :
    if (isset($_POST['login'])) {
        if (empty($_POST['username']) && empty($_POST['password'])) {
            //$_SESSION['message1']='Fields Are Empty';
            header('REFRESH:0;URL=index.php');
        } else {
            include_once 'dbh.php';
            $username = strip_tags($_POST['username']);
            $password = md5(strip_tags($_POST['password']));

            $username = stripslashes($username);
            $password = stripslashes($password);

            //$username= mysqli_real_escape_string($conn,$username);
            //$password= mysqli_real_escape_string($conn,$password);

            /*$sql="SELECT * FROM users WHERE username='$username' AND password='$password'";
            //$query= mysqli_query($conn, $sql);
            if (mysqli_num_rows($query) == 1) {
                $row = mysqli_fetch_assoc($query);
                $_SESSION['username'] = $row['username'];
                $_SESSION['image'] = $row['image'];
                echo "Hello " . $_SESSION['username'] . " You will be directed to the website ";
            } else {
                $_SESSION['message1'] = 'Invalid Credentials';
                //echo 'Fields are Empty or Invalid Credentials'; 
                header('REFRESH:0;URL=index.php');
            }
            */
        }
    }
?>
<?php else : ?>
    <h2>You Are Not Permitted to Access This Area</h2>
    <a href='index.php'>Back</a><br>
<?php

endif;
?>
<?php
//echo "<a href='/folder_view/vs.php?s=" . __FILE__ . "' target='_blank' class='viewsource' style='color:#a3d0f0;'>view source</a>";
?>