<?php
session_start();
if(isset($_SESSION["user_id"]))
{
  //redirect to home page
  
} else if(isset($_SESSION["admin_status"]))
{
  //redirect to admin view
  
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </head>
  <body>
    <div class="container">
       <div class="login-container">
        <h1>shuttleExpress Login</h1>
        <form action="verify_login.php" method="post">
          <div class="form-group">
            <label>UWI ID:</label>
            <input type="text" class="form-control" name="user_id">
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password">
          </div>
          <div class="form-group">
          <?php 
          if(isset($_SESSION['errors']))
          {
            echo $_SESSION['errors'];
            unset($_SESSION['errors']);
          }
          ?>
          </div>
          <div class="form-group">
            <input class="btn btn-primary btn-full-width" type="submit" name="submit-btn" value="Log In"/>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
