<?php
use PHPMailer\PHPMailer\PHPMailer;
include("session.php");
$session_val = $_SESSION['session_email']; 

$output = "";
$fullnames = mysqli_real_escape_string($conn,$_POST['fullnames']);
$lastname = mysqli_real_escape_string($conn,$_POST['lastname']);
$dob = mysqli_real_escape_string($conn,$_POST['dob']);
$gender = mysqli_real_escape_string($conn,$_POST['gender']);
$disab = mysqli_real_escape_string($conn,$_POST['disabilities']);
$email = mysqli_real_escape_string($conn,$_POST['email']);
$cellno = mysqli_real_escape_string($conn,$_POST['cellno']);
$phyad = mysqli_real_escape_string($conn,$_POST['address']);
$passport = mysqli_real_escape_string($conn,$_POST['passport']);
$highblood = mysqli_real_escape_string($conn,$_POST['highblood2']);
$heartdisease = mysqli_real_escape_string($conn,$_POST['heartdisease2']);
$cholestrol = mysqli_real_escape_string($conn,$_POST['cholestrol2']);
$diabetes = mysqli_real_escape_string($conn,$_POST['diabetes2']);
$bleedingdisorder = mysqli_real_escape_string($conn,$_POST['bleedingdisorder2']);
$surgery = mysqli_real_escape_string($conn,$_POST['surgery2']);
$allergies = mysqli_real_escape_string($conn,$_POST['allergies2']);
$pleasespecify = mysqli_real_escape_string($conn,$_POST['pleasespecify2']);
$aboutConsultation = mysqli_real_escape_string($conn,$_POST['aboutConsultation2']);
$date = date('y/m/d');
$Status = 'Submitted';
$paystat = 'Awaiting payment';
$amount = '500';
$audience = 'Someone';

$StatusCheck = "SELECT * FROM intake WHERE const_id = 1 AND const_status = 'Open' ";
$StatusRes = mysqli_query($conn, $StatusCheck);
if(mysqli_num_rows($StatusRes) > 0){
$sql = "SELECT * FROM users WHERE u_email = '$session_val' ";
$res = mysqli_query($conn, $sql);
if(mysqli_num_rows($res) > 0){
    while($row = mysqli_fetch_assoc($res)){
        $id = $row['u_id'];
        $chenn = $row['u_passport'];
    }
    $GetKin = "SELECT * FROM kin WHERE u_id = '$id' ";
    $GetKinRes = mysqli_query($conn, $GetKin);
    if(mysqli_num_rows($GetKinRes) > 0){
        if(empty($chenn)){
            $output = "Please update your profile before booling a consultation. <a id='refresh' href='profile.php'>Update profile</a>";
        }
        else{

            while($row2 = mysqli_fetch_assoc($GetKinRes)){
                $KinID = $row2['k_id'];
             }
                 $ConsultIn = "INSERT INTO consultations(const_fullnames, const_lastname, const_cellno, const_email, const_passport, const_gender, const_disab, const_physad,
                 const_highblood, const_heartdisease, const_cholestrol, const_diabetes, const_bleedingdisord, const_surgery, const_allergies, const_aboutallergies,
                 const_aboutconsultation, const_status, const_doc, const_dom, u_id, k_id, const_paystat,const_schedate, const_amodue, const_audi)VALUES('$fullnames','$lastname','$cellno','$email','$passport','$gender','$disab','$phyad','$highblood','$heartdisease','$cholestrol','$diabetes','$bleedingdisorder','$surgery','$allergies','$pleasespecify','$aboutConsultation','$Status','$date','$date','$id','$KinID','$paystat','Not Yet Scheduled','$amount','$audience')";
                 $ConsultInRes = mysqli_query($conn, $ConsultIn);
                 if($ConsultInRes){
                     //Email notification starts here
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
             $mail->addAddress($session_val); //enter you email address
             $mail->Subject = ("SurgTech consultation information");
             $mail->Body = "
             <i>----------<br/>
             Please do not reply to this email as the maibox is unattended. This email is to remind you that
             you have sumbitted a consultation and you have 24 hours to pay or it will be revoked by the system. 
             <br/>----------<i/><br>
             <br>
            Dear: <b>$lastname</b><br/>
            Below is your consulatation booking information.<br/><br>
            <table style='border-collapse: collapse;width: 100%;margin-top: 0px;'>
                   <thead style='background-color:blue;color:#ffff;'>
                     <th style='border: 1px solid #dddddd;
                     text-align: left;
                     padding: 8px;
                     position: relative;'>Health Related Questions</th>
                     <th style='border: 1px solid #dddddd;
                     text-align: left;
                     padding: 8px;
                     position: relative;'>Answers</th>
                   </thead>
                   <tbody>
                     <tr>
                       <td style='border: 1px solid #dddddd;
                       text-align: left;
                       padding: 8px;
                       position: relative;'>Do you have high blood</td>
                       <td style='border: 1px solid #dddddd;
                       text-align: left;
                       padding: 8px;
                       position: relative;'>$highblood</td>
                     </tr>
                     <tr>
                       <td style='border: 1px solid #dddddd;
                       text-align: left;
                       padding: 8px;
                       position: relative;'>Do you have a heart disease</td>
                       <td style='border: 1px solid #dddddd;
                       text-align: left;
                       padding: 8px;
                       position: relative;'>$heartdisease</td>
                     </tr>
                     <tr>
                       <td style='border: 1px solid #dddddd;
                       text-align: left;
                       padding: 8px;
                       position: relative;'>Do you have a high cholestrol</td>
                       <td style='border: 1px solid #dddddd;
                       text-align: left;
                       padding: 8px;
                       position: relative;'>$cholestrol</td>
                     </tr>
                     <tr>
                       <td style='border: 1px solid #dddddd;
                       text-align: left;
                       padding: 8px;
                       position: relative;'>Do you have diabetes</td>
                       <td style='border: 1px solid #dddddd;
                       text-align: left;
                       padding: 8px;
                       position: relative;'>$diabetes</td>
                     </tr>
                     <tr>
                       <td style='border: 1px solid #dddddd;
                       text-align: left;
                       padding: 8px;
                       position: relative;'>Do you have a bleeding disorder</td>
                       <td style='border: 1px solid #dddddd;
                       text-align: left;
                       padding: 8px;
                       position: relative;'>$bleedingdisorder</td>
                     </tr>
                     <tr>
                       <td style='border: 1px solid #dddddd;
                       text-align: left;
                       padding: 8px;
                       position: relative;'>Have you undergone surgery</td>
                       <td style='border: 1px solid #dddddd;
                       text-align: left;
                       padding: 8px;
                       position: relative;'>$surgery</td>
                     </tr>
                     <tr>
                       <td style='border: 1px solid #dddddd;
                       text-align: left;
                       padding: 8px;
                       position: relative;'>Do you have any allergies</td>
                       <td style='border: 1px solid #dddddd;
                       text-align: left;
                       padding: 8px;
                       position: relative;'>$allergies</td>
                     </tr>
                     </tbody>
                   </table>
                   <br/>
                   Allergies explainded: $pleasespecify<br/>
                   Reason for consultation: $aboutConsultation<br/><br/>
                   
                   Regards<br/>
                   <b>SurgTech Support Team</b>
             ";
     
             if ($mail->send()) {
                 $output = "submitted";
             } else {
                 $output = "submitted";
             }
     
                 }
                 else{
                     $output = "Something went wrong, please try again later2";
                 }

        }

    }
    else{
    $output = "Please add your next of kin before you book a consultation. <a id='refresh' href='next of kin.php'>Add next of kin</a>";
    }

}
else{
    $output = "Something went wrong, please try again later";
}
}
else{
    $output = "Consultation process has been suspended, it may be due to a high number of consultation. Thank you";
}

echo $output;
?>