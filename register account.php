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
<!-- Sweet alert CDN's -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Register New Account | The Surgery</title>
</head>
<body>
    <div class="form-container">
    
        <form action="#!" id="register-form" method="post">
          <h2 class="form-heading">Register New Account</h2>
          <p>To register an account please complete the registration form that consits of three steps.</p>
          <div class="error-message" id="main-error"></div>

          <div class="first-step">
            <p class="step">Step 1/3: Personal details</p>
            <label for="fullnames">Full names</label><br/>
          <input type="text" name="fullnames" id="fullnames" placeholder="Enter your full names"><br/>
          <div class="error-message" id="fullname-error"></div>
          <label for="lastname">Last name</label><br/>
          <input type="text" name="lastname" id="lastname" placeholder="Enter your last name"><br/>
          <div class="error-message" id="lastname-error"></div>
          <button class="next-button" id="step-one-next">Next</button><br/>
          </div>

          <div class="second-step">
            <p class="step">Step 2/3: Contact details</p>
            <label for="cellnumber">Cell No</label><br/>
          <input type="text" name="cellnumber" id="cellnumber" placeholder="Enter your cell number"><br/>
          <div class="error-message" id="cellnumber-error"></div>
          <label for="email">Email address</label><br/>
          <input type="email" name="email" id="email" placeholder="Enter your email address "><br/>
          <div class="error-message" id="email-error"></div>
          <button class="back-button" id="step-two-back">Previous</button><button class="next-button" id="step-two-next">Next</button><br/>
          </div>

          <div class="third-step">
            <p class="step">Step 3/3: Security details</p>
          <label for="password">Password</label><br/>
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
          <button class="back-button" id="step-three-back">Previous</button><button class="next-button" id="step-three-next"><div class="spinner-border text-light"></div> <span id="button-text">Next</span></button><br/>
          </div>
          <div class="links-container">
          <span class="regster-account"><a href="sign in.php">Already have an account</a></span>
          <span class="forgot_password"><a href="forgot password.php">Forgot password</a></span><br/>
        </div>
        </form>
      </div>
</body>
<script src="Clients/JS/register account.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
    $(".second-step").hide();
    $(".third-step").hide();
    $(".spinner-border").hide();
    //First step inputs
    var fullnames =  $("#fullnames");
    var lastname = $("#lastname");
    //Second step inputs
    var cellnumber =  $("#cellnumber");
    var email = $("#email");
    //Third step inputs
    var confirmpassword = $("#confirmpassword");
    var password = $("#password");

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

    //Step one functions
    $("#step-one-next").click(function(e){
      $("#main-error").hide();
      $("#fullname-error").hide();
      $("#lastname-error").hide();
      $("#cellnumber-error").hide();
      $("#email-error").hide();
      $("#password-error").hide();
      $("#confirm-error").hide();
        e.preventDefault();
        if(fullnames.val() === ""){
          $("#fullname-error").show();
          $("#fullname-error").html("Please fill in your full names");
          $("#fullnames").focus();
        }
        else if(lastname.val() === ""){
          $("#lastname-error").show();
          $("#lastname-error").html("Please fill in your last names");
          $("#lastname").focus();
        }
        else{
            $(".second-step").show();
            $(".first-step").hide();
            $(".third-step").hide();
        }
    });

    //step two function
    $("#step-two-next").click(function(e){
        e.preventDefault();
        $("#main-error").hide();
      $("#fullname-error").hide();
      $("#lastname-error").hide();
      $("#cellnumber-error").hide();
      $("#email-error").hide();
      $("#password-error").hide();
      $("#confirm-error").hide();
        if(cellnumber.val() === ""){
          $("#cellnumber-error").show();
          $("#cellnumber-error").html("Mobile No is required");
          $("#cellnumber").focus();
        }
        else if(isNaN(cellnumber.val()) || cellnumber.val().indexOf(" ")!=-1){
            cellnumber.focus();
            $("#cellnumber-error").show();
            $("#cellnumber-error").html("Numeric values allowed only");
          }
          else if(cellnumber.val().length >= 13){
            cellnumber.focus();
            $("#cellnumber-error").show();
            $("#cellnumber-error").html("Cell no must not exceed 13 digits");
          }
          else if (cellnumber.val().charAt(0)!="+")
          {
            cellnumber.focus();
            $("#cellnumber-error").show();
            $("#cellnumber-error").html("Cell no should start with +");
          }
        else if(email.val() === ""){
          $("#email-error").show();
          $("#email-error").html("Email address is required");
          $("#email").focus();
        }
        else if(!emailValidation(email.val())){
          $("#email-error").show();
          $("#email-error").html("Invalid email address");
          $("#email").focus();
        }
        else{
            $(".second-step").hide();
            $(".first-step").hide();
            $(".third-step").show();
        }
    });

    //Step three function
    $("#step-three-next").click(function(e){
        e.preventDefault();
        $("#main-error").hide();
      $("#fullname-error").hide();
      $("#lastname-error").hide();
      $("#cellnumber-error").hide();
      $("#email-error").hide();
      $("#password-error").hide();
      $("#confirm-error").hide();
        if(password.val() === ""){
          $("#password-error").show();
          $("#password-error").html("Password required");
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
          $("#confirm-error").show();
          $("#confirm-error").html("Passwords don't match");
          $("#confirmpassword").focus();
        }
        else{
            //AJAX code starts here
            $.ajax({
             url: "Clients/Contains/register.php",
             method: "post",
             data: $("#register-form").serialize(),
             beforeSend:function(){
              $("#step-three-back").hide();
              $(".spinner-border").show();
              $("#button-text").hide();
              $('#step-three-next').prop('disabled', true);
             },
             success: function (response) {
              if(response == "Account registered"){
                $("#main-error").show();
                $("#main-error").html("Account registered successfully, please verify your email address");
                $("#main-error").css("background-color", "green");
                $("#main-error").css("border", "1px solid green");
                $(".spinner-border").hide();
                $("#button-text").show();
                $('#step-three-next').prop('disabled', false);
              }
              else if(response == "Email exist"){
                $("#main-error").show();
                $("#main-error").html("Email address already has an account");
                $("#main-error").css("background-color", "#dc3545");
                $("#main-error").css("border", "1px solid #dc3545");
                $(".spinner-border").hide();
                $("#button-text").show();
                $('#step-three-next').prop('disabled', false);
              }
              else{
                $("#main-error").show();
                $("#main-error").html(response);
                $("#main-error").css("background-color", "#dc3545");
                $("#main-error").css("border", "1px solid #dc3545");
                $(".spinner-border").hide();
                $("#button-text").show();
                $('#step-three-next').prop('disabled', false);
              }
            },
            });
        }

    });

    $("#step-two-back").click(function(e){
        e.preventDefault();
        $(".second-step").hide();
        $(".first-step").show();
        $(".third-step").hide();
    });
    $("#step-three-back").click(function(e){
        e.preventDefault();
        $(".second-step").show();
        $(".first-step").hide();
        $(".third-step").hide();
    });
    
    });
    //Email validations function
    function emailValidation($email) {
  var key = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return key.test($email);
}
</script>
</html>