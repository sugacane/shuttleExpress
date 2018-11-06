<?php
session_start();
?>

<!-- Login Page -->
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Test Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <div class="container">
      <form action="create_new_user.php" method="post">
          <label>ADMIN</label>
          <input type="number" class="form-control" name="admin">
          <label>UWI ID</label>
          <input type="text" class="form-control" name="uwi_id">
          <label>First Name</label>
          <input type="text" class="form-control" name="fname">
          <label>Last Name</label>
          <input type="text" class="form-control" name="lname">
          <label >Email:</label>
          <input type="text" class="form-control" name="email">
          <label >Password:</label>
          <input type="password" class="form-control" name="password">
          <?php 
          if(isset($_SESSION['create_status']))
          {
            echo $_SESSION['create_status'];
            unset($_SESSION['create_status  ']);
          }
          ?>
          <input class="btn btn-primary" type="submit" id="submit-register-btn" value="Create New User"/>
      </form>           
    </div>
  </body>
</html>
