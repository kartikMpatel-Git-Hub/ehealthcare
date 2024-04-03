<?php
    session_start();
    if(isset($_SESSION["email"])){
        if(($_SESSION["email"])=="" or $_SESSION['usertype']!='D'){
            header("location: ../../login.php");
        }
        else{
            $useremail=$_SESSION["email"];
        }
    }else{
        header("location: ../../login.php");
    }
    if($_GET){
        include("../../php/connection.php");
        $id=$_GET["id"];
        $sql= $database->query("delete from appointment where appo_id='$id';");
        header("location: appointment.php");
    }
?>