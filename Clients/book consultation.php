<?php
include("Contains/session.php");
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Book Consultation | The Surgery</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="CSS/dashboard.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="CSS/profile.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="CSS/book consultation.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="CSS/link.css?v=<?php echo time(); ?>">
  </head>
  <body>
		
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
	          <i class="fa fa-bars"></i>
	          <span class="sr-only">Toggle Menu</span>
	        </button>
        </div>
				<div class="p-4 pt-5">
		  		<h1><a href="index.html" class="logo">SurgTech.</a></h1>
	        <ul class="list-unstyled components mb-5">
	          <li>
             
	          </li>
	          <li>
              <a href="profile.php">Profile</a>
	          </li>
	          <li>
              <a href="next of kin.php">Next of kin</a>
	          </li>
			  <li class="active">
				<a href="#">Book consultation</a>
			  </li>
        <li>
          <a href="consultation status.php">Consultation status</a>
        </li>
			  <li>
				<a href="upload documents.php">Upload documents</a>
			  </li>
			  <li>
				<a href="Contains/sign out.php">Sign Out</a>
			  </li>
	        </ul>

    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5">

        <h2 class="mb-0">Book A Consultation</h2>
        <p>Please choose below who you are booking for and fill in the form that shows in order to book your doctor's consultation. The booking 
            base fee is valued at <b>R500.00</b> which is non-refundable. Thank you.
        </p>
        <div class="choose-holder">
            <label for="option">Who are you booking for</label><br/>
            <select name="option" id="option">
                <option selected hidden >Choose booking option</option>
                <option value="For me">For me</option>
                <option value="Another person">Another person</option>
            </select>
        </div>
        <div class="for-me" id="for-me">
          <form action="#!" id="me-form" method="post">
            <h4 class="mb-0">Consultation Form</h4>
            <div class="one-of-two">
                <table id="myTable">
                <thead>
                <th>Health Related Questions</th>
                <th>Answers</th>
              </thead>
              <tbody>
                    <tr class="highblood-error">
                      <td>Do you have high blood</td>
                      <td><div class="center-it">
                        <label for="highblood">Yes</label> <input type="radio" value="Yes" name="highblood" id="highblood">  
                          <label for="highblood">No</label>   <input type="radio" value="No" checked name="highblood" id="highblood">
                      </div></td>
                    </tr>
                    <tr class="heart-error">
                      <td>Do you have a heart disease</td>
                      <td><div class="center-it">
                        <label for="heartdisease">Yes</label> <input type="radio" value="Yes" name="heartdisease" id="heartdisease">  
                          <label for="heartdisease">No</label>   <input type="radio" value="No" checked name="heartdisease" id="heartdisease">
                      </div></td>
                    </tr>
                    <tr class="cholestrol-error">
                      <td>Do you have a high cholestrol</td>
                      <td><div class="center-it">
                        <label for="cholestrol">Yes</label> <input type="radio" value="Yes" name="cholestrol" id="cholestrol">  
                          <label for="cholestrol">No</label>   <input type="radio" value="No" checked name="cholestrol" id="cholestrol">
                      </div></td>
                    </tr>
                    <tr class="diabetes-error">
                      <td>Do you have diabetes</td>
                      <td><div class="center-it">
                        <label for="diabetes">Yes</label> <input type="radio" value="Yes" name="diabetes" id="diabetes">  
                          <label for="diabetes">No</label>   <input type="radio" value="No" checked name="diabetes" id="diabetes">
                      </div></td>
                    </tr>
                    <tr class="bleeding-error">
                      <td>Do you have a bleeding disorder</td>
                      <td><div class="center-it">
                        <label for="bleedingdisorder">Yes</label> <input type="radio" value="Yes" name="bleedingdisorder" id="bleedingdisorder">  
                          <label for="bleedingdisorder">No</label>   <input type="radio" value="No" checked name="bleedingdisorder" id="bleedingdisorder">
                      </div></td>
                    </tr>
                    <tr>
                      <td>Have you undergone surgery</td>
                      <td><div class="center-it">
                        <label for="surgery">Yes</label> <input type="radio" value="Yes" name="surgery" id="surgery">  
                          <label for="surgery">No</label>   <input type="radio" value="No" checked name="surgery" id="surgery">
                      </div></td>
                    </tr>
                    <tr>
                      <td>Do you have any allergies</td>
                      <td><div class="center-it">
                        <label for="allergies">Yes</label> <input type="radio" value="Yes" name="allergies" id="allergiesYes">  
                          <label for="allergies">No</label>   <input type="radio" checked value="No" name="allergies" id="allergiesNo">
                      </div></td>
                    </tr>
                    </tbody>
                  </table>
                  <div class="specify" id="AllergiesHide">
                    <label for="pleasespecify">Please specify your allergies</label><br/>
                    <textarea name="pleasespecify" id="pleasespecify" cols="30" rows="5"></textarea>
                    <div class="error-message" id="specify-error"></div>
                  </div>
                  <div class="specify">
                    <label for="aboutConsultation">Why do you want to consult</label><br/>
                    <textarea name="aboutConsultation" id="aboutConsultation" cols="30" rows="5"></textarea>
                    <div class="error-message" id="consultation-error"></div>
                  </div>
                  <div class="specify">
                    <button type="submit" id="submit-btn-one"><div class="spinner-border text-light" id="first-border"></div> <span class="text-first">Submit</span></button>
                  </div>
                  <div class="main-message" id="main-message"></div>
            </div>
            </form>
        </div>
        <!-- CONSULTING FOR SOMEONE FORM STARTS HERE -->
        <div class="for-me" id="for-someone">
          <form action="#!" id="someone-form" method="post">
            <h4 class="mb-0">Consultation Form</h4>
            <p>Note that when you book a consultation for someone else you will be listed as next of kin automatically.</p>
          <div class="personal-details-holder">
            <div class="flex-it">
                <div class="left">
                    <label for="fullnames">Full names</label><br/>
                    <input type="text" name="fullnames" id="fullnames">
                    <div class="error-message" id="fullnames-error"></div>
                </div>
                <div class="right">
                    <label for="lastname">Last name</label><br/>
                    <input type="text" name="lastname" id="lastname">
                    <div class="error-message" id="lastname-error"></div>
                </div>
            </div>
            <div class="flex-it">
                <div class="left">
                    <label for="dob">Date of birth</label><br/>
                    <input type="date" name="dob" id="dob">
                    <div class="error-message" id="dob-error"></div>
                </div>
                <div class="right">
                    <label for="passport">Identification/passport No</label><br/>
                    <input type="text" name="passport" id="passport">
                    <div class="error-message" id="id-error"></div>
                </div>
            </div>
            <div class="flex-it">
                <div class="left">
                    <label for="gender">Gender</label><br/>
                    <select name="gender" id="gender">
                        <option selected hidden value="">Select gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                    <div class="error-message" id="gender-error"></div>
                </div>
                <div class="right">
                    <label for="disabilities">Disabilities</label><br/>
                    <select name="disabilities" id="disabilities">
                        <option selected hidden value="">select answer</option>
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                    </select>
                    <div class="error-message" id="disabilities-error"></div>
                </div>
            </div>
            <div class="flex-it">
                <div class="left">
                    <label for="email">Email address</label><br/>
                    <input type="text" name="email" id="email">
                    <div class="error-message" id="email-error"></div>
                </div>
                <div class="right">
                    <label for="cellno">Cell No</label><br/>
                    <input type="text" name="cellno" id="cellno">
                    <div class="error-message" id="cellno-error"></div>
                </div>
            </div>
            <div class="no-flex">
                <label for="address">Physical Address</label><br/>
                <textarea name="address" id="address" cols="30" rows="5"></textarea>
                <div class="error-message" id="address-error"></div>
            </div>
        </div>
        <div class="one-of-two">
            <table>
              <thead>
                <th>Health Related Questions</th>
                <th>Answers</th>
              </thead>
              <tbody>
                <tr>
                  <td>Do you have high blood</td>
                  <td><div class="center-it">
                    <label for="highblood">Yes</label> <input type="radio" value="Yes" name="highblood" id="highblood2">  
                      <label for="highblood">No</label>   <input type="radio" value="No" checked name="highblood2" id="highblood2">
                  </div></td>
                </tr>
                <tr>
                  <td>Do you have a heart disease</td>
                  <td><div class="center-it">
                    <label for="heart2">Yes</label> <input type="radio" value="Yes" name="heartdisease2" id="heartdisease2">  
                      <label for="heart2">No</label>   <input type="radio" value="No" checked name="heartdisease2" id="heartdisease2">
                  </div></td>
                </tr>
                <tr>
                  <td>Do you have a high cholestrol</td>
                  <td><div class="center-it">
                    <label for="cholestrol2">Yes</label> <input type="radio" value="Yes" name="cholestrol2" id="cholestrol2">  
                      <label for="cholestrol2">No</label>   <input type="radio" value="No" checked name="cholestrol2" id="cholestrol2">
                  </div></td>
                </tr>
                <tr>
                  <td>Do you have diabetes</td>
                  <td><div class="center-it">
                    <label for="diabetes2">Yes</label> <input type="radio" value="Yes" name="diabetes2" id="diabetes2">  
                      <label for="diabetes2">No</label>   <input type="radio" value="No" checked name="diabetes2" id="diabetes2">
                  </div></td>
                </tr>
                <tr>
                  <td>Do you have a bleeding disorder</td>
                  <td><div class="center-it">
                    <label for="disorder2">Yes</label> <input type="radio" value="Yes" name="bleedingdisorder2" id="bleedingdisorder2">  
                      <label for="disorder2">No</label>   <input type="radio" value="No" checked name="bleedingdisorder2" id="bleedingdisorder2">
                  </div></td>
                </tr>
                <tr>
                  <td>Have you undergone surgery</td>
                  <td><div class="center-it">
                    <label for="surgery2">Yes</label> <input type="radio" value="Yes" name="surgery2" id="surgery2">  
                      <label for="surgery2">No</label>   <input type="radio" value="No" checked name="surgery2" id="surgery2">
                  </div></td>
                </tr>
                <tr>
                  <td>Do you have any allergies</td>
                  <td><div class="center-it">
                    <label for="allergies2">Yes</label> <input type="radio" value="Yes" name="allergies2" id="allergies2Yes">  
                      <label for="allergies2">No</label>   <input type="radio" value="No" checked name="allergies2" id="allergies2No">
                  </div></td>
                </tr>
                </tbody>
              </table>
              <div class="specify" id="AllergiesHide2">
                <label for="pleasespecify">Please specify your allergies</label><br/>
                <textarea name="pleasespecify2" id="pleasespecify2" cols="30" rows="5"></textarea>
                <div class="error-message" id="allergies-error"></div>
              </div>
              <div class="specify">
                <label for="aboutConsultation">Why do you want to consult</label><br/>
                <textarea name="aboutConsultation2" id="aboutConsultation2" cols="30" rows="5"></textarea>
                <div class="error-message" id="about-error"></div>
              </div>
              <div class="specify">
                <button type="submit" id="submit-someone"><div class="spinner-border text-light" id="spinner-2"></div> <span class="text-2" id="text-2">Submit</span></button>
              </div>
              <div class="main-message" id="main-message2"></div>
        </div>
      </form>
        </div>
		
      </div>
		</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Data table plug CDN's -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $("#for-me").hide();
        $("#for-someone").hide();
        $("#main-message").hide();
        $("#main-message2").hide();
        var highBlood = $('input[name="allergies"]:checked').val();
        var pleasespecify = $("#pleasespecify");
        var aboutConsultation = $("#aboutConsultation");

        //BOOK CONSULTATION FOR SOMEONE VALIDATIONS STARTS HERE
        var fullnames = $("#fullnames");
        var lastname = $("#lastname");
        var dob = $("#dob");
        var passport = $("#passport");
        var gender = $("#gender");
        var disabilities = $("#disabilities");
        var email = $("#email");
        var address = $("#address");
        var pleasespecify2 = $("#pleasespecify2");
        var aboutConsultation2 = $("#aboutConsultation2");
        var cellno = $("#cellno");

        $("#submit-someone").click(function(e){
          e.preventDefault();
          $("#fullnames-error").hide();
          $("#lastname-error").hide();
          $("#dob-error").hide();
          $("#id-error").hide();
          $("#gender-error").hide();
          $("#disabilities-error").hide();
          $("#email-error").hide();
          $("#address-error").hide();
          $("#allergies-error").hide();
          $("#about-error").hide();
          $("#cellno-error").hide();

          if(fullnames.val() == ""){
            fullnames.focus();
            $("#fullnames-error").show();
            $("#fullnames-error").html("Please fill this field");
          }
          else if(lastname.val() == ""){
            lastname.focus();
            $("#lastname-error").show();
            $("#lastname-error").html("Please fill this field");
          }
          else if(dob.val() == ""){
            dob.focus();
            $("#dob-error").show();
            $("#dob-error").html("Please fill this field");
          }
          else if(passport.val() == ""){
            passport.focus();
            $("#id-error").show();
            $("#id-error").html("Please fill this field");
          }
          //
          else if(isNaN(passport.val())|| passport.val().indexOf(" ")!=-1){
               passport.focus();
               $("#id-error").show();
               $("#id-error").html("Numeric values allowed only");
               }
               else if(passport.val().length <= 8 && passport.val().length >= 15){
                passport.focus();
               $("#id-error").show();
               $("#id-error").html("ID number must be 13 digits & passport number must be 9 digits");
               }
          //
          else if(gender.val() == ""){
            gender.focus();
            $("#gender-error").show();
            $("#gender-error").html("Please fill this field");
          }
          else if(disabilities.val() == ""){
            disabilities.focus();
            $("#disabilities-error").show();
            $("#disabilities-error").html("Please fill this field");
          }
          else if(email.val() == ""){
            email.focus();
            $("#email-error").show();
            $("#email-error").html("Please fill this field");
          }
          else if(!emailValidation(email.val())){
            $("#email-error").show();
            $("#email-error").html("Please enter a valid email address");
            email.focus();
          }
          else if(cellno.val() == ""){
            cellno.focus();
            $("#cellno-error").show();
            $("#cellno-error").html("Please fill this field");
          }
          else if(isNaN(cellNo.val())|| cellNo.val().indexOf(" ")!=-1){
            cellNo.focus();
            $("#cellno-error").show();
            $("#cellno-error").html("Numeric values allowed only");
          }
          else if(cellNo.val().length >= 13){
            cellNo.focus();
            $("#cellno-error").show();
            $("#cellno-error").html("Cell no must not exceed 13 digits");
          }
          else if (cellNo.val().charAt(0)!="+")
          {
            cellNo.focus();
            $("#cellno-error").show();
            $("#cellno-error").html("Cell no should start with +");
          }
          else if(address.val() == ""){
            address.focus();
            $("#address-error").show();
            $("#address-error").html("Please fill this field");
          }
          /*else if(pleasespecify2.val() == ""){
            pleasespecify2.focus();
            $("#about-error").show();
            $("#about-error").html("Please fill this field");
          }*/
          else if(aboutConsultation2.val() == ""){
            aboutConsultation2.focus();
            $("#about-error").show();
            $("#about-error").html("Please fill this field");
          }
          else{

            $.ajax({
            url: "Contains/someone.php",
            method: "post",
            data: $("#someone-form").serialize(),
            beforeSend:function(){
            $("#submit-someone").prop("disabled",true);
            $("#option").prop("disabled",true);
            $("#spinner-2").show();
            $("#text-2").hide();
            },
            success: function (response) {
            if(response == "submitted"){
              $("#submit-someone").prop("disabled",false);
              $("#option").prop("disabled",false);
              $("#spinner-2").hide();
              $("#text-2").show();
              $("#main-message2").show();
              $("#main-message2").html("Your booking has been submitted, please <a href='consultation status.php' id='refresh'>pay</a> for your booking to be acknowledged");
            }
            else{
              $("#submit-someone").prop("disabled",false);
              $("#option").prop("disabled",false);
              $("#spinner-2").hide();
              $("#text-2").show();
              $("#main-message2").show();
              $("#main-message2").html(response);
              $("#main-message2").css("background-color","#dc3545");
              $("#main-message2").css("border","1px solid #dc3545");
            }

            },
            });

          }
          

         
        });

        $("#allergiesYes").click(function(){
          $("#AllergiesHide").show();
        });
        $("#allergiesNo").click(function(){
          $("#AllergiesHide").hide();
        });

        $("#allergies2Yes").click(function(){
          $("#AllergiesHide2").show();
        });
        $("#allergies2No").click(function(){
          $("#AllergiesHide2").hide();
        });


        $("#submit-btn-one").click(function(e){
          e.preventDefault();
          $("#specify-error").hide();
          $("#consultation-error").hide();

          if(aboutConsultation.val() == ""){
            aboutConsultation.focus();
            $("#consultation-error").show();
            $("#consultation-error").html("This field is required");
          }
          else{

            $.ajax({
            url: "Contains/me.php",
            method: "post",
            data: $("#me-form").serialize(),
            beforeSend:function(){
              $("#submit-btn-one").prop("disabled",true);
              $("#option").prop("disabled",true);
              $("#first-border").show();
              $(".text-first").hide();
            },
            success: function (response) {
            if(response == "added"){
              $("#submit-btn-one").prop("disabled",false);
              $("#option").prop("disabled",false);
              $("#first-border").hide();
              $(".text-first").show();
              $("#main-message").show();
              $("#main-message").html("Your booking has been submitted, please <a href='consultation status.php' id='refresh'>pay</a> for your booking to be acknowledged");
            }
            else if(response == "profile data"){
              $("#submit-btn-one").prop("disabled",false);
              $("#option").prop("disabled",false);
              $("#first-border").hide();
              $(".text-first").show();
              $("#main-message").show();
              $("#main-message").html("Personal details required first. click <a href='profile.php' id='refresh'>here</a> to update profile");
              $("#main-message").css("background-color","#dc3545");
              $("#main-message").css("border","1px solid #dc3545");
            }
            else if(response == "next of kin"){
              $("#submit-btn-one").prop("disabled",false);
              $("#option").prop("disabled",false);
              $("#first-border").hide();
              $(".text-first").show();
              $("#main-message").show();
              $("#main-message").html("Next of kin details required first. click <a href='next of kin.php' id='refresh'>here</a> to add next of kin details");
              $("#main-message").css("background-color","#dc3545");
              $("#main-message").css("border","1px solid #dc3545");
            }
            else{
              $("#submit-btn-one").prop("disabled",false);
              $("#option").prop("disabled",false);
              $("#first-border").hide();
              $(".text-first").show();
              $("#main-message").show();
              $("#main-message").html(response);
              $("#main-message").css("background-color","#dc3545");
              $("#main-message").css("border","1px solid #dc3545");
            }
            },
            });
            
          }
        });

        $("#option").change(function(){
          var value = $("#option").val();
          if(value == "For me"){
            $("#for-me").show();
            $("#for-someone").hide();
          }
          else if(value = "Another person"){
            $("#for-me").hide();
            $("#for-someone").show();
          }
          else{
            $("#for-me").hide();
            $("#for-someone").hide();
            $("#first-border").show();
          }
        });

        function emailValidation($email) {
          var key = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
          return key.test($email);
        }

      });
    </script>
  </body>
</html>