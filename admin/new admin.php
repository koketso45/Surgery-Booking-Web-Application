<?php
include("Contains/session.php");
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>New Employees | The Surgery</title>
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
        <?php
			  $session_position = $_SESSION['session_position'];
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

        <h2 class="mb-0">New Employees</h2>
        <p>To add a new employee please fill the form below</p>
        <div class="new-form">
          <form action="#!" id="new_admin" method="post">
          <label for="fullnames">Full Names</label> <br>
          <input type="text" name="fullnames" id="fullnames"> <br>
          <div class="error-message" id="fullnames-error">Message goes here</div>
          <label for="lastname">Last Name</label> <br>
          <input type="text" name="lastname" id="lastname"> <br>
          <div class="error-message" id="lastname-error">Message goes here</div>
          <label for="email">Email address</label> <br>
          <input type="text" name="email" id="email"> <br>
          <div class="error-message" id="email-error">Message goes here</div>
          <label for="cellno">Cell No</label> <br>
          <input type="text" name="cellno" id="cellno"> <br>
          <div class="error-message" id="cellno-error">Message goes here</div>
          <label for="position">Position</label> <br>
          <select class="mb-2" name="position" id="position">
            <option value="" selected hidden>Select position</option>
            <option value="Admin">Admin</option>
            <option value="Receptionist">Receptionist</option>
            <option value="Doctor">Doctor</option>
            <option value="Nurse">Nurse</option>
          </select>
          <div class="error-message" id="position-error">Message goes here</div>
          <br>
          <button type="submit" class="submit-btn" id="submit-btn"><div class="spinner-border text-light"></div>
            <span class="text">Submit</span></button>
            <div class="error-message" id="main-message">Main Message</div>
        </div>
      </form>
        <h2 class="mb-0">Current Employees</h2>
        <?php
        $sql = "SELECT * FROM employees ";
        $res = mysqli_query($conn, $sql);
        if(mysqli_num_rows($res) > 0){
          echo"<table id='myTable'>
          <thead>
              <th>Email Address</th>
              <th>Cell No</th>
              <th>Full Names</th>
              <th>Last Name</th>
              <th>Status</th>
          </thead>
          <tbody>";
          while($row = mysqli_fetch_assoc($res)){
            echo"
            <tr>
              <td><a href='manage admins.php?k=".$row['emp_email']."'>".$row['emp_email']."</a></td>
              <td>".$row['emp_cellno']."</td>
              <td>".$row['emp_fullnames']."</td>
              <td>".$row['emp_lastname']."</td>
              <td>".$row['emp_status']."</td>
            </tr>
            ";
          }
          echo" </tbody>
          </table>";
        }
        else{
          echo"<h5>No employees found...</h5>";
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
        var fullnames = $("#fullnames");
        var lastname = $("#lastname");
        var email = $("#email");
        var cellno = $("#cellno");
        var position = $("#position");
        $(".error-message").hide();
          $("#submit-btn").click(function(e){
            e.preventDefault();
            $("#fullnames-error").hide();
            $("#lastname-error").hide();
            $("#email-error").hide();
            $("#cellno-error").hide();
            $("#position-error").hide();
            if(fullnames.val() == ""){
              $("#fullnames-error").show();
              $("#fullnames-error").html("Please fill this field");
              fullnames.focus();
            }
            else if(lastname.val() == ""){
              $("#lastname-error").show();
              $("#lastname-error").html("Please fill this field");
              lastname.focus();
            }
            else if(email.val() == ""){
              $("#email-error").show();
              $("#email-error").html("Please fill this field");
              email.focus();
            }
            else if(!emailValidation($("#email").val())){
              $("#email-error").show();
              $("#email-error").html("Please enter a valid email address");
              email.focus();
            }        
            else if(cellno.val() == ""){
              $("#cellno-error").show();
              $("#cellno-error").html("Please fill this field");
              cellno.focus();
            }
            else if(isNaN(cellno.val())|| cellno.val().indexOf(" ")!=-1){
            cellno.focus();
            $("#cellno-error").show();
            $("#cellno-error").html("Numeric values allowed only");
          }
          else if(cellno.val().length <= 11 && cellno.val().length >= 13){
            cellno.focus();
            $("#cellno-error").show();
            $("#cellno-error").html("Cell no must not exceed 13 digits");
          }
          else if (cellno.val().charAt(0)!="+")
          {
            cellno.focus();
            $("#cellno-error").show();
            $("#cellno-error").html("Cell no should start with +");
          }
            else if(position.val() == ""){
              $("#position-error").show();
              $("#position-error").html("Please fill this field");
              position.focus();
            }
            else{
              $.ajax({
              url: "Contains/new admin.php",
              method: "post",
              data: $("#new_admin").serialize(),
              beforeSend:function(){
                $("#submit-btn").prop("disabled",true);
                $(".text").hide();
                $(".spinner-border").show();
              },
              success: function (response) {
                if(response == "added"){
                  $("#submit-btn").prop("disabled",false);
                  $(".text").show();
                  $(".spinner-border").hide();
                  $("#main-message").show();
                  $("#main-message").css("background-color","#28a745");
                  $("#main-message").css("border","1px solid #28a745");
                  $("#main-message").html("Employee added successfully, <a href='#!' id='refresh'>Refresh page</a>");
                  $("#refresh").click(function(){
                    location.reload();
                  });
                }
                else{
                  $("#submit-btn").prop("disabled",false);
                  $(".text").show();
                  $(".spinner-border").hide();
                  $("#main-message").show();
                  $("#main-message").css("background-color","#dc3545");
                  $("#main-message").css("border","1px solid #dc3545");
                  $("#main-message").html(response);
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