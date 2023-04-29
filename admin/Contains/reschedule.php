<?php
use PHPMailer\PHPMailer\PHPMailer;
include("session.php");
$session_val = $_SESSION['session_email']; 

$ScheduleDate = mysqli_real_escape_string($conn,$_POST['ScheduleDate']);
$ScheduleTime = mysqli_real_escape_string($conn,$_POST['ScheduleTime']);
$bookingID = mysqli_real_escape_string($conn,$_POST['bookingID']);
$output = "";
$currentDate = date("m/d/y");
$date = date('m/d/y', strtotime($ScheduleDate)); //mm-dd-yyyy

if($date <= $currentDate){
    $output = "Date can not be in the past or equal to current date";
}
else{
    $check = "SELECT * FROM consultations WHERE const_schedate = '$date' AND const_schedtime = '$ScheduleTime' ";
    $checkRes = mysqli_query($conn, $check);
    if(mysqli_num_rows($checkRes) > 0){
        $output = "Date & time has a booking already, please choose a different date & time";
    }
    else{
        $sql = "SELECT * FROM consultations WHERE const_id = '$bookingID'";
        $res = mysqli_query($conn, $sql);
        if(mysqli_num_rows($res) > 0){
            while($Y = mysqli_fetch_assoc($res)){
                $SenderEmail = $Y['const_email'];
            }
        $update = "UPDATE consultations SET const_schedate = '$date', const_schedtime = '$ScheduleTime' 
        WHERE const_id = '$bookingID' ";
        $updateRes = mysqli_query($conn, $update);
        if($updateRes){

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
        $mail->addAddress($SenderEmail); //enter you email address
        $mail->Subject = ("The surgery Consultation Rescheduled");
        $mail->Body = "
        <i>----------<br/>
             Please do not reply to this email as the maibox is unattended. This email is to remind you that
             you have sumbitted a consultation and you have 24 hours to pay or it will be revoked by the system. 
             <br/>----------</i><br>
             <br>
            Dear client<br/><br/>
            This email is to notify you that your booking <b>#$bookingID</b> has been rescheduled to <b>$ScheduleDate, $ScheduleTime</b> sorry for the incovienced caused.
            <br/><br/>
            Regards<br/>
            <b>SurgTech Support Team</b>

        "; 

        if ($mail->send()) {
            $output = "updated";
        } else {
            $output = "updated";
        }

        }
        else{
        $output = "Somthing went wrong, please try again later";
        }

    }
}
}

echo $output;
?>