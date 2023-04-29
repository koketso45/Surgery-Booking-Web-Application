<?php
include("config.php");
date_default_timezone_set("Africa/Johannesburg");
session_start();
if(isset($_SESSION['session_email'])){
    if((time() - $_SESSION['last_login_timestamp']) > 900) {// 900 = 15 * 60  
        session_destroy();  
        header("Location:../sign in.php"); 
    }
    else  
    {  
         $_SESSION['last_login_timestamp'] = time();
    } 
}