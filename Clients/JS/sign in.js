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
      $("#username-error").hide();
      $("#password-error").hide();
      $("#main-error").show();
      $("#main-error").html("All fields are required");
      $("#main-error").css("background-color", "green");
      $("#main-error").css("border", "1px solid green");
      $(".spinner-border").show();
      $(location).attr('href','Clients/dashboard.html');
      
    }
    });

  });