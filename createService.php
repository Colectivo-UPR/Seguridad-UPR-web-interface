<?php
	// curl -X POST -H "Content-Type: application/json" -H "Authorization: Token 709f60c18e51e49a971cc1f4642f76b6c5f4372f" -d '{"name":"Cuartel Río Piedras","telephone":"7877650841"}' server.ip.addrs.com:#port/create-service/
	session_start();

	if (isset($_SESSION['token'])) {
		require_once("funciones.php");
		$server = "http://136.145.181.112:8080" ;
		$route = "create-service" ;
		$datos = array('name' => $_POST['name'], 'telephone' => $_POST['telephone']) ;
		curl_post($server, $route, $datos, $_SESSION['token']) ;
		header("location: localhost:800/index.php#stars");
	}
	else {
		header("location: localhost:800/index.php#stars");
	}
?>