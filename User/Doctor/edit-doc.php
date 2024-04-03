
    <?php
    include("../../php/connection.php");
    if($_POST){
        $name=$_POST['name'];
        $oldemail=$_POST["oldemail"];
        $spec=$_POST['spec'];
        $email=$_POST['email'];
        $address=$_POST['address'];
        $pno=$_POST['phoneno'];
        $gender=$_POST['gender'];
        $charge=$_POST['charge'];
        $id=$_POST['id00'];
        
        $result= $database->query("select * from user where user_email = '$email' and user_email != '$oldemail';");
        if($result->num_rows==1){
            $error = '1';
        }   
        else
        {
            $result= $database->query("select * from doctor where doc_phoneno = '$pno' and doc_email != '$oldemail';");
            if($result->num_rows==1){
                 $error = '5';
            }   
            else
            {
                $sql1="update doctor set doc_email='$email',doc_name='$name',doc_address='$address',doc_gender='$gender',doc_phoneno='$pno',doc_charge=$charge,spec_id=$spec where doc_id=$id ;";
                $database->query($sql1);
                $sql1="update user set user_email='$email' where user_email='$oldemail' ;";
                $database->query($sql1);
                $error= '4';
            }
        }
         header("location: doctors.php?action=edit&error=".$error."&id=".$id);
    }
?>