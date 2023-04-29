<!DOCTYPE html>
<html lang="en">
<head>
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
<!-- Font awesome CDN's -->
<script src="https://kit.fontawesome.com/37349f6c3e.js" crossorigin="anonymous"></script>
    <title>Update password | The Surgery</title>
</head>
<body>
    <div class="form-container">
    
        <form action="#!" id="update-form" method="post">
          <h2 class="form-heading">Update password</b></h2>
          <input type="hidden" name="token" id="token" value="<?php if(isset($_GET['k'])){$token = $_GET['k'];echo $token;}else{echo"";}
           ?>">
           <input type="hidden" name="email" id="email" value="<?php
           if(isset($_GET['e'])) {
            $email = $_GET['e'];
            echo $email;
           }
           else{
            echo"";
           }
           ?>">
          <p>On this page you are required to set a new password for your account, please fill the below form to set a new password for your account</p>
          <div class="error-message" id="main-error"></div>
          <label for="password">New password</label><br/>
          <input type="password" name="password" id="password" placeholder="Enter your password"><br/>
          <div class="error-message" id="password-error"></div>
          <div class="password-requirements">
            <p class="step">Password requirements</p>
            <ul>
                <li class="req" id ="capital-right"><i id="cap" class="fa-sharp fa-solid fa-circle-check"></i> At least a capital letter</li>
                <li class="req" id ="number-right"><i id="num" class="fa-sharp fa-solid fa-circle-check"></i> At least a number</li>
                <li class="req" id ="char-right"><i id="char" class="fa-sharp fa-solid fa-circle-check"></i> Be at least 8 characters</li>
                <li class="req" id ="speacial-right"><i id="spec" class="fa-sharp fa-solid fa-circle-check"></i> Be at least a special character</li>
            </ul>
          </div>
          <label for="confirmpassword">Confirm password</label><br/>
          <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm your password"><br/>
          <div class="error-message" id="confirm-error"></div>
          <button class="log-in-button" id="log-in-btn"><div class="spinner-border text-light"></div> <span class="button-text">Update password</span></button><br/>
          <div class="links-container">
            <span class="regster-account"><a href="sign in.php">Already have an account</a></span>
            <span class="forgot_password"><a href="forgot password.php">Forgot password</a></span><br/>
          </div>
        </form>
      </div>
</body>
<script src="Clients/JS/new password.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
    $(".spinner-border").hide();
    //Inputs
    var confirmpassword = $("#confirmpassword");
    var password = $("#password");
    var token = $("#token");
    var email = $("#email");

    $("#log-in-btn").click(function(e){
        e.preventDefault();
        $("#main-error").hide();
        $("#password-error").hide();
        $("#confirm-error").hide();
        
        if(token.val() == ""){
          $("#main-error").show();
          $("#main-error").html("Missing token found, please try again later");
          $("#main-error").css("background-color", "#dc3545");
          $("#main-error").css("border", "1px solid #dc3545");
        }
        else if(email.val() == ""){
          $("#main-error").show();
          $("#main-error").html("Missing token found, please try again later");
          $("#main-error").css("background-color", "#dc3545");
          $("#main-error").css("border", "1px solid #dc3545");
        }
        else if(password.val() === ""){
          $("#password-error").show();
          $("#password-error").html("Password is required");
          $("#password").focus();
        }
        else if (!$("#password").val().match(uppercase)) {
          $("#password-error").show();
          $("#password-error").html("Password must contain atleast a capital letter");
          $("#password").focus();
        } else if (!$("#password").val().match(numbers)) {
          $("#password-error").show();
          $("#password-error").html("Password must contain atleast a number");
          $("#password").focus();
        } else if (!special.test($("#password").val()) == false) {
          $("#password-error").show();
          $("#password-error").html("Password must contain atleast a special character");
          $("#password").focus();
        } else if ($("#password").val().length <= 8) {
          $("#password-error").show();
          $("#password-error").html("Password length must be 8 digits long");
          $("#password").focus();
        }
        else if(confirmpassword.val() === ""){
          $("#confirm-error").show();
          $("#confirm-error").html("This field is required");
          $("#confirmpassword").focus();
        }
        else if(password.val() != confirmpassword.val()){
          $("#main-error").show();
          $("#main-error").html("Passwords don't match");
          $("#confirmpassword").focus();
        }
        else{
    
            $(".spinner-border").show();
            $(".button-text").hide();
            //AJAX code starts here
            $.ajax({
            url: "Clients/Contains/update.php",
            method: "post",
            data: $("#update-form").serialize(),
            beforeSend:function(){
              $(".spinner-border").show();
              $(".button-text").hide();
              $('#log-in-btn').prop('disabled', true);
            },
            success: function (response) {
              if(response == "Updated"){
                $("#main-error").show();
                $("#main-error").html("Your password has been updated successfully");
                $("#main-error").css("background-color", "green");
                $("#main-error").css("border", "1px solid green");
                $('#log-in-btn').prop('disabled', false);
                $(".spinner-border").hide();
                $(".button-text").show();
              }else{
                $("#main-error").show();
                $("#main-error").html(response);
                $("#main-error").css("background-color", "#dc3545");
                $("#main-error").css("border", "1px solid #dc3545");
                $('#log-in-btn').prop('disabled', false);
                $(".spinner-border").hide();
                $(".button-text").show();
              }
           },
          });
        }
    });

    //password validation
    var uppercase = RegExp("[A-Z]");
    var smallLetters = RegExp("[a-z]");
    var numbers = RegExp("[0-9]");
    var special = RegExp("^[a-zA-Z0-9 ]*$");

    $("#password")
  .keyup(function () {
  var pass = $(this).val();
  if (pass.length >= 8) {
    $("#char-right").css("color", "green");
    $("#char").css("color", "green");
  } else {
    $("#char-right").css("color", "red");
    $("#char").css("color", "red");
  }
  if (pass.match(uppercase)) {
    $("#capital-right").css("color", "green");
    $("#cap").css("color", "green");
  } else {
    $("#capital-right").css("color", "red");
    $("#cap").css("color", "red");
  }
  if (pass.match(numbers)) {
    $("#number-right").css("color", "green");
    $("#num").css("color", "green");
  } else {
    $("#number-right").css("color", "red");
    $("#num").css("color", "red");
  }
  if (special.test(pass) == false) {
    $("#speacial-right").css("color", "green");
    $("#spec").css("color", "green");
  } else {
    $("#speacial-right").css("color", "red");
    $("#spec").css("color", "red");
  }
})
.focus(function () {
  $(".validation-info").show();
})
.blur(function () {
  $(".validation-info").hide();
});
});
</script>
</html>