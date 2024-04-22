<?php
    session_start();
    if(isset($_SESSION["email"])){
        if(($_SESSION["email"])=="" or $_SESSION['usertype']!='P'){
            header("location: ../../../login.php");
        }
        else{
            $useremail=$_SESSION["email"];
        }
    }else{
        header("location: ../../../login.php");
    }

    include("../../../php/connection.php");
    if(isset($_POST['profile']))
    {
        $query= $database->query("select * from patient where patient_email='$useremail'");
        $ans= $query->fetch_assoc();
        $image=$ans["patient_img"];


        $email = $_POST['email'];
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $dob = $_POST['dob'];
        $phoneno = $_POST['phoneno'];
        $img = $_FILES['img']['name'];

        if($img == "")
        {
            $img = $image;
        }

        if($email == "" || $name == "" || $phoneno == "" || $address == "" || $gender == "" || $dob == "")
        {
            $_SESSION['ERROR'] = "Enter All Field First !!";
        }  
        else
        {
            $user = $database->query("select  * from  user where user_email = '$email' and user_email != '$useremail';");
            if($user->num_rows)
            {
                $_SESSION['ERROR'] = "Email Already Exist !"; 
            }
            else
            {
                $user = $database->query("select  * from  patient where patient_phoneno = '$phoneno' and patient_email != '$useremail';");
                if($user->num_rows)
                {
                    $_SESSION['ERROR'] = "Phone No Already Exist !"; 
                }
                else
                {
                    $user = $database->query("select  * from  patient where patient_img = '$img'  and patient_email != '$useremail' and patient_img != 'user.jpg';");
                    if($user->num_rows)
                    {
                        $_SESSION['ERROR'] = "Wrong Image !"; 
                    }
                    else
                    {
                        if(isset($_FILES['img']))
                        {


                            $type=$_FILES['img']['type'];     
                            $extensions=array( 'image/jpeg', 'image/png');
                            if( in_array( $type, $extensions ))
                            {
                                $file_name = $_FILES['img']['name'];
                                $tmp_name = $_FILES['img']['tmp_name'];
                                if(move_uploaded_file($tmp_name,"../../../img/Patient/".$file_name))
                                {
                                    $query = "update patient set patient_email = '$email',patient_name = '$name', patient_phoneno = '$phoneno' , patient_address = '$address' , patient_gender = '$gender' , patient_dob = '$dob' , patient_img = '$img' where patient_email = '$useremail';";
                                    $database->query($query);

                                    $query = "update user set user_email = '$email' , user_name = '$name' where user_email = '$useremail';";
                                    $database->query($query);

                                    $_SESSION['email'] = $email;
                                    $_SESSION['phoneno'] = $phoneno;
                                    $_SESSION['name'] = $name;
                                    $useremail = $email;
                                    $_SESSION['ERROR'] = "Profile Updated Sucessfully !"; 
                                    $_SESSION['ERROR'] = $_SESSION['ERROR']."With Image Upload !"; 
                                }
                                else
                                {
                                    $_SESSION['ERROR'] = $_SESSION['ERROR']."With out Image Upload !"; 
                                }

                            }
                            else
                            {
                                $query = "update patient set patient_email = '$email',patient_name = '$name', patient_phoneno = '$phoneno' , patient_address = '$address' , patient_gender = '$gender' , patient_dob = '$dob' where patient_email = '$useremail';";
                                $database->query($query);

                                $query = "update user set user_email = '$email' , user_name = '$name' where user_email = '$useremail';";
                                $database->query($query);

                                $_SESSION['email'] = $email;
                                $_SESSION['phoneno'] = $phoneno;
                                $_SESSION['name'] = $name;
                                $useremail = $email;
                                $_SESSION['ERROR'] = "Profile Updated Sucessfully !"; 
                            }
                        }
                    }
                }
            }
        }
        header('location: ../profile.php');
    }

    if(isset($_POST['password']))
    {
        $_SESSION['ERROR'] = "";
        $result = $database->query("select * from patient where patient_email = '$useremail';");
        $row=$result->fetch_assoc();
        $password = $row['patient_password'];
        $oldpassword = $_POST['old'];
        $oldpassword = md5($oldpassword);
        echo $oldpassword;
        $newpassword = $_POST['new'];
        $renewpassword = $_POST['renew'];
        if($oldpassword == "" || $password == "" || $newpassword == "" || $renewpassword =="")
        {
            $_SESSION['ERROR'] = "Enter All Field First !!";
            echo "all";
        }  
        else
        {
            if($oldpassword != $password)
            {
                $_SESSION['ERROR'] = "Old Password Is Wrong";
                echo "old";
            }
            else
            {
                
                $_SESSION['ERROR'] = "Old Password Is Right !!";
                if($oldpassword == $newpassword)
                {
                    $_SESSION['ERROR'] = "Old Password and New Password Must Be Different !!";
                }
                else
                {
                    if($newpassword != $renewpassword)
                    {
                        $_SESSION['ERROR'] = "New Password And Re - Enter Password Is Incorrect !!";
                    }
                    else
                    {
                        $newpassword = md5($newpassword);
                        $query = "update patient set patient_password = '$newpassword' where patient_email = '$useremail';";
                        $database->query($query);
                        $_SESSION['ERROR'] = "Password Changed Sucessfully !!";
                    }
                }
            }
        }
        header('location: ../password.php');
    }



?>