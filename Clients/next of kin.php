<?php
include("Contains/session.php");

$session_val = $_SESSION['session_email']; 

$sql = "SELECT * FROM users WHERE u_email = '$session_val' ";
$res = mysqli_query($conn, $sql);

if(mysqli_num_rows($res) > 0){
  while($mdata = mysqli_fetch_assoc($res)){
    $userID = $mdata['u_id'];
  }
  $fetch = "SELECT * FROM kin WHERE u_id = '$userID' ";
  $fetchRes = mysqli_query($conn, $fetch);
  if(mysqli_num_rows($fetchRes) > 0){
    while($row = mysqli_fetch_assoc($fetchRes)){
      $fullnames = $row['k_fullnames'];
      $lastname = $row['k_lastname'];
      $cellno = $row['k_cellno'];
      $email = $row['k_email'];
      $passport = $row['k_passport'];
      $gender = $row['k_gender'];
      $disab = $row['k_disab'];
      $phyad = $row['k_phyad'];
      $dob = $row['k_dob'];
    }
  }
}


?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Next Of Kin | The Surgery</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="CSS/dashboard.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="CSS/profile.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="CSS/link.css?v=<?php echo time(); ?>">
     <!-- Jquery & Ajax library -->
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
	          <li class="active">
              <a href="#">Next of kin</a>
	          </li>
			  <li>
				<a href="book consultation.php">Book consultation</a>
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

        <h2 class="mb-0">Next Of Kin Details </h2>
        <p class="justify">Please update or add your next of kin details as they are very important to us, the information provided will help
            us contact your next of kin incase of emergencies and unforseen circumstances.
        </p>
		<div class="personal-details-holder">
            <form action="#!" id="kin-form" method="post">
            <div class="flex-it">
                <div class="left">
                    <label for="fullnames">Full names</label><br/>
                    <input type="text" value="<?php if(isset($fullnames)){echo $fullnames;}else{echo "99999";} ?>" name="fullnames" id="fullnames">
                    <div class="error-message" id="fullnames-error"></div>
                </div>
                <div class="right">
                    <label for="lastname">Last name</label><br/>
                    <input type="text" value="<?php if(isset($lastname)){echo $lastname;}else{} ?>" name="lastname" id="lastname">
                    <div class="error-message" id="lastname-error"></div>
                </div>
            </div>
            <div class="flex-it">
                <div class="left">
                    <label for="dob">Date of birth</label><br/>
                    <input type="date" value="<?php if(isset($dob)){echo date('Y-m-d',strtotime($dob));}else{} ?>" name="dob" id="dob">
                    <div class="error-message" id="dob-error"></div>
                </div>
                <div class="right">
                    <label for="passport">Identification/passport No</label><br/>
                    <input type="text" value="<?php if(isset($passport)){echo $passport;}else{} ?>" name="passport" id="passport">
                    <div class="error-message" id="id-error"></div>
                </div>
            </div>
            <div class="flex-it">
                <div class="left">
                    <label for="gender">Gender</label><br/>
                    <select name="gender" id="gender">
                          <option value="<?php if(empty($gender)){echo "";}else{echo $gender;} ?>" selected hidden><?php 
                          if(empty($gender)){
                            echo"Select gender";
                            }
                            else{
                              echo"<option value='$gender' selected hidden>$gender</option>";
                            }
                         ?></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                    <div class="error-message" id="gender-error"></div>
                </div>
                <div class="right">
                    <label for="disabilities">Disabilities</label><br/>
                    <select name="disabilities" id="disabilities">
                         <option value="<?php if(empty($disab)){echo "";}else{echo $disab;} ?>" selected hidden><?php 
                          if(empty($disab)){
                            echo"Select answer";
                            }
                            else{
                              echo"<option value='$disab' selected hidden>$disab</option>";
                            }
                         ?></option>
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                    </select>
                    <div class="error-message" id="disabilities-error"></div>
                </div>
            </div>
            <div class="flex-it">
                <div class="left">
                    <label for="email">Email address</label><br/>
                    <input type="text" value="<?php if(isset($email)){echo $email;}else{} ?>" name="email" id="email">
                    <div class="error-message" id="email-error"></div>
                </div>
                <div class="right">
                    <label for="cellno">Cell No</label><br/>
                    <input type="text" value="<?php if(isset($cellno)){echo $cellno;}else{} ?>" name="cellno" id="cellno">
                    <div class="error-message" id="cellno-error"></div>
                </div>
            </div>
            <div class="no-flex">
                <label for="address">Physical Address</label><br/>
                <textarea name="address" id="address" cols="30" rows="5"><?php if(isset($phyad)){echo $phyad;}else{} ?></textarea>
                <div class="error-message" id="address-error"></div>
            </div>
            <div class="no-flex">
                <button type="submit" class="submit-btn" id="submit-btn"><div class="spinner-border text-light"></div> <span class="text">Update</span></button>
            </div>
            
            <div class="main-message" id="main-message"></div>
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
        <script type="text/javascript">
            $(document).ready(function(){
              $("#main-message").hide();
              $("#fullnames-error").hide();
              $("#lastname-error").hide();
              $("#dob-error").hide();
              $("#id-error").hide();
              $("#gender-error").hide();
              $("#disabilities-error").hide();
              $("#email-error").hide();
              $("#cellno-error").hide();
              $("#address-error").hide();
              //Link input values
              var fullnames = $("#fullnames");
              var lastname = $("#lastname");
              var dob = $("#dob");
              var IdNumber = $("#passport");
              var Gender = $("#gender");
              var Disabilities = $("#disabilities");
              var email = $("#email");
              var cellNo = $("#cellno");
              var address = $("#address");
      
              $("#submit-btn").click(function(e){
                e.preventDefault();
                $("#fullnames-error").hide();
              $("#lastname-error").hide();
              $("#dob-error").hide();
              $("#id-error").hide();
              $("#gender-error").hide();
              $("#disabilities-error").hide();
              $("#email-error").hide();
              $("#cellno-error").hide();
              $("#address-error").hide();
                if(fullnames.val() == ""){
                  fullnames.focus();
                  $("#fullnames-error").show();
                  $("#fullnames-error").html("Please fill this filed");
                }
                else if(lastname.val() == ""){
                  lastname.focus();
                  $("#lastname-error").show();
                  $("#lastname-error").html("Please fill this filed");
                }
                else if(dob.val() == ""){
                  dob.focus();
                  $("#dob-error").show();
                  $("#dob-error").html("Please fill this filed");
                }
                else if(IdNumber.val() == ""){
                  IdNumber.focus();
                  $("#id-error").show();
                  $("#id-error").html("Please fill this filed");
                }
                else if(isNaN(IdNumber.val())||IdNumber.val().indexOf(" ")!=-1){
                IdNumber.focus();
               $("#id-error").show();
               $("#id-error").html("Numeric values allowed only");
               }
               else if(IdNumber.val().length <= 8 && IdNumber.val().length >= 15){
               IdNumber.focus();
               $("#id-error").show();
               $("#id-error").html("ID number must be 13 digits & passport number must be 9 digits");
               }
                else if(Gender.val() == ""){
                  Gender.focus();
                  $("#gender-error").show();
                  $("#gender-error").html("Please fill this filed");
                }
                else if(Disabilities.val() == ""){
                  Disabilities.focus();
                  $("#disabilities-error").show();
                  $("#disabilities-error").html("Please fill this filed");
                }
                else if(email.val() == ""){
                  email.focus();
                  email.focus();
                  $("#email-error").show();
                  $("#email-error").html("Please fill this filed");
                }
                else if(!emailValidation(email.val())){
                 $("#email-error").show();
                 $("#email-error").html("Please enter a valid email address");
                 email.focus();
                }
                else if(cellNo.val() == ""){
                  cellNo.focus();
                  $("#cellno-error").show();
                  $("#cellno-error").html("Please fill this filed");
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
                  $("#address-error").html("Please fill this filed");
                }
                else{

                    $.ajax({
                    url: "Contains/update kin.php",
                    method: "post",
                    data: $("#kin-form").serialize(),
                    beforeSend:function(){
                      $("#submit-btn").prop("disabled",true);
                      $(".text").hide();
                      $(".spinner-border").show();
                    },
                    success: function (response) {
                      if(response == "updated"){
                        $("#main-message").show();
                        $("#main-message").css("background-color","#28a745");
                        $("#main-message").css("border","1px solid #28a745");
                        $("#main-message").html("Next of kin information updated successfully. <a href='#!' class='refresh' id='refresh'>Refresh page</a>");
                        $("#submit-btn").prop("disabled",false);
                        $(".text").show();
                        $(".spinner-border").hide();
                        $("#refresh").click(function(){
                        location.reload();
                        });
                      }
                      else{
                        $("#main-message").show();
                        $("#main-message").css("background-color","#dc3545");
                        $("#main-message").css("border","1px solid #dc3545");
                        $("#main-message").html(response);
                        $("#submit-btn").prop("disabled",false);
                        $(".text").show();
                        $(".spinner-border").hide();
                      }
                    },
                    });

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