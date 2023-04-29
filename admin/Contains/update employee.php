<?php
use PHPMailer\PHPMailer\PHPMailer;
include("session.php");
$session_val = $_SESSION['session_email']; 

$fullnames = mysqli_real_escape_string($conn,$_POST['fullnames']);
$lastname = mysqli_real_escape_string($conn,$_POST['lastname']);
$provider = mysqli_real_escape_string($conn,$_POST['provider']);
$cellno = mysqli_real_escape_string($conn,$_POST['cellno']);
$position = mysqli_real_escape_string($conn,$_POST['position']);
$output = "";
$date = date("m/d/y");

$sql = "UPDATE employees SET emp_fullnames = '$fullnames',emp_lastname = '$lastname',emp_cellno = '$cellno', emp_position = '$position' WHERE emp_email = '$provider'   ";
$res = mysqli_query($conn, $sql);
if($res){
    $output = "updated";
}
else{
    $output = "Something went wrong, please try again later";
}

echo $output;
?>