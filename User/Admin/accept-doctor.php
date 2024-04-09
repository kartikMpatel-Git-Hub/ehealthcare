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

        $query= "select * from pending where pen_doc_id=$id;";
        $result= $database->query($query);
        $row=$result->fetch_assoc();

        $email=$row['doc_email'];
        $name=$row["doc_name"];
        $address=$row["doc_address"];
        $password=$row["doc_password"];
        $gender=$row["doc_gender"];
        $phoneno=$row["doc_phoneno"];
        $spec=$row["spec_id"];
        $img=$row["doc_img"];
        $charge=$row["doc_charge"];

        echo $email;

        $sql1= "update pending set status = 2 where pen_doc_id= $id ;";
        $database->query($sql1);
        $sql2= "insert into user (user_email,user_name,user_type) values('$email','$name','D')";
        $database->query($sql2);
        $sql3= "insert into doctor (doc_email,doc_name,doc_password,doc_address,doc_gender,doc_phoneno,spec_id,doc_charge,doc_img) values ('$email','$name','$password','$address','$gender','$phoneno',$spec,$charge,'$img');";
        $database->query($sql3);

        $query= "select * from doctor where doc_email='$email';";
        $result= $database->query($query);
        $row=$result->fetch_assoc();
        $docid=$row['doc_id'];

        $sql4= "insert into rating (doc_id) values ($docid);";
        $database->query($sql4);
        header("location: pending_request.php");
    }


?>