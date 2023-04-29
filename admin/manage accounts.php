<?php
include("Contains/session.php");
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Manage Accounts | The Surgery</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="CSS/style.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" href="CSS/dashboard.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="CSS/new admin.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="CSS/link.css?v=<?php echo time(); ?>">
  <script src="https://kit.fontawesome.com/37349f6c3e.js" crossorigin="anonymous"></script>
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
	          <li class="active">
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

        <h2 class="mb-0">Manage Account</h2>
        <p>Below are the admins information, you can suspend, activate, and delete the account.
		</p>
    <?php
    if(isset($_GET['acc'])){
      $value = $_GET['acc'];
      $sql = "SELECT * FROM users WHERE u_id = '$value' ";
      $res = mysqli_query($conn, $sql);
      if(mysqli_num_rows($res) > 0){
        while($row = mysqli_fetch_assoc($res)){
          echo"
        <h4 class='mb-0'>Personal Information</h4>
        <p>
        Full Names: ".$row['u_fullnames']."<br/>
        Last Name: ".$row['u_lastname']."<br/>
        Email Address: ".$row['u_email']."<br>
        Phone No: ".$row['u_cellno']."<br>
        Account status: ".$row['u_status']."
        </p>
        ";
        }
        if($session_position == "Admin"){
          echo"
          <form action='#!' id='status-form' method='post'>
        <input type='hidden' value='".$value."' id='ID' name='ID'/>
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
        echo"<h5>No user information found</h5>";
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
            var status = $("#status");
            var ID = $("ID");
            $("#submit-btn").click(function(e){
              e.preventDefault();
              if(ID.val() == ""){
                    $("#status-error").show();
                    $("#status-error").html("Something went wrong, please try again later");
              }
              else if(status.val() == ""){
                    status.focus();
                    $("#status-error").show();
                    $("#status-error").html("Please select an option");
                }
                else{
                    $.ajax({
        url: "Contains/FORM.php",
        method: "post",
        data: $("#status-form").serialize(),
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
        });
    </script>
  </body>
</html>