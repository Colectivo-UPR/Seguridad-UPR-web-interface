<?php
session_start();
require_once("funciones.php");
$server = "http://136.145.181.112:8080";
//$token=$_SESSION['token'];
if (!isset($_SESSION['token'])) 
{
	header("location: index.php");
}
else
{
	$token=$_SESSION['token'];
}
?>