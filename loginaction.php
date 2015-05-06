<?php 
session_start();
// curl -X POST -H "Content-Type: application/json" -d '{"username":"colectivo.upr@gmail.com","password":"colectivo!uprrp"}' http://136.145.181.112:8080/api-token-auth/
// curl -X GET -H "Authorization: Token 76f2a7959ab8fe718ae25ed374a71418568e1cd9 " http://136.145.181.112:8080/route/


// curl -X GET -H "Authorization: Token <76f2a7959ab8fe718ae25ed374a71418568e1cd9> https://13v6.145.181.112:8080/services/
// curl -X GET -H "Authorization: Token <76f2a7959ab8fe718ae25ed374a71418568e1cd9>" https://136.145.181.112:8080/services/

require_once("funciones.php");
$server= "http://136.145.181.112:8080";
$route= "rest-auth/login";
//print_r($_POST);
$datos= array("username"=>$_POST['username'],"password"=>$_POST['password']);
//colectivo.upr@gmail.com
//colectivo!uprrp
$token=curl_post($server, $route, $datos, $token = NULL);
var_dump($token);

if($token["key"])
{
	$_SESSION['token'] = $token["key"]; 
	//header("Location: index.php");
}
else
{
	header('Location: login.php');
}
?>