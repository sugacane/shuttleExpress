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

if(!isset($_GET["des"]))
{
  // get value not set so send back
  // TODO: could let user know ...
  $newurl = "admin_home.php";
  header('Location: '.$newurl);
  die();
}


require('config.php');

require_once('destination_names.php');

// Get all persons who requested a destination
function getWhoRequested($destination) 
{
  $result = array();
  
  
  $conn = new mysqli(hostname, user, password, db_name);

  $sql="SELECT first_name, last_name, users.uwi_id, time_requested FROM tracking INNER JOIN users ON tracking.uwi_id = users.uwi_id WHERE destination=?";
  
  // prepare and bind
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $destination);
  
  $stmt->execute();
  
  $rc = $stmt->get_result();
  
  if( $rc->num_rows > 0 ) 
  {
    echo "<h2>Request for [".
    returnDestinationName($destination)  
    ."] <span class=\"badge badge-secondary\">".$rc->num_rows."</span></h2>";
    while ($row = $rc->fetch_assoc())
    {
		  echo "<tr>";
      echo "<td>";
      echo $row['first_name']." ".$row['last_name'];
      echo "</td>";
		  echo "<td>";
      echo $row['uwi_id'];
      echo "</td>";
		  echo "<td>";
      echo $row['time_requested'];
      echo "</td>";
		  echo "</tr>";
    }
  }
  else
  {
    // nothing was found
    echo "<td colspan=\"3\">Nothing was found</td>";
  }
  
  // close database connection
  $stmt->close();
  $conn->close();
}

$destination = $_GET["des"];

?>

<!-- Login Page -->

<!DOCTYPE html>
<html>
  <head>
    <title>Admin Report Page</title>
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
            echo "Login as: ".$_SESSION['user_id']."";
            if($_SESSION['admin_status'] == 1)
            {
              echo " <b>ADMIN</b>";
            } 
            else 
            {
              echo " NOT ADMIN";
            }
          ?>
        </span>
      </div>
    </nav>
    <div class="container">
      
      <button class="btn btn-info float-left" onclick="location.href='admin_home.php';"><i class="fas fa-arrow-left"></i> Go Back</button>
      <?php
      echo "<button class=\"btn btn-info float-right\" onclick=\"window.print()\"><i class=\"fa fa-print\" aria-hidden=\"true\"></i> Print Report</button>";
        echo "<div class=\"table-responsive\">
                <table class=\"table table-hover\">
                  <thead>
                    <th>First Name</th>
                    <th>UWI ID</th>
                    <th>Time Requested</th>
                  </thead>
                  <tbody>";
        
        getWhoRequested($destination);
        echo "    </tbody>
                </table>
              </div>";
      ?>
    </div>
  </body>
</html>
