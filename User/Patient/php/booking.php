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

require "connection.php";
if($_GET){
    $id=$_GET["id"];
    $action=$_GET["action"];
    if($action=='add')
    {
        $query= $database->query("select * from patient where patient_email='$useremail'");
        $patient= $query->fetch_assoc();
        $pid=$patient["patient_id"];
        
        $query= $database->query("select * from schedule where sche_id='$id'");
        $patient= $query->fetch_assoc();
        $did=$patient["doc_id"];

        $query= $database->query("select * from doctor where doc_id='$did'");
        $patient= $query->fetch_assoc();
        $charge=$patient["doc_charge"];
        $query="select * from appointment where sche_id = '$id' and appo_status != 0";
        $empty=$database->query($query);	
        $appono=$empty->num_rows;
        $appono=$appono + 1;
        $date = $_SESSION['today'];
        $sql="insert into appointment (patient_id,appo_no,sche_id,appo_date,appo_status) values($pid,$appono,$id,'$date',1)";
        $database->query($sql);

        $new1= $database->query("select * from appointment where patient_id=$pid and appo_no=$appono and sche_id=$id and appo_status != 0");
        $row= $new1 ->fetch_assoc();
        $aid=$row["appo_id"];

        echo $aid;

        $sql="insert into transaction (doc_id,sche_id,patient_id,appo_id,charge,tra_status) values($did,$id,$pid,$aid,$charge,1)";
        $database->query($sql);
    }
    elseif($action == 'delete')
    {
        $tid = $_GET['tid'];
        $sql="update appointment set appo_status = 0  where appo_id = '$id'";
        $database->query($sql);
        $sql="update transaction set tra_status = 0 where tra_id = $tid";
        $database->query($sql);
    }
    else
    {
        ?>
            <script>window.location.href='session.php';</script>
        <?php
    }
   header("location: ../mysession.php");
}

?>
