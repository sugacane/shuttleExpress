<?php
session_start();

ob_start();
include_once('header.php');
$buffer=ob_get_contents();
ob_end_clean();

$title = "Help Page";
$buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);

echo $buffer;

?>

<?php 
include_once('footer.php');
?>