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
$email = mysqli_real_escape_string($conn,$_POST['email']);
$output = "";
$date = date("y/m/d");

$select = "SELECT * FROM users WHERE u_email = '$session_val' ";
$selectRes = mysqli_query($conn, $select);

if(mysqli_num_rows($selectRes) > 0){
  while($mdata = mysqli_fetch_assoc($selectRes)){
    $userID = $mdata['u_id'];
  }

  $sql = "SELECT * FROM kin WHERE u_id = '$userID' ";
$res = mysqli_query($conn, $sql);
if(mysqli_num_rows($res) > 0){
    $update = "UPDATE kin
    SET k_fullnames = '$fullnames', k_lastname = '$lastname', k_cellno = '$cellno', k_email = '$email', k_passport = '$passport',
    k_gender = '$gender', k_disab = '$disabilities', k_phyad = '$address', k_dob = '$dob', k_doc = '$date', u_id = '$userID' 
    WHERE u_id = '$userID' ";
    $updateRes = mysqli_query($conn, $update);
    if($updateRes){
        $output = "updated";
    }
    else{
        $output = "Something went wrong, please try again later";
    }
}
else{
    $insertNew = "INSERT INTO kin(k_fullnames, k_lastname, k_cellno, k_email, k_passport, k_gender, k_disab, k_phyad, k_dob, k_doc, u_id)
    VALUES('$fullnames','$lastname','$cellno', '$email', '$passport', '$gender','$disabilities','$address', '$dob','$date', '$userID')";
    $insertNewRes = mysqli_query($conn, $insertNew);
    if($insertNewRes){
        $output = "updated";
    }
    else{
        $output = "Something went wrong, please try again later";
    }
}

}


echo $output;
?>