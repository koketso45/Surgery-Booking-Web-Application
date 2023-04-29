<!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript">
        function preventBack() {
            window.history.forward(); 
        }
          
        setTimeout("preventBack()", 0);
          
        window.onunload = function () { null };
    </script>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS links -->
  <link rel="stylesheet" href="Clients/CSS/verify.css?v=<?php echo time(); ?>">
  <!-- Javascript CDN's -->
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Bootstrap 5 CDN's -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Sweet alert CDN's -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <title>Verify Email address | The Surgery</title>
</head>
<body>

  <!-- Toast message -->
  <?php
  if(isset($_GET['k'])){
    $value = $_GET['k'];
    include("Clients/Contains/config.php");
    //Check from users table first
    $users = "SELECT * FROM users WHERE u_email = '$value' AND u_status = 'Deactivated'  ";
    $usersRes = mysqli_query($conn, $users);
    //Check from employees
    $employees = "SELECT * FROM employees WHERE emp_email = '$value' AND emp_status = 'Deactivated'  ";
    $employeesRes = mysqli_query($conn, $employees);

    if(mysqli_num_rows($usersRes) > 0){
        $updateUsers = "UPDATE users SET u_status = 'Activated' WHERE u_email = '$value'  ";
        $updateUsersRes = mysqli_query($conn, $updateUsers);
        if($updateUsersRes){
            echo"
            <div class='message-hol'>
            <p>Your email has been verified, you can procced to book your consultation</p>
            <a href='sign in.php'>click here for home page</a>
          </div>
            "; 
        }
        else{
            echo"
            <div class='message-hol'>
            <p>Something went wrong, please try again later</p>
            <a href='sign in.php'>click here for home page</a>
          </div>
            "; 
        }
    }
    else if(mysqli_num_rows($employeesRes) > 0){
        $updateEmp = "UPDATE users SET u_status = 'Activated' WHERE u_email = '$value'  ";
        $updateEmpRes = mysqli_query($conn, $updateEmp);
        if($updateEmpRes){
            echo"
            <div class='message-hol'>
            <p>Your email has been verified, you can procced to book your consultation</p>
            <a href='sign in.php'>click here for home page</a>
          </div>
            "; 
        }
        else{
            echo"
            <div class='message-hol'>
            <p>Something went wrong, please try again later</p>
            <a href='sign in.php'>click here for home page</a>
          </div>
            "; 
        }
    }
    else{
        echo"
    <div class='message-hol'>
    <p>Email address not found, it may be that it has already been verified. For enquiries please contact support@surgtech.co.za</p>
    <a href='sign in.php'>click here for home page</a>
  </div>
    "; 
    }
  }
  else{
    echo"
    <div class='message-hol'>
    <p>Something went wrong, please try again later</p>
    <a href='sign in.php'>click here for home page</a>
  </div>
    ";
  }
  ?>
 
  </div>
</body>

<script type="text/javascript">
  $(document).ready(function(){
    //alert();
  });
</script>
</html>