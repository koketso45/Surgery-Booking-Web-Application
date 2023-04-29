<?php
include("Contains/session.php");
if(isset($_GET['k'])){
  $value = $_GET['k'];
  $GetData = "SELECT * FROM employees WHERE emp_email = '$value' ";
  $GetDataRes = mysqli_query($conn, $GetData);
  if(mysqli_num_rows($GetDataRes) > 0){
    while($row = mysqli_fetch_assoc($GetDataRes)){
      $fullnames = $row['emp_fullnames'];
      $lastname = $row['emp_lastname'];
      $cellno = $row['emp_cellno'];
      $email = $row['emp_email'];
      $position = $row['emp_position'];
    }
  }
}
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Manage Employees | The Surgery</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://kit.fontawesome.com/37349f6c3e.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="CSS/style.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" href="CSS/dashboard.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="CSS/new admin.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="CSS/modal form.css?v=<?php echo time(); ?>">
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
          <li>
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

      <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update personal details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#!" id="modal-form" method="post">
        <div class="update-form-holder">
          <input type="hidden" name="provider" value="<?php if(isset($email)){echo $email;}else{} ?>" id="provider">
          <div class="error-message" id="main-error"></div>
          <label for="fullnames">Full names</label> <br>
          <input type="text" value="<?php if(isset($fullnames)){echo $fullnames;}else{} ?>" name="fullnames" id="fullnames"> <br>
          <div class="error-message" id="fullnames-error"></div>
          <label for="lastname">Last name</label> <br>
          <input type="text" value="<?php if(isset($lastname)){echo $lastname;}else{} ?>" name="lastname" id="lastname"> <br>
          <div class="error-message" id="lastname-error"></div>
          <label for="email">Email address</label> <br>
          <input type="text" value="<?php if(isset($email)){echo $email;}else{} ?>" name="email" id="email"> <br>
          <div class="error-message" id="email-error"></div>
          <label for="email">Cell No</label> <br>
          <input type="text" value="<?php if(isset($cellno)){echo $cellno;}else{} ?>" name="cellno" id="cellno"> <br>
          <div class="error-message" id="cellno-error"></div>
          <label for="position">Position</label> <br>
          <select name="position" id="position">
            <option value="" hidden selected>Select option below</option>
            <option value="<?php if(empty($position)){echo "";}else{echo $position;} ?>" selected hidden><?php 
                if(empty($position)){
                  echo"Select answer";
                  }
                  else{
                  echo"<option value='$position' selected hidden>$position</option>";
                    }
            ?></option>
            <option value="Admin">Admin</option>
            <option value="Doctor">Doctor</option>
            <option value="Receptionist">Receptionist</option>
            <option value="Nurse">Nurse</option>
          </select> <br>
          <div class="error-message" id="position-error"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="modal-btn"><div class="spinner-border text-light modal-spinner"></div><span class="text-modal">Save changes</span></button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal ends -->

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5">

        <h2 class="mb-0">Manage Employee</h2>
		<p>Below is the employee information, you can suspend, activate, and delete the account.
		</p>
    <?php
    if(isset($_GET['k'])){
      $Two = "SELECT * FROM employees WHERE emp_email = '$value' ";
    $TwoRes = mysqli_query($conn, $Two);
    if(mysqli_num_rows($TwoRes) > 0){
      while($TwoRow = mysqli_fetch_assoc($TwoRes)){
        echo"
        <h4 class='mb-0'>Personal details</h4>
        <p>
        <i class='fa-solid fa-pencil' class='btn btn-primary' data-toggle='modal' data-target='#exampleModal'></i>  <br>
        Full Names: ".$TwoRow['emp_fullnames']."<br/>
        Last Name: ".$TwoRow['emp_lastname']."<br/>
        Email Address: ".$TwoRow['emp_email']."<br>
        Phone No: ".$TwoRow['emp_cellno']." <br>
        Position: ".$TwoRow['emp_position']."<br>
        Account status: ".$TwoRow['emp_status']."
        </p>
        <form action='#!' id='form' method='post'>
          <input type='hidden' value='$value'  name='ID' id='ID'>
        <label for='status-label'>Change account status</label> <br>
        <select class='mb-2 status-select' name='status' id='status'>
            <option value='' hidden selected>Select account status</option>
            <option value='Activated'>Activate</option>
            <option value='Suspended'>Suspend</option>
            <option value='Deleted'>Delete account</option>
        </select>
        <div class='error-message' id='status-error'></div>
        <br>
        <button class='submit-btn' id='submit-btn'><div class='spinner-border text-light'></div><span class='text'>Submit</span></button> 
        </form>
        ";
      }
    }
    else{
      echo"<h5>No employee information found...</h5>";
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
    <script type="text/javascript">
        $(document).ready(function(){
          $("#email").prop("disabled",true);
            var status = $("#status");
            var fullnames = $("#fullnames");
            var lastname = $("#lastname");
            var email = $("#email");
            var position = $("#position");
            var cellno = $("#cellno");
            var provider = $("#provider");
            var ID = $("#ID");
            //Modal validations starts here
            $("#modal-btn").click(function(e){
              e.preventDefault();
              $("#fullnames-error").hide();
              $("#lastname-error").hide();
              $("#email-error").hide();
              $("#position-error").hide();

              if(provider.val() == ""){
                $("#main-error").show();
                $("#main-error").html("Something went wrong, please try again later");
                $("#main-error").css("background","#dc3545");
                $("#main-error").css("border","1px solid #dc3545");
              }
              else if(fullnames.val() == ""){
                fullnames.focus();
                $("#fullnames-error").show();
                $("#fullnames-error").html("Please fill this filed");
              }
              else if(lastname.val() == ""){
                lastname.focus();
                $("#lastname-error").show();
                $("#lastname-error").html("Please fill this filed");
              }
              else if(email.val() == ""){
                email.focus();
                $("#email-error").show();
                $("#email-error").html("Please fill this filed");
              }
              else if(cellno.val() == ""){
                cellno.focus();
                $("#cellno-error").show();
                $("#cellno-error").html("Please fill this filed");
              }
              else if(isNaN(cellno.val())|| cellno.val().indexOf(" ")!=-1){
            cellno.focus();
            $("#cellno-error").show();
            $("#cellno-error").html("Numeric values allowed only");
          }
          else if(cellno.val().length <= 11){
            cellno.focus();
            $("#cellno-error").show();
            $("#cellno-error").html("Cell no must not be over 11 digits");
          }
          else if (cellno.val().charAt(0)!="+")
          {
            cellno.focus();
            $("#cellno-error").show();
            $("#cellno-error").html("Cell no should start with +");
          }
              else if(!emailValidation($("#email").val())){
              $("#email-error").show();
              $("#email-error").html("Please enter a valid email address");
              email.focus();
              }   
              else if(position.val() == ""){
                position.focus();
                $("#position-error").show();
                $("#position-error").html("Please fill this filed");
              }
              else{
                    
                    $.ajax({
                    url: "Contains/update employee.php",
                    method: "post",
                    data: $("#modal-form").serialize(),
                    beforeSend:function(){
                      $(".modal-spinner").show();
                      $(".text-modal").hide();
                      $("#modal-btn").prop("disabled",true);
                    },
                    success: function (response) {
                      if(response == "updated"){
                        $(".modal-spinner").hide();
                        $(".text-modal").show();
                        $("#modal-btn").prop("disabled",false);
                        $("#main-error").show();
                        $("#main-error").css("background","#28a745");
                        $("#main-error").css("border","1px solid #28a745");
                        $("#main-error").html("Information updated successfully, <a href='#!' id='refresh'>Refresh page</a>");
                        $("#refresh").click(function(e){
                          e.preventDefault();
                          location.reload();
                        });
                      }
                      else{
                        $(".modal-spinner").hide();
                        $(".text-modal").show();
                        $("#modal-btn").prop("disabled",false);
                        $("#main-error").show();
                        $("#main-error").css("background","#dc3545");
                        $("#main-error").css("border","1px solid #dc3545");
                        $("#main-error").html(response);
                        $("#refresh").click(function(e){
                          e.preventDefault();
                          location.reload();
                        });
                      }
                    },
                    });
              }
            });
            $("#submit-btn").click(function(e){
              e.preventDefault();
                if(ID.val() == ""){
                      $("#status-error").show();
                      $("#status-error").html("Something went wrong, please try again later");
                }
              else if(status.val() == ""){
                    $("#status-error").show();
                    $("#status-error").html("Please select an option");
                }
                else{
                    
                    $.ajax({
                    url: "Contains/employee.php",
                    method: "post",
                    data: $("#form").serialize(),
                    beforeSend:function(){
                      $(".spinner-border").show();
                      $(".text").hide();
                      $("#submit-btn").prop("disabled",true);
                    },
                    success: function (response) {
                      if(response == "Something went wrong, please try again later"){
                      $(".spinner-border").hide();
                      $(".text").show();
                      $("#submit-btn").prop("disabled",false);
                      $("#status-error").show();
                      $("#status-error").css("background","#28a745");
                      $("#status-error").css("border","1px solid #28a745");
                      $("#status-error").html(response);
                      }
                      else{
                      $(".text").show();
                      $(".spinner-border").hide();
                      $("#submit-btn").prop("disabled",false);
                      $("#status-error").show();
                      $("#status-error").css("background","#28a745");
                      $("#status-error").css("border","1px solid #28a745");
                      $("#status-error").html(response);
                      $("#refresh").click(function(e){
                      e.preventDefault();
                      location.reload();
                     });
                     }
                    },
                    });

                }
            });

            function emailValidation($email) {
          var key = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
          return key.test($email);
          }
        });
    </script>
  </body>
</html>