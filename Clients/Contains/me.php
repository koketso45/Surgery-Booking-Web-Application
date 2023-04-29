<?php
use PHPMailer\PHPMailer\PHPMailer;
include("session.php");
$session_val = $_SESSION['session_email']; 
$output = "";
$highblood = mysqli_real_escape_string($conn,$_POST['highblood']);
$heartdisease = mysqli_real_escape_string($conn,$_POST['heartdisease']);
$cholestrol = mysqli_real_escape_string($conn,$_POST['cholestrol']);
$diabetes = mysqli_real_escape_string($conn,$_POST['diabetes']);
$bleedingdisorder = mysqli_real_escape_string($conn,$_POST['bleedingdisorder']);
$surgery = mysqli_real_escape_string($conn,$_POST['surgery']);
$allergies = mysqli_real_escape_string($conn,$_POST['allergies']);
$pleasespecify = mysqli_real_escape_string($conn,$_POST['pleasespecify']);
$aboutConsultation = mysqli_real_escape_string($conn,$_POST['aboutConsultation']);
$date = date('y/m/d');
$Status = "Submitted";
$paystat = "Awaiting payment";
$amount = "500";
$audience = "Me";


$StatusChec = "SELECT * FROM intake WHERE const_id = 1 AND const_status = 'Open' ";
$StatusRes = mysqli_query($conn, $StatusChec);
if(mysqli_num_rows($StatusRes) > 0){
    $sql = "SELECT * FROM users WHERE u_email = '$session_val' ";
$res = mysqli_query($conn, $sql);
if(mysqli_num_rows($res) > 0){
    while($row = mysqli_fetch_assoc($res)){
        $fullnames = $row['u_fullnames'];
        $lastname = $row['u_lastname'];
        $cellno = $row['u_cellno'];
        $email = $row['u_email'];
        $passport = $row['u_passport'];
        $gender = $row['u_gender'];
        $disab = $row['u_disab'];
        $phyad = $row['u_phyad'];
        $dob = $row['u_dob'];
        $id = $row['u_id'];
    }
    $GetKin = "SELECT * FROM kin WHERE u_id = '$id' ";
    $GetKinRes = mysqli_query($conn, $GetKin);
    if(mysqli_num_rows($GetKinRes) > 0){
        while($row2 = mysqli_fetch_assoc($GetKinRes)){
           $KinID = $row2['k_id'];
        }
        if(empty($passport)){
            $output = "profile data";
        }
        else{
            $ConsultIn = "INSERT INTO  consultations(const_fullnames, const_lastname, const_cellno, const_email, const_passport, const_gender, const_disab, const_physad,
            const_highblood, const_heartdisease, const_cholestrol, const_diabetes, const_bleedingdisord, const_surgery, const_allergies, const_aboutallergies,
            const_aboutconsultation, const_status, const_doc, const_dom, u_id, k_id, const_paystat, const_schedate, const_amodue, const_audi)
            VALUES('$fullnames','$lastname','$cellno','$email','$passport','$gender','$disab','$phyad','$highblood','$heartdisease','$cholestrol'
            ,'$diabetes','$bleedingdisorder','$surgery','$allergies','$pleasespecify','$aboutConsultation','$Status','$date','$date','$id','$KinID','$paystat','Not Yet Scheduled','$amount','$audience')";
            $ConsultInRes = mysqli_query($conn, $ConsultIn);
            if($ConsultInRes){
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
                $output = "added";
             } else {
                $output = "added";
             }
            }
            else{
                $output = "Something went wrong, please try again later";
            }
        }
    }
    else{
        $output = "next of kin";
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