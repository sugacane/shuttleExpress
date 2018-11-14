<?php
session_start();
?>
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
    <nav class="navbar navbar-expand-lg navbar-light my-color">
      <a class="navbar-brand" href="home.php"><img alt="shuttleExpress"src="image/logo3-sm-cp.png" /></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#"><i class="fas fa-home"></i> Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-success" href="#"><i class="fas fa-question"></i> Help Desk</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
          </li>
        </ul>
        <ul class="navbar-nav">
					<a class="btn btn-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
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