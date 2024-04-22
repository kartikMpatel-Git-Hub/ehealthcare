<?php

session_start();    
$_SESSION["user"] = "";
$_SESSION["usertype"] = "";
$_SESSION['ERROR'] = "";
include("connection.php");

if(isset($_POST['pat']))
{

    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['pass'];
    $cpassword = $_POST['re_pass'];
    $gender = $_POST['gender'];
    $phoneno = $_POST['phoneno'];
    $dob = $_POST['dob'];
    $add = $_POST['address'];

    $query = "select * from user where user_email = '$email'";
    $result= $database->query($query);	
    if($ans=$result->num_rows)
    {
        $_SESSION['Message'] = "Email Already Exist !";
    }
    else
    {
        $query = "select * from patient where patient_phoneno = '$phoneno'";
        $result= $database->query($query);	
        if($ans=$result->num_rows)
        {
            $_SESSION['Message'] = "Mobile No Already Exist !";
        }
        else
        {
            if($cpassword == $password)
            {
                $password = md5($password);
                echo $password;
                $query1 = "insert into patient(patient_email,patient_name,patient_password,patient_gender,patient_phoneno,patient_dob,patient_address,patient_img) values ('$email','$name','$password','$gender','$phoneno','$dob','$add','user.jpg');";
                $database->query($query1);
                $query2 = "insert into user(user_email,user_name,user_type) values('$email','$name','P');";
                $database->query($query2);
                $_SESSION['Message'] = 'Patient Create Successfully !!';
                header("location: ../login.php");
            }   
            else{
                $_SESSION['Message'] = 'Both Password Must Be Same';
            }
        }
    }
    header("location: ../registration.php?action=patient");
}
elseif(isset($_POST['doc']))
{
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['pass'];
    $cpassword = $_POST['re_pass'];
    $gender = $_POST['gender'];
    $phoneno = $_POST['phoneno'];
    $charge = $_POST['charge'];
    $spec = $_POST['spec'];
    $dob=$_POST['dob'];
    $exp=$_POST['exp'];
    $about=addslashes($_POST["about"]);
    $add = $_POST['address'];

    if($spec == "-Specialist-")
    {
        $_SESSION['Message'] = "Select Your Specialist !";
        echo "spec";
        header("location: ../registration.php?action=doctor");
    }
    else
    {

        $query = "select * from user,pending where user.user_email = '$email' or pending.doc_email = '$email' and pending.Status != 0";
        $result= $database->query($query);	
        if($ans=$result->num_rows)
        {
            $_SESSION['Message'] = "Email Already Exist !";
        }
        else
        {
            $query = "select * from doctor,pending where doctor.doc_phoneno = '$phoneno' or  pending.doc_phoneno = '$phoneno' and pending.Status != 0";
            $result= $database->query($query);	
            if($ans=$result->num_rows)
            {
                $_SESSION['Message'] = "Mobile No Already Exist !";
            }
            else
            {
                if($cpassword == $password)
                {
                    $password = md5($password);
                    $query1 = "insert into pending(doc_email,doc_name,doc_password,doc_gender,doc_phoneno,doc_charge,doc_address,spec_id,doc_dob,doc_experience,doc_about,doc_img,Status) values ('$email','$name','$password','$gender','$phoneno','$charge','$add',$spec,'$dob',$exp,'$about','user.jpg','1');";
                    $database->query($query1);
                    $_SESSION['Message'] = 'Doctor Details Add Successfully For Inquiry !!';
                    header("location: ../registration.php?action=doctor");
                }   
                else{
                echo "wrong";
                    $_SESSION['Message'] = 'Both Password Must Be Same';
                }
            }
        }
    }
}

?>