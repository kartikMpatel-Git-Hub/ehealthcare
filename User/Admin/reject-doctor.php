<?php

    session_start();

    if(isset($_SESSION["email"])){
        if(($_SESSION["email"])=="" or $_SESSION['usertype']!='A'){
            header("location: ../../php/login.php");
        }
    }else{
        header("location: ../../php/login.php");
    }
    if($_GET){
        include("../../php/connection.php");
        $id=$_GET["id"];

        $result= $database->query("select * from pending where pen_doc_id=$id;");

        $email=($result->fetch_assoc())["doc_email"];

        $sql= $database->query("update pending set status = 0 where pen_doc_id=$id;");

        header("location: pending_request.php");
    }


?>