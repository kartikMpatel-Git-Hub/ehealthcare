<?php
    session_start();

    $_SESSION["user"] = "";
    $_SESSION["usertype"] = "";
    $_SESSION['ERROR'] = "";
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d');
    $_SESSION["date"] = $date;
    include("connection.php");
    if(isset($_POST['signin'])) 
    {
        $email = $_POST["email"];
        $password = $_POST['password'];

        $password = md5($password);

        $error = '<label for="promter" class="form-label"></label>';

        $result = $database->query("select * from user where user_email='$email'");
        echo $result->num_rows ;
        if($result->num_rows == 1) 
        {
            $utype = $result->fetch_assoc()['user_type'];

            if ($utype == 'A') {
                $checker = $database->query("select * from admin where admin_email='$email' and admin_password='$password'");

                if ($checker->num_rows == 1) {
                    $_SESSION['email'] = $email;
                    $_SESSION['usertype'] = 'A';

                    header('location: ../User/Admin/index.php');

                } else {
                    // echo "wrong";
                    $_SESSION['Message'] = "Wrong Password !!";
                    header('location: ../login.php');       
                }
            } 
            elseif($utype == 'D') {
                $checker = $database->query("select * from doctor where doc_email='$email' and doc_password='$password'");

                if ($checker->num_rows == 1) {
                    $_SESSION['email'] = $email;
                    $_SESSION['usertype'] = 'D';

                    header('location: ../User/Doctor/index.php');

                } else {
                    // echo "wrong";
                    $_SESSION['Message'] = "Wrong Password !!";
                    header('location: ../login.php');       
                }
            } 
            elseif($utype == 'P') {
                $checker = $database->query("select * from patient where patient_email='$email' and patient_password='$password'");

                if ($checker->num_rows == 1) {
                    $_SESSION['email'] = $email;
                    $_SESSION['usertype'] = 'P';

                    header('location: ../User/Patient/index.php');

                } else {
                    // echo "wrong";
                    $_SESSION['Message'] = "Wrong Password !!";
                    header('location: ../login.php');       
                }
            } 
        }
        else 
        {
            $query= $database->query("select * from pending where doc_email='$email' and doc_password = '$password'");
            $row= $query->fetch_assoc();
            $status=$row["Status"];
            echo $status;
            if($status == 1) 
            {
                $_SESSION['Message'] = "Your Details Are Under Inquiry !!";
                header('location: ../login.php');     
            }
            elseif($status == 0)
            {
                $_SESSION['Message'] = "Register For Login !!";
                header('location: ../login.php');  
            }      
        }
    }
    else
    {
        $_SESSION['Message'] = "Email Not Found !!";
        header('location: ../login.php');       
    }

    echo $_SESSION['Message'];
?>