<?php
session_start();
//kill all session and redirect to login page
session_destroy();
$newurl = "index.php";
header('Location: '.$newurl);
die();
?>
