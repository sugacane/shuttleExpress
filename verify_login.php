<?php
session_start();

//attempting a function that handles redirecting user
function redirectUser($url)
{
  //redirect based on url and kill script
  header('Location: '.$url);
  die();
}

$servername = "localhost";
$username = "root";
$cpassword = "";
$dbname = "shuttle_system";

$json=null;

// Create connection
$conn = new mysqli($servername, $username, $cpassword, $dbname);
$user_id = $_POST['user_id'];
$password = $_POST['password'];

//var_dump($user_id);
//var_dump($password);

// prepare and bind
$stmt = $conn->prepare("SELECT password, admin FROM users WHERE uwi_id=?");
$stmt->bind_param("i", $user_id);
//var_dump($stmt);

$stmt->execute();

$rc = $stmt->bind_result($hash,$admin);

/**
$result = $stmt->get_result();
//var_dump($result);
while ($row = $result->fetch_assoc()) {
  var_dump($row);
} **/

if($stmt->fetch())
{
  //Whoa, hash was receive from database :)
  
  //echo "<br>password ".$hash ;
  //echo "<br>admin ".$admin;
  // check if user password is correct
  if(password_verify($password,$hash)) {
			$_SESSION['user_id']=$user_id;
      $_SESSION['admin_status']=$admin;
      //$_SESSION['full_name']="";
      redirectUser("home.php");
		} else {
      // user entered wrong username or password
		  $_SESSION['errors']=" Opps. Wrong Email or Password ";
      redirectUser("index.php");

		}
}
else 
{
  // Whelp, that database call failed :(
  // However, well just tell the user to login again
  $_SESSION['errors']=" Opps. Wrong Email or Password ";
  redirectUser("index.php");
  
}

/*
$servername = "localhost";
$username = "root";
$cpassword = "";
$dbname = "shuttle_system";

// Create connection
$conn = new mysqli($servername, $username, $cpassword, $dbname);
$user_id = $_POST['user_id'];
$password = $_POST['password'];

// prepare and bind
$stmt = $conn->prepare("SELECT password FROM users WHERE uwi_id=?");

$stmt->bind_param("i", $user_id);

$stmt->execute();

$rc = $stmt->bind_result($DBpassword);
var_dump($user_id);
var_dump($password);
//var_dump("");

//echo "<br>-".$rc."- DB value is ".$DBpassword;
//$rownum = $stmt->num_rows;
//var_dump($password);
if($stmt->fetch())
{
  //Success the data was received from database
  //var_dump($DBpassword);
  echo "pass";
  if($DBpassword == $password)
  {
    //echo $DBpassword ."- -". $password;
    //password is valid
    var_dump($DBpassword);
    
    $_SESSION['user_id']="";
    $_SESSION['admin_status']="";
    $_SESSION['full_name']="";
    
    $newurl = "home.php";
    //header('Location: '.$newurl);
    die();
  } 
  else 
  {
    $_SESSION['errors']=" Opps. Wrong Email or Password ";
    $newurl = "index.php";
    //header('Location: '.$newurl);
    die();
  }
}
else
{
  //var_dump();
  //fail
  echo "fail";
  $_SESSION['errors']=" Opps. Wrong Email or Password ";
  $newurl = "index.php";
  //header('Location: '.$newurl);
  die();
}
**/
/**
$newurl = "http://laroneh/chandtec.com/";
header('Location: '.$newurl);
die();
**/

?>
