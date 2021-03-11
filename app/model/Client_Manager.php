<?php
include 'dbh.php';

//this refers to php models
$current_view=$config['VIEW_PATH'].'Client_Manager'.DS;
//$file=$config['DATA_PATH'].'clients.txt';

switch (get('action')){
        case 'View':{//done
    $view=$current_view.'View.phtml';
    //$clients= file($file);
    break;        
    }
        case 'archive':{
    $view=$current_view.'archive.phtml';
    break;        
    }
    //-----------------------------------------------------------
        case 'update':{
        $view=$current_view.'update.phtml';
        $id=get('id');
        $sql2="SELECT * FROM client WHERE cid=$id";
        $fetch=mysqli_query($conn,$sql2);
        $row=mysqli_fetch_array($fetch);
        break;
    }
        case 'doUpdate':{
        $cid=get('id');
        $company=get('c_name');
        $bnumber=get('b_num');
        $fname=get('f_name');
        $lname=get('l_name');
        $phone=get('p_num');
        $cell=get('c_num');
        $website=get('w_site');
        $status=get('stat');
        $sql5="UPDATE client
               SET company='$company', bnumber='$bnumber', fname='$fname', lname='$lname', phone='$phone', cell='$cell', website='$website', status='$status' 
               WHERE cid=$cid";
        mysqli_query($conn,$sql5);
        //header('location:?page=Client_Manager&action=View');
            $view=$current_view.'View.phtml';
        break;
        }
    //-----------------------------------------------------------
        case 'Add':{//done
        $view=$current_view.'Add.phtml';
        include 'dbh.php';
            if (!empty($_POST["c_name"])&&!empty($_POST["b_num"])&&!empty($_POST["f_name"])&&!empty($_POST["l_name"])
            &&!empty($_POST["p_num"])&&!empty($_POST["p_num"])&&!empty($_POST["c_num"])) {
            $c_name=$_POST["c_name"];
            $b_num=$_POST["b_num"];
            $f_name=$_POST["f_name"];
            $l_name=$_POST["l_name"];
            $p_num=$_POST["p_num"];
            $c_num=$_POST["c_num"];
            $w_site=$_POST["w_site"];
            $stat=$_POST["stat"]; 
            
            $c_name=mysqli_real_escape_string($conn,$c_name);
            $b_num=mysqli_real_escape_string($conn,$b_num);
            $f_name=mysqli_real_escape_string($conn,$f_name);
            $l_name=mysqli_real_escape_string($conn,$l_name);
            $p_num=mysqli_real_escape_string($conn,$p_num);
            $c_num=mysqli_real_escape_string($conn,$c_num);
            $w_site=mysqli_real_escape_string($conn,$w_site);
            $stat=mysqli_real_escape_string($conn,$stat);
            
            $sql1="INSERT INTO client (company,bnumber,fname,lname,phone,cell,website,status) VALUES('$c_name','$b_num','$f_name','$l_name','$p_num','$c_num','$w_site','$stat')";
            mysqli_query($conn, $sql1);
                $view=$current_view.'View.phtml';
        }
            break;
        }
}
 ?>
<?php
//echo "<a href='/folder_view/vs.php?s=" . __FILE__ . "' target='_blank' class='viewsource' style='color:#a3d0f0;'>view source</a>";
?>