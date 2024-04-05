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
    
    if($_POST){

        date_default_timezone_set('Asia/Kolkata');

        include("../../php/connection.php");
        $title=addslashes($_POST["title"]);
        $docid=$_POST["docid"];
        $description=addslashes($_POST["desc"]);
        $img = $_FILES['img']['name'];
        $date=date('Y-m-d');
        
        $sql="insert into article (doc_id,article_title,article_date,article_description,article_img) values ($docid,'$title','$date','$description','$img');";
        $result= $database->query($sql);
        if(isset($_FILES['img']))
        {
            $file_name = $_FILES['img']['name'];
            $tmp_name = $_FILES['img']['tmp_name'];
            
            if(move_uploaded_file($tmp_name,"img/Article/".$file_name))
            {
                $_SESSION['ERROR'] = $_SESSION['ERROR']."With Image Upload !"; 
            }
            else
            {
                $_SESSION['ERROR'] = $_SESSION['ERROR']."With out Image Upload !"; 
            }
        }
        header("location: article.php");
    }
?>