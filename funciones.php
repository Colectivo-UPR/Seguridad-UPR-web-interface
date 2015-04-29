<?php

date_default_timezone_set('America/Anguilla');

function curl_post($server, $route, $datos, $token = NULL)
{
	$service_url = "$server/$route/";
	$curl = curl_init($service_url);
	$curl_post_data = $datos;
	//var_dump($curl_post_data);
	//$curl_post_data = json_decode($datos,true);

	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
	if(isset($token)){curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Token $token"));}
	$curl_response = curl_exec($curl);
	$info = curl_getinfo($curl);
	if ($curl_response === false) {
		curl_close($curl);
		die('error: ' . var_export($info));
	}
	curl_close($curl);
	$decoded = json_decode($curl_response, true);
	//print_r($info);
	if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
		die('error occured: ' . $decoded->response->errormessage);
	}
	return $decoded;
}

function curl_post_json($server, $route, $datos, $token = NULL)
{
	$service_url = "$server/$route/";
	$curl = curl_init($service_url);
	// $curl_post_data = $datos;
	//var_dump($curl_post_data);
	$curl_post_data = json_encode($datos,true);

	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
	if(isset($token)){curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Token $token"));}
	$curl_response = curl_exec($curl);
	$info = curl_getinfo($curl);
	if ($curl_response === false) {
		curl_close($curl);
		die('error: ' . var_export($info));
	}
	curl_close($curl);
	$decoded = json_decode($curl_response, true);
	//print_r($info);
	if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
		die('error occured: ' . $decoded->response->errormessage);
	}
	return $decoded;
}


function curl_get($server, $route, $token)
{

	$service_url = "$server/$route/";
	$curl = curl_init($service_url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Token $token"));
	$curl_response = curl_exec($curl);
	$info = curl_getinfo($curl);

	if ($curl_response === false) 
	{
		curl_close($curl);
		die('error: ' . var_export($info));
	}
	curl_close($curl);
	$decoded = json_decode($curl_response, true);

	if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') 
	{
		die('error occured: ' . $decoded->response->errormessage);
	}

	//print_r($info);
	return $decoded;
}

function curl_get_sin_dash($server, $route, $token)
{

	$service_url = "$server/$route";
	$curl = curl_init($service_url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Token $token"));
	$curl_response = curl_exec($curl);
	$info = curl_getinfo($curl);

	if ($curl_response === false) 
	{
		curl_close($curl);
		die('error: ' . var_export($info));
	}
	curl_close($curl);
	$decoded = json_decode($curl_response, true);

	if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') 
	{
		die('error occured: ' . $decoded->response->errormessage);
	}

	//print_r($info);
	return $decoded;
}

function curl_put($server, $route, $id, $datos, $token = NULL){
	$service_url = "$server/$route/$id/" ;
	$curl = curl_init($service_url) ;
	$curl_post_data = $datos ;

	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true) ;
	curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Token $_SESSION[token]")) ;
	curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data) ;

	$curl_response = curl_exec($curl) ;
	$info = curl_getinfo($curl) ;

	if ($curl_response === false) 
	{
		curl_close($curl);
		die('error: ' . var_export($info));
	}

	curl_close($curl);
	$decoded = json_decode($curl_response, true);

	if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
		die('error occured: ' . $decoded->response->errormessage);
	}

	return $decoded;
}

function curl_delete($server, $route, $id, $token = NULL){
	$service_url = "$server/$route/$id/" ;
	$curl = curl_init($service_url) ;

	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE') ;
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true) ;
	curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Token $_SESSION[token]")) ;

	$curl_response = curl_exec($curl) ;
	$info = curl_getinfo($curl) ;
	
	if ($curl_response === false) 
	{
		curl_close($curl) ;
		die('error: ' . var_export($info)) ;
	}

	curl_close($curl) ;
	$decoded = json_decode($curl_response, true) ;

	if (isset($decoded->response->status) && $decoded->response->status == 'ERROR'){
		die('error occured: ' . $decoded->response->errormessage) ;
	}

	return $decoded ;
}

?>