<?php
session_start();
if(!isset($_SESSION['user_id']))
{
  session_destroy();
  $newurl = "index.php";
  header('Location: '.$newurl);
  die();
}
?>

<!-- Login Page -->

<!DOCTYPE html>
<html>
  <head>
    <title>Tracking Home Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
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
     <form action="add_student_request.php" method="post">
        <h1>Tracking Page</h1>
        <div class="form-group">
          <label for="sel1">Select list:</label>
          <select class="form-control" name="destination">
            <option value="bridgetown">Bridgetown</option>
            <option value="warrens">Warrens</option>
            <option value="heightsterraces">Heights & Terraces</option>
            <option value="lazaretto">Lazaretto</option>
          </select>
        </div>   
        <div class="form-group">
          <input class="btn btn-primary btn-full-width" type="submit" id="submit-btn" value="Request Location"/>
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
    </div>
  </body>
</html>
