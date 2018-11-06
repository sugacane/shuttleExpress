<?php
session_start();

$servername = "localhost";
$username = "root";
$cpassword = "";
$dbname = "shuttle_system";

$json=null;

// Create connection
$conn = new mysqli($servername, $username, $cpassword, $dbname);

$uwi_id = $_POST['uwi_id'];
$password = $_POST['password'];
// create hash
$password = password_hash($password,PASSWORD_DEFAULT);
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$admin_status = $_POST['admin'];

// prepare and bind
$stmt = $conn->prepare("INSERT INTO users (uwi_id,password,admin,email,first_name,last_name) values (?,?,?,?,?,?)");
$stmt->bind_param("isisss", $uwi_id, $password, $admin_status, $email, $fname, $lname);

$rc = $stmt->execute();
if($rc)
{
  // Successfully added new User
  $_SESSION["create_status"]="Successfully added user ".$fname." ".$lname.".";
  $newurl = "register.php";
  header('Location: '.$newurl);
  die();
}
else
{
  // for some reason insert failed
  $_SESSION["create_status"]="Failed to add user ".$fname." ".$lname.".";
  $newurl = "register.php";
  header('Location: '.$newurl);
  die();
  
  /*
  var_dump($uwi_id);
  var_dump($password);
  // create hash
  var_dump($password);
  var_dump($fname);
  var_dump($lname);
  var_dump($email);
  var_dump($admin_status);*/
}

?>
