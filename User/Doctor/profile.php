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
include("../../php/connection.php");

$query= "select * from doctor where doc_email = '$useremail';";
$result= $database->query($query);
$row=$result->fetch_assoc();
$name=$row['doc_name'];
$phoneno=$row['doc_phoneno'];
$address=$row['doc_address'];
$gender=$row['doc_gender'];
$spec=$row['spec_id'];
$charge=$row['doc_charge'];
$dob=$row['doc_dob'];
$exp=$row['doc_experience'];
$about=$row['doc_about'];
$img=$row['doc_img'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/css/animations.css">  
    <link rel="stylesheet" href="../../css/css/main.css">  
    <link rel="stylesheet" href="../../css/css/admin.css">
        
    <title>Dashboard</title>
    <style>
        .dashbord-tables{
            animation: transitionIn-Y-over 0.5s;
        }
        .filter-container{
            animation: transitionIn-Y-bottom  0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
    <script>
      function validateFileType() {
         var selectedFile = document.getElementById('fileInput').files[0];
         var allowedTypes = ['image/jpeg', 'image/png' , 'image/jpg'    ];

         if (!allowedTypes.includes(selectedFile.type)) {
            alert('Invalid file type. Please upload a JPEG, PNG and JPG file.');
            document.getElementById('fileInput').value = '';
         }
      }
   </script>
    
</head>
<body>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px" >
                                    <img src="../../img/Doctor/<?php echo $img;?>" alt="" width="100px" height="90px"  style="border-radius:60%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title"><?php echo $name;?></p>
                                    <p class="profile-subtitle"><?php echo $useremail; ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../../index.php" ><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-dashbord" >
                        <a href="index.php" class="non-style-link-menu "><div><p class="menu-text">Dashboard</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="appointment.php" class="non-style-link-menu"><div><p class="menu-text">My Appointments</p></a></div>
                    </td>
                </tr>
                
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-session">
                        <a href="schedule.php" class="non-style-link-menu"><div><p class="menu-text">My Sessions</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-patient">
                        <a href="patient.php" class="non-style-link-menu"><div><p class="menu-text">My Patients</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-dashbord">
                        <a href="article.php" class="non-style-link-menu"><div><p class="menu-text">My Article</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-settings  menu-active menu-icon-settings-active">
                        <a href="settings.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Settings</p></a></div>
                    </td>
                </tr>
                
            </table>
        </div>
        <div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style="border-spacing: 0;margin:0;padding:0;" class="profile-container">
                <tr>
                    <td width="13%" >
                         <a href="settings.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                    </td>
                    <td>
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Manage Profile</p>                    
                    </td>
                    <td colspan="2" class="nav-bar" ></td>
                    <td colspan="2" width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php 
                                date_default_timezone_set('Asia/Kolkata');
                                $today = date('Y-m-d');
                                echo $today;
                            ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../../img/Other/calendar.svg" width="100%"></button>
                    </td>
                </tr> 
            </table>  
            <table border="0" width="50%" style="border-spacing: 0;margin-left:30px;padding:0; text-align:left;" class="profile-container">
                <form method="POST" enctype="multipart/form-data" action="updateprofile.php">                    
                    <tr>
                        <th colspan="2" style="text-align:center; font-size:30px; ">Profile</th>
                    </tr>   
                    <tr>
                        <td>Name</td>
                        <td>
                            <input type="text" name="name" class="input-text" value="<?php  echo $name ;?>" placeholder="" style="margin-top:10px;">&nbsp;&nbsp;
                        </td>
                    </tr>   
                    <tr>
                        <td>Email</td>
                        <td>
                            <input type="text" name="email" class="input-text" value="<?php  echo $useremail ;?>" placeholder="Your Email" style="margin-top:10px;">&nbsp;&nbsp;
                        </td>
                    </tr>   
                    <tr>
                        <td>Phone No</td>
                        <td>
                            <input type="text" name="phoneno" class="input-text" value="<?php  echo $phoneno ;?>" placeholder="Your Phone No" style="margin-top:10px;">&nbsp;&nbsp;
                        </td>
                    </tr>   
                    <tr>
                        <td>Address </td>
                        <td>
                            <input type="text" name="address" class="input-text" value="<?php  echo $address ;?>" placeholder="Your Address" style="margin-top:10px;">&nbsp;&nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top:20px;">Gender </td>
                        <td style="padding-top:20px;">
                            <input type="radio" name="gender" value="Male" <?php if($gender == "Male"){ echo "checked"; } ?> >Male
                            <input type="radio" name="gender" value="Female" <?php if($gender == "Female"){ echo "checked"; } ?> >Female
                        </td>
                    </tr>

                    <tr>
                        <td style="padding-top:20px;"><label for="spec" class="form-label">Choose specialties</label></td>
                        <td style="padding-top:30px;">
                            <select name="spec" id="" class="box">
                                <?php 
                                    $list = $database->query("select  * from  specialist where spec_id = $spec;");
                                    $row=$list->fetch_assoc();
                                    $sid=$row['spec_id'];
                                    $name=$row['spec_type'];
                                ?>
                                <option value="<?php echo $sid; ?>"><?php echo $name; ?></option><br/>
                                <?php
                                    $list = $database->query("select  * from  specialist");
                                    for ($y=0;$y<$list->num_rows;$y++)
                                    {
                                        $row=$list->fetch_assoc();
                                        $sn=$row["spec_type"];
                                        $id=$row["spec_id"];
                                        echo "<option value=".$id.">$sn</option><br/>";
                                    }
                                ?>
                            </select><br><br>
                        </td>
                    </tr>
                    <tr>
                        <td>Charge </td>
                        <td>
                            <input type="text" name="charge" class="input-text" value="<?php  echo $charge ;?>" placeholder="Your Charge" style="margin-top:10px;" onkeypress="return event.charCode>=48 && event.charCode<=57" maxlength="5" >&nbsp;&nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td>DOB </td>
                        <td>
                            <input type="date" name="dob" class="input-text" value="<?php  echo $dob ;?>" placeholder="Your Charge" style="margin-top:10px;">&nbsp;&nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td>Experience </td>
                        <td>
                            <input type="text" name="exp" class="input-text" value="<?php  echo $exp ;?>" placeholder="Your Charge" style="margin-top:10px;" onkeypress="return event.charCode>=48 && event.charCode<=57" maxlength="2" >&nbsp;&nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td>About  </td>
                        <td>
                            <input type="text" name="about" class="input-text" value="<?php  echo $about;?>" placeholder="Your Charge" style="margin-top:10px;">&nbsp;&nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td>Image </td>
                        <td>
                            <input type="file" name="image" class="input-text" id="fileInput" value="<?php  echo $img ;?>" src="<?php  echo $img ;?>" placeholder="Your Image" style="margin-top:10px;"  onchange=validateFileType()>&nbsp;&nbsp;
                        </td>
                    </tr>
                    <tr style="margin-bottom:10%;">
                        <td colspan="2">
                            <input type="submit" name="update" class="login-btn btn-primary-soft btn" style="margin:5% 0 2% 20%;width:120px;text-align:center;">
                            <a href="change_password.php" class="login-btn btn-primary-soft btn" style="text-align:center;">change Password</a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center; color:red; font-size:20px; ">
                            <?php 
                                echo $_SESSION['ERROR']; 
                                $_SESSION['ERROR'] = " "; 
                            ?>
                        </td>
                    </tr> 
                </form>
                <br>
            </table>
        </div>
    </div>
</body>

