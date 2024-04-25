<?php
session_start();    
$_SESSION["user"] = "";
$_SESSION["usertype"] = "";
$_SESSION['ERROR'] = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        require "Import/Head.php";
    ?>
    <script>        
           function phoneno(){          
            $('#phone').keypress(function(e) {
                var a = [];
                var k = e.which;

                for (i = 48; i < 58; i++)
                    a.push(i);

                if (!(a.indexOf(k)>=0))
                    e.preventDefault();
            });
        }
       </script>
</head>
<body>

        <?php
			require "php/connection.php";
		?>
		<section class="news-single section">
            <div class="container">
                <a href="login.php" style="color:black; text-decoration:none;"><i class="icofont icofont-arrow-left" style="font-size:40px;"></i></a>
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="comments-form">
                                    <div class="row">
                                            <a href="registration.php?action=patient" class="col-6 p-0" style="border-bottom:1px solid gray;border-top:1px solid gray; border-right:1px solid gray; border-radius:0;"><center class="register">Patient</center></a>
                                            <a href="registration.php?action=doctor" class="col-6 p-0" style="border-bottom:1px solid gray; border-top:1px solid gray; border-radius:0;"><center class="register">Doctor</center></a>
                                    </div>
                                    <br>
                                    <br>
                                    <?php
                                        $action = $_GET['action'];
                                        if($action == "doctor")
                                        {
                                    ?>
                                     <div class="row">
                                        <div class="col-12 col-lg-4 pt-5 mt-5">
                                            <img src="img/Other/signupdoc-image.jpg" alt="sing up image" style="border-radius: 10px;">
                                        </div>
                                        <div class="col-lg-8 col-12">
                                            <div class="row">
                                                    <div class="col-lg-3 col-2"></div>
                                                    <div class="col-lg-9 col-10"><h1>Doctor Registration</h1></div>
                                            </div>
                                            <br><br>
                                            <form method="POST" action="php/register.php">
                                                <div class="row">
                                                    <div class="form-group col-lg-2">
                                                    </div>
                                                    <div class="form-group col-lg-10">
                                                        <p style="color:black; padding:10px; font-size:15px;">Email</p>
                                                        <input type="email" name="email" placeholder="Email" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-lg-2">
                                                    </div>
                                                    <div class="form-group col-lg-10">
                                                            <p style="color:black; padding:10px; font-size:15px;">Name</p>
                                                        <input type="name" name="name" placeholder="Name" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-lg-2">
                                                    </div>
                                                    <div class="form-group col-lg-5">
                                                            <p style="color:black; padding:10px; font-size:15px;">Password</p>
                                                        <input type="password" name="pass" placeholder="Password" required>
                                                    </div>
                                                    <div class="form-group col-lg-5">
                                                        <p style="color:black; padding:10px; font-size:15px;">Re-Enter Password</p>
                                                        <input type="password" name="re_pass" placeholder="Password" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-lg-2">
                                                    </div>
                                                    <div class="form-group col-lg-5">
                                                        <p style="color:black; padding:10px; font-size:15px;">Phone No</p>
                                                        <input type="text" name="phoneno" id="phone" placeholder="Phone No" onkeypress="return event.charCode>=48 && event.charCode<=57" maxlength="10" required>
                                                    </div>
                                                    <div class="form-group col-lg-5">
                                                        <p style="color:black; padding:10px; font-size:15px;">Charge</p>
                                                        <input type="text" name="charge" placeholder="charge" onkeypress="return event.charCode>=48 && event.charCode<=57" maxlength="5"  required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-lg-2">
                                                    </div>
                                                    <div class="form-group col-lg-5">
                                                        <p style="color:black; padding:10px; font-size:15px;">Gender</p>
                                                        <select name="gender" style="border-radius: 5px;width: 100%;height: 51px;border:1px solid #eee">
                                                            <option value="Male"  style="text-align:center;">Male</option>
                                                            <option value="Female"   style="text-align:center;">Female</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-lg-5">
                                                        <p style="color:black; padding:10px; font-size:15px;">Specialist</p>
                                                        <select name="spec" style="border-radius: 5px;width: 100%;height: 51px;border:1px solid #eee">
                                                        <option style="text-align:center;">-Specialist-</option>
                                                        <?php
                                                                $list = $database->query("select  * from  specialist;");
                                                                for ($y=0;$y<$list->num_rows;$y++)
                                                                {
                                                                    $row=$list->fetch_assoc();
                                                                    $sn=$row["spec_type"];
                                                                    $id=$row["spec_id"];?>
                                                                    <option value="<?php echo $id; ?>" style="text-align:center;" ><?php echo $sn; ?></option><br/>
                                                        <?php
                                                                }
                                                        ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-lg-2">
                                                    </div>
                                                    <div class="form-group col-lg-5">
                                                        <p style="color:black; padding:10px; font-size:15px;">Date Of Birth </p>
                                                        <input type="date" name="dob" placeholder="Date Of Birth" required>
                                                    </div>
                                                    <div class="form-group col-lg-5">
                                                        <p style="color:black; padding:10px; font-size:15px;">Experience </p>
                                                        <input type="text" name="exp" placeholder="Experience" onkeypress="return event.charCode>=48 && event.charCode<=57" maxlength="2" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-lg-2">
                                                    </div>
                                                    <div class="form-group col-lg-10">
                                                        <p style="color:black; padding:10px; font-size:15px;">About </p>
                                                        <input type="text" name="about" placeholder="About You" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-lg-2">
                                                    </div>
                                                    <div class="form-group col-lg-10">
                                                        <p style="color:black; padding:10px; font-size:15px;">Address</p>
                                                        <input type="text" name="address" placeholder="Address" required>
                                                    </div>
                                                </div>

                                                
                                                <br><br>
                                                <div class="row">
                                                    <div class="form-group col-lg-3 col-2">
                                                    </div>
                                                        <center>
                                                            <button type="submit" class="btn primary" name="doc" style="color:white; padding:13px 50px;">Register</button>    
                                                            <a href="registration.php?action=doctor" class="btn primary" style="color:white; padding:13px 50px;">Reset</a>
                                                        </center>
                                                </div>
                                                <center>
                                                <br>
                                                <div style="color:red;">
                                                    <?php
                                                        echo $_SESSION['Message'];
                                                        $_SESSION['Message'] = "";
                                                    ?>
                                                </div>
                                                </center>
                                            </form>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                        elseif($action == "patient")
                                        {
                                    ?>
                                    <div class="row">
                                        <div class="col-12 col-lg-4 pt-5 mt-5">
                                            <img src="img/Other/signuppat-image.jpg" alt="sing up image" style="border-radius: 10px;">
                                        </div>
                                        <div class="col-lg-8 col-12">
                                            <div class="row">
                                                    <div class="col-lg-3 col-2"></div>
                                                    <div class="col-lg-9 col-10"><h1>Patient Registration</h1></div>
                                            </div>
                                            <br><br>
                                            <form method="POST" action="php/register.php">
                                                <div class="row">
                                                    <div class="form-group col-lg-2">
                                                    </div>
                                                    <div class="form-group col-lg-10">
                                                        <p style="color:black; padding:10px; font-size:15px;">Email</p>
                                                        <input type="text" name="email" placeholder="Email" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-lg-2">
                                                    </div>
                                                    <div class="form-group col-lg-5">
                                                            <p style="color:black; padding:10px; font-size:15px;">Password</p>
                                                        <input type="password" name="pass" placeholder="Password" required>
                                                    </div>
                                                    <div class="form-group col-lg-5">
                                                        <p style="color:black; padding:10px; font-size:15px;">Re-Enter Password</p>
                                                        <input type="password" name="re_pass" placeholder="Password" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-lg-2">
                                                    </div>
                                                    <div class="form-group col-lg-5">
                                                        <p style="color:black; padding:10px; font-size:15px;">Name</p>
                                                        <input type="text" name="name" placeholder="Name" required>
                                                    </div>
                                                    <div class="form-group col-lg-5">
                                                        <p style="color:black; padding:10px; font-size:15px;">Phone NO</p>
                                                        <input type="text" name="phoneno" placeholder="Phone No" onkeypress="return event.charCode>=48 && event.charCode<=57" maxlength="10" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-lg-2">
                                                    </div>
                                                    <div class="form-group col-lg-5">
                                                        <p style="color:black; padding:10px; font-size:15px;">Gender</p>
                                                        <select name="gender" style="border-radius: 5px;width: 100%;height: 51px;border:1px solid #eee">
                                                            <option value="Male"  style="text-align:center;">Male</option>
                                                            <option value="Female"   style="text-align:center;">Female</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-lg-5">
                                                        <p style="color:black; padding:10px; font-size:15px;">Date Of Birth </p>
                                                        <input type="date" name="dob" placeholder="Date Of Birth" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-lg-2">
                                                    </div>
                                                    <div class="form-group col-lg-10">
                                                        <p style="color:black; padding:10px; font-size:15px;">Address</p>
                                                        <input type="text" name="address" placeholder="Address" required>
                                                    </div>
                                                </div>

                                                
                                                <br><br>
                                                <div class="row">
                                                    <div class="form-group col-lg-3 col-2">
                                                    </div>
                                                        <center>
                                                            <button type="submit" class="btn primary" name="pat" style="color:white; padding:13px 50px;">Register</button>    
                                                            <a href="registration.php?action=patient" class="btn primary" style="color:white; padding:13px 50px;">Reset</a>
                                                        </center>
                                                </div>
                                                <center>
                                                <br>
                                                <div style="color:red;">
                                                    <?php
                                                        echo $_SESSION['Message'];
                                                        $_SESSION['Message'] = "";
                                                    ?>
                                                </div>
                                                </center>
                                            </form>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php  
		//	require "Import/Javascript.php";
		?>
    </body>
</html>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>