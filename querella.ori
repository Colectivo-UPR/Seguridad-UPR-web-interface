<?php
session_start();
require_once("funciones.php");
$server = "http://136.145.181.112:8080";
//$token=$_SESSION['token'];
if (!isset($_SESSION['token'])) 
{
	header("location: index.php");
}
else
{
	$token=$_SESSION['token'];
}
//$token='709f60c18e51e49a971cc1f4642f76b6c5f4372f';

$rutas=array('area_geografica','sancion_arresto','tipo_incidente','medio_notificacion','forma_se_refirio','sector');
//print_r($rutas);

foreach($rutas as $ruta)
{
	//echo "*";
	$ans=curl_get($server, 'querella/'.str_replace("_","-",$ruta), $token);
	$$ruta=$ans;
	//print_r($$ruta);
	//echo "*";
}
?>
<!DOCTYPE html>
<html lang="en">
<!--Configuracion de bootstap-->
  <head>
    <title>Seguridad UPRRP</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/me.css" rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

<!-- topbar y sidebar -->
  <header>
    <nav class="topbar" >
      <a href="index.php" class="navbar-brand">Seguridad UPRRP</a>
      <ul class="nav panel panel-default">
        <li class="navbar-right"><a href="logout.php">Logout</a></li>
      </ul>
    </nav>

    <nav class="sidebar">
      <ul class="vertical nav" >
      	<li role="presentation"><a href="alertas.php" ><img src="imagenes/alertas.png" /></a></li>
        <li role="presentation"><a href="usuarios.php" ><img src="imagenes/usuarios.png" /></a></li>
        <li role="presentation"><a href="mundo.php" ><img src="imagenes/world.png" /></a></li>
        <li role="presentation"><a href="servicios.php" ><img src="imagenes/stars.png" /></a></li>
      </ul>
    </nav>
  </header>
<body>
    <div class="tab-content container-fluid content" >
 <!--     <h1>Avisos de Emergencia</h1> -->
      <div role="tabpanel">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation"><a href="alertas.php" aria-controls="alertas">Avisos</a></li>
          <li role="presentation"><a href="reportes.php" aria-controls="reportes" >Reportes</a></li>
          <li role="presentation" class="active"><a href="querella.php" aria-controls="querellas">Querellas</a></li>
        </ul>
	</div>
<!--  </div>
  
    <div class="container-fluid content"> 
    -->
        <h2>Querella</h2>
      <form class="form-inline" role="form" method="post" action="procesa_querella.php">

<div class="form-group col-md-8">
    <label for="numero_caso">Número de caso:</label>
    <input type="text" class="form-control-corrada col-md-8" id="numero_caso" name="numero_caso" placeholder="Número de caso" required>
  </div>
 
<div class="form-group col-md-4">
    <label for="area_geografica">Área geográfica:</label>
<select class="form-control-corrada col-md-4" id="area_geografica" name="area_geografica" required>
<?php
foreach($area_geografica as $id => $tipo)
{
?>
<option value="<?php echo $tipo['id'];?>"><?php echo $tipo['tipo'];?></option>
<?php
}
?>
</select>
 </div>      

<div class="form-group col-md-5">
    <label for="nombre_querellante">Nombre del querellante:</label>
    <input type="text" class="form-control-corrada col-md-5" id="nombre_querellante" name="nombre_querellante" placeholder="Nombre del querellante" required>
  </div>

<div class="form-group col-md-5">
    <label for="fecha_informada">Fecha informada:</label>
    <input type="datetime-local" class="form-control-corrada col-md-5" id="fecha_informada" name="fecha_informada" required>
  </div>

<div class="form-group col-md-4">
    <label for="direccion_residencial">Dirección residencial:</label>
<textarea class="form-control-box col-md-4" rows="4" id="direccion_residencial_querellante" name="direccion_residencial_querellante" required></textarea>
<br>
    <label for="direccion_postal">Dirección postal:</label>
<textarea class="form-control-box col-md-4" rows="4" id="direccion_postal_querellante" name="direccion_postal_querellante" required></textarea>
  </div>
  
<div class="form-group col-md-4">
    <label for="numero_identificacion">Número de identificación:</label>
    <input type="text" class="form-control-corrada col-md-4" id="numero_identificacion_querellante" name="numero_identificacion_querellante" placeholder="Número de identificación">
  </div>

<div class="form-group col-md-4">
    <label for="medio_notificacion">Medio de notificación:</label>
<select class="form-control-corrada col-md-4" id="medio_notificacion" name="medio_notificacion" required>
<?php
foreach($medio_notificacion as $id => $tipo)
{
?>
<option value="<?php echo $tipo['id'];?>"><?php echo $tipo['tipo'];?></option>
<?php
}
?>
</select>
  </div>

<div class="form-group col-md-4">
    <label for="lugar_trabajo">Lugar de trabajo:</label>
    <input type="text" class="form-control-corrada col-md-4" id="lugar_trabajo_querellante" name="lugar_trabajo_querellante" placeholder="Lugar de trabajo"> 
  </div>

<div class="form-group col-md-4">
    <label for="tel_trabajo">Teléfono y extensión de trabajo:</label>
    <input type="tel" pattern="(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}(( |[x ])?\d{4})?" class="form-control-corrada col-md-4" id="tel_trabajo_querellante" name="tel_trabajo_querellante" placeholder="Teléfono trabajo"> 
  </div>

<div class="form-group col-md-4">
    <label for="tel_personal">Teléfono o celular personal:</label>
    <input type="tel" pattern="(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}(( |[x ])?\d{4})?" class="form-control-corrada col-md-4" id="tel_personal_querellante" name="tel_personal_querellante" placeholder="Teléfono personal" required> 
  </div>

<div class="form-group col-md-4">
    <label for="sector_querellante">Sector del querellante:</label>
<select class="form-control-corrada col-md-4" id="sector_querellante" name="sector_querellante" required>
<?php
foreach($sector as $id => $tipo)
{
?>
<option value="<?php echo $tipo['id'];?>"><?php echo $tipo['tipo'];?></option>
<?php
}
?>
</select>
  </div>
	

<div class="form-group col-md-4">
    <label for="fotos">¿Se tomaron fotos?</label>
<select class="form-control-corrada col-md-4" name="hay_fotos" id="hay_fotos" required>
<option value="true">Sí</option>
<option value="false" selected>No</option>
</select>
  </div>
	
 
<div class="form-group col-md-4">
    <label for="genero_querellante">Sexo</label>
<select class="form-control-corrada col-md-4" name="genero_querellante" id="genero_querellante" required>
<option value="0">M</option>
<option value="1" selected>F</option>
</select>
  </div>
	
<div class="form-group col-md-12">
</div>

<div class="form-group col-md-4">
    <label for="tipo_identificacion_querellante">Tipo ID:</label>
    <input type="text" class="form-control-corrada col-md-4" id="tipo_identificacion_querellante" name="tipo_identificacion_querellante" placeholder="Tipo ID" required>
  </div>
 
<div class="form-group col-md-4">
    <label for="numero_identificacion_querellante">Número ID:</label>
    <input type="text" class="form-control-corrada col-md-4" id="numero_identificacion_querellante" name="numero_identificacion_querellante" placeholder="Número ID" required>
  </div>
 
<div class="form-group col-md-4">
    <label for="email_querellante">Correo electrónico:</label>
    <input type="email" class="form-control-corrada col-md-4" id="email_querellante" name="email_querellante" placeholder="Correo electrónico" required>
  </div>
<div class="form-group col-md-12">
<hr> 
</div>
 
<div class="form-group col-md-12">
<h3>Personas perjudicadas</h3>
</div>

<?php
$n_perjudicado=3;

for($i=1;$i<=$n_perjudicado;$i++)
{
?>

<div class="form-group col-md-4">
    <label for="nombre<?php echo $i;?>_perjudicado">Nombre Perjudicado:</label>
    <input type="text" class="form-control-corrada col-md-4" id="nombre<?php echo $i;?>_perjudicado" name="nombre<?php echo $i;?>_perjudicado" placeholder="Nombre Perjudicado" <?php if($i==1)echo 'required';?>>
<br>
    <label for="telefono<?php echo $i;?>_perjudicado">Teléfono:</label>
    <input type="tel" pattern="(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}(( |[x ])?\d{4})?" class="form-control-corrada col-md-4" id="tel<?php echo $i;?>_perjudicado" name="telefono<?php echo $i;?>_perjudicado" placeholder="Teléfono personal" <?php if($i==1)echo 'required';?>> 
  </div>
 
<div class="form-group col-md-4">
    <label for="direccion_residencial<?php echo $i;?>_perjudicado">Dirección residencial:</label>
<textarea class="form-control-box col-md-4" rows="4" id="direccion_residencial<?php echo $i;?>_perjudicado" name="direccion_residencial<?php echo $i;?>_perjudicado" placeholder="Dirección residencial" <?php if($i==1)echo 'required';?>></textarea>
  </div>
 
<div class="form-group col-md-4">
    <label for="direccion_postal<?php echo $i;?>_perjudicado">Dirección postal:</label>
<textarea class="form-control-box col-md-4" rows="4" id="direccion_postal<?php echo $i;?>_perjudicado" name="direccion_postal<?php echo $i;?>_perjudicado" placeholder="Dirección postal" <?php if($i==1)echo 'required';?>></textarea>
  </div>
<div class="form-group col-md-12">
<hr> 
</div>
<?php
}
?>
<input type="hidden" name="n_perjudicado" value="<?php echo $n_perjudicado;?>">


<div class="form-group col-md-12">
<h3>Testigos</h3>
</div>

<?php
$n_testigo=3;

for($i=1;$i<=$n_testigo;$i++)
{
?>

<div class="form-group col-md-4">
    <label for="nombre<?php echo $i;?>_testigo">Nombre Testigo:</label>
    <input type="text" class="form-control-corrada col-md-4" id="nombre<?php echo $i;?>_testigo" name="nombre<?php echo $i;?>_testigo" placeholder="Nombre Perjudicado" <?php if($i==1)echo 'required';?>>
<br>
    <label for="telefono<?php echo $i;?>_testigo">Teléfono:</label>
    <input type="tel" pattern="(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}(( |[x ])?\d{4})?" class="form-control-corrada col-md-4" id="telefono<?php echo $i;?>_testigo" name="telefono<?php echo $i;?>_testigo" placeholder="Teléfono personal" <?php if($i==1)echo 'required';?>> 
  </div>
 
<div class="form-group col-md-4">
    <label for="direccion_residencial<?php echo $i;?>_testigo">Dirección residencial:</label>
	<textarea class="form-control-box col-md-4" rows="4" id="direccion_residencial<?php echo $i;?>_testigo" name="direccion_residencial<?php echo $i;?>_testigo" placeholder="Dirección residencial" <?php if($i==1)echo 'required';?>></textarea>
  </div>
 
<div class="form-group col-md-4">
    <label for="direccion_postal<?php echo $i;?>_testigo">Dirección postal:</label>
	<textarea class="form-control-box col-md-4" rows="4" id="direccion_postal<?php echo $i;?>_testigo" name="direccion_postal<?php echo $i;?>_testigo" placeholder="Dirección postal" <?php if($i==1)echo 'required';?>></textarea>
  </div>

<div class="form-group col-md-12">
<hr> 
</div>
<?php
}
?>
<input type="hidden" name="n_testigo" value="<?php echo $n_testigo;?>">


<div class="form-group col-md-12">
<h3>Datos sobre el incidente</h3>
</div>
<div class="form-group col-md-4">
    <label for="fecha_incidente">Fecha:</label>
    <input type="datetime-local" class="form-control-corrada col-md-6" id="fecha_incidente" name="fecha_incidente" required>
  </div>

<div class="form-group col-md-6">
    <label for="lugar_incidente">Lugar:</label>
	<input type="text" class="form-control-box col-md-6" id="lugar_incidente" name="lugar_incidente" required>
  </div>

<div class="form-group col-md-2">
    <label for="area_incidente">Área:</label>
<select class="form-control-corrada col-md-2" id="area_incidente" name="area_incidente" required>
<option value="A">A</option>
<option value="B">B</option>
<option value="C">C</option>
</select>
  </div>
  
<div class="form-group col-md-5">
    <label for="tipo_incidente">Tipo de querella:</label>
<select class="form-control-corrada col-md-5" id="tipo_incidente" name="tipo_incidente" required>
<?php
foreach($tipo_incidente as $id => $tipo)
{
?>
<option value="<?php echo $tipo['id'];?>"><?php echo $tipo['tipo'];?></option>
<?php
}
?>
</select>
  </div>
	

<div class="form-group col-md-4">
    <label for="sancion_arresto">Sanciones y/o arrestos por:</label>
<select class="form-control-corrada col-md-4" id="sancion_arresto" name="sancion_arresto">
<?php
foreach($sancion_arresto as $id => $tipo)
{
?>
<option value="<?php echo $tipo['id'];?>"><?php echo $tipo['tipo'];?></option>
<?php
}
?>
</select>
  </div>

<div class="form-group col-md-3">
    <label for="crimen_odio">Crimen por Odio</label>
<select class="form-control-corrada col-md-3" name="crimen_odio" id="crimen_odio" required>
<option value="true">Sí</option>
<option value="false" selected>No</option>
</select>
  </div>
	
<div class="form-group col-md-6">
    <label for="descripcion_incidente">Descripción de la querella (qué, cómo, cuándo, dónde, quién):</label>
<textarea class="form-control-box col-md-6" rows="4" id="descripcion_incidente" name="descripcion_incidente" required></textarea>
  </div>
  
<div class="form-group col-md-12">
<h3>Querellado(s)</h3>
</div>

<?php
$n_querellado=3;

for($i=1;$i<=$n_querellado;$i++)
{
?>

<div class="form-group col-md-4">
    <label for="nombre<?php echo $i;?>_querellado">Nombre querellado:</label>
    <input type="text" class="form-control-corrada col-md-4" id="nombre<?php echo $i;?>_querellado" name="nombre<?php echo $i;?>_querellado" placeholder="Nombre Perjudicado" <?php if($i==1)echo 'required';?>>
<br>
    <label for="telefono<?php echo $i;?>_querellado">Teléfono:</label>
    <input type="tel" pattern="(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}(( |[x ])?\d{4})?" class="form-control-corrada col-md-4" id="telefono<?php echo $i;?>_querellado" name="telefono<?php echo $i;?>_querellado" placeholder="Teléfono personal" <?php if($i==1)echo 'required';?>> 
  </div>
 
<div class="form-group col-md-4">
    <label for="direccion_residencial<?php echo $i;?>_querellado">Dirección residencial:</label>
	<textarea class="form-control-box col-md-4" rows="4" id="direccion_residencial<?php echo $i;?>_querellado" name="direccion_residencial<?php echo $i;?>_querellado" placeholder="Dirección residencial" <?php if($i==1)echo 'required';?>></textarea>
  </div>
 
<div class="form-group col-md-4">
    <label for="direccion_postal<?php echo $i;?>_querellado">Dirección postal:</label>
	<textarea class="form-control-box col-md-4" rows="4" id="direccion_postal<?php echo $i;?>_querellado" name="direccion_postal<?php echo $i;?>_querellado" placeholder="Dirección postal" <?php if($i==1)echo 'required';?>></textarea>
  </div>
<div class="form-group col-md-12">
<hr> 
</div>

<?php
}
?>
<input type="hidden" name="n_querellado" value="<?php echo $n_querellado;?>">

<div class="form-group col-md-12">
<h3>Oficiales de seguridad que intervinieron</h3>
</div>

<?php
$n_officiales_intervinieron=3;

for($i=1;$i<=$n_officiales_intervinieron;$i++)
{
?>
<div class="form-group col-md-4">
    <label for="nombre<?php echo $i;?>_officiales_intervinieron">Nombre oficial:</label>
    <input type="text" class="form-control-corrada col-md-4" id="nombre<?php echo $i;?>_officiales_intervinieron" name="nombre<?php echo $i;?>_officiales_intervinieron" placeholder="Nombre Oficial" <?php if($i==1)echo 'required';?>>
  </div>
 
<div class="form-group col-md-4">
    <label for="turno1_officiales_intervinieron">Turno:</label>
    <input type="text" class="form-control-corrada col-md-4" id="turno<?php echo $i;?>_officiales_intervinieron" name="turno<?php echo $i;?>_officiales_intervinieron" placeholder="Turno" <?php if($i==1)echo 'required';?>>
  </div>
 
<div class="form-group col-md-4">
    <label for="numero_placa<?php echo $i;?>_officiales_intervinieron">Número de placa:</label>
    <input type="text" class="form-control-corrada col-md-4" id="numero_placa<?php echo $i;?>_officiales_intervinieron" name="numero_placa<?php echo $i;?>_officiales_intervinieron" placeholder="Número de placa" <?php if($i==1)echo 'required';?>>
  </div>
<div class="form-group col-md-12">
<hr> 
</div>
<?php
}
?>
<input type="hidden" name="n_officiales_intervinieron" value="<?php echo $n_officiales_intervinieron;?>">

<div class="form-group col-md-12">
<h3>Oficial de seguridad que atendió la querella</h3>
</div>
		
<div class="form-group col-md-4">
    <label for="official_atendio">Nombre oficial:</label>
    <input type="text" class="form-control-corrada col-md-4" id="official_atendio" name="official_atendio" placeholder="Nombre Oficial" required>
  </div>
 
<div class="form-group col-md-4">
    <label for="placa_official">Número de placa:</label>
    <input type="text" class="form-control-corrada col-md-4" id="placa_official" name="placa_official" placeholder="Número de placa" required>
  </div>

<div class="form-group col-md-12">
<hr> 
</div>

<div class="form-group col-md-4">
    <label for="referido_a">Caso referido a:</label>
    <input type="text" class="form-control-corrada col-md-4" id="referido_a" name="referido_a" placeholder="Referido" required>
  </div>
 
<div class="form-group col-md-4">
    <label for="agente_se_notifico">Agente al cual se le notificó:</label>
    <input type="text" class="form-control-corrada col-md-4" id="agente_se_notifico" name="agente_se_notifico" placeholder="Nombre Agente" required>
  </div>
 
<div class="form-group col-md-4">
    <label for="placa_agente">Número de placa:</label>
    <input type="text" class="form-control-corrada col-md-4" id="placa_agente" name="placa_agente" placeholder="Número de placa" required>
  </div>

<div class="form-group col-md-4">
    <label for="numero_caso_policia">Número de caso de la policía:</label>
    <input type="text" class="form-control-corrada col-md-4" id="numero_caso_policia" name="numero_caso_policia" placeholder="Número de caso de la policía" required>
  </div>


<div class="form-group col-md-4">
    <label for="forma_se_refirio">Forma en que se refirió:</label>
<select class="form-control-corrada col-md-4" id="forma_se_refirio" name="forma_se_refirio" required>
<?php
//print_r($forma_se_refirio);
foreach($forma_se_refirio as $id => $tipo)
{
?>
<option value="<?php echo $tipo['id'];?>"><?php echo $tipo['tipo'];?></option>
<?php
}
?>
</select>
  </div>

	
<div class="form-group col-md-12">
<hr> 
</div>

<div class="form-group col-md-8">
    <label for="accion_tomada">Acción tomada:</label>
<textarea class="form-control-box col-md-8" rows="4" id="accion_tomada" name="accion_tomada"></textarea>
  </div>

<div class="form-group col-md-4 col-md-offset-4">

        <button type="submit" class="btn btn-default">Someter querella</button>
</div>
      </form>
    </div>
  </body>
</html>
