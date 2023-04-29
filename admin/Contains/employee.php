<?php
use PHPMailer\PHPMailer\PHPMailer;
include("session.php");
$session_val = $_SESSION['session_email']; 
$ID = mysqli_real_escape_string($conn,$_POST['ID']);
$status = mysqli_real_escape_string($conn,$_POST['status']);
$output = "";

$sql = "SELECT * FROM employees WHERE emp_email = '$ID' ";
$res = mysqli_query($conn, $sql);
if(mysqli_num_rows($res) > 0){
    while($row = mysqli_fetch_assoc($res)){
        $email = $row['emp_email'];
        $DBstatus = $row['emp_status'];
    }
    if($DBstatus == "Activated" && $status == "Activated"){
        $output = "Account is already Activated";
    }
    else if($DBstatus == "Suspended" && $status == "Suspended"){
        $output = "Account is already suspended";
    }
    else if($DBstatus == "Deleted" && $status == "Deleted"){
        $output = "Account is already deleted";
    }
    else{
    $update = "UPDATE employees SET emp_status = '$status' WHERE emp_email = '$ID'";
    $updateRes = mysqli_query($conn, $update);
    if($updateRes){
        
        //Email to users about account status
        if($status == "Activated"){
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
            $mail->Subject = ("The Surgtech Account Status");
            $mail->Body = "
            <i>----------<br/>
                 Please do not reply to this email as the maibox is unattended. 
                 <br/>----------</i><br>
                 <br>
                Dear employee<br/><br/>
                Your acount has been <b>Activated</b>, for enquiries please contact support@surgtech.co.za
                <br/><br/>
                Regards<br/>
                <b>SurgTech Support Team</b>
    
            "; 
    
            if ($mail->send()) {
                $output = "Account status updated successfully, <a href='#!'id='refresh'>Refresh page</a>";
            } else {
                $output = "Account status updated successfully, <a href='#!'id='refresh'>Refresh page</a>";
            }
        }
        else if($status == "Suspended"){
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
            $mail->Subject = ("The Surgtech Account Status");
            $mail->Body = "
            <i>----------<br/>
                 Please do not reply to this email as the maibox is unattended. 
                 <br/>----------</i><br>
                 <br>
                Dear employee<br/><br/>
                Your acount has been <b>Suspended</b>, for enquiries please contact support@surgtech.co.za
                <br/><br/>
                Regards<br/>
                <b>SurgTech Support Team</b>
    
            "; 
    
            if ($mail->send()) {
                $output = "Account status updated successfully, <a href='#!'id='refresh'>Refresh page</a>";
            } else {
                $output = "Account status updated successfully, <a href='#!'id='refresh'>Refresh page</a>";
            }
        }
        else{
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
            $mail->Subject = ("The Surgtech Account Status");
            $mail->Body = "
            <i>----------<br/>
                 Please do not reply to this email as the maibox is unattended. 
                 <br/>----------</i><br>
                 <br>
                Dear employee<br/><br/>
                Your acount has been <b>Deleted</b>, for enquiries please contact support@surgtech.co.za
                <br/><br/>
                Regards<br/>
                <b>SurgTech Support Team</b>
    
            "; 
    
            if ($mail->send()) {
                $output = "Account status updated successfully, <a href='#!'id='refresh'>Refresh page</a>";
            } else {
                $output = "Account status updated successfully, <a href='#!'id='refresh'>Refresh page</a>";
            }
        }
    }
    else{
        $output = "Something went wrong, please try again later";
    }
    }
}
else{
    $output = "Something went wrong, please try again later";
}

echo $output;
?>