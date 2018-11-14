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
<?php
include_once('header.php');
?>
    <div class="container">
      <h1></h1>
      <p>Click on a destination below to view request for destination.</p>
      <a href="view_all_reports.php">View all reports</a><br>
      <a href="report.php?des=bridgetown">View Bridgetown reports</a><br>
      <a href="report.php?des=warrens">View Warrens reports</a><br>
      <a href="report.php?des=heightsterraces">View Heights & Terraces reports</a><br>
      <a href="report.php?des=lazaretto">View Lazaretto reports</a>
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
        
						<div class="alert">
							<?php 
								if(isset($_SESSION['report_errors']))
								{
									echo $_SESSION['report_errors'];
									unset($_SESSION['report_errors']);
								}
							?>
						</div>
      </div>
      </div>
    </div>
  </body>
</html>
