<?php
            include 'dbh.php';
//this refers to php models
$current_view=$config['VIEW_PATH'].'C_N_Manager'.DS;


switch (get('action')){
    case 'Add':{
    $view=$current_view.'Add.phtml';
            include 'dbh.php';
            if (!empty($_POST["client"])&&!empty($_POST["note"])&&!empty($_POST["date"])&&!empty($_POST["time"])&&!empty($_POST["rep"])) {
            $client=$_POST["client"]; 
            $note=$_POST["note"];
            $date=$_POST["date"];
            $time=$_POST["time"];
            $rep=$_POST["rep"];

            $client=mysqli_real_escape_string($conn,$client);
            $note=mysqli_real_escape_string($conn,$note);
            $date=mysqli_real_escape_string($conn,$date);
            $time=mysqli_real_escape_string($conn,$time);
            $rep=mysqli_real_escape_string($conn,$rep);
            
            $sql1="INSERT INTO clientnoti (cid,nid,date,time,frequency) VALUES('$client','$note','$date','$time','$rep')";
            mysqli_query($conn, $sql1);
            $view=$current_view.'View.phtml';
            }
    break;        
    }
        case 'View':{
    $view=$current_view.'View.phtml';
    
    break;        
    }
        case 'delete':{
    $view=$current_view.'delete.phtml';
    break;        
    }
        case 'update':{
    $view=$current_view.'update.phtml';
            $id=get('id');
            $sql2="SELECT * FROM clientnoti WHERE cnid=$id";
            $fetch2=mysqli_query($conn,$sql2);
            $rowup=mysqli_fetch_array($fetch2);
    break;        
    }
        case 'doUpdate':{
        $cnid=get('id');
        $cid=get('client');
        $nid=get('note');
        $date=get('date');
        $time=get('time');
        $frequency=get('rep');
        $sqlupdate="UPDATE clientnoti SET cid='$cid',nid='$nid',date='$date',time='$time',frequency='$frequency' WHERE cnid=$cnid";
        mysqli_query($conn,$sqlupdate);
        //header('location:?page=C_N_Manager&action=View');
        $view=$current_view.'View.phtml';
        break;
        
    break;        
    }
}

?>
<?php
//echo "<a href='/folder_view/vs.php?s=" . __FILE__ . "' target='_blank' class='viewsource' style='color:#a3d0f0;'>view source</a>";
?>