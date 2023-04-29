<?php
include("config.php");

$email = mysqli_real_escape_string($conn,$_POST['email']);
$password = mysqli_real_escape_string($conn,$_POST['password']);
$output = "";

//Check if the credidentials matches the registered users table
$sql = "SELECT * FROM users WHERE u_email = '$email' AND u_password = '$password' AND u_status = 'Activated' ";
$res = mysqli_query($conn, $sql);

//Check if the credidentials matches the employees table
$sql2 = "SELECT * FROM employees WHERE emp_email = '$email' AND emp_password = '$password' AND emp_status = 'Activated' ";
$res2 = mysqli_query($conn, $sql2);

if(mysqli_num_rows($res) > 0){
    session_start();
    $_SESSION['session_email'] = $email;
    $_SESSION['last_login_timestamp'] = time();
    $output = "users";
}
else if(mysqli_num_rows($res2) > 0){
    while($row = mysqli_fetch_assoc($res2)){
        $position = $row['emp_position'];
    }
    session_start();
    $_SESSION['session_email'] = $email;
    $_SESSION['session_position'] = $position;
    $_SESSION['last_login_timestamp'] = time();
    $output = "employee";
}
else{
    $output = "Credidentials not found";
}

echo $output;
?>