<?php

session_start();

require_once("funciones.php");

function send_alert($message)
{
	$server= "http://127.0.0.1:8080";
	$route = "send-alert";
	$datos = array("message"=>$message);

	print 'token: ' . $_SESSION['token']; 
	
	$request = curl_post_json($server, $route, $datos);
} ?>