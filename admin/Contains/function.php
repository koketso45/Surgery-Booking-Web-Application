<?php
include("session.php");
$session_val = $_SESSION['session_email']; 

$OpenAndClose = mysqli_real_escape_string($conn,$_POST['OpenAndClose']);
$output = "";
$date = date("m/d/y");

//Fetch userID from DB
$fetchID = "SELECT * FROM employees WHERE emp_email = '$session_val' ";
$fetchIDRes = mysqli_query($conn, $fetchID);
if(mysqli_num_rows($fetchIDRes) > 0){
    while($roww = mysqli_fetch_assoc($fetchIDRes)){
        $USERID = $roww['emp_id'];
    }
    //Get data from intake table
    $getIntake = "SELECT * FROM intake WHERE const_id = 1";
    $getIntakeRes = mysqli_query($conn, $getIntake);
    if(mysqli_num_rows($getIntakeRes) > 0){
        while($row2 = mysqli_fetch_assoc($getIntakeRes)){
            $INATAKE_status = $row2['const_status'];
            $INATAKE_ID = $row2['const_id'];
        }
    }
    if($INATAKE_status == "Open" && $OpenAndClose == "Open"){
        $output = "Consultation intake are already open";
    }
    else if($INATAKE_status == "Close" && $OpenAndClose == "Open"){
        $sql = "UPDATE intake SET const_status = 'Open', cosnt_mod ='$date',emp_email = '$session_val', emp_id = '$USERID'
        WHERE const_id = 1 "; 
        $res = mysqli_query($conn, $sql);
        if($res){
        $output = "Open";
        }
        else{
        $output = "Something went wrong, please try again later";
        }
    }
    else if($INATAKE_status == "Close" && $OpenAndClose == "Close"){
        $output = "Consultation intake are already closed";
    }
    else if($INATAKE_status == "Open" && $OpenAndClose == "Close"){
        $sql2 = "UPDATE intake SET const_status = 'Close', cosnt_mod ='$date',emp_email = '$session_val', emp_id = '$USERID' 
        WHERE const_id = 1"; 
        $res2 = mysqli_query($conn, $sql2);
        if($res2){
        $output = "Close";
        }
        else{
        $output = "Something went wrong, please try again later";
        }
    }
    else{
        $output = "Contact support";
    }
} 
echo $output;


?>