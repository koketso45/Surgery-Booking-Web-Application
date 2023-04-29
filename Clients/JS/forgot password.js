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
        $("#main-error").show();
        $("#main-error").html("Server response");
        $("#main-error").css("background-color", "green");
        $("#main-error").css("border", "1px solid green");
        $(".spinner-border").show();
        $(".button-text").hide();
    }
    });

    //Email validations function
    function emailValidation($email) {
        var key = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return key.test($email);
      }
});