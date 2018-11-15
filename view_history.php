<?php
session_start();

if(isset($_SESSION['admin_status']))
{
  if($_SESSION['admin_status'] == 1)
  {
    $newurl = "admin_home.php";
    header('Location: '.$newurl);
    die();
  }
}


if(!isset($_SESSION['user_id']))
{
  session_destroy();
  $newurl = "index.php";
  header('Location: '.$newurl);
  die();
}

require_once('destination_names.php');

?>

<!-- Home Page -->

			<?php
  		ob_start();
			include_once('header.php');
			$buffer=ob_get_contents();
			ob_end_clean();

			$title = "View History Page";
			$buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);

			echo $buffer;
   		?>
    <div class="container">
      <br>
      <!--<h2>My History</h2>-->
      <?php
        require('config.php');
      
				//
				function parseTimeValue($time)
				{
					$value = "";
					if($time == NULL)
					{
						$value = "-";
					}
					else 
					{
						$value = $time;
					}
					 return $value;
				}
				
        function getStaus($status)
        {
          //
          if($status == 0)
          {
            // request is still pending by admin
            $value = "Pending";
          } else if($status == 1)
          {
            // bus driver pick up student
            $value = "Completed";
          } else 
          {
            // Something went wrong
            $value = "";
          }
          
          return $value;
        }

        // Get the number of request for a destination made by login user
        function showAllUsersRequest($id) 
        {
          // Create connection
          $conn = new mysqli(hostname, user, password, db_name);

          $sql="SELECT destination, time_requested, status, pickup_time FROM tracking WHERE uwi_id=? ORDER BY time_requested DESC";
          // prepare and bind
          if($stmt = $conn->prepare($sql))
          {
            
            $stmt->bind_param("s", $id);

            $stmt->execute();
            //$rc = $stmt->bind_result($destination,$time);
            $rc = $stmt->get_result();
            //echo "".$rc->num_rows."";
            if( $rc->num_rows > 0 ) {
	   
							echo "<h2>My History <span class=\"badge badge-secondary\">".$rc->num_rows."</span></h2>";
              while ($row = $rc->fetch_assoc())
              {
								/*
								if()
								{
									
								}*/
                echo "<tr>";
                echo "<td>";
                echo returnDestinationName($row['destination']);
                echo "</td>";
                echo "<td>";
                echo $row['time_requested'];
                echo "</td>";
                echo "<td>";
                echo getStaus($row['status']);
                echo "</td>";
                echo "<td>";
                echo parseTimeValue($row['pickup_time']);
                echo "</td>";
                echo "</tr>";

              }
            }
            else
            {
							echo "<h2>My History <span class=\"badge badge-secondary\">".$rc->num_rows."</span></h2>";
              echo "<tr>";
              echo "<td style=\"text-align: center;\" colspan=\"4\">No History Result Found</td>";
							echo "</tr>";
            }
            
          } else 
          {
						echo "<h2>My History <span class=\"badge badge-secondary\">".$rc->num_rows."</span></h2>";
            echo "<tr>";
            echo "<td colspan=\"4\">Failed Connection to Database</td>";
						echo "</tr>";
          }
          // close database connection
          $stmt->close();
          $conn->close();

          //FINALLY RETURN VALUE
        }
      
      ?>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <th>Destination</th>
            <th>Request Time</th>
            <th>Status</th>
            <th>Departure Times</th>
          </thead>
          <tbody>
            <?php
              showAllUsersRequest($_SESSION['user_id']);
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </body>
</html>
