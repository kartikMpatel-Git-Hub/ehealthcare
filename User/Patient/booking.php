<?php
session_start();

if(isset($_SESSION["email"])){
    if(($_SESSION["email"])=="" or $_SESSION['usertype']!='P'){
        header("location: ../../login.php");
    }else{
        $useremail=$_SESSION["email"];
    }
}else{
    header("location: ../../login.php");
}

require "php/connection.php";
if($_GET){
    $id=$_GET["id"];
    $action=$_GET["action"];
    if($action=='add')
    {
        $query= $database->query("select * from patient where patient_email='$useremail'");
        $patient= $query->fetch_assoc();
        $pid=$patient["patient_id"];
        $query="select * from appointment where sche_id = '$id'";
        $empty=$database->query($query);	
        $appono=$empty->num_rows;
        $appono=$appono + 1;
        $date = $_SESSION['today'];
        $sql="insert into appointment (patient_id,appo_no,sche_id,appo_date) values($pid,$appono,$id,'$date')";
        $database->query($sql);
    }
    else
    {
        ?>
            <script>window.location.href='specialist.php';</script>
        <?php
    }
    header("location: index.php");
}

?>
