<?php
	session_start();
	if(isset($_SESSION['token'])){
		require_once('funciones.php');
		$server = 'http://136.145.181.112:8080';
		$route = 'edit-official-phone';
		$id = $_GET['id'];

		curl_delete($server, $route, $id, $_SESSION['token']);

		header('location: securityPhones.php');
	}
	else{
		header('location: securityPhones.php');
	}
?>