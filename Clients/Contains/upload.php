<?php   
use PHPMailer\PHPMailer\PHPMailer;
date_default_timezone_set("Africa/Johannesburg");
include("session.php");
$session_val = $_SESSION['session_email']; 
 $output = "";  

 if(isset($_FILES['file']['name'][0]))  
 {  
     $check = "SELECT * FROM users WHERE u_email = '$session_val' ";
     $checkRes = mysqli_query($conn, $check);
     if(mysqli_num_rows($checkRes) > 0){
          while($row = mysqli_fetch_assoc($checkRes)){
               $userID = $row['u_id'];
          }
     $extension = array('jpeg','jpg','png','docx','pdf');
	foreach ($_FILES['file']['tmp_name'] as $key => $value) {
		$filename = $_FILES['file']['name'][$key];
		$filename_tmp = $_FILES['file']['tmp_name'][$key];

		$ext = pathinfo($filename,PATHINFO_EXTENSION);
		$finalimg='';
		if(in_array($ext,$extension))
		{
			if(!file_exists('../../Images/'.$filename))
			{
			move_uploaded_file($filename_tmp, '../../Images/'.$filename);
			$finalimg = $filename;
			}else
			{
				 $filename = str_replace('.','-',basename($filename,$ext));
				 $newfilename = $filename.time().".".$ext;
				 move_uploaded_file($filename_tmp, '../../Images/'.$newfilename);
				 $finalimg = $newfilename;
			}
			$creattime = date('y-m-d');
		
			$sql = "INSERT INTO documents(doc_name, doc_doc, u_id,doc_email) VALUES('$finalimg','$creattime','$userID','$session_val')";
			$res = mysqli_query($conn,$sql);
		}
          else
		{
			$output =  "Invalid file extension!";
		}
	}
     if($res){
          $output = "Uploaded";
     }
     else{
          $output = "Something went wrong, please try again later";
     }

     }
     else{
          $output = "Something went wrong, please try again later";
     }
}
 echo $output;
 ?>  