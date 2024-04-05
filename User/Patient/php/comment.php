<?php
    session_start();
    if(isset($_SESSION["email"])){
        if(($_SESSION["email"])=="" or $_SESSION['usertype']!='P'){
            header("location: ../../login.php");
        }
        else{
            $useremail=$_SESSION["email"];
        }
    }else{
        header("location: ../../login.php");
    }
    

    if($_GET){


        date_default_timezone_set('Asia/Kolkata');
        $date=date('Y-m-d');
        $time = date("H:i:s");
        include("connection.php");
        $id=$_GET["id"];
        $action=$_GET["action"];
        $query1 = "select * from patient where patient_email='$useremail'";
        $result1= $database->query($query1);
        $row=$result1->fetch_assoc();
        $Pid = $row['patient_id'];

        
        if($action == "add")
        {
            $query1 = "select * from patient where patient_email='$useremail'";
            $result1= $database->query($query1);
            $row=$result1->fetch_assoc();
            $Pid = $row['patient_id'];
            $description=addslashes($_POST["message"]);
            
            $sql="insert into comment (article_id,cmt_detail,patient_id,cmt_date,cmt_time) values ($id,'$description',$Pid,'$date','$time');";
            $result= $database->query($sql);

            header("location: ../singlearticle.php?action=view&id=$id");
            echo "Hello";
        }
        elseif($action == "delete")
        {
            $query1 = "select * from comment where cmt_id = $id and patient_id = $Pid;";
            $result1= $database->query($query1);
            $row=$result1->fetch_assoc();
            $aid = $row['article_id'];
            $sql="delete from comment where cmt_id = $id and patient_id = $Pid;";
            $result= $database->query($sql);
            echo "Hello2";
            header("location: ../singlearticle.php?action=view&id=$aid");
        }
    }
?>