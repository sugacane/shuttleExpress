<?php


$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$password = password_hash($password,PASSWORD_DEFAULT);

echo $name." ".$email." ".$password

?>
