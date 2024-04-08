 
<?php 
if(isset($_GET)){
    
    $action = $_GET['action'];
    $id = $_GET['id'];

    if($action == "Done")
    {
       header('location: ../php/booking.php?action=add&id='.$id.'');
    }
    else
    {
        header('location: ../booksession.php?action=book&id='.$id.'');
    }
}
?>