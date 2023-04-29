<?php
include("Contains/session.php");
if(isset($_GET['delet'])){
  $value = $_GET['delet'];
  $getName = "SELECT * FROM documents WHERE doc_id = '$value'";
  $getNameRes = mysqli_query($conn, $getName);
  if(mysqli_num_rows($getNameRes) > 0){
    while($mkoko = mysqli_fetch_assoc($getNameRes)){
      $ImgName = $mkoko['doc_name']; 
    }
    $delet = "SELECT * FROM documents WHERE doc_id = '$value'";
  $deleteRes = mysqli_query($conn, $delet);
  if(mysqli_num_rows($deleteRes) > 0){
    $realDelet = "DELETE FROM documents WHERE doc_id = '$value' ";
    $realDeletRes = mysqli_query($conn, $realDelet);
    if($realDeletRes){
      unlink("../Images/$ImgName");
      $alert = "File deleted successully";
      echo "<script type='text/javascript'>alert('$alert');</script>";
    }
  }
  }
  
}
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Upload documents | The Surgery</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="CSS/dashboard.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="CSS/profile.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="CSS/upload.css?v=<?php echo time(); ?>">
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
        <li>
          <a href="consultation status.php">Consultation status</a>
        </li>
			  <li class="active">
				<a href="#">Upload documents</a>
			  </li>
			  <li>
				<a href="Contains/sign out.php">Sign Out</a>
			  </li>
	        </ul>

    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5">

        <h2 class="mb-0">Upload Documents</h2>
        <p class="justify">Please update or add your next of kin details as they are very important to us, the information provided will help
            us contact your next of kin incase of emergencies and unforseen circumstances.
        </p>
        
        
        <div id="dropZone">
            <center>
                <h4>Drag & Drop Files...</h4>
                <p>OR</p>
                <input type="file" id="fileupload" name="fileupload[]" multiple>
            </center>
        </div>
        <br/>
        <?php
        $session_val = $_SESSION['session_email']; 
        $sql = "SELECT * FROM users WHERE u_email = '$session_val' ";
        $res = mysqli_query($conn, $sql);
        if(mysqli_num_rows($res) > 0){
            while($row = mysqli_fetch_assoc($res)){
                $userID = $row['u_id'];
            }
            $fecthDoc = "SELECT * FROM documents WHERE u_id = '$userID' ORDER BY doc_doc ASC";
            $fecthDocRes = mysqli_query($conn, $fecthDoc);
            if(mysqli_num_rows($fecthDocRes) > 0){
                echo'<h2 class="mb-4">Uploaded Documents</h2>
                <table id="myTable">
                  <thead>
                      <th>Document Name</th>
                      <th>Action</th>
                  </thead>
                  <tbody>';
                while($row2 = mysqli_fetch_assoc($fecthDocRes)){
                    echo'<tr>
                    <td><a download href="../Images/'.$row2['doc_name'].'" >'.$row2['doc_name'].'</a></td>
                    <td><a href="upload documents.php?delet='.$row2['doc_id'].'">Delete</a></td>
                  </tr>';
                }
                echo "</tbody>
                </table>";
            }
            else{
                echo '<h2 class="mb-4"> Uploaded Documents</h2>';
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
    <script src="JS/js/vendor/jquery.ui.widget.js" type="text/javascript"></script>
		<script src="JS/js/jquery.iframe-transport.js" type="text/javascript"></script>
		<script src="JS/js/jquery.fileupload.js" type="text/javascript"></script>
    <!-- Data table plug CDN's -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){

          $('#myTable').DataTable();
          
           $('#dropZone').on('dragover', function(){  
               $(this).addClass('file_drag_over');  
               return false;  
           });  
            $('#dropZone').on('dragleave', function(){  
              $(this).removeClass('file_drag_over');  
              return false;  
            });  
            $('#dropZone').on('drop', function(e){  
              e.preventDefault();  
              $(this).removeClass('file_drag_over');  
              var formData = new FormData();  
              var files_list = e.originalEvent.dataTransfer.files;  
              //console.log(files_list);  
              for(var i=0; i<files_list.length; i++)  
              {  
                formData.append('file[]', files_list[i]);  
              }  
              //console.log(formData);
              $.ajax({  
                url:"Contains/upload.php",  
                method:"POST",  
                data:formData,  
                contentType:false,  
                cache: false,  
                processData: false,  
                beforeSend:function(){
                  $("#loader").load("Contains/load.php");
               },
                success:function(data){  
                    
                     if(data == "Uploaded"){
                      alert(data);
                      $("#loader").load("Contains/load.php");
                     }
                     else{
                      alert(data);
                     }
                }  
              }); 
            }); 
            //File input change function
            $("#fileupload").change(function(e){
              e.preventDefault();  
              var formData = new FormData();

          var totalFiles = $("#fileupload").get(0).files.length;
          for (var i = 0; i < totalFiles; i++) {
              formData.append("fileupload[]", $("#fileupload").get(0).files[i]);
          }

          $.ajax({
            url: 'Contains/upload2.php',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success:function(response){
              alert(response);
            }
          });


            });
            //Load data from surgery.db
            $("#loader").load("Contains/load.php");
        });
    </script>
  </body>
</html>