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
  <link rel="stylesheet" href="Clients/CSS/main.css?v=<?php echo time(); ?>">
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
  <title>Welcome | The Surgery</title>
</head>
<body>

  <!-- Toast message -->
  

  <div class="form-container">
    
    <form action="#!" id="sign-form" method="post">
      <h2 class="form-heading">Welcome to Surgtech</h2>
      <p>To book a doctor's appointment, check up, upload documents, and view recent bookings. Sign in or register an account.</p>
      <div class="error-message" id="main-error"></div>
      <label for="email">Email address</label><br/>
      <input type="text" name="email" id="email" placeholder="Enter your email address "><br/>
      <div class="error-message" id="username-error"></div>
      <label for="password">Password</label><br/>
      <input type="password" name="password" id="password" placeholder="Enter your password"><br/>
      <div class="error-message" id="password-error"></div>
      <div class="links-container">
      <span class="regster-account"><a href="register account.php">New account</a></span>
      <span class="forgot_password"><a href="forgot password.php">Forgot password</a></span><br/>
    </div>
      <button class="log-in-button" id="log-in-btn"><div class="spinner-border text-light"></div> <span class="button-text">SIGN IN</span></button><br/>
    </form>
  </div>
</body>

<script type="text/javascript">
  $(document).ready(function(){
    var username = $("#email");
    var password = $("#password");
    $(".spinner-border").hide();

    $("#log-in-btn").click(function(e){
      $("#username-error").hide();
      $("#password-error").hide();
      $(".spinner-border").show();
      $(".button-text").hide();
      e.preventDefault();

      if(username.val() === ""){
        $("#username-error").show();
        $("#username-error").html("Email address is required");
        $("#email").focus();
      $(".spinner-border").hide();
      $(".button-text").show();
    }
    else if(password.val() === ""){
      $("#password-error").show();
      $("#password-error").html("Password is required");
      $("#password").focus();
      $(".spinner-border").hide();
      $(".button-text").show();
    }
    else{
      //AJAX CODE STARTS HERE
      $.ajax({
        url: "Clients/Contains/sign in.php",
        method: "post",
        data: $("#sign-form").serialize(),
        beforeSend:function(){
          $(".spinner-border").show();
          $(".button-text").hide();
          $('#log-in-btn').prop('disabled', true);
        },
        success: function (response) {
          if(response == "users"){
            $(".spinner-border").hide();
            $(".button-text").show();
            $("#username-error").hide();
            $("#password-error").hide();
            $("#main-error").show();
            $("#main-error").html("Redirecting...");
            $("#main-error").css("background-color", "green");
            $("#main-error").css("border", "1px solid green");
            $('#log-in-btn').prop('disabled', false);
            $(location).attr('href','Clients/profile.php');
          }
          else if(response == "employee"){
            $(".spinner-border").hide();
            $(".button-text").show();
            $("#username-error").hide();
            $("#password-error").hide();
            $("#main-error").show();
            $("#main-error").html("Redirecting...");
            $("#main-error").css("background-color", "green");
            $("#main-error").css("border", "1px solid green");
            $('#log-in-btn').prop('disabled', false);
            $(location).attr('href','admin/index.php');
          }
          else{
            $(".spinner-border").hide();
            $(".button-text").show();
            $("#username-error").hide();
            $("#password-error").hide();
            $("#main-error").show();
            $("#main-error").html(response);
            $("#main-error").css("background-color", "#dc3545");
            $("#main-error").css("border", "1px solid #dc3545");
            $('#log-in-btn').prop('disabled', false);
          }
        },
      });
    }
    });

  });
</script>
</html>