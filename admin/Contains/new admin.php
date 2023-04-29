<?php
use PHPMailer\PHPMailer\PHPMailer;
include("session.php");
$session_val = $_SESSION['session_email']; 
$fullnames = mysqli_real_escape_string($conn,$_POST['fullnames']);
$lastname = mysqli_real_escape_string($conn,$_POST['lastname']);
$email = mysqli_real_escape_string($conn,$_POST['email']);
$cellno = mysqli_real_escape_string($conn,$_POST['cellno']);
$position= mysqli_real_escape_string($conn,$_POST['position']);
$output = "";
$date = date("m/d/y");

//GENERATE PASSWORD FOR OWNER
$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789@#$%&";
$prefix = "PA-";
$generated = substr(str_shuffle($string),0,6);
$password = $prefix.''.$generated;


$sql = "SELECT * FROM employees WHERE emp_email = '$email'";
$res = mysqli_query($conn, $sql);
if(mysqli_num_rows($res) > 0){
    $output = "Email address already has an account";
}
else{
    $Get = "INSERT INTO employees(emp_fullnames,emp_lastname,emp_email,emp_cellno,emp_position,emp_status,emp_doc,emp_dom,emp_password)
    VALUES('$fullnames','$lastname','$email','$cellno','$position','Deactivated','$date','$date''1010','$password ')";
    $GetRes = mysqli_query($conn, $Get);
    if($GetRes){
        
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
        $mail->Subject = ("The Surgery New Employee");
        $mail->Body = "
        <i>----------<br/>
             Please do not reply to this email as the maibox is unattended. 
             <br/>----------</i><br>
             <br>
            Dear Employee welcome to Surgtech<br/><br/>
            Your account has been created successfully, your username is your $email & password is $password. To activate your
            account please click <a href='http://localhost/Semester%20project/verify.php?k=$email'>here</a> <br/><br/>
            or copy and paste this link in your browser: http://localhost/Semester%20project/verify.php?k=$email
            <br/><br/>
            Regards<br/>
            <b>SurgTech Support Team</b>

        "; 

        if ($mail->send()) {
            $output = "added";
        } else {
            $output = "added";
        }
    }
    else{
        $output = "Something went wrong, please try again later";
    }
}
echo $output;
?>