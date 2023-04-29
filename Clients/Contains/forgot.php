<?php
use PHPMailer\PHPMailer\PHPMailer;
include("config.php");
$email = mysqli_real_escape_string($conn,$_POST['email']);
$date = date("y/m/d");
$output = "";
$uniqueID = uniqid();

//Check the first table being users if the email is registered and activated
$check1 = "SELECT * FROM users WHERE u_email = '$email' AND u_status = 'Activated' ";
$check1Res = mysqli_query($conn, $check1);

//Check the second table being employees if the email is registred and activated
$check2 = "SELECT * FROM employees WHERE emp_email = '$email' AND emp_status = 'Activated' ";
$check2Res = mysqli_query($conn, $check2);


if(mysqli_num_rows($check1Res) > 0){
    $sql1 = "INSERT INTO rest(r_token, r_doc, r_status, r_email)VALUES('$uniqueID', '$date','Pending','$email')";
    $res1 = mysqli_query($conn, $sql1);
    if($res1){
        //Call email credidentials
        include("credidentials.php");

        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $host;
        $mail->SMTPAuth = true;
        $mail->Username = $username; //enter you email address
        $mail->Password = $UserPass; //enter you email password
        $mail->Port = 465;
        $mail->SMTPSecure = "ssl";

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($username, $name);
        $mail->addAddress($email); //enter you email address
        $mail->Subject = ("The surgery Password Recovery");
        $mail->Body = "
        You have requested to change your account password, please click <a href='http://localhost/Semester Project/new password.php?k=$uniqueID&e=$email'>here</a> to 
        change your password. If this is not you, please ignore this email. <br><br>
        Or copy and paste this link on your browser: http://localhost/Semester Project/new password.php?k=$uniqueID&e=$email
        ";

        if ($mail->send()) {
            $output = "Email sent";
        } else {
            $output = "Email sent";
        }
    }
    else{
        $output = "Something went wrong, please try again later";
    }
}
else if(mysqli_num_rows($check2Res) > 0){
    $sql2 = "INSERT INTO rest(r_token, r_doc, r_status, r_email)VALUES('$uniqueID', '$date','Pending','$email')";
    $res2 = mysqli_query($conn, $sql2);
    if($res2){
        //Call email credidentials
        include("credidentials.php");

        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $host;
        $mail->SMTPAuth = true;
        $mail->Username = $username; //enter you email address
        $mail->Password = $UserPass; //enter you email password
        $mail->Port = 465;
        $mail->SMTPSecure = "ssl";

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($username, $name);
        $mail->addAddress($email); //enter you email address
        $mail->Subject = ("The surgery Password Recovery");
        $mail->Body = "
        You have requested to change your account password, please click <a href='http://localhost/Semester Project/new password.php?k=$uniqueID&e=$email'>here</a> to 
        change your password. If this is not you, please ignore this email. <br><br>
        Or copy and paste this link on your browser: http://localhost/Semester Project/new password.php?k=$uniqueID&e=$email
        ";

        if ($mail->send()) {
            $output = "Email sent";
        } else {
            $output = "Email sent nnn";
        }
    }
    else{
        $output = "Something went wrong, please try again later";
    }
}
else{
    $output = "Email is not registered to any account";
}

echo $output;
?>