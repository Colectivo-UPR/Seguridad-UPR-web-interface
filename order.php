
<?php
session_start();
echo $_SESSION['order'];
if ($_SESSION['order']="/") {
	$_SESSION['order']= "/?ordering=-incident_date";
	header("location: index.php");
}
else {
	$_SESSION['order']="/";
	header('location: index.php');
}
?>
