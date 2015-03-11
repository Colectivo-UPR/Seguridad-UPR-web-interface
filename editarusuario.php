<?php
session_start();
require_once("funciones.php");
$server= "http://136.145.181.112:8080";
$route= "edit-staff-users";
$datos= array("email"=>$_GET["email"], "first_name"=>$_GET["nombre"], "last_name"=>$_GET["apellidos"]);
curl_put($server, $route, $_get['id'] , $datos, $_SESSION['token']);
header("location: usuarios.php");
?>