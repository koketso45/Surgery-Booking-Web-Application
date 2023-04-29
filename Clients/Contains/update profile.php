<?php
session_start();
include("config.php");
$session_val = $_SESSION['session_email']; 

$fullnames = mysqli_real_escape_string($conn,$_POST['fullnames']);
$lastname = mysqli_real_escape_string($conn,$_POST['lastname']);
$dob = mysqli_real_escape_string($conn,$_POST['dob']);
$passport = mysqli_real_escape_string($conn,$_POST['passport']);
$gender = mysqli_real_escape_string($conn,$_POST['gender']);
$disabilities = mysqli_real_escape_string($conn,$_POST['disabilities']);
$cellno = mysqli_real_escape_string($conn,$_POST['cellno']);
$address = mysqli_real_escape_string($conn,$_POST['address']);
$output = "";

$sql = "SELECT * FROM users WHERE u_email = '$session_val' ";
$res = mysqli_query($conn, $sql);
if(mysqli_num_rows($res) > 0){
    $update = "UPDATE users
    SET u_fullnames = '$fullnames', u_lastname = '$lastname', u_cellno = '$cellno', u_passport = '$passport',
    u_gender = '$gender', u_disab = '$disabilities', u_phyad = '$address', u_dob = '$dob'
    WHERE u_email = '$session_val' ";
    $updateRes = mysqli_query($conn, $update);
    if($updateRes){
        $output = "updated";
    }
    else{
        $output = "Something went wrong, please try again later";
    }
}
else{
    $output = "Something went wrong, please try again later";
}

echo $output;
?>