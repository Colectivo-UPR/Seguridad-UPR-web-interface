<?php 
// curl -X POST -H "Content-Type: application/json" -d '{"username":"prueba","password":"test"}' http://136.145.181.112:80/api-token-auth/
// curl -X GET -H "Authorization: Token f1aa9c78927c01617c1b0d1540bc2064375768b9" http://136.145.181.112:80/reports/

require_once("funciones.php");
$server= "http://136.145.181.112:80";

// No se como es que se supone que mandes los $datos y tampoco se como combinar apostrofes y comillas. 
// Mi problema es que no entiendo como es que funcionan las funciones y como se manda y se recibe la informacion y
// esto es uno de mis intento con lo poco que se.

$apos= "'"; 
$datos= '{"username":"prueba","password":"test"}';
$datos= $apos . $datos . $apos;

//Estos son pruebas
print $_POST['username'];
print $_POST['password'];
print $datos;

// Que es lo que se supone que tenga la variable $datos?
curl_post($server, $route, $datos, $token = NULL);
?>