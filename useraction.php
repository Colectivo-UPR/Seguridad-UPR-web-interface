<?php
session_start();

if (isset($_SESSION['token'])) {
}
else {
  header("location: index.php");
}

require_once("funciones.php");
$server= "http://136.145.181.112:8080";
$route= "register-staff";
$datos= array("email"=>$_POST["email"], "first_name"=>$_POST["nombre"], "last_name"=>$_POST["apellidos"], "password"=>$_POST["password"]);
$usuarios=curl_post($server, $route, $datos, $_SESSION['token']);

var_dump($usuarios);

// header("location: usuarios.php");
// curl -X POST -H "Content-Type: application/json" -d '{"email":"<email>","first_name":"<nombre>","last_name":"<apellido>","password":"<password>"}' https://web.api.url:<port>/registers

?>