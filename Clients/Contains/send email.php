<?php
use PHPMailer\PHPMailer\PHPMailer;
//Call email credidentials
include("credidentials.php");

require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";
require_once "PHPMailer/Exception.php";

$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = "mail.exclusiveabodes.co.za";
$mail->SMTPAuth = true;
$mail->Username = "surgtech@exclusiveabodes.co.za"; //enter you email address
$mail->Password = "@Koki8253"; //enter you email password
$mail->Port = 465;
$mail->SMTPSecure = "ssl";

//Email Settings
$mail->isHTML(true);
$mail->setFrom("surgtech@exclusiveabodes.co.za", "SURGTECH RGISTRATION EMAIL");
$mail->addAddress("koketsobura80@gmail.com"); //enter you email address
$mail->Subject = ("The surgery Account Registration");
$mail->Body = "
Thank you for creating an account with us, please click <a href='http://localhost/Resturant%20Res/client%20side/account verification.php?k=koketsobura80@gmail.com'>here</a> to verify your email.
";

if ($mail->send()) {
 echo "Account registered";
} else {
    echo'Something went wrong, please try again later';
}
?>