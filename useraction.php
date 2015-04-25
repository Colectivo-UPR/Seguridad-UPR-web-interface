<?php
session_start();

if (isset($_SESSION['token'])) {
}
else {
  header("location: index.php");
}

// stack overflow woooo
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

require_once("funciones.php");
$server= "http://136.145.181.112:8080";

$route= "rest-auth/registration";
$password = generateRandomString();
$datos= array("email"=>$_POST["email"], "first_name"=>$_POST["nombre"], "last_name"=>$_POST["apellidos"], "password1"=>$password, "password2"=> $password);
$usuarios=curl_post($server, $route, $datos, $_SESSION['token']);


if (isset($_POST['director'])) {
	$director = true;
} else {
	$director = false;
}

if (isset($_POST['manager'])) {
	$manager = true;
} else {
	$manager = false;
}

if (isset($_POST['official'])) {
	$official = true;
} else {
	$official = false;
}

$rutaTipo = "staff-permissions/" . $_POST['email'];
$datoTipo = array("is_director"=> $director, "is_shift_manager"=> $manager, "is_official"=> $official);
$tipo = curl_post_json($server, $rutaTipo, $datoTipo, $_SESSION['token']);

var_dump($tipo);


header("location: usuarios.php");
// curl -X POST -H "Content-Type: application/json" -d '{"email":"<email>","first_name":"<nombre>","last_name":"<apellido>","password":"<password>"}' https://web.api.url:<port>/registers

?>