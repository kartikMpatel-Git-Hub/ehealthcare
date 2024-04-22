
<?php

session_start();

$useremail=$_SESSION["email"];  

include("../../php/connection.php");

$query= "select * from doctor where doc_email = '$useremail';";
$result= $database->query($query);
$row=$result->fetch_assoc();
$img=$row['doc_img'];

if($_POST)
{
    $emaill = $_POST['email'];
    $namee = $_POST['name'];
    $phonenoo = $_POST['phoneno'];
    $addresss = $_POST['address'];
    $genderr = $_POST['gender'];
    $specc = $_POST['spec'];
    $chargee = $_POST['charge'];
    $imgg = $_FILES['image']['name'];


    echo "Hello";

    if($imgg == "")
    {
        $imgg = $img;
    }

    if($emaill == "" || $namee == "" || $phonenoo == "" || $addresss == "" || $genderr == "" || $specc == "" || $chargee == "")
    {
        $_SESSION['ERROR'] = "Enter All Field First !!";
    }  
    else
    {
        $user = $database->query("select  * from  user,pending where user.user_email = '$emaill' and user.user_email != '$useremail' or pending.doc_email = '$emaill' and pending.status = 1;");
        
        if($user->num_rows)
        {
            $_SESSION['ERROR'] = "Email Already Exist !"; 
        }
        else
        {
            $user = $database->query("select  * from  doctor,pending where doctor.doc_phoneno = '$phonenoo' and doctor.doc_email != '$useremail' or pending.doc_phoneno = '$phonenoo' and pending.status = 1;");
            if($user->num_rows)
            {
                $_SESSION['ERROR'] = "Phone No Already Exist !"; 
            }
            else
            {
                $user = $database->query("select  * from  doctor,pending where doctor.doc_img = '$imgg' and doctor.doc_img != 'user.jpg' and doctor.doc_email != '$useremail' or pending.doc_img = '$imgg' and pending.status != 0 and pending.doc_img != 'user.jpg';");
                if($user->num_rows)
                {
                    $_SESSION['ERROR'] = "Wrong Image !"; 
                }
                else
                {
                    if(isset($_FILES['image']))
                    {
                        $query = "update doctor set doc_email = '$emaill',doc_name = '$namee', doc_phoneno = '$phonenoo' , doc_address = '$addresss' , doc_gender = '$genderr' , spec_id = $specc , doc_charge = $chargee , doc_img = '$imgg' where doc_email = '$useremail';";
                        $database->query($query);
    
                        $query = "update user set user_email = '$emaill' , user_name = '$namee' where user_email = '$useremail';";
                        $database->query($query);
    
                        $_SESSION['email'] = $emaill;
                        $useremail = $emaill;
    
                        $_SESSION['ERROR'] = "Profile Updated Sucessfully !"; 

                        $file_name = $_FILES['image']['name'];
                        $tmp_name = $_FILES['image']['tmp_name'];
                    
                        if(move_uploaded_file($tmp_name,"../../img/Doctor/".$file_name))
                        {
                            echo "file Transfer ";
                        }
                        else
                        {
                            echo "file Not Transfer ";
                        }
                    }
                }
            }
        }
    }
    header('location: profile.php');
}
?>