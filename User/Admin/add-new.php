<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/css/animations.css">  
    <link rel="stylesheet" href="../../css/css/main.css">  
    <link rel="stylesheet" href="../../css/css/admin.css">
        
    <title>Doctor</title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
</style>
</head>
<body>
    <?php

    //learn from w3schools.com

    session_start();

    if(isset($_SESSION["email"])){
        if(($_SESSION["email"])=="" or $_SESSION['usertype']!='A'){
            header("location: ../../login.php");
        }

    }else{
        header("location: ../../login.php");
    }
    
    

    //import database
    include("../../php/connection.php");



    if($_POST){
        //print_r($_POST);
        // $result= $database->query("select * from webuser");
        $name=$_POST['name'];
        $spec=$_POST['spec'];
        $email=$_POST['email'];
        $chr=$_POST['charge'];
        $gen=$_POST['gender'];
        $tele=$_POST['Tele'];
        $address=$_POST['address'];
        $dob=$_POST['dob'];
        $exp=$_POST['exp'];
        $about=$_POST['about'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];
        
        if ($password==$cpassword){
            $result= $database->query("select * from user where user_email='$email';");
            if($result->num_rows==1){
                $error='1';
            }else{
                $result= $database->query("select * from doctor where doc_phoneno='$tele';");
                if($result->num_rows==1){
                    $error='3';
                }else{
                    $password = md5($password);
                    $sql1="insert into pending(doc_email,doc_name,doc_password,doc_address,doc_gender,doc_phoneno,spec_id,doc_charge,doc_img,doc_dob,doc_experience,doc_about,Status) values('$email','$name','$password','$address','$gen','$tele',$spec,$chr,'user.jpg','$dob',$exp,'$about',1);";
                    $sql2="insert into user (user_email,user_name,user_type) values('$email','$name','D')";
                    $database->query($sql1);
                    $database->query($sql2);

                    //echo $sql1;
                    //echo $sql2;
                    $error= '4';
                }
            }
            
        }else{
            $error='2';
        }
    
    
        
        
    }else{
        //header('location: signup.php');
        $error='5';
    }
    

    header("location: doctors.php?action=add&error=".$error);
    ?>
    
   

</body>
</html>