<?php
include("Contains/session.php");
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Completed consultations | The Surgery</title>
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
             
	          </li>
	          <li>
              <a href="profile.php">Profile</a>
	          </li>
	          <li>
              <a href="next of kin.php">Next of kin</a>
	          </li>
			  <li>
				<a href="book consultation.php">Book consultation</a>
			  </li>
              <li class="active">
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

        <h2 class="mb-0">Completed & Paid Consultation</h2>
        <p class="justify"> 
            Below are your completed & paid consultations. 
        </p>

        <?php
        $session_val = $_SESSION['session_email'];
        $sql = "SELECT * FROM users WHERE u_email = '$session_val' ";
        $res = mysqli_query($conn, $sql);
        if(mysqli_num_rows($res) > 0){
          while($row = mysqli_fetch_assoc($res)){
            $userID = $row['u_id'];
          }
          $fetch = "SELECT * FROM  consultations WHERE u_id = '$userID' AND const_paystat = 'Paid' AND const_status = 'Completed' ORDER BY const_id DESC";
          $fetchRes = mysqli_query($conn, $fetch);
          if(mysqli_num_rows($fetchRes) > 0){
            echo"<table id='myTable'>
            <thead>
              <th>Booking Reference</th>
              <th>Amount Due</th>
              <th>Payment Status</th>
              <th>Booking Status</th>
            </thead>
            <tbody>";
            while($row2 = mysqli_fetch_assoc($fetchRes)){
              echo"<tr>
              <td><a href='consultation history.php?ref=".$row2['const_id']."'>#".$row2['const_id']."</a></td>
              <td><b>R".$row2['const_amodue'].",00</b></td>
              <td>".$row2['const_paystat']."</td>
              <td>".$row2['const_status']."</td>
            </tr>";
            }
            echo"
            </tbody>
            </table>";
          }
          else{
            echo"<h3>No booking/consultations found...</h3>";
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