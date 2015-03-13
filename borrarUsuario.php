<?php
session_start();
require_once("funciones.php");
$server = "http://136.145.181.112:8080";
$route= "edit-staff-user";
$id = $_GET['id'];
$a = curl_delete($server, $route, $id, $_SESSION['token']);
header("location: usuarios.php");
?>