<?php
	session_start();
	if(isset($_SESSION['token'])){
		require_once('funciones.php');
		$server = 'http://136.145.181.112:8080';
		$route = 'edit-service';
		$id = $_GET['id'];
		$datos = array('name' => $_GET['name'], 'telephone'	=> $_GET['telephone']);

		curl_put($server, $route, $id, $datos, $_SESSION['token']);

		header('location: servicios.php');
	}
	else{
		header('location: servicios.php');
	}
?>