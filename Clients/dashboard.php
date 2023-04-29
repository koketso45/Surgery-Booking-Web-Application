<!doctype html>
<html lang="en">
  <head>
  	<title>Emergency Consultations | The Surgery</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="CSS/dashboard.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" href="css/consultation.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" href="css/upload documents.css?v=<?php echo time(); ?>">
	<!-- FONT AWESOME CDN -->
    <script src="https://kit.fontawesome.com/37349f6c3e.js" crossorigin="anonymous"></script>
	<!-- Jquery & Ajax library -->
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
		  		<h1><a href="index.html" class="logo">Surgery.</a></h1>
	        <ul class="list-unstyled components mb-5">
	          <li>
             
	          </li>
	          <li class="active">
				<a href="#">Consultation history</a>
	          </li>
	          <li>
				 <a href="profile.html">Profile</a>
	          </li>
	          <li>
              <a href="next of kin.html">Next of kin</a>
	          </li>
			  <li>
				<a href="book consultation.html">Book consultation</a>
			  </li>
			  <li>
				<a href="consultation status.html">Consultation status</a>
			  </li>
			  <li>
				<a href="upload documents.html">Upload documents</a>
			  </li>
			  <li>
				<a href="#">Sign Out</a>
			  </li>
	        </ul>

    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5">

        <h2 class="mb-0">Consulation History</h2>
        <p class="justify"></p>
		<div>
		<table>
            <tr>
              <th>Booking Reference</th>
              <th>Amount Due</th>
              <th>Payment Status</th>
              <th>Booking Status</th>
              <th>Action</th>
            </tr>
            <tr>
              <td><a href="consultation history.html">#0001</a></td>
              <td><b>R500.00</b></td>
              <td>Awaiting payment</td>
              <td>Submitted</td>
              <td><a class="pay-btn" href="#!">Pay</a></td>
            </tr>
            <tr>
                <td><a href="consultation history.html">#0002</a></td>
                <td><b>R500.00</b></td>
                <td>Paid</td>
                <td>Scheduled</td>
                <td><a class="pay-btn" href="#!">Pay</a></td>
              </tr>
          </table>
	</div>
      </div>
		</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".spinner-border").hide();
			$("#fullnames-error").hide();
			$("#lastname-error").hide();
			$("#email-error").hide();
			$("#cellno-error").hide();
			$("#gender-error").hide();
			$("#description-error").hide();
			var fullnames = $("#fullnames");
			var lastname = $("#lastname");
			var email = $("#email");
			var cellno = $("#cellno");
			var gender = $("#gender");
			var description = $("#description");
			
			$("#submit-btn").click(function(e){
				e.preventDefault();
				$("#fullnames-error").hide();
			    $("#lastname-error").hide();
			    $("#email-error").hide();
			    $("#cellno-error").hide();
			    $("#gender-error").hide();
			    $("#description-error").hide();

				if(fullnames.val() == ""){
					fullnames.focus();
					$("#fullnames-error").show();
					$("#fullnames-error").html("Please fill this field");
				}
				else if(lastname.val() == ""){
					lastname.focus();
					$("#lastname-error").show();
					$("#lastname-error").html("Please fill this field");
				}
				else if(email.val() == ""){
					email.focus();
					$("#email-error").show();
					$("#email-error").html("Please fill this field");
				}
				else if(!emailValidation(email.val())){
                   $("#email-error").show();
                   $("#email-error").html("Please enter a valid email address");
                   email.focus();
                } 
				else if(cellno.val() == ""){
					cellno.focus();
					$("#cellno-error").show();
					$("#cellno-error").html("Please fill this field");
				}
				else if(gender.val() == ""){
					gender.focus();
					$("#gender-error").show();
					$("#gender-error").html("Please fill this field");
				}
				else if(description.val() == ""){
					description.focus();
					$("#description-error").show();
					$("#description-error").html("Please fill this field");
				}
				else{
					$("#main-message").show();
                    $("#main-message").css("background-color","#28a745");
                    $("#main-message").css("border","1px solid #28a745");
					$("#submit-btn").css("cursor","pointer");
                    $("#main-message").html("Awaiting server response");
                    $("#submit-btn").prop("disabled",true);
                    $(".text").hide();
                    $(".spinner-border").show();
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