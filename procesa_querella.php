<?php
require_once("connect.php");

$ruta["querella"] = "querellas";
$ruta["querellante"] = "querella/querellante";
$ruta["perjudicado"] = "querella/perjudicado";
$ruta["testigo"] = "querella/testigo";
$ruta["querellado"] = "querella/querellado";
$ruta["officiales_intervinieron"] = "querella/officiales-intervinieron";

$simples = array("querella","querellante");
$multiples = array("perjudicado","querellado","testigo","officiales_intervinieron");

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
//print_r($_POST);
if(isset($_POST['id_querella']))$id_querella=$_POST['id_querella'];

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
		if($tabla=="intervinieron") $tabla="officiales_intervinieron";
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
//echo "<br><br>";
//echo "querellante";
//print_r($querellante);

if(isset($id_querella))
{
	$resulta=curl_put($server, $ruta['querella'], $id_querella, $querella, $token);
	$tablas = array("querellante","perjudicado","querellado","testigo","officiales_intervinieron");
	foreach($tablas as $tt)
	{
		$temp=curl_get_sin_dash($server, "querella/".str_replace("_","-",$tt)."/?search=$id_querella", $token);
		//echo $tt;
		//print_r($$tt);
		foreach($temp as $t)
		{
			//print_r($t);
			curl_delete($server, $ruta[$tt], $t['id'], $token);
		}
		//curl_delete($server, $ruta["querellante"], $querellante['id'], $token);

	}
}
else
{
	$resulta=curl_post($server, $ruta['querella'], $querella, $token);
	$id_querella =$resulta['id'];
}
//var_dump($id_querella);
/*echo "<br><br>";
echo "querellante";
print_r($querellante);
*/
$querellante=array_merge($querellante,array("id_querella" => $id_querella));
/*echo "<br><br>";
echo "querellante";
print_r($querellante);
*/
curl_post($server, $ruta["querellante"], $querellante, $token);

foreach($multiples as $ttt)
{
	//print_r(${$ttt});
	$a="n_".$ttt;
	//for($i=0;$i<$$a;$i++)
	foreach(${$ttt} as &$entrada)
	{
		//print $ttt;echo "<br>";
//		$datos=array_merge(${$ttt}[$i],array("id_querella" => $id_querella));
		$datos=array_merge($entrada,array("id_querella" => $id_querella));
		//print_r($datos);echo "<br>";
		curl_post($server, $ruta[$ttt], $datos, $token);
	}

}

//echo "location: querella.php?id=$id_querella";
header("location: querella.php?id_querella=".$id_querella);

?>