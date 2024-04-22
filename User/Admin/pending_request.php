<?php
session_start();
if(isset($_SESSION["email"])){
    if(($_SESSION["email"])=="" or $_SESSION['usertype']!='A'){
        header("location: ../../login.php");
    }
    else{
        $useremail=$_SESSION["email"];
    }
}else{
    header("location: ../../login.php");
}   
include("../../php/connection.php");
$query= "select * from admin where admin_email = '$useremail';";
$result= $database->query($query);
$row=$result->fetch_assoc();
$name=$row['admin_name'];
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
                                    <img src="../../img/Other/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <a href="profile.php" style="text-decoration:none;"><p class="profile-title"><?php echo $name; ?></p>
                                    <p class="profile-subtitle"><?php echo $useremail; ?></p></a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../../login.php" ><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-dashbord " >
                        <a href="index.php" class="non-style-link-menu"><div><p class="menu-text">Dashboard</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor ">
                        <a href="doctors.php" class="non-style-link-menu "><div><p class="menu-text">Doctors</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor menu-active menu-icon-active">
                        <a href="doctors.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Pending Request</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-schedule">
                        <a href="schedule.php" class="non-style-link-menu"><div><p class="menu-text">Schedule</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="appointment.php" class="non-style-link-menu"><div><p class="menu-text">Appointment</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-patient">
                        <a href="patient.php" class="non-style-link-menu"><div><p class="menu-text">Patients</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-dashbord">
                        <a href="article.php" class="non-style-link-menu"><div><p class="menu-text">Article</p></a></div>
                    </td>
                </tr>   
            </table>
        </div>
        <div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style="border-spacing: 0;margin:0;padding:0;" class="profile-container">
                <tr>
                    <td width="13%" >
                         <a href="schedule.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                    </td>
                    <td>
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Requests</p>                    
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

                                $sqlmain= "select * from pending where status = 1 ";
                            ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../../img/icons/calendar.svg" width="100%"></button>
                    </td>
                </tr> 
            </table>  

            <table border="0" width="100%" style="border-spacing: 0;margin:0;padding:0;" class="profile-container">
                <tr>
                    <td colspan="4">
                        <center>
                        <div class="abc scroll">
                            <table width="93%" class="sub-table scrolldown" border="0">
                                <thead>
                                    <tr>
                                        <th colspan="4" style="font-size:20px; padding:30px;">Pending Request</th>
                                    </tr>
                                    <tr>
                                        <th class="table-headin"></th>
                                        <th class="table-headin">Doctor Name</th>
                                        <th class="table-headin">Email</th>
                                        <th class="table-headin">Specialties</th>
                                        <th class="table-headin">Events</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $result= $database->query($sqlmain);
                                        if($result->num_rows==0){
                                            echo '<tr>
                                            <td colspan="4">
                                            <br><br><br><br>
                                            <center>
                                            <img src="../../img/icons/notfound.svg" width="25%">
                                        
                                            <br>
                                            <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                            <a class="non-style-link" href="doctors.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Doctors &nbsp;</font></button>
                                            </a>
                                            </center>
                                            <br><br><br><br>
                                            </td>
                                            </tr>';
                                        }
                                        else
                                        {
                                            for ( $x=0; $x<$result->num_rows;$x++){
                                                $row=$result->fetch_assoc();
                                                $docid=$row["pen_doc_id"];
                                                $docimg=$row["doc_img"];
                                                $name=$row["doc_name"];
                                                $email=$row["doc_email"];
                                                $spe=$row["spec_id"];
                                                $spcil_res= $database->query("select spec_type from specialist  where spec_id='$spe'");
                                                $spcil_array= $spcil_res->fetch_assoc();
                                                $spcil_name=$spcil_array["spec_type"];
                                                echo '
                                                    <tr>
                                                        <td> &nbsp;&nbsp;&nbsp;&nbsp;<img src="../../img/Doctor/'.$docimg.'" height="50px" style="border-radius:50%;"></td>
                                                        <td> &nbsp;'.substr($name,0,30).'</td>
                                                        <td>'.substr($email,0,20).'</td>
                                                        <td>'.substr($spcil_name,0,20).'</td>
                                                        <td>
                                                            <div style="display:flex;justify-content: center;">
                                                                <a href="?action=view&id='.$docid.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View</font></button></a>
                                                                &nbsp;&nbsp;&nbsp;
                                                                <a href="?action=accept&id='.$docid.'&name='.$name.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-check"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Accept</font></button></a>
                                                                &nbsp;&nbsp;&nbsp;
                                                                <a href="?action=reject&id='.$docid.'&name='.$name.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-delete"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Reject</font></button></a>
                                                            </div>
                                                        </td>
                                                    </tr>';
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>

                            <table width="93%" class="sub-table scrolldown" border="0" style="margin-top:50px;" height="50%">
                                <thead>
                                    <tr>
                                        <th colspan="5" style="font-size:20px; padding:30px;">All Request</th>
                                    </tr>
                                    <tr>
                                        <th class="table-headin"></th>
                                        <th class="table-headin">Doctor Name</th>
                                        <th class="table-headin">Email</th>
                                        <th class="table-headin">Specialties</th>
                                        <th class="table-headin">Action</th>
                                        <th class="table-headin">Detail</th>
                                        <th 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sqlmain= "select * from pending where status != 1 ";
                                        $result= $database->query($sqlmain);
                                        if($result->num_rows==0){
                                            echo '<tr>
                                            <td colspan="4">
                                            <br><br><br><br>
                                            <center>
                                            <img src="../../img/icons/notfound.svg" width="25%">
                                        
                                            <br>
                                            <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                            <a class="non-style-link" href="doctors.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Doctors &nbsp;</font></button>
                                            </a>
                                            </center>
                                            <br><br><br><br>
                                            </td>
                                            </tr>';
                                        }
                                        else
                                        {
                                            for ( $x=0; $x<$result->num_rows;$x++){
                                                $row=$result->fetch_assoc();
                                                $docid=$row["pen_doc_id"];
                                                $name=$row["doc_name"];
                                                $docimg=$row["doc_img"];
                                                $email=$row["doc_email"];
                                                $spe=$row["spec_id"];
                                                $status=$row["Status"];
                                                $spcil_res= $database->query("select spec_type from specialist  where spec_id='$spe'");
                                                $spcil_array= $spcil_res->fetch_assoc();
                                                $spcil_name=$spcil_array["spec_type"];
                                                echo '
                                                    <tr>
                                                        <td style="text-align:center; "> &nbsp;<img src="../../img/Doctor/'.$docimg.'" height="50px" style="border-radius:50%;"></td>
                                                        <td style="text-align:center; "> &nbsp;'.substr($name,0,30).'</td>
                                                        <td style="text-align:center; ">'.substr($email,0,20).'</td>
                                                        <td style="text-align:center; ">'.substr($spcil_name,0,20).'</td>
                                                        '; 
                                                        if($status == 2)
                                                        {
                                                            echo '
                                                            <td style="text-align:center; ">
                                                                <div style="display:flex;justify-content: center; color:green;">ACCEPTED</div>
                                                            </td>';
                                                        }
                                                        else
                                                        {
                                                            echo '
                                                            <td style="text-align:center; ">
                                                                <div style="display:flex;justify-content: center;color:red;">REJECTED</div>
                                                            </td>';
                                                        }
                                                        echo'
                                                        <td style="text-align:center; ">
                                                        
                                                        <div style="display:flex;justify-content: center;">
                                                            <a href="?action=view&id='.$docid.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View</font></button></a>
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
</body>
<?php
  if($_GET){  
    $id=$_GET["id"];
    $action=$_GET["action"];
    
    if($action=='reject'){
        $nameget=$_GET["name"];
        echo '
        <div id="popup1" class="overlay">
            <div class="popup">
                <center>
                    <h2>Are you sure?</h2>
                    <a class="close" href="doctors.php">&times;</a>
                    <div class="content">
                        You want to Reject this Request<br>('.substr($nameget,0,40).').   
                    </div>
                    <div style="display: flex;justify-content: center;">
                        <a href="reject-doctor.php?id='.$id.'" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Yes&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="pending_request.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>
                    </div>
                </center>
            </div>
        </div>
        ';
    }
    elseif($action=='accept'){
        $nameget=$_GET["name"];
        echo '
        <div id="popup1" class="overlay">
            <div class="popup">
                <center>
                    <h2>Are you sure?</h2>
                    <a class="close" href="doctors.php">&times;</a>
                    <div class="content">
                        You want to Accept this Request<br>('.substr($nameget,0,40).').   
                    </div>
                    <div style="display: flex;justify-content: center;">
                        <a href="accept-doctor.php?id='.$id.'" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Yes&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="pending_request.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>
                    </div>
                </center>
             </div>
        </div>
        ';
    }
    elseif($action=='view')
    {
        $sqlmain= "select * from pending where pen_doc_id='$id'";
        $result= $database->query($sqlmain);
        $row=$result->fetch_assoc();
        $name=$row["doc_name"];
        $email=$row["doc_email"];
        $spe=$row["spec_id"];
        $gen=$row['doc_gender'];
        $pno=$row['doc_phoneno'];
        $charge=$row['doc_charge'];
        $img=$row['doc_img'];
        
        $spcil_res= $database->query("select spec_type from specialist where spec_id='$spe'");
        $spcil_array= $spcil_res->fetch_assoc();
        $spcil_name=$spcil_array["spec_type"];
       
        echo '
        <div id="popup1" class="overlay">
            <div class="popup">
                <center>
                    <div style="display: flex;justify-content: center;">
                    <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                    
                        <tr>
                            <td>
                                <p style="padding: 0;margin: 0;text-align: center;font-size: 25px;font-weight: 500;"><img src="../../img/Doctor/'.$img.'" height="150px"></p><br><br>
                            </td>
                        </tr>
                        
                        <tr>
                            <td class="label-td" colspan="2">
                                <label for="name" class="form-label">Name: </label>
                            </td>
                        </tr> 
                        <tr>
                            <td class="label-td" colspan="2">'.$name.'<br><br></td>
                        </tr> 
                        <tr>
                            <td class="label-td" colspan="2">
                                <label for="Email" class="form-label">Email: </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">'.$email.'<br><br></td>
                        </tr> 

                        <tr>
                            <td class="label-td" colspan="2">
                                <label for="spec" class="form-label">Specialties: </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">'.$spcil_name.'<br><br></td>
                        </tr>
                        
                        <tr>
                            <td class="label-td" colspan="2">
                                <label for="spec" class="form-label">Gender: </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">'.$gen.'<br><br></td>
                        </tr>
                
                        <tr>
                            <td class="label-td" colspan="2">
                                <label for="spec" class="form-label">Phone No: </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">'.$pno.'<br><br></td>
                        </tr>
                        
                        <tr>
                            <td class="label-td" colspan="2">
                                <label for="spec" class="form-label">Charge : </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">'.$charge.'<br><br></td>
                        </tr>    
                        <tr>
                            <td colspan="2">
                                <center><a href="pending_request.php"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a></center>
                            </td>
                        </tr>
                    </table> 
                    </div>
                </center>
                <br><br>
            </div>
        </div>
        ';
    }
  }
?>