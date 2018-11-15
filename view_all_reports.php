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

require_once('destination_names.php');

// Get all persons who requested a destination
function viewAllRequest() 
{
  $result = array();
  
  
  $conn = new mysqli(hostname, user, password, db_name);

  $sql="SELECT first_name, last_name, users.uwi_id, time_requested FROM tracking INNER JOIN users ON tracking.uwi_id = users.uwi_id";
  
  // prepare and bind
  $stmt = $conn->prepare($sql);
  //$stmt->bind_param("s", $destination);
  
  $stmt->execute();
  
  $rc = $stmt->get_result();
  
  if( $rc->num_rows > 0 ) 
  {
    echo "<h2>View All Requests <span class=\"badge badge-secondary\">".$rc->num_rows."</span></h2>";
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

//$destination = $_GET["des"];

?>

<!-- Login Page -->
			<?php
			ob_start();
			include_once('header.php');
			$buffer=ob_get_contents();
			ob_end_clean();

			$title = "View All Reports Page";
			$buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);

			echo $buffer;
			?>

    <div class="container">
     <br>
      
      <button class="btn btn-info float-left hide-print" onclick="location.href='admin_home.php';"><i class="fas fa-arrow-left "></i> Go Back</button>
      <?php
      echo "<button class=\"btn btn-info float-right hide-print\" onclick=\"window.print()\"><i class=\"fa fa-print\" aria-hidden=\"true\"></i> Print Report</button>";
        echo "<div class=\"table-responsive\">
                <table class=\"table table-hover\">
                  <thead>
                    <th>First Name</th>
                    <th>UWI ID</th>
                    <th>Time Requested</th>
                  </thead>
                  <tbody>";
        
        viewAllRequest();
        echo "    </tbody>
                </table>
              </div>";
      ?>
    </div>
  </body>
</html>
