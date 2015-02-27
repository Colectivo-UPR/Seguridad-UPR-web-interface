<?php
session_start();
require_once("funciones.php");

require_once("funciones.php");
$server= "http://136.145.181.112:8080";
$route= "edit-staff-users";
$datos= array("email"=>$_POST["email"], "first_name"=>$_POST["nombre"], "last_name"=>$_POST["apellidos"], "password"=>$_POST["password"]);
var_dump($datos);


// $usuarios=curl_post($server, $route . "/" . $_POST['id'] . "/", $datos, $_SESSION['token']);
// header("location: usuarios.php");
?>  