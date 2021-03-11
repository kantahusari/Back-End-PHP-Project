<?php
session_start();
//include 'dbh.php';
//--- sign up form values
//$sql1="SELECT * FROM position";
//$fetch1= mysqli_query($conn, $sql1);
//$sql2="SELECT * FROM ustatus";
//$fetch2= mysqli_query($conn, $sql2);
//---- sign up Process
$_SESSION['message'] = '';
$_SESSION['message1'] = '';
if (isset($_POST['login'])) {
    if (empty($_POST['username']) && empty($_POST['password'])) {
        $_SESSION['message1'] = 'Fields Are Empty';
    }
}
if (isset($_POST['signup'])) {
    if (!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['email']) && !empty($_POST['cell']) && !empty($_POST['position'])) {
        if (!empty($_POST['susername'])) {
            if ($_POST['supassword'] == $_POST['rsupassword']) {
                $fname = $_POST['fname'];
                $lname = $_POST['lname'];
                $email = $_POST['email'];
                $cell = $_POST['cell'];
                $position = $_POST['position'];
                $susername = $_POST['susername'];
                $supass = md5($_POST['supassword']);
                $status = $_POST['status'];
                //$image_path='image/'.$_FILES['image']['name'];
                $filename = $_FILES['image']['name'];
                /*
                if (file_exists($filename)) {
                  unlink("image/$filename");
                }

                 */
                $image_path = 'image/' . $filename;

                $fname = mysqli_real_escape_string($conn, $fname);
                $lname = mysqli_real_escape_string($conn, $lname);
                $email = mysqli_real_escape_string($conn, $email);
                $cell = mysqli_real_escape_string($conn, $cell);
                $position = mysqli_real_escape_string($conn, $position);
                $position = mysqli_real_escape_string($conn, $position);
                $susername = mysqli_real_escape_string($conn, $susername);
                $supass = mysqli_real_escape_string($conn, $supass);
                $status = mysqli_real_escape_string($conn, $status);
                $image_path = mysqli_real_escape_string($conn, $image_path);

                if (preg_match("!image!", $_FILES['image']['type'])) {
                    if (copy($_FILES['image']['tmp_name'], $image_path)) {
                        $sql3 = "INSERT INTO users (fname,lname,email,cellnumber,position,username,password,ustatus,image) VALUES('$fname','$lname','$email','$cell','$position','$susername','$supass','$status','$image_path')";
                        if (mysqli_query($conn, $sql3)) {
                            $_SESSION['message'] = "Registration Success !!";
                        } else {
                            $_SESSION['message'] = "User Could Not Be Added";
                        }
                    } else {
                        $_SESSION['message'] = "File Upload Fail !";
                    }
                } else {
                    $_SESSION['message'] = "wrong file format only JPG, PNG,OR GIF images !!";
                }
            } else {
                $_SESSION['message'] = "Passwords Doesn't Match";
            }
        } else {
            $_SESSION['message'] = "User Name Can't Be Empty..";
        }
    } else {
        $_SESSION['message'] = 'Please Fill Required Fields..';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="layout.css">
    <title>PHP Assignment 3</title>
</head>

<body class="body">
    <div class="container">
        <!--LogIN-->
        <h2>Login</h2>
        <h5>please use kanta and 123 as user name and password or sign up</h5>
        <div>
            <h4><?php echo $_SESSION['message1']; ?></h4>
        </div>
        <form action="process.php" method="post"><br>
            Username: <input type="text" name="username"><br>
            Password: <input type="password" name="password"><br>
            <input type="submit" name="login" value="login"><br>
        </form>
        <!--SignUp done !!-->
        <h3>Or</h3>
        <h2>Sign Up</h2>
        <div>
            <h4><?php echo $_SESSION['message']; ?></h4>
        </div>
        <form action="index.php" method="post" enctype="multipart/form-data">
            First Name: *<input type="text" name="fname"><br>
            Last Name: *<input type="text" name="lname"><br>
            Email: *<input type="email" name="email"><br>
            Cell Phone: *<input type="text" name="cell"><br>
            Position: *<select name="position"><br>
                <option value="">Choose...</option>
                <?php
                while ($row1 = mysqli_fetch_array($fetch1)) {
                    echo '<option value="' . $row1['pid'] . '">' . $row1['pname'] . '</option>';
                }
                ?>
            </select><br>
            Username: <input type="text" name="susername"><br>
            Password: <input type="password" name="supassword"><br>
            Confirm Password: <input type="password" name="rsupassword"><br>
            Status: <select name="status">
                <option value="">Choose...</option>
                <?php
                while ($row2 = mysqli_fetch_array($fetch2)) {
                    echo '<option value="' . $row2['ustatid'] . '">' . $row2['ustatname'] . '</option>';
                }
                ?>
            </select><br>
            Upload Image: <input type="file" name="image"><br>
            <input type="submit" value="signup" name="signup"><br>
        </form>
    </div>
</body>

</html>
<?php
//echo "<a href='/folder_view/vs.php?s=" . __FILE__ . "' target='_blank' class='viewsource' style='color:#a3d0f0;'>view source</a>";
?>