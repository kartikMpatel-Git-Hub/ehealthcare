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
            elseif($utype == 'P') {
                $checker = $database->query("select * from patient where patient_email='$email' and patient_password='$password'");

                if ($checker->num_rows == 1) {
                    $_SESSION['email'] = $email;
                    $_SESSION['usertype'] = 'P';

                    header('location: User/Patient/index.php');

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
    <?php 
        require "ImportFile/Head.php";
    ?>
    
</head>
<body>
	<section class="news-single section">
        <div class="container">
            <a href="index.php" style="color:black; text-decoration:none;"><i class="icofont icofont-arrow-left" style="font-size:40px;"></i></a>
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="comments-form">
                                <br><br>
                                <div class="row">
                                    <div class="col-12  col-lg-4">
                                        <img src="img/Other/signin-image.jpg" alt="sing up image" style="border-radius: 10px;">
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="row">
                                                <div class="col-lg-5 col-4"></div>
                                                <div class="col-lg-4 col-2"><h1>Login</h1></div>
                                        </div>
                                        <br><br>
                                        <form method="POST" action="php/login.php">
                                            <div class="row">
                                                <div class="form-group col-lg-2">
                                                </div>
                                                <div class="form-group col-lg-10">
                                                    <p style="color:black; padding:10px; font-size:20px;">Email</p>
                                                    <input type="text" name="email" placeholder="Email" required>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="form-group col-lg-2">
                                                </div>
                                                <div class="form-group col-lg-10">
                                                    <p style="color:black; padding:10px; font-size:20px;">Password</p>
                                                    <input type="password" name="password" placeholder="Password" required>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="row">
                                                <div class="form-group col-lg-5 col-4">
                                                </div>
                                                    <center>
                                                        <button type="submit" class="btn primary" name="signin">Login</button>    
                                                        <a href="registration.php?action=patient" type="clear" class="btn primary" style="color:white;">Register</a>
                                                    </center>
                                            </div>
                                            <center>
                                            <br>
                                            <div style="color:red;">
                                                <?php
                                                echo "max appointment number fix it ";
                                                    echo $_SESSION['Message'];
                                                    $_SESSION['Message'] = "";
                                                ?>
                                            </div>
                                            </center>
                                        </form>
                                    </div>
                                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
    </body>
</html>