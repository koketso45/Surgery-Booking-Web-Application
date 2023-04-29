<?php
include("Contains/session.php");
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>More Documents | The Surgery</title>
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
		  		<h1><a href="index.php" class="logo">SurgTech</a></h1>
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
			  <li class="active">
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

        <h2 class="mb-0">User's Documents</h2>
		<p>Below are the the user's documents list.
		</p>
    <?php
    if(isset($_GET['more'])){
        $val = $_GET['more'];
    $session_val = $_SESSION['session_email']; 
    $sql = "SELECT DISTINCT doc_email, doc_name, u_id
    FROM documents WHERE doc_email = '$val' ";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) > 0){
      echo"<table id='myTable'>
      <thead>
      <th>Users ID</th>
      <th>Email Address</th>
      <th>Document Name</th>
      </thead>
      <tbody>";
      while($row = mysqli_fetch_assoc($res)){
        echo"
        <tr>
        <td><a href='manage accounts.php?acc=".$row['u_id']."'>#".$row['u_id']."</a></td>
        <td>".$row['doc_email']."</td>
        <td><a href='../Images/".$row['doc_name']."' download>".$row['doc_name']."</a></td>
        </tr>
        ";
      }
      echo"</tbody>
      </table>";
    }
    else{
      echo"<h5>No documents found...</h5>";
    }
    }
    ?>
      </div>
		</div>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
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