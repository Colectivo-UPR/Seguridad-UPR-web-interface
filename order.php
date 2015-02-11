
<?php
session_start();
echo $_SESSION['order'];
if ($_SESSION['order']="/?ordering=-incident_date") {
	$_SESSION['order']= "/";
	echo "  1"; 
	// header("location: index.php");
}
else {
	$_SESSION['order']="/?ordering=-incident_date";
	echo "  2";
	// header('location: index.php');
}
?>
