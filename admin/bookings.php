<?php
include("Contains/session.php");
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Administration | The Surgery</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="CSS/style.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" href="CSS/dashboard.css?v=<?php echo time(); ?>">
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

        <h2 class="mb-0">Manage Bookings</h2>
		<p>Below are the booking submitted and paid towards your business, please click on them and schedule a date for them. Once scheduled 
			the booker will recieve an email stating their day and time of their consulation.
		</p>
		<form action="#!" id="function-form" method="post">
		<label class="mlab" for="OpenAndClose">Consultation intakes</label> <br>
		<select class="mlab-select down"  name="OpenAndClose" id="OpenAndClose">
			<option value="" selected hidden>Select option</option>
			<option value="Open">Open consulation intakes</option>
			<option value="Close">Close consulation intakes</option>
		</select>
		<button class="submit-btn" id="submit-btn" type="submit"><div class="spinner-border text-light"></div> <span class="text">submit</span> </button>
		</form>
		<br>
		<div class="error-message" id="support-error"></div>
		<?php
		$sql = "SELECT * FROM consultations WHERE const_status =  'Submitted' AND const_paystat = 'Paid' ORDER BY const_id DESC";
		$res = mysqli_query($conn, $sql);
		if(mysqli_num_rows($res) > 0){
			echo"
			<table id='myTable'>
			<thead>
              <th>Booking Reference</th>
			  <th>Date & Time</th>
              <th>Amount Due</th>
              <th>Payment Status</th>
              <th>Booking Status</th>
			  </thead>
			  <tbody>
			";
			while($row = mysqli_fetch_assoc($res)){
				echo"
				<tr>
              <td><a href='manage booking.php?k=".$row['const_id']."'>#".$row['const_id']."</a></td>
			  <td><b>".$row['const_schedate']." ".$row['const_schedtime']."</b></td>
              <td><b>R".$row['const_amodue'].",00</b></td>
              <td>".$row['const_paystat']."</td>
              <td>".$row['const_status']."</td>
               </tr>
				";
			}
			echo" </tbody>
			</table>";
		}
		else{
			echo"<h5>No bookings/consultations found...</h5>";
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
			$("#support-error").hide();
			var selectData = $("#OpenAndClose");
			$(".spinner-border").hide();
			$("#submit-btn").click(function(e){
				e.preventDefault();
				if(selectData.val() == ""){
					selectData.css("border","1px solid #dc3545");
				}
				else{
				
					$.ajax({
                    url: "contains/function.php",
                    method: "post",
                    data: $("#function-form").serialize(),
                    beforeSend:function(){
						$(".spinner-border").show();
					    $(".text").hide();
					    $("#submit-btn").prop("disabled",true);
                    },
                    success: function (response) {
                   if(response == "Open"){
					selectData.css("border","1px solid #007bff");
					$(".spinner-border").hide();
					$(".text").show();
					$("#submit-btn").prop("disabled",false);
					$("#support-error").show();
					$("#support-error").css("border","1px solid #28a745");
					$("#support-error").css("background-color","#28a745");
					$("#support-error").css("padding","10px");
					$("#support-error").css("border-radius","5px");
					$("#support-error").html("Intakes are now open, <a href='#!' id='refresh'>Refresh page</a>");
					$("#refresh").click(function(){
						location.reload();
					});
				   }
				   else if(response == "Close"){
					selectData.css("border","1px solid #007bff");
					$(".spinner-border").hide();
					$(".text").show();
					$("#submit-btn").prop("disabled",false);
					$("#support-error").show();
					$("#support-error").css("border","1px solid #28a745");
					$("#support-error").css("background-color","#28a745");
					$("#support-error").css("padding","10px");
					$("#support-error").css("border-radius","5px");
					$("#support-error").html("Intakes are now closed, <a href='#!' id='refresh'>Refresh page</a>");
					$("#refresh").click(function(){
						location.reload();
					});
				   }
				   else if(response == "Consultation intake are already open"){
					selectData.css("border","1px solid #007bff");
					$(".spinner-border").hide();
					$(".text").show();
					$("#submit-btn").prop("disabled",false);
					$("#support-error").show();
					$("#support-error").css("border","1px solid #28a745");
					$("#support-error").css("background-color","#28a745");
					$("#support-error").css("padding","10px");
					$("#support-error").css("border-radius","5px");
					$("#support-error").html("Consultation intake are already open, <a href='#!' id='refresh'>Refresh page</a>");
					$("#refresh").click(function(){
						location.reload();
					});
				   }
				   else if(response == "Consultation intakes are already closed"){
					selectData.css("border","1px solid #007bff");
					$(".spinner-border").hide();
					$(".text").show();
					$("#submit-btn").prop("disabled",false);
					$("#support-error").show();
					$("#support-error").css("border","1px solid #28a745");
					$("#support-error").css("background-color","#28a745");
					$("#support-error").css("padding","10px");
					$("#support-error").css("border-radius","5px");
					$("#support-error").html("Consultation intakes are already closed, <a href='#!' id='refresh'>Refresh page</a>");
					$("#refresh").click(function(){
						location.reload();
					});
				   }
				   else{
					selectData.css("border","1px solid #dc3545");
					$(".spinner-border").hide();
					$(".text").show();
					$("#submit-btn").prop("disabled",false);
					$("#support-error").show();
					$("#support-error").css("border","1px solid #dc3545");
					$("#support-error").css("background-color","#dc3545");
					$("#support-error").css("padding","10px");
					$("#support-error").css("border-radius","5px");
					$("#support-error").html(response);
				   }
                    },
                    });

				}
			});
		});
	</script>
  </body>
</html>