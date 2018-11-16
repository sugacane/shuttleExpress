<?php
session_start();

require('config.php');

// Create connection
$conn = new mysqli(hostname, user, password, db_name);

// get user info for adding student request
$uwi_id = $_SESSION['user_id'];        //get users uwi ID
$destination = $_POST['destination'];   //destination user wants
$status = 0; //default status
// prepare and bind
$stmt = $conn->prepare("INSERT INTO tracking (uwi_id,destination,status) values (?,?,?)");
$stmt->bind_param("isi", $uwi_id, $destination,$status);

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