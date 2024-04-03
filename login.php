<?php
    session_start();

    $_SESSION["user"] = "";
    $_SESSION["usertype"] = "";
    $_SESSION['Message'] = "";
    $_SESSION['ERROR'] = "";
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d');
    $_SESSION["date"] = $date;
    include("php/connection.php");
    if(isset($_POST['signin'])) 
    {
        $email = $_POST["email"];
        $password = $_POST['password'];
        
        $error = '<label for="promter" class="form-label"></label>';

        $result = $database->query("select * from user where user_email='$email'");
        if($result->num_rows == 1) {
            $utype = $result->fetch_assoc()['user_type'];

            if ($utype == 'A') {
                $checker = $database->query("select * from admin where admin_email='$email' and admin_password='$password'");

                if ($checker->num_rows == 1) {
                    $_SESSION['email'] = $email;
                    $_SESSION['usertype'] = 'A';

                    header('location: User/Admin/index.php');

                } else {
                    // echo "wrong";
                    $_SESSION['Message'] = "Wrong Email Or Password !!";
                }
            } 
            elseif($utype == 'D') {
                $checker = $database->query("select * from doctor where doc_email='$email' and doc_password='$password'");

                if ($checker->num_rows == 1) {
                    $_SESSION['email'] = $email;
                    $_SESSION['usertype'] = 'D';

                    header('location: User/Doctor/index.php');

                } else {
                    // echo "wrong";
                    $_SESSION['Message'] = "Wrong Email Or Password !!";
                }
            } 
        }
        else {
            $_SESSION['Message'] = "Enter Email And Password First  !!";
        }
    }
    
            
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

	<link rel="stylesheet" href="css/icofont.css">
    
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="main">

        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="img/signin-image.jpg" alt="sing up image" style="border-radius: 10px;"></figure>
                        <div class="create">
                            <a>Create Account As </a><br>
                            <a href="#"  id="login"><i class="icofont icofont-user"></i>  Doctor</a><br>
                            <a href="#" id="login"><i class="icofont icofont-user"></i>  Patient</a>
                        </div>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title" style="text-align: center;">Log in</h2>
                        <form method="POST">
                            <div class="form-group">
                                <label for="your_name"><i class="icofont icofont-envelope"></i></label>
                                <input type="text" name="email" id="your_name" placeholder="Enter Email"/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="icofont icofont-lock"></i></label>
                                <input type="password" name="password" id="your_pass" placeholder="Password"/>
                            </div>
                            <div>
                                <?php 
                                    echo $_SESSION['Message'];
                                    $_SESSION['Message'] = "";
                                ?>
                            </dvi>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>