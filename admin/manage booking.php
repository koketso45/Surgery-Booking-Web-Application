<?php
include("Contains/session.php");
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Manage Booking | The Surgery</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="CSS/style.css?v=<?php echo time(); ?>">
		<link rel="stylesheet" href="CSS/dashboard.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="CSS/new admin.css?v=<?php echo time(); ?>">
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
		  		<h1><a href="index.php" class="logo">SurgTech.</a></h1>
	        <ul class="list-unstyled components mb-5">
            <li>
              <a href="index.php">Today's Consultations</a>
            </li>
          <li class="active">
              <a href="bookings.php">Schedule Consultations</a>
          </li>
      <li>
      <a href="consultation history.php">Consultations History</a>
      </li>
          <li>
            <a href="users accounts.php">Users Accounts</a>
          </li>
      <li>
      <a href="users documents.php">Users Documents</a>
      </li>
      <?php
			  if(isset($_SESSION['session_position'])){
					$session_position = $_SESSION['session_position'];
                  if($session_position == "Admin"){
                  echo"<li>
                 <a href='new admin.php'>New Employees</a>
                 </li>";
                  }
				  }
				  else{

				  }
                  ?>
      <li>
      <a href="Contains/sign out.php">Sign Out</a>
      </li>
	        </ul>

	      </div>
    	</nav>
      
        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5">

        <h2 class="mb-0">Recent Bookings</h2>
		<p>Below are the booking submitted and paid towards your business, please click on them and schedule a date for them. Once scheduled 
			the booker will recieve an email stating their day and time of their consulation.
		</p>

    <?php
    if(isset($_GET['k'])){
      $value = $_GET['k'];
      $sql = "SELECT * FROM consultations WHERE const_id = '$value' ";
      $res = mysqli_query($conn, $sql);
      if(mysqli_num_rows($res) > 0){
        while($row = mysqli_fetch_assoc($res)){
          $KinVal = $row['k_id'];
          echo"
          <h5 class='mb-0'>Personal Information</h5>
          <p>
          Booking Reference: #".$row['const_id']."<br>
          Full Names: ".$row['const_fullnames']."<br/>
          Last Name: ".$row['const_lastname']."<br/>
          Identification/Passport No: ".$row['const_passport']."<br/>
          Gender: ".$row['const_gender']."<br>
          Disabilities: ".$row['const_disab']."<br/>
          Email Address: ".$row['const_email']."<br>
          Phone No: ".$row['const_cellno']." <br>
          </p>
          <h5 class='mb-0'>Health Questions</h5>
           <p>
            High blood: ".$row['const_highblood']."<br>
            Heart Disease: ".$row['const_heartdisease']." <br>
            High Cholestrol: ".$row['const_cholestrol']." <br>
            Diabetes: ".$row['const_diabetes']."  <br>
            Bleeding Disorder: ".$row['const_bleedingdisord']." <br>
            Allergies: ".$row['const_allergies']."  <br>
            Reason for allergies: ".$row['const_aboutallergies']." <br>
            Explain your consulation: ".$row['const_aboutconsultation']." <br>
        </p>
          ";
          $BBstatus = $row['const_status'];
          $DAdate = $row['const_schedate'];
           $DAtime = $row['const_schedtime'];
        }
        //Fetch Next Of Kin Info
        $GetTheKin = "SELECT * FROM kin WHERE k_id = '$KinVal'";
        $GetTheKinRes = mysqli_query($conn, $GetTheKin);
        if(mysqli_num_rows($GetTheKinRes) > 0){
          while($Mkin = mysqli_fetch_assoc($GetTheKinRes)){
            echo"
          <h5 class='mb-0'>Next Of Kin details</h5>
          <p>
          Full Names: ".$Mkin['k_fullnames']."<br/>
          Last Name: ".$Mkin['k_lastname']."<br/>
          Identification/Passport No: ".$Mkin['k_passport']."<br/>
          Gender: ".$Mkin['k_gender']."<br>
          Disabilities: ".$Mkin['k_disab']."<br/>
          Email Address: ".$Mkin['k_email']."<br>
          Phone No: ".$Mkin['k_cellno']." <br>
          Physical Address: ".$Mkin['k_phyad']." <br>
          </p>
          ";
          $wantedID = $Mkin['u_id'];
          //print_r($wantedID);
          }
          $Getdocuments = "SELECT * FROM documents WHERE u_id = '$wantedID' ";
          $GetdocumentsRes = mysqli_query($conn, $Getdocuments);
          if(mysqli_num_rows($GetdocumentsRes) > 0){
            while($MgetRow = mysqli_fetch_assoc($GetdocumentsRes)){
              $MlinkLink = $MgetRow['doc_email']; 
            }
            echo"
          <a href='more%20documents.php?more=$MlinkLink'>Click here to view documents for this patient</a>
          <hr/>
            ";
          }
          else{
            echo"<hr/>";
          }
        }
        else{
          echo"
          <h5 class='mb-0'>Next Of Kin details</h5>
          <p>
          Full Names: <br/>
          Last Name: <br/>
          Identification/Passport No: <br/>
          Gender: <br>
          Disabilities: <br/>
          Email Address: <br>
          Phone No: <br>
          Physical Address:  <br>
          </p>";
        }
        if(!empty($BBstatus)){
          echo"
          <h5 class='mb-0'>Booking Information</h5>
        <p>
        Booking status: <b>$BBstatus</b><br/>
        Scheduled date: <b>$DAdate</b><br/>
        Scheduled time: <b>$DAtime</b>
        </p>
          ";
        }
        else{
          echo"
          <h5 class='mb-0'>Booking Information</h5>
        <p>
        Booking status: <br/>
        Scheduled date: <br/>
        Scheduled time: 
          ";
        }
        echo"
        <form action='#!' method='post' id='change_status_form'>
        <input type='hidden' id='bookingID2' name='bookingID2' value='$value'/>
        <label class='mlab' for='ScheduleTime'>Change booking status</label> <br>
        <select class='mb-2 mlab-select' name='BookingStatus' id='BookingStatus'>
            <option value='' selected hidden >Select booking status</option>
            <option value='Submitted'>Submitted</option>
            <option value='Completed'>Completed</option>
        </select>
        <div class='error-message' id='booking-status-error'>This is an erreor message</div> <br> 
        <button class='submit-btn' id='submit-btn-submit'><div class='spinner-border text-light' id='spinner-sub'></div><span class='text-sub'>Submit</span></button>
        </form>
        <hr/>
  ";
        if($DAdate  != null || $DAtime!= null){
          echo"
          <form action='#!' method='post' id='reschedule_form'>
          <h5 class='mb-0'>Reschedule Booking</h5>
          <input type='hidden' id='bookingID' name='bookingID' value='$value'/>
        <label class='mlab mbla-1' for='ScheduleDate'>Schedule Date</label><br>
        <input class='mlab-input' type='date' name='ScheduleDate' id='ScheduleDate'> <br>
        <div class='error-message' id='date-error'>This is an erreor message</div>
        <label class='mlab' for='ScheduleTime'>Schedule Time</label> <br>
        <select class='mb-2 mlab-select' name='ScheduleTime' id='ScheduleTime'>
            <option value='' selected hidden >Select booking time</option>
            <option value='08h00 - 09h00'>08h00 - 09h00</option>
            <option value='09h00 - 10h00'>09h00 - 10h00</option>
            <option value='10h00 - 11h00'>10h00 - 11h00</option>
            <option value='11h00 - 12h00'>11h00 - 12h00</option>
            <option value='12h00 - 13h00'>12h00 - 13h00</option>
            <option value='14h00 - 15h00'>14h00 - 15h00</option>
            <option value='15h00 - 16h00'>15h00 - 16h00</option>
            <option value='16h00 - 17h00'>16h00 - 17h00</option>
        </select>
        <div class='error-message' id='time-error'>This is an erreor message</div> <br>
        <button class='submit-btn' id='subtmit-btn'><div class='spinner-border text-light' id='spinner-border'></div><span class='text'>Submit</span></button>
        </form>
          ";
        }
        else{
          echo"
          <form action='#!' method='post' id='reschedule_form2'>
          <h5 class='mb-0'>Schedule Booking</h5>
          <input type='hidden' id='bookingID2' name='bookingID2' value='$value'/>
        <label class='mlab mbla-1' for='ScheduleDate'>Schedule Date</label><br>
        <input class='mlab-input' type='date' name='ScheduleDate2' id='ScheduleDate2'> <br>
        <div class='error-message' id='date-error'>This is an erreor message</div>
        <label class='mlab' for='ScheduleTime'>Schedule Time</label> <br>
        <select class='mb-4 mlab-select' name='ScheduleTime2' id='ScheduleTime2'>
            <option value='' selected hidden >Select booking time</option>
            <option value='08h00 - 09h00'>08h00 - 09h00</option>
            <option value='09h00 - 10h00'>09h00 - 10h00</option>
            <option value='10h00 - 11h00'>10h00 - 11h00</option>
            <option value='11h00 - 12h00'>11h00 - 12h00</option>
            <option value='12h00 - 13h00'>12h00 - 13h00</option>
            <option value='14h00 - 15h00'>14h00 - 15h00</option>
            <option value='15h00 - 16h00'>15h00 - 16h00</option>
            <option value='16h00 - 17h00'>16h00 - 17h00</option>
        </select>
        <div class='error-message' id='time-error2'>This is an erreor message</div> <br>
        <button class='submit-btn' id='subtmit-btn2'><div id='spinner-border2' class='spinner-border text-light'></div><span class='text2'>Submit</span></button>
        </form>
          ";
        }
      }
    }
    ?>
      </div>
		</div>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- Jquery & Ajax library -->
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- Data table plug CDN's -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#myTable').DataTable();
        $("#date-error").hide();
        $("#time-error").hide();
        var BookingID = $("bookingID");
        var SelectDate = $("#ScheduleDate");
        var SelectTime = $("#ScheduleTime");
        //Second
        var BookingID2 = $("bookingID2");
        var SelectDate2 = $("#ScheduleDate2");
        var SelectTime2 = $("#ScheduleTime2");
        //Ststus change values
        var bookingID2 = $("#bookingID2");
        var BookingStatus = $("#BookingStatus");

        $("#submit-btn-submit").click(function(e){
          e.preventDefault();
          $("#booking-status-error").hide();
          if(bookingID2.val() == ""){
            $("#booking-status-error").show();
            $("#booking-status-error").css("background-color","#dc3545");
            $("#booking-status-error").css("border","1px solid #dc3545");
            $("#booking-status-error").html("Something went wrong, please try again later");
          }
          else if(BookingStatus.val() == ""){
            $("#booking-status-error").show();
            $("#booking-status-error").css("background-color","#dc3545");
            $("#booking-status-error").css("border","1px solid #dc3545");
            $("#booking-status-error").html("Please select a booking status");
          }
          else{
           
            $.ajax({
            url: "Contains/one.php",
            method: "post",
            data: $("#change_status_form").serialize(),
            beforeSend:function(){
              $(".text-sub").hide();
             $("#spinner-sub").show();
             $("#submit-btn-submit").prop("disabled",true);
            },
            success: function (response) {
              if(response == "updated"){
                $(".text-sub").show();
                $("#spinner-sub").hide();
                $("#booking-status-error").show();
                $("#booking-status-error").css("background-color","#28a745");
                $("#booking-status-error").css("border","1px solid #28a745");
                $("#submit-btn-submit").prop("disabled",false);
                $("#booking-status-error").html("Booking status has been updated successfully, <a href='#!' id='refresh'>Refresh page</a>");
                $("#refresh").click(function(){
                  location.reload();
                });
              }
              else{
                $("#spinner-sub").hide();
                $("#booking-status-error").show();
                $("#booking-status-error").css("background-color","#dc3545");
                $("#booking-status-error").css("border","1px solid #dc3545");
                $("#booking-status-error").html(response);
                $("#submit-btn-submit").prop("disabled",false);
              }
           },
           });
            
          }

        });

        $("#subtmit-btn2").click(function(e){
          e.preventDefault();
          $("#date-error").hide();
          $("#time-error").hide();

          if(BookingID2.val() == ""){
            $("#time-error").show();
            $("#time-error").css("background-color","#dc3545");
            $("#time-error").css("border","1px solid #dc3545");
            $("#time-error").html("Something went wrong, please try again later");
          }
          else if(SelectDate2.val() == ""){
          $("#date-error").show();
          $("#date-error").html("Please choose a date");
        }
        else if(SelectTime2.val() == ""){
          $("#time-error").show();
          $("#time-error").html("Please select a suitable time for this consulatation");
        }else{
          $.ajax({
          url: "contains/reschedule2.php",
          method: "post",
          data: $("#reschedule_form2").serialize(),
          beforeSend:function(){
            $(".text2").hide();
            $("#spinner-border2").show();
          },
          success: function (response) {
          if(response == "updated"){
            $(".text2").show();
            $("#spinner-border2").hide();
            $("#submit-btn2").prop("disabled",false);
            $("#time-error2").show();
            $("#time-error2").css("background-color","#28a745");
            $("#time-error2").css("border","1px solid #28a745");
            $("#time-error2").html("Booking rescheduled successfully. <a href='#!' id='refresh'>Refresh page</a>");
            $("#refresh").click(function(e){
              e.preventDefault();
              location.reload();
            });
          }
          else{
            $(".text2").show();
            $("#spinner-border2").hide();
            $("#submit-btn2").prop("disabled",false);
            $("#time-error2").show();
            $("#time-error2").css("background-color","#dc3545");
            $("#time-error2").css("border","1px solid #dc3545");
            $("#time-error2").html(response);
          }

          },
          });
        }

        });

        $("#subtmit-btn").click(function(e){
          e.preventDefault();
          $("#date-error").hide();
          $("#time-error").hide();

          if(BookingID.val() == ""){
            $("#time-error").show();
            $("#time-error").css("background-color","#dc3545");
            $("#time-error").css("border","1px solid #dc3545");
            $("#time-error").html("Something went wrong, please try again later");
          }
          else if(SelectDate.val() == ""){
          $("#date-error").show();
          $("#date-error").html("Please choose a date");
        }
        else if(SelectTime.val() == ""){
          $("#time-error").show();
          $("#time-error").html("Please select a suitable time for this consulatation");
        }else{
          $.ajax({
          url: "contains/reschedule.php",
          method: "post",
          data: $("#reschedule_form").serialize(),
          beforeSend:function(){
            $(".text").hide();
            $("#spinner-border").show();
          },
          success: function (response) {
          if(response == "updated"){
            $(".text").show();
            $("#spinner-border").hide();
            $("#submit-btn").prop("disabled",false);
            $("#time-error").show();
            $("#time-error").css("background-color","#28a745");
            $("#time-error").css("border","1px solid #28a745");
            $("#time-error").html("Booking rescheduled successfully. <a href='#!' id='refresh'>Refresh page</a>");
            $("#refresh").click(function(e){
              e.preventDefault();
              location.reload();
            });
          }
          else{
            $(".text").show();
            $("#spinner-border").hide();
            $("#submit-btn").prop("disabled",false);
            $("#time-error").show();
            $("#time-error").css("background-color","#dc3545");
            $("#time-error").css("border","1px solid #dc3545");
            $("#time-error").html(response);
          }

          },
          });
        }

        });
      
      });
    </script>
  </body>
</html>