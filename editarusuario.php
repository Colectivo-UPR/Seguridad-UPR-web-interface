<?php
session_start();
require_once("funciones.php");
$server= "http://136.145.181.112:8080";
$route= "edit-staff-user";
$datos= array("email"=>$_GET["email"], "first_name"=>$_GET["nombre"], "last_name"=>$_GET["apellidos"], /* get the tipo de usuario*/);
$id = $_GET['id'];
$a = curl_put($server, $route, $id , $datos, $_SESSION['token']);
var_dump($a);

if (isset($_GET['director'])) {
	$director = "true";
} else {
	$director = "false";
}

if (isset($_GET['manager'])) {
	$manager = "true";
} else {
	$manager = "false";
}

if (isset($_GET['official'])) {
	$official = "true";
} else {
	$official = "false";
}

echo $director;
echo $manager;
echo $official;

$rutaTipo = "staff-permissions/" . $_GET['email'];
$datoTipo = array("is_director"=> $director, "is_shift_manager"=> $manager, "is_official"=> $official);
$tipo = curl_post($server, $rutaTipo, $datoTipo, $_SESSION['token']);
var_dump($tipo);

// header("location: usuarios.php");
?>