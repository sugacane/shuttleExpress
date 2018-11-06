<?php

?>

<!-- Login Page -->
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <title>Test Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <div class="container">
      <form action="receive.php" method="post">
          
          <input type="text" class="form-control" name="name">
          <label for="email">Email:</label>
          <input type="text" class="form-control" name="email">
          <label for="password">Password:</label>
          <input type="password" class="form-control" name="password">
        <input class="btn btn-primary" type="submit" id="submit-btn" value="Log In"/>
      </form>           
    </div>
  </body>
</html>
