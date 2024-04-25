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
        .dashbord-tables,.doctor-heade{
            animation: transitionIn-Y-over 0.5s;
        }
        .filter-container{
            animation: transitionIn-Y-bottom  0.5s;
        }
        .sub-table,#anim{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .doctor-heade{
            animation: transitionIn-Y-over 0.5s;
        }
    </style>
    
    
</head>
<body>
    <?php

    session_start();

    if(isset($_SESSION["email"])){
        if(($_SESSION["email"])=="" or $_SESSION['usertype']!='A'){
            header("location: ../../login.php");
        }else{
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

    date_default_timezone_set('Asia/Kolkata');

    $time = date("H:i:s");
    
    ?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px" >
                                    <img src="../../img/Other/user.png" alt="" width="100px" height="90px"  style="border-radius:60%">
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
                    <td class="menu-btn menu-icon-dashbord" >
                        <a href="index.php" class="non-style-link-menu"><div><p class="menu-text">Dashboard</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor ">
                        <a href="doctors.php" class="non-style-link-menu "><div><p class="menu-text">Doctors</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor ">
                        <a href="pending_request.php" class="non-style-link-menu "><div><p class="menu-text">Pendeing Request</p></a></div>
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
                    <td class="menu-btn menu-icon-patient ">
                        <a href="patient.php" class="non-style-link-menu"><div><p class="menu-text">Patients</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-dashbord menu-icon-dashbord-active menu-active ">
                        <a href="article.php" class="non-style-link-menu   non-style-link-menu-active"><div><p class="menu-text">Article</p></a></div>
                    </td>
                </tr>
                
                
            </table>
        </div>
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%" >
                    <a href="schedule.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                    </td>
                    <td>
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Manage Article</p>                    
                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php 

                        date_default_timezone_set('Asia/Kolkata');

                        $today = date('Y-m-d');
                        echo $today;
                        // echo $time;

                        $list110 = $database->query("select  * from  article;");

                        ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../../img/Other/calendar.svg" width="100%"></button>
                    </td>


                </tr>
               
                <tr>
                    <td colspan="4" >
                        <div style="display: flex;margin-top: 40px;">
                        <div class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49);margin-top: 5px;">More Article</div>
                        <a href="?action=add-article&id=none&error=0" class="non-style-link"><button  class="login-btn btn-primary btn button-icon"  style="margin-left:25px;background-image: url('../../img/icons/add.svg');">Add New Article</font></button>
                        </a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-top:10px;width: 100%;" >
                    
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">All Article (<?php echo $list110->num_rows; ?>)</p>
                    </td>
                    
                </tr>
                
                <?php
                        $sqlmain= "select * from article";
                ?>
                  
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                            
                        <table width="100%" class="sub-table scrolldown" border="0">
                        <thead>
                        <?php
                            echo '
                            <tr>
                                <th colspan=6><h1>Your Article</h1><th>
                            <tr>                                
                            ';
                        ?>
                        <tr>
                                <th class="table-headin">
                                    Article Title
                                </th>
                                
                                <th class="table-headin">
                                    Publisher
                                </th>
                                <th class="table-headin">
                                    Publish Date
                                </th>
                                <th class="table-headin">
                                    Total View On Article
                                </th>
                                <th class="table-headin">
                                    Events
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
                                    <a class="non-style-link" href="schedule.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Sessions &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                    
                                }
                                else{
                                for ( $x=0; $x<$result->num_rows;$x++){
                                    $row=$result->fetch_assoc();
                                    $aid=$row['article_id'];
                                    $title = $row['article_title'];
                                    $adate = $row['article_date'];
                                    $view = $row['article_view'];
                                    $docid = $row['doc_id'];
                                    $query= $database->query("select * from doctor  where doc_id='$docid'");
                                    $ans= $query->fetch_assoc();
                                    $doc_name=$ans["doc_name"];
                                    echo '<tr>
                                        <td> &nbsp;'.
                                        substr($title,0,30)
                                        .'</td>
                                        <td>
                                        '.substr($doc_name,0,20).'
                                        </td>
                                        <td style="text-align:center;">
                                            '.substr($adate,0,10).'
                                        </td>
                                        <td style="text-align:center;">
                                            '.$view.'
                                        </td>

                                        <td>
                                        <div style="display:flex;justify-content: center;">
                                        
                                        <a href="?action=view&id='.$aid.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View</font></button></a>
                                       &nbsp;&nbsp;&nbsp;
                                       <a href="?action=comment&id='.$aid.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Comment</font></button></a>
                                       &nbsp;&nbsp;&nbsp;
                                       <a href="?action=drop&id='.$aid.'&name='.$title.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-delete"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Remove</font></button></a>
                                        </div>
                                        </td>
                                    </tr>';
                                    
                                }    
                            }    

                            ?>
                        </div>
                        </center>
                   </td> 
                </tr>
            </table>
        </div>
        <?php
    
    if($_GET){
        $id=$_GET["id"];
        $action=$_GET["action"];
        if($action=='add-article'){

            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <a class="close" href="schedule.php">&times;</a> 
                        <div style="display: flex;justify-content: center;">
                        <div class="abc">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Add New Article.</p><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                        <form action="add-article.php" method="POST" class="add-new-form" enctype="multipart/form-data">
                                    <label for="title" class="form-label">Article Title : </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="title" class="input-text" placeholder="Title Of Article" required><br>
                                </td>
                            </tr>
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="docid" class="form-label">Publisher/Doctor: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <select name="docid" id="" class="box" >
                                            <option value="'.$userid.'">'.$username.'</option><br/>
                                    </select><br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="date" class="form-label">Article Description: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <textarea name="desc" class="input-text"></textarea>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="time" class="form-label">Article Image: </label>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="file" name="img" class="input-text" placeholder="Time" required><br>
                                </td>
                            </tr>
                           
                            <tr>
                                <td colspan="2">
                                    <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                
                                    <input type="submit" value="Place this Session" class="login-btn btn-primary btn" name="shedulesubmit">
                                </td>
                
                            </tr>
                           
                            </form>
                            </tr>
                        </table>
                        </div>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';
        }
        elseif($action=='drop'){
            $nameget=$_GET["name"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>Are you sure?</h2>
                        <a class="close" href="article.php">&times;</a>
                        <div class="content">
                            You want to delete this Article<br>('.substr($nameget,0,40).').
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="delete-article.php?id='.$id.'" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Yes&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="schedule.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>

                        </div>
                    </center>
            </div>
            </div>
            '; 
        }elseif($action=='view'){
            $sqlmain= "select * from article where article_id=$id";
            $result= $database->query($sqlmain);
            $row=$result->fetch_assoc();
            $desc=$row["article_description"];
            $img=$row['article_img'];
            $doc_id=$row['doc_id'];

            $sqlmain1= "select * from doctor where doc_id=$doc_id";
            $result1= $database->query($sqlmain1);
            $row1=$result1->fetch_assoc();
            $doc_name=$row1["doc_name"];

           
            echo '
            <div id="popup1" class="overlay">
                <div class="popup" style="width: 70%;">
                    <center>
                        <h2></h2>
                        <a class="close" href="article.php">&times;</a>
                        <div class="abc scroll" style="display: flex;justify-content: center;" style="height : 100%;">
                            <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0" >
                                <tr>
                                    <td>
                                        <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;"><center><b style="font-size:50px;">View Article</b></center></p><br><br>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="label-td" colspan="2" >
                                        <center>
                                            <img src="../../img/Article/'.$img.'" height="300px">
                                        </center>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td"  style="padding-top:100px;">
                                        <label for="name" ><b>Article Title - </b></label>
                                        <label for="name" >'.$title.'</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td"  style="padding-top:30px;">
                                        <label for="name" ><b>Publisher/Doctor Name - </b></label>
                                        <label for="name" >'.$doc_name.'</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td"  style="padding-top:30px;">
                                        <label for="name" class="form-label"><b>Article Date - </b></label>
                                        <label for="name" class="form-label">'.$adate.'</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2" style="padding-top:30px;">
                                    <label for="Tele" class="form-label"><center><b>________________________________________________________________________________________________________________________________________________________<b></center></label>
                                    <label for="Tele" class="form-label"><center><b>Article<b></center></label>
                                    <label for="Tele" class="form-label"><center><b>________________________________________________________________________________________________________________________________________________________<b></center></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <p  style="word-wrap: break-word;">'.$desc.'<p><br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2" style="padding-top:30px;">
                                    <label for="Tele" class="form-label"><center><b>________________________________________________________________________________________________________________________________________________________<b></center></label>
                                    <label for="Tele" class="form-label"><center><b>Comments<b></center></label>
                                    <label for="Tele" class="form-label"><center><b>________________________________________________________________________________________________________________________________________________________<b></center></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">';
                                    $query = "select * from comment where article_id=$id";
								    $result= $database->query($query);
                                    for ($x=0; $x<$result->num_rows;$x++)
                                    {
                                        $row=$result->fetch_assoc();
										$pid = $row['patient_id'];
										$des = $row['cmt_detail'];
										$query1 = "select * from patient where patient_id='$pid'";
										$result1= $database->query($query1);
										$row1=$result1->fetch_assoc();
										$pname = $row1['patient_name'];
										$pimg = $row1['patient_img'];
                                        echo '
                                            <br><br>
                                            <img src="../../img/Patient/'.$pimg.'" width="50px" style="border-radius:50%;"><span style="color:gray;">'.$pname.'</span>
                                            <p  style="word-wrap: break-word;">'.$des.'<p>
                                            ';
                                    }
                                    echo '
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </center>
                </div>
            </div>
            ';  
        }elseif($action=='comment')
        {

            $sqlmain12= "select * from comment where article_id = $id";
            $result12= $database->query($sqlmain12);
            echo '
            <div id="popup1" class="overlay">
                <div class="popup" style="width: 70%;">
                    <center>
                        <h2></h2>
                        <a class="close" href="article.php">&times;</a>
                        <div class="content">
                            
                            
                        </div>
                        <div class="abc scroll" style="display: flex;justify-content: center;">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">View Feedbacks.</p><br><br>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label"><b>Patients that Give Feedback On This Session</b> ('.$result12->num_rows.')</label>
                                    <br><br>
                                </td>
                            </tr>

                            
                            <tr>
                            <td colspan="4">
                                <center>
                                 <div class="abc scroll">
                                 <table width="100%" class="sub-table scrolldown" border="0">
                                 <thead>
                                 <tr>   
                                        <th class="table-headin">

                                         </th>
                                         <th class="table-headin">
                                             Patient name
                                         </th>
                                         <th class="table-headin">
                                             
                                             Comment
                                             
                                         </th>
                                        
                                         
                                         <th class="table-headin">
                                             Date & Time 
                                         </th>
                                         
                                 </thead>
                                 <tbody>';
                                         

                                        $querya = "select * from comment where article_id = $id";
                                        $resulta= $database->query($querya);
                
                                         if($resulta->num_rows==0){
                                             echo '<tr>
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
                                             </tr>';
                                             
                                         }
                                         else
                                         {
                                         for ( $x=0; $x<$resulta->num_rows;$x++){
                                             $row=$resulta->fetch_assoc();
                                             $cmt=$row["cmt_detail"];
                                             $pid=$row["patient_id"];
                                             $cdate=$row["cmt_date"];
                                             $ctime=$row["cmt_time"];

                                             $queryp = "select * from patient where patient_id = $pid";
                                             $result= $database->query($queryp);
                                             $row=$result->fetch_assoc();
                                             $pname=$row["patient_name"];
                                             $pimg=$row["patient_img"];

                                             echo '<tr style="text-align:center;">
                                                <td>
                                                    <img src="../../img/Patient/'.$pimg.'" width="50px" style="border-radius:50%;">
                                                </td>
                                                 <td style="font-weight:600;padding:25px">'.
                                                 
                                                 substr($pname,0,25)
                                                 .'</td >
                                                 <td style="text-align:center;font-size:23px;font-weight:500; color: var(--btnnicetext);">
                                                 '.$cmt.'
                                                 
                                                 </td>
                                                 <td>
                                                 '.$cdate.' At '.$ctime.'
                                                 </td>
                                                 
                                                 
                
                                                 
                                             </tr>';
                                             
                                         }
                                     }
                                    echo '</tbody>
                
                                 </table>
                                 </div>
                                 </center>
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