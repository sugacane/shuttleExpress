<?php
session_start();
ob_start();
include_once('header.php');
$buffer=ob_get_contents();
ob_end_clean();

$title = "Example Page";
$buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);

echo $buffer;
?>

<div class="container">
	<?php 
	echo date("Y-m-d H:00:00")."<br>";
	
	echo time()."<br>";
	if(time() - strtotime(date("H:00:00")) > 3599){
		echo "test";
	}
	
	$time = '2013-01-22 10:45:45';

echo $time = date("H:i:s",strtotime($time));
	?>
</div>

<?php
include_once('footer.php');
?>