<?php
include("Contains/session.php");
date_default_timezone_set("Africa/Johannesburg");
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
              <li class="active">
                <a href="#">Today's Consultations</a>
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

        <h2 class="mb-0">Today's Consultations</h2>
		<p>Below are the the consultations scheduled for today <b><?php echo date("m/d/y"); ?></b>
		</p>
    <?php
    $date = date("m/d/y");
    $sql = "SELECT * FROM consultations WHERE const_schedate = '$date' AND const_paystat = 'Paid' ORDER BY const_schedtime ASC ";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) > 0){
      echo"<table id='myTable'>
      <thead>
              <th>Booking Reference</th>
              <th>Email Address</th>
              <th>Consultation Date</th>
              <th>Consultation Time</th>
      </thead>
      <tbody>";
      while($row = mysqli_fetch_assoc($res)){
        echo"
        <tr>
                    <td><a href='manage booking.php?k=".$row['const_id']."'>#".$row['const_id']."</a></td>
                    <td>".$row['const_email']."</td>
                    <td>".$row['const_schedate']."</td>
                    <td>".$row['const_schedtime']."</td>
        </tr>
        ";
      }
      echo"</tbody>
      </table>";
    }
    else{
      echo"<h5>No booking/consultation found...</h5>";
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
            });
        </script>
  </body>
</html>