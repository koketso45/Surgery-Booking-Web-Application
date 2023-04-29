<?php
use PHPMailer\PHPMailer\PHPMailer;
date_default_timezone_set("Africa/Johannesburg");
include("session.php");
$session_val = $_SESSION['session_email']; 
$output = "";
$date = date("y-m-d");

if(isset($_FILES["fileupload"]["name"])){

    $check = "SELECT * FROM users WHERE u_email = '$session_val' ";
     $checkRes = mysqli_query($conn, $check);
     if(mysqli_num_rows($checkRes) > 0){
          while($row = mysqli_fetch_assoc($checkRes)){
               $userID = $row['u_id'];
          }
    $totalFiles = count($_FILES['fileupload']['name']);
    $filesArray = array();
  
    for($i = 0; $i < $totalFiles; $i++){
      $imageName = $_FILES["fileupload"]["name"][$i];
      $tmpName = $_FILES["fileupload"]["tmp_name"][$i];
  
      $imageExtension = explode('.', $imageName);
  
      $name = $imageExtension[0];
      $imageExtension = strtolower(end($imageExtension));
  
      $newImageName = $name . " - " . uniqid(); // Generate new image name
      $newImageName .= '.' . $imageExtension;
  
      move_uploaded_file($tmpName, '../../Images/' . $newImageName);
      $filesArray[] = $newImageName;
    }
  
    //$filesArray = json_encode($filesArray);
    foreach ($filesArray as $key => $value) {
        $query = "INSERT INTO documents(doc_name,doc_doc,u_id,doc_email) VALUES('$value','$date','$userID','$session_val')";
        $res = mysqli_query($conn, $query);
    }
    if($res){
        $output = "Success";
    }
    else{
        $output = "Something went wrong, please try again later";
    }

     }
}

echo $output;

?>