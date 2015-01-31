<?php 
session_start();
// curl -X POST -H "Content-Type: application/json" -d '{"username":"prueba","password":"test"}' http://54.165.138.75:8000/api-token-auth/
// curl -X GET -H "Authorization: Token f1aa9c78927c01617c1b0d1540bc2064375768b9" http://54.172.3.196:8000/reports/

require_once("funciones.php");
$server= "http://136.145.181.112:8080";
$route= "api-token-auth";
//print_r($_POST);
$apos= "'"; 
$datos= array("username"=>$_POST['username'],"password"=>$_POST['password']);
//colectivo.uprrp@gmail.com
//colectivo!uprrp
$token=curl_post($server, $route, $datos, $token = NULL);
$token=($token['token']);

if($token["token"])
{
	$_SESSION['token']=$token;
	header("Location: index.php");
}
else
{
	header('Location: error.php');
}
// f7dfca98ac1273bdefb088da0b54ca35c7cffdcb
?>