<?php
session_start();

if(isset($_SESSION["email"])){
    if(($_SESSION["email"])=="" or $_SESSION['usertype']!='P'){
        header("location: ../../../login.php");
    }else{
        $useremail=$_SESSION["email"];
    }
}else{
    header("location: ../../../login.php");
}

require "../../../php/connection.php";
if($_POST)
{
    $rate = $_COOKIE['rating'];
    $desc=$_POST['message'];
    $sid=$_POST['sche_id'];
    $aid=$_POST['appoid'];
    $query= $database->query("select * from patient where patient_email='$useremail'");
	$ans= $query->fetch_assoc();
	$pid=$ans["patient_id"];
    $query= $database->query("select * from schedule where sche_id='$sid'");
	$ans= $query->fetch_assoc();
	$did=$ans["doc_id"];

    $sql="insert into feedback (doc_id,sche_id,patient_id,feedback_description,rating,appo_id) values($did,$sid,$pid,'$desc',$rate,$aid)";
    $database->query($sql);

    $sql="update rating set rate_total_rating = rate_total_rating + $rate , rate_total_review =  rate_total_review + 1 where doc_id = $did ";
    $database->query($sql);

    
   header("location: ../mysession.php");
}

?>
