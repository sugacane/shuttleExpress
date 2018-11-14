<?php
session_start();
//IF USER IS NOT A ADMIN, SEND THEM TO HOME PAGE
if(isset($_SESSION['admin_status']))
{
  // if not admin send home
  if($_SESSION['admin_status'] == 0)
  {
    $newurl = "home.php";
    header('Location: '.$newurl);
    die();
  }
} else
{
  // user has not logged in
  session_destroy();
  $newurl = "index.php";
  header('Location: '.$newurl);
  die();
}

require('config.php');

// Get the number of request for a destination
function getNumberOfRequest($destination) 
{
  $value = 0;
	$status = 0;
  // Create connection
  $conn = new mysqli(hostname, user, password, db_name);
  
  $sql="SELECT COUNT(*) FROM tracking WHERE destination=? AND status=?";
  // prepare and bind
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("si", $destination,$status);
  
  $stmt->execute();
  $rc = $stmt->bind_result($count);
  
  
  if($stmt->fetch())
  {
    // go
    $value = $count;
    
  } else
  {
    //attempt to get destination count failed
    $value = -1;
  }
  
  // close database connection
  $stmt->close();
  $conn->close();
  
  //FINALLY RETURN VALUE
  return $value;
}

?>



<!-- Admin Home Page -->

<!DOCTYPE html>
<html>
  <head>
    <title>Admin Home Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="home.php">shuttleExpress</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About Us</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-link" href="logout.php">Logout</a>
          </li>
        </ul>
        <span class="navbar-text">
          <?php
            /**
             * SHOW THAT USER IS ADMIN
             */
            echo "Login as: ".$_SESSION['user_id']."";
            if($_SESSION['admin_status'] == 1)
            {
              echo " <b>ADMIN</b>";
            } 
            else 
            {
              //echo " NOT ADMIN";
            }
          ?>
        </span>
      </div>
    </nav>
    <div class="container">
      <h1></h1>
      <p>Click on a destination below to view request for destination.</p>
      <a href="">View all reports</a><br>
      <a href="">View Bridgetown reports</a><br>
      <a href="">View Warrens reports</a><br>
      <a href="">View Heights & Terraces reports</a><br>
      <a href="">View Lazaretto reports</a>
      <div class="row report_link justify-content-center">
        <div class="card col-lg-3">
         <div class="col report_link card-body">
          <a class="" href="report.php?des=bridgetown">
            <h5 class="card-title">Bridgetown</h5>
            <h2><?php echo getNumberOfRequest("bridgetown"); ?></h2>
          </a>
          <a class="btn btn-primary text-white" href="send_bus_action.php?des=bridgetown">
            <i class="fas fa-bus"></i> SEND BUS
          </a>  
        </div>    
        </div>
        <div class="card col-lg-3">
        <div class="col  card-body">
          <a class="report_link" href="report.php?des=warrens">
            <h5 class="card-title">Warrens</h5>
            <h2><?php echo getNumberOfRequest("warrens"); ?></h2>
          </a>
          <a class="btn btn-primary text-white" href="send_bus_action.php?des=warrens">
            <i class="fas fa-bus"></i> SEND BUS
          </a>
        </div>
        </div>
        <div class="card col-lg-3">
        <div class="col  card-body">
          <a class="report_link" href="report.php?des=heightsterraces">
            <h5 class="card-title">Heights & Terraces</h5>
            <h2><?php echo getNumberOfRequest("heightsterraces"); ?></h2>
          </a>
          <a class="btn btn-primary text-white" href="send_bus_action.php?des=heightsterraces">
            <i class="fas fa-bus"></i> SEND BUS
          </a>
        </div>
        </div>
        <div class="card col-lg-3">
        <div class="col  card-body">
          <a class="report_link" href="report.php?des=lazaretto">
            <h5 class="card-title">Lazaretto</h5>
            <h2><?php echo getNumberOfRequest("lazaretto"); ?></h2>
          </a>
          <a class="btn btn-primary text-white" href="send_bus_action.php?des=lazaretto">
            <i class="fas fa-bus"></i> SEND BUS
          </a>
        </div>
      </div>
      </div>
    </div>
  </body>
</html>
