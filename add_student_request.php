<?php
session_start();


$servername = "localhost";
$username = "root";
$cpassword = "";
$dbname = "shuttle_system";

// Create connection
$conn = new mysqli($servername, $username, $cpassword, $dbname);

// get user info for adding student request
$uwi_id = $_SESSION['user_id'];        //get users uwi ID
$destination = $_POST['destination'];   //destination user wants

// prepare and bind
$stmt = $conn->prepare("INSERT INTO tracking (uwi_id,destination) values (?,?)");
$stmt->bind_param("is", $uwi_id, $destination);

$rc = $stmt->execute();
//var_dump($stmt);

if($rc)
{
  // Successfully added new User
  //$_SESSION["request_status"]="Successfully added your request.";
  $_SESSION["request_status"]=1;
  $newurl = "home.php";
  header('Location: '.$newurl);
  die();
}
else
{
  //var_dump($destination);
  //var_dump($uwi_id);
  
  // for some reason insert failed
  //$_SESSION["request_status"]="Failed to add your request. Try again.";
  $_SESSION["request_status"]=0;
  $newurl = "home.php";
  //header('Location: '.$newurl);
  die();
}



?>