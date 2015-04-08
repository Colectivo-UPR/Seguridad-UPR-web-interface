<?php
session_start();
require_once("funciones.php");
$server= "http://136.145.181.112:8080";
$route= "edit-staff-user";
$datos= array("email"=>$_GET["email"], "first_name"=>$_GET["nombre"], "last_name"=>$_GET["apellidos"], /* get the tipo de usuario*/);
$id = $_GET['id'];
$a = curl_put($server, $route, $id , $datos, $_SESSION['token']);
var_dump($a);
// header("location: usuarios.php");
?>