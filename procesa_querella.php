<?php
session_start();
require_once("funciones.php");
$server = "http://136.145.181.112:8080";
$token=$_SESSION['token'];
    if (isset($_SESSION['token'])) {
   //   header("location: index.php");
}
    else {
}
$token='709f60c18e51e49a971cc1f4642f76b6c5f4372f';


$ruta["querella"] = "querellas";
$ruta["querellante"] = "querella/querellante";
$ruta["perjudicado"] = "querella/perjudicado";
$ruta["testigo"] = "querella/testigo";
$ruta["querellado"] = "querella/querellado";
$ruta["oficiales_intervinieron"] = "querella/officiales-intervinieron";

$simples = array("querella","querellante");
$multiples = array("perjudicado","querellado","testigo","oficiales_intervinieron");

foreach($simples as $tt) $$tt=array();

foreach($multiples as $tt)
{
	$$tt=array();
	$a="n_$tt";//echo $a;echo "<br>\n";
	$$a=$_POST[$a];
	unset($_POST[$a]);
	for($k=1;$k<=$$a;$k++)
	{
		${$tt}[$k]=array();
	}
}
print_r($_POST);

//print "<br>";
foreach($_POST as $atributo => $entrada)
{
	$tabla = substr($atributo,strrpos($atributo,"_")+1);
	if($tabla!="querellante" and $tabla!="perjudicado" and $tabla!="testigo" and $tabla!="querellado" and $tabla!="intervinieron")
	{
		$tabla = "querella";
		$querella=array_merge($querella,array($atributo => $entrada)); 
	}
	else
	{
		if($tabla=="intervinieron") $tabla="oficiales_intervinieron";
		$atributo = substr($atributo,0,strpos($atributo, $tabla)-1);
		$n = substr($atributo,-1);
		if(is_numeric($n))
		{
			$atributo = substr($atributo,0,-1);
			${$tabla}[$n]=array_merge(${$tabla}[$n],array($atributo => $entrada)); 
		}
		else $$tabla=array_merge($$tabla,array($atributo => $entrada)); 
	}
}

//$id_querella=curl_post($server, $ruta['querella'], $querella, $token);
$id_querella =1;
var_dump($id_querella);
$querellante=array_merge($querellante,array("id_querella" => $id_querella));
//print_r($querellante);
//curl_post($server, $ruta["querellante"], $querellante, $token);

foreach($multiples as $ttt)
{
	$a="n_".$ttt;
	for($i=1;$i<=$$a;$i++)
	{
		$datos=array_merge(${$ttt}[$i],array("id_querella" => $id_querella));
		print_r($datos);echo "<br>";
		curl_post($server, $ruta[$ttt], $datos, $token);
	}

}

//echo "location: querella.php?id=$id_querella";
//header("location: querella.php?id="$id_querella);

?>