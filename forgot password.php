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
    <title>Forgot password | The Surgery</title>
</head>
<body>
    <div class="form-container">
        <form action="#!" id="forgot-form" method="post">
          <h2 class="form-heading">Password recovery</h2>
          <p>To recover your lost password, please fill in the form below.</p>
          <div class="error-message" id="main-error"></div>
          <label for="email">Email address</label><br/>
          <input type="text" name="email" id="email" placeholder="Enter your email address "><br/>
          <div class="error-message" id="email-error"></div>
          <div class="links-container">
          <span class="regster-account"><a href="sign in.php">Already have an account</a></span>
          <span class="forgot_password"><a href="register account.php">New account</a></span><br/>
        </div>
          <button class="log-in-button" id="log-in-btn"><div class="spinner-border text-light"></div> <span class="button-text">Recover</span></button><br/>
        </form>
      </div>
</body>
<script type="text/javascript">
    $(document).ready(function(){
    $(".spinner-border").hide();
    var email = $("#email");
    $("#log-in-btn").click(function(e){
        e.preventDefault();
        $("#main-error").hide();
        $("#email-error").hide();
        if(email.val() === ""){
            $("#email-error").show();
            $("#email-error").html("Email address is required");
            $("#email").focus();
    }else if(!emailValidation(email.val())){
        $("#email-error").show();
            $("#email-error").html("Please enter a valid email address");
            $("#email").focus();
    }
    else{
        //AJAX code starts here
        $.ajax({
        url: "Clients/Contains/forgot.php",
        method: "post",
        data: $("#forgot-form").serialize(),
        beforeSend:function(){
          $(".spinner-border").show();
          $(".button-text").hide();
          $('#log-in-btn').prop('disabled', true);
        },
        success: function (response) {
          
          if(response == "Email sent"){
            $(".spinner-border").hide();
            $(".button-text").show();
            $("#main-error").show();
            $("#main-error").html("An email with a reset password link has been sent to your mailbox");
            $("#main-error").css("background-color", "green");
            $("#main-error").css("border", "1px solid green");
            $('#log-in-btn').prop('disabled', false);
          }
          else{
            $("#main-error").show();
            $("#main-error").html(response);
            $("#main-error").css("background-color", "#dc3545");
            $("#main-error").css("border", "1px solid #dc3545");
            $(".spinner-border").hide();
            $(".button-text").show();
            $('#log-in-btn').prop('disabled', false);
          }
        },
      });
    }
    });

    //Email validations function
    function emailValidation($email) {
        var key = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return key.test($email);
      }
});
</script>
</html>