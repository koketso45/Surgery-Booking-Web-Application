<?php
include("config.php");
session_start();

if(isset($_SESSION['session_email'])){
    session_destroy();  
    header("Location:../../sign in.php"); 
}
else{
    session_destroy();  
    header("Location:../../sign in.php"); 
}
?>  