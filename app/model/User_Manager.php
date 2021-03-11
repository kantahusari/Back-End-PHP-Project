<?php
include 'dbh.php';
//this refers to php models
$current_view=$config['VIEW_PATH'].'User_Manager'.DS;
switch (get('action')){
    case 'Add':{//done
    $view=$current_view.'Add.phtml';
include 'dbh.php';

if (isset($_POST['signup'])) {
    if (!empty($_POST['fname'])&&!empty($_POST['lname'])&&!empty($_POST['email'])&&!empty($_POST['cell'])&&!empty($_POST['position'])) {
        if (!empty($_POST['susername'])) {
            if ($_POST['supassword']==$_POST['rsupassword']) {
                $fname=$_POST['fname'];
                $lname=$_POST['lname'];
                $email=$_POST['email'];
                $cell=$_POST['cell'];
                $position=$_POST['position'];
                $susername=$_POST['susername'];
                $supass= md5($_POST['supassword']);
                $status=$_POST['status'];
                $filename=$_FILES['image']['name'];
                if (file_exists($filename)) {
                    unlink("image/$filename");
                }
                $image_path='image/'.$filename;
                
                $fname=mysqli_real_escape_string($conn,$fname);
                $lname=mysqli_real_escape_string($conn,$lname);
                $email=mysqli_real_escape_string($conn,$email);
                $cell=mysqli_real_escape_string($conn,$cell);
                $position=mysqli_real_escape_string($conn,$position);
                $position=mysqli_real_escape_string($conn,$position);
                $susername=mysqli_real_escape_string($conn,$susername);
                $supass=mysqli_real_escape_string($conn,$supass);
                $status=mysqli_real_escape_string($conn,$status);
                $image_path=mysqli_real_escape_string($conn,$image_path);
                
                if (preg_match("!image!",$_FILES['image']['type'])){
                    if (copy($_FILES['image']['tmp_name'],$image_path)){
                    $sql3="INSERT INTO users (fname,lname,email,cellnumber,position,username,password,ustatus,image) VALUES('$fname','$lname','$email','$cell','$position','$susername','$supass','$status','$image_path')";
                    if (mysqli_query($conn, $sql3)){
        $_SESSION['message']="Registration Success !!";                                                
                    }else{
        $_SESSION['message']="User Could Not Be Added";                        
                    }
                    }else{
        $_SESSION['message']="File Upload Fail !";                             
                    }
                }else{
        $_SESSION['message']="wrong file format only JPG, PNG,OR GIF images !!";                    
                }
            }else{
        $_SESSION['message']="Passwords Doesn't Match";         
            }
        }else{
        $_SESSION['message']="User Name Can't Be Empty..";
        }
    } else {
        $_SESSION['message']='Please Fill Required Fields..'; 
    }
}
    break;        
    }
        case 'View':{//done
    $view=$current_view.'View.phtml';
    //$notes= file($file);
    break;        
    }
        case 'delete':{
    $view=$current_view.'delete.phtml';
    break;        
    }
        case 'update':{//done
        $view=$current_view.'Update.phtml';
        //$notes= file($file);
        $id=get('id');
        $sql3="SELECT * FROM users WHERE uid=$id";
        $fetch5=mysqli_query($conn,$sql3);
        $rowup=mysqli_fetch_array($fetch5);
    break;        
    }
        case 'doUpdate':{
$id=get('id');
if (    !empty(get('fname'))&&
        !empty(get('lname'))&&
        !empty(get('email'))&&
        !empty(get('cell'))&&
        !empty(get('position'))&&
        !empty(get('susername'))&&
        !empty(get('supassword'))&&
        !empty(get('rsupassword'))&&
        !empty(get('status'))) {
    if (get('supassword')==get('rsupassword')) {

        $fname=get('fname');
        $lname=get('lname');
        $email=get('email');
        $cell=get('cell');
        $position=get('position');
        $susername=get('susername');
        $supassword= md5(get('supassword'));
        $status=get('status');
        $newfilename=$_FILES['image']['name'];
        $image_path='image/'.$newfilename;

        $fname=mysqli_real_escape_string($conn,$fname);
        $lname=mysqli_real_escape_string($conn,$lname);
        $email=mysqli_real_escape_string($conn,$email);
        $cell=mysqli_real_escape_string($conn,$cell);
        $position=mysqli_real_escape_string($conn,$position);
        $susername=mysqli_real_escape_string($conn,$susername);
        $supassword=mysqli_real_escape_string($conn,$supassword);
        $status=mysqli_real_escape_string($conn,$status);
        $image_path=mysqli_real_escape_string($conn,$image_path);

        if (preg_match("!image!",$_FILES['image']['type'])) {
                if (!file_exists($newfilename)) {
                    if (copy($_FILES['image']['tmp_name'], $image_path)) {
                     $sqlupuser="UPDATE users 
                             SET 
                             fname='$fname',lname='$lname',email='$email',cellnumber='$cell',position='$position',username='$susername',password='$supassword',ustatus='$status',image='$image_path'
                               WHERE uid='$id'";
                     if (mysqli_query($conn, $sqlupuser)) {
                         $_SESSION['message']="Update Success !!"; 
                                // header('location:?page=User_Manager&action=View');
                         $view=$current_view.'View.phtml';
                     } else {
                         $_SESSION['message']="Update fail !!";
                     }
                    }
                }else{
                  unlink($image_path);
                    if (copy($_FILES['image']['tmp_name'], $image_path)) {
                     $sqlupuser="UPDATE users 
                             SET 
                             fname='$fname',lname='$lname',email='$email',cellnumber='$cell',position='$position',username='$susername',password='$supassword',ustatus='$status',image='$image_path'
                               WHERE uid='$id'";
                     if (mysqli_query($conn, $sqlupuser)) {
                         $_SESSION['message']="Update Success !!"; 
                                 //header('location:?page=User_Manager&action=View');
                         $view=$current_view.'View.phtml';
                     } else {
                         $_SESSION['message']="Update fail !!";
                     }
                    }
                }
        } else {
            $_SESSION['message']="wrong file format only JPG, PNG,OR GIF images !!";  
        }
    }else{
        $_SESSION['message']="Passwords Doesn't Match";        
    }
} else {
        $_SESSION['message']="All Fields Should Be Filled";
        }
        break;
    break;        
    }
}
?>
<?php
//echo "<a href='/folder_view/vs.php?s=" . __FILE__ . "' target='_blank' class='viewsource' style='color:#a3d0f0;'>view source</a>";
?>