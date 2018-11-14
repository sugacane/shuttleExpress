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
  include_once('header.php');
   ?>
    <div class="container">
     <form action="add_student_request.php" method="post">
        <h1>Tracking Page</h1>
        <div class="form-group">
          <label>Make request for Shuttle:</label>
          <select class="form-control" name="destination">
            <option value="bridgetown">Bridgetown</option>
            <option value="warrens">Warrens</option>
            <option value="heightsterraces">Heights & Terraces</option>
            <option value="lazaretto">Lazaretto</option>
          </select>
        </div>   
        <div class="form-group">
          <button type="submit" id="submit-btn"  class="btn btn-primary btn-full-width" ><i class="far fa-compass"></i> Request Location</button>
        </div>
        <div class="alert 
          <?php
            if(isset($_SESSION['request_status']))
            {
              if($_SESSION['request_status'] == 1)
              {
                echo "alert-success";
              } else
              {
                echo "alert-danger";
              }
            }
          ?>
          "
        >
         <?php
            if(isset($_SESSION['request_status']))
            {
              if($_SESSION['request_status'] == 1)
              {
                echo "Successfully added your request.";
              } else
              {
                echo "Failed to add your request. Try again.";
              }
              unset($_SESSION['request_status']);
            }
         ?>
       </div>
      </form>
      <h2>My History</h2>
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

          $sql="SELECT destination, time_requested, status, pickup_time FROM tracking WHERE uwi_id=? ORDER BY time_requested DESC LIMIT 10";
          // prepare and bind
          if($stmt = $conn->prepare($sql))
          {
            
            $stmt->bind_param("s", $id);

            $stmt->execute();
            //$rc = $stmt->bind_result($destination,$time);
            $rc = $stmt->get_result();
            //echo "".$rc->num_rows."";
            if( $rc->num_rows > 0 ) {
	   
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
              echo "</td colspan=\"2\">No Result Found<td>";
            }
            
          } else 
          {
            echo "</td colspan=\"2\">Failed Connection to Database<td>";
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
