<?php
session_start();
if(isset($_SESSION["user_id"]))
{
  //redirect to home page
	$newurl = "home.php";
  header('Location: '.$newurl);
  die();
  
}


?>

<!-- Login Page -->

<!DOCTYPE html>
<html>
  <head>
    <title>Login Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/all.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </head>
  <body class="login-background">
    <div class="container">
       <div class="login-container card ">
          <div class="card-header bg-dark">
            <h3>shuttleExpress</h3>
          </div>
          <div class="card-body">
          <h5 class="card-title" >Please enter login credetials below</h5>
        <form action="verify_login.php" method="post">
          <div class="form-group">
            <label class="lil-labels">UWI ID:</label>
            <input type="text" class="form-control login-inputs" name="user_id">
            <i class="fas fa-user login-icons"></i>
          </div>
          <div class="form-group">
            <label class="lil-labels">Password:</label>
            <input type="password" class="form-control login-inputs" name="password">
            <i class="fas fa-key login-icons"></i>
          </div>
          <div class="form-group">
          <div class="">
          	<h5>
							<?php 
							if(isset($_SESSION['errors']))
							{
								echo "<div class='alert alert-warning'>";
								echo "".$_SESSION['errors'];
								echo "</h5>";
								echo "</div>";
								unset($_SESSION['errors']);
								
							}
							?>
          </div>
          <div class="form-group">
            <input class="btn btn-dark btn-full-width " type="submit" name="submit-btn" value="Log In"/>
          </div>
        </form>
         </div>
      </div>
    </div>
  </body>
</html>
