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
    
    if($_POST){

        date_default_timezone_set('Asia/Kolkata');

        include("../../php/connection.php");

        $query1 = "select * from patient where patient_email='$useremail'";
		$result1= $database->query($query1);
        $row=$result1->fetch_assoc();
        $Pid = $row['patient_id'];
        $id=$_GET["id"];
        $description=$_POST["message"];
        $date=date('Y-m-d');
        $time = date("H:i:s");
        
        $sql="insert into comment (article_id,cmt_detail,patient_id,cmt_date,cmt_time) values ($id,'$description',$Pid,'$date','$time');";
        $result= $database->query($sql);
        header("location: singlearticle.php?action=view&id=$id");
    }
?>