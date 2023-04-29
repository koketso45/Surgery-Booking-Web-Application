$(document).ready(function(){
    $(".spinner-border").hide();

    $("#update-form").click(function(e){
        e.preventDefault();
        $(".spinner-border").hide();
        $("#fullnames-error").hide();
        $("#lastname-error").hide();
        $("#email-error").hide();
        $("#mobile-error").hide();
        $("#dob-error").hide();
        $("#sex-error").hide();
        $("#address-error").hide();

        //Call input values
        var fullnames = $("#fullnames");
        var lastname = $("#lastname");
        var email = $("#email");
        var mobileno = $("#mobileno");
        var dob = $("#dob");
        var gender = $("#gender");
        var address = $("#address");

        if(fullnames.val() === ""){
            $("#fullnames-error").show();
            $("#fullnames-error").html("Full name is required");
            $("#fullnames").focus();
        }
        else if(lastname.val() === ""){
            $("#lastname-error").show();
            $("#lastname-error").html("Last name is required");
            $("#lastname").focus();
        }else if(email.val() === ""){
            $("#email-error").show();
            $("#email-error").html("Email is required");
            $("#email").focus();
        }else if(!emailValidation(email.val())){
            $("#email-error").show();
            $("#email-error").html("Invalid email address");
            $("#email").focus();
        }else if(mobileno.val() === ""){
            $("#mobile-error").show();
            $("#mobile-error").html("Mobile no is required");
            $("#mobileno").focus();
        }
        else if(dob.val() === ""){
            $("#dob-error").show();
            $("#dob-error").html("Date of birth is required");
            $("#dob").focus();
        }else if(gender.val() === ""){
            $("#sex-error").show();
            $("#sex-error").html("Sex is required");
            $("#gender").focus();
        }else if(address.val() === ""){
            $("#address-error").show();
            $("#address-error").html("Sex is required");
            $("#address").focus();
        }
        else{
            //alert("Server request");
            $(".spinner-border").show();
            $(".form-text").hide();
            $('#update-form').prop('disabled', true);
        }
    });

    //Email validations function
    function emailValidation($email) {
        var key = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return key.test($email);
      }

});