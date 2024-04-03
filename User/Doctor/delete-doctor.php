<?php

    session_start();

    if(isset($_SESSION["email"])){
        if(($_SESSION["email"])=="" or $_SESSION['usertype']!='D'){
            header("location: ../../php/login.php");
        }

    }else{
        header("location: ../../php/login.php");
    }
    
    
    if($_GET){
        //import database
        include("../../php/connection.php");
        $id=$_GET["id"];
        $result001= $database->query("select * from doctor where doc_id=$id;");
        $email=($result001->fetch_assoc())["doc_email"];
        $sql= $database->query("delete from user where user_email='$email';");
        $sql= $database->query("delete from doctor where doc_email='$email';");
        //print_r($email);
        header("location: doctors.php");
    }


?>