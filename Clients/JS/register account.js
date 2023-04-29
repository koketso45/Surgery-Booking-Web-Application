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
            $(".spinner-border").show();
            $("#step-three-back").hide();
            $("#button-text").hide();
            $("#main-error").show();
            $('#step-three-next').prop('disabled', true);
          $("#main-error").html("Server response");
          $("#main-error").css("background-color", "green");
          $("#main-error").css("border", "1px solid green");
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