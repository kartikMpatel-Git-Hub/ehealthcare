<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/css/animations.css">  
    <link rel="stylesheet" href="../../css/css/main.css">  
    <link rel="stylesheet" href="../../css/css/admin.css">
        
    <title>Appointments</title>
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
    session_start();

    if(isset($_SESSION["email"])){
        if(($_SESSION["email"])=="" or $_SESSION['usertype']!='D'){
            header("location: ../../login.php");
        }else{
            $useremail=$_SESSION["email"];
        }
    }else{
        header("location: ../../login.php");
    }
   
    include("../../php/connection.php");
    $query= "select * from doctor where doc_email = '$useremail';";
    $result= $database->query($query);
    $row=$result->fetch_assoc();
    $img=$row['doc_img'];
    $doc_id=$row['doc_id'];
    $doc_name=$row['doc_name'];
    
    
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
                    <td class="menu-btn menu-icon-appoinment  menu-active menu-icon-dashbord-active">
                        <a href="appointment.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">My Appointments</p></a></div>
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
                    <td class="menu-btn menu-icon-settings">
                        <a href="settings.php" class="non-style-link-menu"><div><p class="menu-text">Settings</p></a></div>
                    </td>
                </tr>

            </table>
        </div>
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%" >
                    <a href="appointment.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                    </td>
                    <td>
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Appointment Manager</p>
                                           
                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php 

                        date_default_timezone_set('Asia/Kolkata');

                        $today = date('Y-m-d');
                        $time = date("H:i:s");
                        echo $today;

                        $list110 = $database->query("select  * from  appointment where appo_status != 0 and sche_id in (select sche_id from schedule where doc_id = $doc_id and sche_id not in(select sche_id from schedule where sche_date = '$today' and sche_end < '$time'))");

                        ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../../img/Other/calendar.svg" width="100%"></button>
                    </td>


                </tr>
               
                <!-- <tr>
                    <td colspan="4" >
                        <div style="display: flex;margin-top: 40px;">
                        <div class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49);margin-top: 5px;">Schedule a Session</div>
                        <a href="?action=add-session&id=none&error=0" class="non-style-link"><button  class="login-btn btn-primary btn button-icon"  style="margin-left:25px;background-image: url('../img/icons/add.svg');">Add a Session</font></button>
                        </a>
                        </div>
                    </td>
                </tr> -->
                <tr>
                    <td colspan="4" style="padding-top:10px;width: 100%;" >
                    
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">All Appointments (<?php echo $list110->num_rows; ?>)</p>
                    </td>
                    
                </tr>
                <?php
                        $sqlmain= "select * from schedule inner join appointment on schedule.sche_id=appointment.sche_id inner join patient on patient.patient_id=appointment.patient_id where   appointment.appo_status != 0 and schedule.doc_id = $doc_id and schedule.sche_date >= '$today' and schedule.sche_id not in (select sche_id from schedule where sche_date = '$today' and sche_end < '$time')";
                        $sqlmain1= "select * from schedule inner join appointment on schedule.sche_id=appointment.sche_id inner join patient on patient.patient_id=appointment.patient_id where  appointment.appo_status != 0 and schedule.sche_date <= '$today' and schedule.doc_id = $doc_id and schedule.sche_id in (select sche_id from schedule where sche_date = '$today' and sche_end < '$time') ";
                ?>
                  
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <?php 
                            $result= $database->query($sqlmain);
                            $result1= $database->query($sqlmain1);
                            if($result->num_rows > 0)
                            {
                        ?>
                        <table width="93%" class="sub-table scrolldown" border="0">
                            <thead>
                                <tr>
                                    <th class="table-headin">
                                        Patient name
                                    </th>
                                    <th class="table-headin">
                                        Appointment number
                                    </th>
                                    <th class="table-headin">
                                        Session Title
                                    </th>
                                    <th class="table-headin" >
                                        Session Date & Time
                                    </th>
                                    <th class="table-headin">
                                        Appointment Date
                                    </th>
                                    <th class="table-headin">
                                        Events
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                        for ( $x=0; $x<$result->num_rows;$x++)
                                        {
                                            $row=$result->fetch_assoc();
                                            $appoid=$row["appo_id"];
                                            $scheduleid=$row["sche_id"];
                                            $title=$row["sche_title"];
                                            $scheduledate=$row["sche_date"];
                                            $scheduletime=$row["sche_start"];
                                            $pname=$row["patient_name"];
                                            $apponum=$row["appo_no"];
                                            $appodate=$row["appo_date"];
                                            echo '
                                            <tr>
                                                <td style="text-align:center;"> &nbsp;'.substr($pname,0,25).'</td >
                                                <td style="text-align:center;font-size:23px;font-weight:500; color: var(--btnnicetext);">'.$apponum.'</td>
                                                <td style="text-align:center;">'.substr($title,0,15).'</td>
                                                <td style="text-align:center;">'.substr($scheduledate,0,10).' <br>'.substr($scheduletime,0,5).'</td>
                                                <td style="text-align:center;">'.$appodate.'</td>
                                                <td>
                                                    <div style="display:flex;justify-content: center;">
                                                        <a href="?action=drop&id='.$appoid.'&name='.$pname.'&session='.$title.'&apponum='.$apponum.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-delete"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Cancel</font></button></a>&nbsp;&nbsp;&nbsp;
                                                    </div>
                                                </td>
                                            </tr>';
                                        }
                                ?>
                            </tbody>
                        </table>
                        <?php
                            }
                            if($result1->num_rows > 0)
                            {
                        ?>
                        <div style="font-size :30px; font-weight:bold; margin:20px 0 20px 0 ;">Complite Appointment</div>
                        <table width="93%" class="sub-table scrolldown" border="0" height="auto">
                            <thead>
                                <tr>
                                    <th class="table-headin">
                                        Patient name
                                    </th>
                                    <th class="table-headin">
                                        Appointment number
                                    </th>
                                    <th class="table-headin">
                                        Doctor
                                    </th>
                                    <th class="table-headin">
                                        Session Title
                                    </th>
                                    <th class="table-headin" >
                                        Session Date & Time
                                    </th>
                                    <th class="table-headin">
                                        Appointment Date
                                    </th>
                                    <th class="table-headin">
                                        Events
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                        for ( $x=0; $x<$result1->num_rows;$x++)
                                        {
                                            $row=$result1->fetch_assoc();
                                            $appoid=$row["appo_id"];
                                            $scheduleid=$row["sche_id"];
                                            $title=$row["sche_title"];
                                            $scheduledate=$row["sche_date"];
                                            $scheduletime=$row["sche_start"];
                                            $pname=$row["patient_name"];
                                            $apponum=$row["appo_no"];
                                            $appodate=$row["appo_date"];
                                            echo '
                                            <tr>
                                                <td style="text-align:center;"> &nbsp;'.substr($pname,0,25).'</td >
                                                <td style="text-align:center;font-size:23px;font-weight:500; color: var(--btnnicetext);">'.$apponum.'</td>
                                                <td style="text-align:center;">'.substr($doc_name,0,25).'</td>
                                                <td style="text-align:center;">'.substr($title,0,15).'</td>
                                                <td style="text-align:center;">'.substr($scheduledate,0,10).' <br>'.substr($scheduletime,0,5).'</td>
                                                <td style="text-align:center;">'.$appodate.'</td>
                                                <td>
                                                    <div style="display:flex;justify-content: center;">
                                                        <a href="?action=drop&id='.$appoid.'&name='.$pname.'&session='.$title.'&apponum='.$apponum.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-delete"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Cancel</font></button></a>&nbsp;&nbsp;&nbsp;
                                                    </div>
                                                </td>
                                            </tr>';
                                        }
                                    }
                                    if($result->num_rows == 0 && $result1->num_rows == 0)
                                    { ?>

                        <table width="93%" class="sub-table scrolldown" border="0" height="auto">
                            <thead>
                                <tr>
                                    <th class="table-headin">
                                       <b> No Appointment </b>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>                                        
                                <tr>
                                    <td colspan="7">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../../img/icons/notfound.svg" width="25%">
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                    <a class="non-style-link" href="appointment.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Appointments &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                </tr>
                                <?php
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
        if($action=='drop'){
            $nameget=$_GET["name"];
            $session=$_GET["session"];
            $apponum=$_GET["apponum"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>Are you sure?</h2>
                        <a class="close" href="appointment.php">&times;</a>
                        <div class="content">
                            You want to delete this record<br><br>
                            Patient Name: &nbsp;<b>'.substr($nameget,0,40).'</b><br>
                            Appointment number &nbsp; : <b>'.substr($apponum,0,40).'</b><br><br>
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="delete-appointment.php?id='.$id.'" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Yes&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="appointment.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>

                        </div>
                    </center>
            </div>
            </div>
            '; 
        }
}

    ?>
    </div>

</body>
</html>