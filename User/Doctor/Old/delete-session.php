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

    
    if($_GET){
        //import database
        
        $id=$_GET["id"];
        //$result001= $database->query("select * from schedule where scheduleid=$id;");
        //$email=($result001->fetch_assoc())["docemail"];
        $sql= $database->query("delete from schedule where scheduleid='$id';");
        //$sql= $database->query("delete from doctor where docemail='$email';");
        //print_r($email);
        header("location: schedule.php");
    }


?>