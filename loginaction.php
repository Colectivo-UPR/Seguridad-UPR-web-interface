<?php 
session_start();
// curl -X POST -H "Content-Type: application/json" -d '{"username":"colectivo.uprrp@gmail.com","password":"colectivo!uprrp"}' http://136.145.181.112:8080/api-token-auth/
// curl -X GET -H "Authorization: Token f1aa9c78927c01617c1b0d1540bc2064375768b9" http://54.172.3.196:8000/reports/

require_once("funciones.php");
$server= "http://136.145.181.112:8080";
$route= "api-token-auth";
//print_r($_POST);
$datos= array("username"=>$_POST['username'],"password"=>$_POST['password']);
//colectivo.upr@gmail.com
//colectivo!uprrp
$token=curl_post($server, $route, $datos, $token = NULL);
// var_dump($token);
$token=($token['token']);
$_SESSION['token']=$token;


if($token["token"])
{
	$_SESSION['token'] = $token;
	header("Location: index.php");
}
else
{
	header('Location: login.php');
}
?>