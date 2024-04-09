<?php

    $database= new mysqli("localhost","root","","ehealthcare1");
    if ($database->connect_error){
         die("Connection failed:  ".$database->connect_error);
    }
?>