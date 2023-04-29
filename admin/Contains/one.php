<?php
use PHPMailer\PHPMailer\PHPMailer;
include("session.php");
$session_val = $_SESSION['session_email']; 
$output = "";

$bookingID2 = mysqli_real_escape_string($conn,$_POST['bookingID2']);
$BookingStatus = mysqli_real_escape_string($conn,$_POST['BookingStatus']);

$sql = "SELECT * FROM consultations WHERE const_id = '$bookingID2'";
$res = mysqli_query($conn, $sql);
if(mysqli_num_rows($res) > 0){
    while($row = mysqli_fetch_assoc($res)){
        $SenderEmail = $row['const_email'];
        $status = $row['const_email'];
    }
    if($status == "Completed" && $BookingStatus == "Completed"){
        $output = "Booking has already been marked as completed ";
    }
    else if($status == "Submitted" && $BookingStatus == "Submitted"){
        $output = "Booking has already been marked as submitted ";
    }
    else{
        if($BookingStatus == "Completed"){
            $updateCompl = "UPDATE consultations SET const_status = '$BookingStatus' WHERE const_id = '$bookingID2' ";
            $updateComplRes = mysqli_query($conn, $updateCompl);
            if($updateComplRes){
                //Email goes here
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
        $mail->Subject = ("The surgery Consultation Completion");
        $mail->Body = "
        <i>----------<br/>
             Please do not reply to this email as the maibox is unattended. 
             <br/>----------</i><br>
             <br>
            Dear client<br/><br/>
            Thank you for using our services, Booking consultation  <b>#$bookingID2</b> has been completed successfully.
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
                $output = "Something went wrong, please try again later";
            }

        }
        else{
            $updateCompl = "UPDATE consultations SET const_status = '$BookingStatus' WHERE const_id = '$bookingID2' ";
            $updateComplRes = mysqli_query($conn, $updateCompl);
            if($updateComplRes){
                //Email goes here
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
        $mail->Subject = ("The surgery Consultation Completion");
        $mail->Body = "
        <i>----------<br/>
             Please do not reply to this email as the maibox is unattended. 
             <br/>----------</i><br>
             <br>
            Dear client<br/><br/>
            Booking consultation <b>#$bookingID2</b> status has been changed from completed to <b>Submitted</b>.<br/>
            This may be caused by system failure or the admin office, for enquires please contact support@surgtech.co.za
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
                $output = "Something went wrong, please try again later";
            }
        }
    }
}
else{
    $output = "Something went wrong, please try again later";
}

echo $output;
?>