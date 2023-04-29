<?php
use PHPMailer\PHPMailer\PHPMailer;
include("config.php");
$fullnames = mysqli_real_escape_string($conn,$_POST['fullnames']);
$lastname = mysqli_real_escape_string($conn,$_POST['lastname']);
$cellnumber = mysqli_real_escape_string($conn,$_POST['cellnumber']);
$email = mysqli_real_escape_string($conn,$_POST['email']);
$password = mysqli_real_escape_string($conn,$_POST['password']);
$confirmpassword = mysqli_real_escape_string($conn,$_POST['confirmpassword']);
$status = "Deactivated";
$output = "";
$date = date("y/m/d");

$check = "SELECT * FROM users WHERE u_email = '$email' ";
$check_query = mysqli_query($conn, $check);

if(mysqli_num_rows($check_query) > 0){
    $output = "Email exist";
}
else{
    $sql = "INSERT INTO users(u_fullnames, u_lastname, u_cellno, u_email, u_password, u_doc, u_status)
    VALUES ('$fullnames','$lastname','$cellnumber','$email','$password','$date', '$status')";
    $res = mysqli_query($conn, $sql);

    if($res){
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
        $mail->Subject = ("The surgery Account Registration");
        $mail->Body = "
        Thank you for creating an account with us, please click <a href='http://localhost/Semester project/verify.php?k=$email'>here</a> to verify your email.
        ";

        if ($mail->send()) {
            $output = "Account registered";
        } else {
            $output = 'Something went wrong, please try again later email';
        }
    } 
    else{
        $output = "Something went wrong, please try again later";
    }
}


echo $output;
?>