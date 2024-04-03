<?php

session_start();

if(isset($_SESSION["email"])){
    if(($_SESSION["email"])=="" or $_SESSION['usertype']!='D'){
        header("location: ../../index.php");
    }else{
        $useremail=$_SESSION["email"];
    }

}else{
    header("location: ../../index.php");
}


//import database
include("../../php/connection.php");

    if($_POST){
        //import database
        $title=$_POST["title"];
        $docid=$_POST["docid"];
        $nop=$_POST["nop"];
        $date=$_POST["date"];
        $time=$_POST["time"];
        $etime=$_POST["etime"];
        $sql="insert into schedule (docid,title,scheduledate,scheduletime,nop,endtime) values ($docid,'$title','$date','$time',$nop,'$etime');";
        $result= $database->query($sql);
        header("location: schedule.php?action=session-added&title=$title");
        
    }


?>