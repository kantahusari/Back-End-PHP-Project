<?php
include 'dbh.php';
//this refers to php models
$current_view=$config['VIEW_PATH'].'Notification_Manager'.DS;
$file=$config['DATA_PATH'].'notes.txt';
switch (get('action')){
    case 'Add':{//done
    $view=$current_view.'Add.phtml';
include 'dbh.php';
            if (!empty($_POST["type"])&&!empty($_POST["content"])&&!empty($_POST["stat"])) {
            $type=$_POST["type"];
            $content=$_POST["content"];
            $stat=$_POST["stat"];
            
            $type=mysqli_real_escape_string($conn,$type);
            $content=mysqli_real_escape_string($conn,$content);
            $stat=mysqli_real_escape_string($conn,$stat);
            $sql="INSERT INTO notification (typ,content,nstatus) VALUES('$type','$content','$stat')";
            mysqli_query($conn, $sql);
                $view=$current_view.'View.phtml';
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
    $view=$current_view.'update.phtml';
        //$notes= file($file);
        $id=get('id');
        $sql3="SELECT * FROM notification WHERE nid=$id";
        $fetch5=mysqli_query($conn,$sql3);
        $rowup=mysqli_fetch_array($fetch5);

    break;        
    }
        case 'doUpdate':{
        $nid=get('id');
        $type=get('type');
        $content=get('content');
        $stat=get('stat');

        $sqlupdate="UPDATE notification
       SET typ='$type', content='$content', nstatus='$stat' WHERE nid=$nid";
        mysqli_query($conn,$sqlupdate);
        //header('location:?page=Notification_Manager&action=View');
        $view=$current_view.'View.phtml';
        break;
    break;        
    }
}

 ?>
<?php
//echo "<a href='/folder_view/vs.php?s=" . __FILE__ . "' target='_blank' class='viewsource' style='color:#a3d0f0;'>view source</a>";
?>