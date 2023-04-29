<?php
use PHPMailer\PHPMailer\PHPMailer;
include("config.php");
$token = mysqli_real_escape_string($conn,$_POST['token']);
$password = mysqli_real_escape_string($conn,$_POST['password']);
$confirmpassword = mysqli_real_escape_string($conn,$_POST['confirmpassword']);
$email = mysqli_real_escape_string($conn,$_POST['email']);
$output = "";
$sql = "SELECT * FROM rest WHERE r_token = '$token' AND r_status = 'Pending' ";
$res = mysqli_query($conn, $sql);

if(mysqli_num_rows($res) > 0){
    //check if the email exits in either one of the two tables
    $check1 = "SELECT * FROM users WHERE u_email = '$email' ";
    $check1Res = mysqli_query($conn, $check1);

    $check2 = "SELECT * FROM employees WHERE emp_email = '$email' ";
    $check2Res = mysqli_query($conn, $check2);

    if(mysqli_num_rows($check1Res) > 0){
        $update = "UPDATE users
        SET u_password = '$confirmpassword'
        WHERE u_email = '$email' ";
        $updateRes = mysqli_query($conn, $update);
        if($updateRes){
            $updateToken1 = "UPDATE rest
            SET r_status = 'Redeemed'
            WHERE r_token = '$token' ";
            $updateToken1Res = mysqli_query($conn, $updateToken1);
            if($updateToken1Res){
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
        $mail->Subject = ("The surgery Password Update");
        $mail->Body = "
        Your password has been updated successfully.<br><br>
        If this is not you please send an email to support@thesurgery.co.za for assistance.<br><br>
        Reagrds<br>
        <b>Support Team</b>
        ";

        if ($mail->send()) {
            $output = "Updated";
        } else {
            $output = 'Something went wrong, please try again later';
        }
            }
            else{
                $output = 'Something went wrong, please try again later';
            }
        }
        else{
            $output = "Something went wrong, please try again later";
        }
    }else if(mysqli_num_rows($check2Res) > 0){
        $update2 = "UPDATE employees
        SET emp_password = '$confirmpassword'
        WHERE emp_email = '$email' ";
        $update2Res = mysqli_query($conn, $update2);
        if($update2Res){
            $updateToken2 = "UPDATE rest
            SET r_status = 'Redeemed'
            WHERE r_token = '$token' ";
            $updateToken2Res = mysqli_query($conn, $updateToken2);
            if($updateToken2Res){
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
        $mail->setFrom($email, $name);
        $mail->addAddress($email); //enter you email address
        $mail->Subject = ("The surgery Password Update");
        $mail->Body = "
        Your password has been updated successfully.<br><br>
        If this is not you please send an email to support@thesurgery.co.za for assistance.<br><br>
        Reagrds<br>
        <b>Support Team</b>
        ";

        if ($mail->send()) {
            $output = "Updated";
        } else {
            $output = 'Something went wrong, please try again later';
        }
            }
            else{
                $output = 'Something went wrong, please try again later';
            }

        }
        else{
            $output = "Something went wrong, please try again later";
        }
    }
    else{
        $output = "Email is not registered to any account";
    }
}
else{
    $output = "Token not found, please try again later";
}
echo $output;
?>