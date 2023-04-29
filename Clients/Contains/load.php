<?php
include("session.php");
$session_val = $_SESSION['session_email']; 
$output = "";

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
        $output = '<h2 class="mb-4"> Uploaded Documents</h2>';
    }
}
else{
    $output = "Tjeeer";
}
echo $output;
?>