<?php
	session_start();
	if(isset($_SESSION['token'])){
		require_once('funciones.php');
		$server = 'http://136.145.181.112:8080';
		$route = 'edit-service';
		$id = $_GET['id'];

		curl_delete($server, $route, $id, $_SESSION['token']);

		header('location: servicios.php');
	}
	else{
		header('location: servicios.php');
	}
?>