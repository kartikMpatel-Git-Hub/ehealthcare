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
    $_SESSION['ERROR'] = "";
    $query= "select * from doctor where doc_email = '$useremail';";
    $result= $database->query($query);
    $row=$result->fetch_assoc();
    $img=$row['doc_img'];
    $name=$row['doc_name'];

    if(isset($_POST['update']))
    {
        $_SESSION['ERROR'] = "";
        $result = $database->query("select * from doctor where doc_email = '$useremail';");
        $row=$result->fetch_assoc();
        $password = $row['doc_password'];
        $oldpassword = $_POST['old'];
        $newpassword = $_POST['new'];
        $renewpassword = $_POST['renew'];
        if($oldpassword == "" || $password == "" || $newpassword == "" || $renewpassword =="")
        {
            $_SESSION['ERROR'] = "Enter All Field First !!";
        }  
        else
        {
            if($oldpassword != $password)
            {
                $_SESSION['ERROR'] = "Old Password Is Wrong";
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
                        $query = "update doctor set doc_password = '$newpassword' where doc_email = '$useremail';";
                        $database->query($query);
                        $_SESSION['ERROR'] = "Password Changed Sucessfully !!";
                    }
                }
            }
        }
    }
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
                <form method="POST">  
                    <tr>
                        <th colspan="2" style="text-align:center; font-size:30px; ">Change Password</th>
                    </tr>   
                    <tr>
                        <td>Old Password</td>
                        <td>
                            <input type="text" name="old" class="input-text" placeholder="Old Password" style="margin-top:10px;">&nbsp;&nbsp;
                        </td>
                    <tr>   
                    <tr>
                        <td>New Password</td>
                        <td>
                            <input type="text" name="new" class="input-text" placeholder="New Password" style="margin-top:10px;">&nbsp;&nbsp;
                        </td>
                    <tr>   
                    <tr>
                        <td>Re-Enter Password</td>
                        <td>
                            <input type="password" name="renew" class="input-text" placeholder="Re-Enter Password" style="margin-top:10px;">&nbsp;&nbsp;
                        </td>
                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Update" name="update" class="login-btn btn-primary-soft btn" style="margin:5% 0 2% 25%;width:120px;text-align:center;">
                            <a href="profile.php" class="login-btn btn-primary-soft btn" style="text-align:center;">Back To Profile</a>
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

