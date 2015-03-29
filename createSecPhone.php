<?php
	session_start();
	if(isset($_SESSION['token'])){
		require_once('funciones.php');
		$server = 'http://136.145.181.112:8080';
		$route = 'create-official-phone';
		$data = array('official' => $_POST['selected_opt'], 'phone_number' => $_POST['number']);
		
		curl_post($server, $route, $data, $_SESSION['token']);

		header('location: securityPhones.php');
	}
	else{
		header('location: securityPhones.php');
	}
?>