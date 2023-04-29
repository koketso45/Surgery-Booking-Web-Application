$(document).ready(function(){
    $(".spinner-border").hide();
    //Inputs
    var confirmpassword = $("#confirmpassword");
    var password = $("#password");

    $("#log-in-btn").click(function(e){
        e.preventDefault();
        $("#main-error").hide();
        $("#password-error").hide();
        $("#confirm-error").hide();
        
        if(password.val() === ""){
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
          $("#main-error").show();
          $("#main-error").html("Server response");
          $("#main-error").css("background-color", "green");
          $("#main-error").css("border", "1px solid green");
            $(".spinner-border").show();
            $(".button-text").hide();
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