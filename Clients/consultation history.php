<?php
use PHPMailer\PHPMailer\PHPMailer;
include("Contains/session.php");
$session_val = $_SESSION['session_email'];
if(isset($_GET['pay'])){
  $payVal = $_GET['pay'];
  $PaySql = "SELECT * FROM consultations WHERE const_id = '$payVal' AND const_paystat = 'Awaiting payment' ";
  $payValRes = mysqli_query($conn, $PaySql);
  if(mysqli_num_rows($payValRes) > 0){
    $UpdatePay = "UPDATE consultations SET const_paystat = 'Paid' WHERE const_id = '$payVal' ";
    $UpdatePayRes = mysqli_query($conn, $UpdatePay);
    if($UpdatePayRes){
      include("Contains/credidentials.php");
     
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
             $mail->Subject = ("SurgTech Payment Confirmation");
             $mail->Body = "
             <i>----------<br/>
             Please do not reply to this email as the maibox is unattended. 
             <br/>----------</i><br>
             <br>
            Dear client<br><br>
            Thank you for paying booking consultation <b>#$payVal</b>, your consultation date and time will be
            allocated as soon as possible<br><br>
                   Regards<br/>
                   <b>SurgTech Support Team</b>
             ";
     
             if ($mail->send()) {
              echo "<script type='text/javascript'>alert('Booking #$payVal paid successfully');</script>";
             } else {
              echo "<script type='text/javascript'>alert('Booking #$payVal paid successfully');</script>";
             }
    }
    else{
      echo "<script type='text/javascript'>alert('Something went wrong, please try again later');</script>";
    }
  }
  else{

  }
}
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Consultation History | The Surgery</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="CSS/dashboard.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="CSS/profile.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="CSS/upload.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="CSS/consultation.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="CSS/link.css?v=<?php echo time(); ?>">
  </head>
  <body>
		
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
	          <i class="fa fa-bars"></i>
	          <span class="sr-only">Toggle Menu</span>
	        </button>
        </div>
				<div class="p-4 pt-5">
		  		<h1><a href="index.html" class="logo">SurgTech.</a></h1>
	        <ul class="list-unstyled components mb-5">
	          <li>
              <a href="profile.php">Profile</a>
	          </li>
	          <li>
              <a href="next of kin.php">Next of kin</a>
	          </li>
			  <li>
				<a href="book consultation.php">Book consultation</a>
			  </li>
              <li>
                <a href="consultation status.php">Consultation status</a>
              </li>
			  <li>
				<a href="upload documents.php">Upload documents</a>
			  </li>
			  <li>
				<a href="Contains/sign out.php">Sign Out</a>
			  </li>
	        </ul>

    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5">

        <h2 class="mb-0">Consultation Information</h2>
        <p class="justify">This is your consultation information, booking status, and payment status. On this page you are allowed to
            pay your consultation. Note that if you dont pay your consulation booking fee, your consulation won't be consired at all.  
        </p>
        <h4 class="mb-4">Personal Information</h4>
        <?php
        if(isset($_GET['ref'])){
          $reference = $_GET['ref'];
          $sql = "SELECT * FROM consultations WHERE const_id = '$reference' ";
          $res = mysqli_query($conn, $sql);
          if(mysqli_num_rows($res) > 0){
            while($row = mysqli_fetch_assoc($res)){
              echo"
              <p>Consultation for: ".$row['const_audi']."<br>
              Full Names: ".$row['const_fullnames']."<br>
              Last Name: ".$row['const_lastname']."<br/>
              Identification/Passport No: ".$row['const_passport']."<br/>
              Gender: ".$row['const_gender']." <br>
             Email Address: ".$row['const_email']." <br>
             Phone No: ".$row['const_cellno']."<br>
             Address: ".$row['const_physad']." <br>
             Disabilities: ".$row['const_disab']."
             </p>
            <h4 class='mb-4'>Health Questions</h4>
            <p>
            High blood: ".$row['const_highblood']." <br>
            Heart Disease: ".$row['const_heartdisease']."<br>
            High Cholestrol: ".$row['const_cholestrol']."<br>
            Diabetes: ".$row['const_diabetes']."<br>
            Bleeding Disorder: ".$row['const_bleedingdisord']."<br>
            Undergone surgery: ".$row['const_surgery']."<br>
            Allergies: ".$row['const_allergies']."<br>
            Reason for allergies: ".$row['const_aboutallergies']."<br>
            Explain your consulation: ".$row['const_aboutconsultation']."<br>
            </p>
            <h4 class='mb-4'>Booking Information</h4>
            <p>
            Booking Reference: #".$row['const_id']."<br>
            Amount Due: <b>R".$row['const_amodue'].",00</b> <br>
            Payment Status: ".$row['const_paystat']." <br>
            Booking status: ".$row['const_status']." <br/>
            Scheduled date & time: <b>".$row['const_schedate'].", ".$row['const_schedtime']."</b>
            </p>

              ";
              if($row['const_paystat'] == "Awaiting payment"){
                echo"<a class='payy' href='consultation history.php?ref=".$row['const_id']."&pay=".$row['const_id']."'>Pay</a>";
              }
            }
          }
          else{
            echo"
              <p>Consultation for: <br>
              Full Names: <br>
              Last Name: <br/>
              Identification/Passport No: <br/>
              Gender: <br>
             Email Address:  <br>
             Phone No: <br>
             Address: <br>
             Disabilities: 
             </p>
            <h4 class='mb-4'>Health Questions</h4>
            <p>
            High blood: <br>
            Heart Disease: <br>
            High Cholestrol: <br>
            Diabetes: <br>
            Bleeding Disorder: <br>
            Undergone surgery: <br>
            Allergies: <br>
            Reason for allergies: <br>
            Explain your consulation: <br>
            </p>
            <h4 class='mb-4'>Booking Information</h4>
            <p>
            Booking Reference: <br>
            Amount Due: <b>R <br>
            Payment Status:  <br>
            Booking status: 
            </p>
              ";
          }
        }
        ?>
        
      </div>
		</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
      <!-- Javascript CDN's -->
      <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
           
        });
    </script>
  </body>
</html>