<?php

$server = "localhost";
$username = "root";
$password = "";
$db_name = "surgery";
date_default_timezone_set("Africa/Johannesburg");
$conn = mysqli_connect($server, $username, $password, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  else{
    /*echo "Connected successfully";*/
  }

?>