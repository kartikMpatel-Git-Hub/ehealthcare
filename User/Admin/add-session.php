<?php
    session_start();
    if(isset($_SESSION["email"])){
        if(($_SESSION["email"])=="" or $_SESSION['usertype']!='A'){
            header("location: ../../login.php");
        }
        else{
            $useremail=$_SESSION["email"];
        }
    }else{
        header("location: ../../login.php");
    }
    
    if($_POST){
        include("../../php/connection.php");
        $title=$_POST["title"];
        $docid=$_POST["docid"];
        $nop=$_POST["nop"];
        $date=$_POST["date"];
        $stime=$_POST["time"];
        $etime=$_POST["etime"];
        
        $sql="insert into schedule (doc_id,sche_title,sche_date,sche_start,sche_end,sche_noappo) values ($docid,'$title','$date','$stime','$etime',$nop);";
        $result= $database->query($sql);
        header("location: schedule.php?action=session-added&title=$title");
    }
?>