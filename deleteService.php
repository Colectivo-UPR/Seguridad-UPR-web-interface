<?php
	//curl -X DELETE -H "Content-Type: application/json" -H "Authorization: Token <token>" -d '{"name":"Policía Río Piedras","telephone":"7877650841"}' http://www.example.com:8080/edit-service/2/
	session_start();
	
	if(isset($_SESSION['token'])){
		require_once('funciones.php');
		$server = 'http://136.145.181.112:8080' ;
		$route = 'edit-service' ;
		$id = $_GET['id'] ;
		$datos = array('name' => $_POST['name'], 'telephone' => $_POST['telephone']) ;

		curl_delete($server, $route, $id, $_SESSION['token']) ;

		header('location: localhost:800/index.php#stars') ;
	}
	else{
		header('location: localhost:800/index.php#stars') ;
	}
?>