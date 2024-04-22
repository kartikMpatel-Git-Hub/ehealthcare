<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/css/animations.css">  
    <link rel="stylesheet" href="../../css/css/main.css">  
    <link rel="stylesheet" href="../../css/css/admin.css">
        
    <title>Patients</title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }
</style>
</head>
<body>
    <?php

    //learn from w3schools.com

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
    

    //import database
    include("../../php/connection.php");
    $query= "select * from doctor where doc_email = '$useremail';";
    $result= $database->query($query);
    $row=$result->fetch_assoc();
    $img=$row['doc_img'];
    $doc_name=$row['doc_name'];
    $doc_id=$row['doc_id'];
    
    ?>
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
                                    <p class="profile-title"><?php echo $doc_name; ?></p>
                                    <p class="profile-subtitle"><?php echo $useremail;?></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                <a href="../.../index.php" ><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
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
                    <td class="menu-btn menu-icon-appoinment ">
                        <a href="appointment.php" class="non-style-link-menu"><div><p class="menu-text">My Appointments</p></a></div>
                    </td>
                </tr>
                
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-session ">
                        <a href="schedule.php" class="non-style-link-menu"><div><p class="menu-text">My Sessions</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-patient menu-active menu-icon-patient-active">
                        <a href="patient.php" class="non-style-link-menu  non-style-link-menu-active"><div><p class="menu-text">My Patients</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-dashbord">
                        <a href="article.php" class="non-style-link-menu"><div><p class="menu-text">My Article</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-settings">
                        <a href="settings.php" class="non-style-link-menu"><div><p class="menu-text">Settings</p></a></div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%">

                    <a href="patient.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                        
                    </td>
                    <?php $list11 = $database->query("select * from patient where patient_id in (select patient_id from appointment where  sche_id in (select sche_id from schedule where doc_id = $doc_id));"); ?>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php 
                        date_default_timezone_set('Asia/Kolkata');

                        $date = date('Y-m-d');
                        echo $date;
                        ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../../img/Other/calendar.svg" width="100%"></button>
                    </td>


                </tr>
               
                
                <tr>
                    <td colspan="4" style="padding-top:10px;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">Total Patients (<?php echo $list11->num_rows; ?>)</p>
                    </td>
                    
                </tr>
                <?php
                    $sqlmain= "select * from patient where patient_id in (select patient_id from appointment where  sche_id in (select sche_id from schedule where doc_id = $doc_id))";
                ?>
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="100%" class="sub-table scrolldown"  style="border-spacing:0;">
                        <thead>
                        <tr>
                                
                                <th class="table-headin">
                                    
                                </th>
                                <th class="table-headin">
                                    Name
                                </th>
                                <th class="table-headin">
                                    Email
                                </th>
                                <th class="table-headin">
                                    gender
                                </th>
                                <th class="table-headin">
                                    Address
                                </th>
                                <th class="table-headin">
                                    Date of Birth
                                </th>
                                <th class="table-headin">
                                    Phone No
                                </th>
                                <th class="table-headin">
                                    Events
                                </th>
                        </thead>
                        <tbody>
                        
                            <?php

                                
                                $result= $database->query($sqlmain);

                                if($result->num_rows==0){
                                    echo '<tr>
                                    <td colspan="8">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../../img/icons/notfound.svg" width="30%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                    <a class="non-style-link" href="patient.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Patients &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                    
                                }
                                else{
                                for ( $x=0; $x<$result->num_rows;$x++){
                                    $row=$result->fetch_assoc();
                                    $pid=$row["patient_id"];
                                    $pimg=$row["patient_img"];
                                    $name=$row["patient_name"];
                                    $email=$row["patient_email"];
                                    $address=$row["patient_address"];
                                    $gender=$row["patient_gender"];
                                    $dob=$row["patient_dob"];
                                    $phoneno=$row["patient_phoneno"];
                                    
                                    echo '
                                    <tr>
                                        <td style="padding-left:20px;"><img src="../../img/Patient/'.$pimg.'" width="50px" style="border-radius:50%;"></td>
                                        <td style="padding-left:40px;">'.$name.'</td>
                                        <td style="padding-left:40px;">'.$email.'</td>
                                        <td style="padding-left:40px;">'.$gender.'</td>
                                        <td style="padding-left:40px;">'.$address.'</td>
                                        <td style="padding-left:40px;">'.$dob.'</td>
                                        <td style="padding-left:40px;">'.$phoneno.'</td>
                                        <td>
                                            <div style="display:flex;justify-content: center;">
                                                 <a href="?action=view&id='.$pid.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View</font></button></a>
                                            </div>
                                        </td>
                                    </tr>';
                                    
                                }
                            }
                                 
                            ?>
 
                            </tbody>

                        </table>
                        </div>
                        </center>
                   </td> 
                </tr>
                       
                        
                        
            </table>
        </div>
    </div>
    <?php 
    if($_GET){
        
        $id=$_GET["id"];
        $action=$_GET["action"];
            $sqlmain= "select * from patient where patient_id='$id'";
            $result= $database->query($sqlmain);
            $row=$result->fetch_assoc();
            $name=$row["patient_name"];
            $pimg=$row["patient_img"];
            $email=$row["patient_email"];
            $gender=$row["patient_gender"];
            $address=$row["patient_address"];
            $dob=$row["patient_dob"];
            $phoneno=$row["patient_phoneno"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <a class="close" href="patient.php">&times;</a>
                        <div class="content">

                        </div>
                        <div style="display: flex;justify-content: center;">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">View Details.</p><br><br>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <center><img src="../../img/Patient/'.$pimg.'" width="50%" style="border-radius:10%;"></center>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <br><label for="name" class="form-label"><b>Patient ID:</b></label>'.$id.'<br><br>
                                </td>
                            </tr>
                            
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label"><b>Name:</b></label>'.$name.'<br><br>
                                </td>
                                
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Email" class="form-label"><b>Email: </b></label>'.$email.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="nic" class="form-label"><b>Gender: </b></label>'.$gender.'<br><br></td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label"><b>Address:</b> </label>'.$address.'<br><br></td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label"><b>Date Of Birth : </b></label>'.$dob.'<br><br></td>
                            </tr>
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label"><b>Phone No:</b> </label>'.$phoneno.'<br><br></td>
                                
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <center><a href="patient.php"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a></center>
                                </td>
                
                            </tr>
                           

                        </table>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';
        
    };

?>
</div>

</body>
</html>