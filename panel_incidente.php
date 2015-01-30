<?php 
require_once("funciones.php");

$token="8ca1821b3c1dfc947268768acfaae76567803ddd";
$servicio= "http://136.145.181.112:80"
$incidentes= curl_get($servicio, "incidents", $token);

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Seguridad UPR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="../bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet" media="screen">
  </head>
  <body>
    <h1>Incidentes</h1>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="../bootstrap-3.2.0-dist/js/bootstrap.min.js"></script>
 <table>
 <tr>
 <td>   
		<button type="button" class="btn btn-default" data-toggle="collapse" data-target="#panel_incidenteN">
		  Crear incidente
		</button>
		<div id="panel_incidenteN" class="collapse"><div id="incidenteN"></div></div>
		<script>
			$('#incidenteN').load('info_incidente.php').fadeIn("slow");
		</script>
</td>
</tr>
<?php 
if(count($incidentes))
{
	$i=0;
	foreach($incidentes['results'] as $incidente)
	{
	?>
	<tr>
	<td>
			<button type="button" class="btn btn-default" data-toggle="collapse" data-target="#panel_incidente<?php print $i;?>">
			  <?php print $incidente["title"].' '.date("Y-m-d H:i:s", strtotime($incidente["pub_date"]));?>
			</button>
			<div id="panel_incidente<?php print $i;?>" class="collapse"><div id="incidente<?php print $i;?>"></div></div>
			<script>
				$('#incidente<?php print $i;?>').load('info_incidente.php?datos=<?php print urlencode(json_encode($incidente));?>').fadeIn("slow");
			</script>
	</td>
	</tr>
	<?php
		$i++;
	}
}
?>
</table>
</body>
</html>