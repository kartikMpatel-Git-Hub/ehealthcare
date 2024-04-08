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
    
    if($_POST){

        date_default_timezone_set('Asia/Kolkata');

        include("../../php/connection.php");
        $title=addslashes($_POST["title"]);
        $docid=$_POST["docid"];
        $description=addslashes($_POST["desc"]);
        $img = $_FILES['img']['name'];
        $date=date('Y-m-d');
        
        $sql="insert into article (doc_id,article_title,article_date,article_description,article_img) values ($docid,'$title','$date','$description','$img');";
        $result= $database->query($sql);
        if(isset($_FILES['img']))
        {
            $file_name = $_FILES['img']['name'];
            $tmp_name = $_FILES['img']['tmp_name'];
            
            if(move_uploaded_file($tmp_name,"img/Article/".$file_name))
            {
                $_SESSION['ERROR'] = $_SESSION['ERROR']."With Image Upload !"; 
            }
            else
            {
                $_SESSION['ERROR'] = $_SESSION['ERROR']."With out Image Upload !"; 
            }
        }
        header("location: article.php");
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
    <script>
      function validateFileType() {
         var selectedFile = document.getElementById('fileInput').files[0];
         var allowedTypes = ['image/jpeg', 'image/png' , 'image/jpg'    ];

         if (!allowedTypes.includes(selectedFile.type)) {
            alert('Invalid file type. Please upload a JPEG, PNG, or PDF file.');
            document.getElementById('fileInput').value = '';
         }
      }
   </script>
    
</head>
<body>
    <?php

    include("../../php/connection.php");
    
    $userrow = $database->query("select * from doctor where doc_email='$useremail'");
    $userfetch=$userrow->fetch_assoc();
    $userid= $userfetch["doc_id"];
    $username=$userfetch["doc_name"];
    $img=$userfetch["doc_img"];

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
                                    <img src="../../img/Doctor/<?php echo $img;?>" alt="" width="100px" height="90px"  style="border-radius:60%">

                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title"><?php echo substr($username,0,13)  ?>..</p>
                                    <p class="profile-subtitle"><?php echo substr($useremail,0,22)  ?></p>
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
                    <td class="menu-btn menu-icon-dashbord " >
                        <a href="index.php" class="non-style-link-menu"><div><p class="menu-text">Dashboard</p></a></div></a>
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
                    <td class="menu-btn menu-icon-deshboard menu-active menu-icon-dashbord-active ">
                        <a href="article.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">My Article</p></a></div>
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
                    <a href="article.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
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

                        $list110 = $database->query("select  * from  article where doc_id ='$userid';");

                        ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../../img/Other/calendar.svg" width="100%"></button>
                    </td>


                </tr>
            </table>
            <table width="80%" class="sub-table scrolldown add-doc-form-container" style="border:0px;">
                <tr>
                    <td>
                        <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Add New Article.</p><br>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                    <form  method="POST" class="add-new-form" enctype="multipart/form-data">
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
                                            <option value="'.$userid.'"><?php echo $username; ?></option><br/>
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
                                    <input type="file" name="img" class="input-text" id="fileInput" onchange=validateFileType() required><br>
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
</body>
</html>
               