<?php
	session_start();
	if(isset($_SESSION['token'])){
		require_once('funciones.php');
		$server = 'http://136.145.181.112:8080';
		$route = 'edit-official-phone';
		$id = $_GET['id'];
		$datos = array('official' => $_GET['selected-opt'], 'phone_number' => $_GET['number'] );

		curl_put($server, $route, $id, $datos, $_SESSION['token']);

		header('location: securityPhones.php');
	}
	else{
		header('location: index.php');
	}
?>