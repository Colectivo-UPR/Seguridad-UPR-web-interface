<?php
session_start();
require_once("funciones.php");
$server= "http://136.145.181.112:8080";
$route= "edit-staff-users";
$a = curl_delete($server, $route, $_GET['id'], $_SESSION['token']);
var_dump($a);
// header("location: usuarios.php");
?>