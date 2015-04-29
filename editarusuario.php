<?php
session_start();
require_once("funciones.php");
$server= "http://136.145.181.112:8080";
$route= "edit-staff-user";
$datos= array("email"=>$_GET["email"], "first_name"=>$_GET["nombre"], "last_name"=>$_GET["apellidos"]);
$a = curl_put($server, $route, $_GET['id'], $datos, $_SESSION['token']);

if (isset($_GET['director'])) {
	$director = true;
} else {
	$director = false;
}

if (isset($_GET['manager'])) {
	$manager = true;
} else {
	$manager = false;
}

if (isset($_GET['official'])) {
	$official = true;
} else {
	$official = false;
}

$rutaTipo = "staff-permissions/" . $_GET['email'];
$datoTipo = array("is_director"=> $director, "is_shift_manager"=> $manager, "is_official"=> $official);
$tipo = curl_post_json($server, $rutaTipo, $datoTipo, $_SESSION['token']);

header("location: usuarios.php");
?>