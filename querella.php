    <?php
    //session_start();
    if (isset($_SESSION['token'])) {
      header("location: index.php");
}
    else {
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
  <header >
      <nav class="topbar">
        <a href="login.php" class="navbar-brand">Seguridad UPRRP</a>
        <ul class="nav panel panel-default">
          <li><a>Usuarios</a></li>
          <li class="navbar-right"><a href="logout.php">Logout</a></li>
        </ul>
      </nav>

      <nav class="sidebar">
        <ul class="vertical nav" >
          <li role="presentation" class="active"><a role="tab" data-toggle="tab" ><img src="imagenes/world.png" /></a></li>
          <li role="presentation" class="active"><a role="tab" data-toggle="tab" ><img src="imagenes/phone.png" /></a></li>
          <li role="presentation" class="active"><a role="tab" data-toggle="tab" ><img src="imagenes/sign.png" /></a></li>
          <li role="presentation" class="active"><a role="tab" data-toggle="tab" ><img src="imagenes/trolley.png" /></a></li>
          <li role="presentation" class="active"><a role="tab" data-toggle="tab" ><img src="imagenes/stars.png" /></a></li>
        </ul>
  </header>
<body>
    <div class="container-fluid content"> 
        <h1>Querella</h1>
      <form class="form-inline" role="form" method="post" action="procesa_querella.php">
        <div class="form-group">
          <label for="nombres" class="col-sm-2 col-sm-offset-6 control-label">Área geográfica:</label>
          <div class="col-sm-4 col-sm-offset-8">

<div class="radio">
  <label>
    <input type="radio" name="area_geografica" id="optionsRadios1" value="1">
En campus
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="area_geografica" id="optionsRadios2" value="2">
No en campus
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="area_geografica" id="optionsRadios3" value="3">
Propiedad pública
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="area_geografica" id="optionsRadios4" value="4">
Residencia estudiantil
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="area_geografica" id="optionsRadios5" value="5">
Otros
  </label>
</div>

</div>
</div>
      

<div class="form-group col-md-12">
    <label for="numero_caso">Número de caso:</label>
    <input type="text" class="form-control" id="numero_caso" name="numero_caso" placeholder="Número de caso" required>
  </div>
 
<div class="form-group col-md-5">
    <label for="nombre_querellante">Nombre del querellante:</label>
    <input type="text" class="form-control col-md-5" id="nombre_querellante" nombre="nombre_querellante" placeholder="Nombre del querellante" required>
  </div>

<div class="form-group col-md-5 col-md-offset-2">
    <label for="fecha_informada">Fecha informada:</label>
    <input type="datetime-local" class="form-control col-md-5 col-md-offset-2" id="fecha_informada" name="fecha_informada" required>
  </div>

<div class="form-group col-md-6">
    <label for="direccion_residencial">Dirección residencial:</label>
<textarea class="form-control col-md-6" rows="3" id="direccion_residencial_querellante" name="direccion_residencial_querellante" required></textarea>
  </div>
  
<div class="form-group col-sm-6 col-md-offset-1">
    <label for="lugar_trabajo">Lugar de trabajo:</label>
    <input type="text" class="form-control col-sm-6 col-md-offset-1" id="lugar_trabajo_querellante" name="lugar_trabajo_querellante" placeholder="Lugar de trabajo"> 
  </div>

<div class="form-group">
    <label for="numero_identificacion">Número de identificación:</label>
    <input type="text" class="form-control" id="numero_identificacion_querellante" name="numero_identificacion_querellante" placeholder="Número de identificación">
  </div>

<div class="form-group">
    <label for="medio_notificacion">Medio de notificación:</label>
<select class="form-control" id="medio_notificacion" name="medio_notificacion" required>
<option value="1">Teléfono</option>
<option value="2" selected>Personalmente</option>
<option value="3">Escrito</option>
<option value="4">Propio conocimiento</option>
</select>
  </div>
		
<div class="form-group">
    <label for="direccion_postal">Dirección postal:</label>
<textarea class="form-control" rows="3" id="direccion_postal_querellante" name="direccion_postal_querellante" required></textarea>
  </div>
	
<div class="form-group">
    <label for="tel_trabajo">Teléfono y extensión de trabajo:</label>
    <input type="tel" pattern="(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}(( |[x ])?\d{4})?" class="form-control" id="tel_trabajo_querellante" name="tel_trabajo_querellante" placeholder="Teléfono trabajo"> 
  </div>

<div class="form-group">
    <label for="tel_personal">Teléfono o celular personal:</label>
    <input type="tel" pattern="(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}(( |[x ])?\d{4})?" class="form-control" id="tel_personal_querellante" name="tel_personal_querellante" placeholder="Teléfono personal" required> 
  </div>

<div class="form-group">
    <label for="sector_querellante">Sector del querellante:</label>
<select class="form-control" id="sector_querellante" name="sector_querellante" required>
<option value="1">Estudiante</option>
<option value="2" selected>Empleado</option>
<option value="3">Visitante</option>
<option value="4">Servicio</option>
</select>
  </div>
	

<div class="form-group">
    <label for="fotos">¿Se tomaron fotos?</label>
<select class="form-control" name="hay_fotos" id="hay_fotos" required>
<option value="1">Sí</option>
<option value="2" selected>No</option>
</select>
  </div>
	
 
<div class="form-group">
    <label for="genero_querellante">Sexo</label>
<select class="form-control" name="genero_querellante" id="genero_querellante" required>
<option value="1">M</option>
<option value="2" selected>F</option>
</select>
  </div>
	
Identificación (puede ser tarjeta electoral, licencia, tarjeta de estudiante o empleado)	
<div class="form-group col-md-12">
    <label for="tipo_identificacion_querellante">Tipo ID:</label>
    <input type="text" class="form-control" id="tipo_identificacion_querellante" name="tipo_identificacion_querellante" placeholder="Tipo ID" required>
  </div>
 
<div class="form-group col-md-12">
    <label for="numero_identificacion_querellante">Número ID:</label>
    <input type="text" class="form-control" id="numero_identificacion_querellante" name="numero_identificacion_querellante" placeholder="Número ID" required>
  </div>
 
<div class="form-group col-md-12">
    <label for="email_querellante">Correo electrónico:</label>
    <input type="text" class="form-control" id="email_querellante" name="email_querellante" placeholder="Correo electrónico" required>
  </div>
 

PERSONAS PERJUDICADAS

<?php
$n_perjudicado=3;

for($i=1;$i<=$n_perjudicado;$i++)
{
?>

<div class="form-group col-md-12">
    <label for="nombre<?php echo $i;?>_perjudicado">Nombre Perjudicado:</label>
    <input type="text" class="form-control" id="nombre<?php echo $i;?>_perjudicado" name="nombre<?php echo $i;?>_perjudicado" placeholder="Nombre Perjudicado" required>
  </div>
 
<div class="form-group col-md-12">
    <label for="direccion_residencial<?php echo $i;?>_perjudicado">Dirección residencial:</label>
    <input type="text" class="form-control" id="direccion_residencial<?php echo $i;?>_perjudicado" name="direccion_residencial<?php echo $i;?>_perjudicado" placeholder="Dirección residencial" required>
  </div>
 
<div class="form-group col-md-12">
    <label for="direccion_postal<?php echo $i;?>_perjudicado">Dirección postal:</label>
    <input type="text" class="form-control" id="direccion_postal<?php echo $i;?>_perjudicado" name="direccion_postal<?php echo $i;?>_perjudicado" placeholder="Dirección postal" required>
  </div>

<div class="form-group">
    <label for="tel<?php echo $i;?>_perjudicado">Teléfono:</label>
    <input type="tel" pattern="(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}(( |[x ])?\d{4})?" class="form-control" id="tel<?php echo $i;?>_perjudicado" name="tel<?php echo $i;?>_perjudicado" placeholder="Teléfono personal" required> 
  </div>
<?php
}
?>
<input type="hidden" name="n_perjudicado" value="<?php echo $n_perjudicado;?>">


TESTIGOS
<?php
$n_testigo=3;

for($i=1;$i<=$n_testigo;$i++)
{
?>

<div class="form-group col-md-12">
    <label for="nombre<?php echo $i;?>_testigo">Nombre Testigo:</label>
    <input type="text" class="form-control" id="nombre<?php echo $i;?>_testigo" name="nombre<?php echo $i;?>_testigo" placeholder="Nombre Perjudicado" required>
  </div>
 
<div class="form-group col-md-12">
    <label for="direccion_residencial<?php echo $i;?>_testigo">Dirección residencial:</label>
    <input type="text" class="form-control" id="direccion_residencial<?php echo $i;?>_testigo" name="direccion_residencial<?php echo $i;?>_testigo" placeholder="Dirección residencial" required>
  </div>
 
<div class="form-group col-md-12">
    <label for="direccion_postal<?php echo $i;?>_testigo">Dirección postal:</label>
    <input type="text" class="form-control" id="direccion_postal<?php echo $i;?>_testigo" name="direccion_postal<?php echo $i;?>_testigo" placeholder="Dirección postal" required>
  </div>

<div class="form-group">
    <label for="tel<?php echo $i;?>_testigo">Teléfono:</label>
    <input type="tel" pattern="(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}(( |[x ])?\d{4})?" class="form-control" id="tel<?php echo $i;?>_testigo" name="tel<?php echo $i;?>_testigo" placeholder="Teléfono personal" required> 
  </div>
<?php
}
?>
<input type="hidden" name="n_testigo" value="<?php echo $n_testigo;?>">


DATOS SOBRE EL INCIDENTE
<div class="form-group col-md-5 col-md-offset-2">
    <label for="fecha_incidente">Fecha:</label>
    <input type="datetime-local" class="form-control col-md-5 col-md-offset-2" id="fecha_incidente" name="fecha_incidente" required>
  </div>

<div class="form-group col-md-6">
    <label for="direccion_residencial">Lugar:</label>
<textarea class="form-control col-md-6" rows="3" id="lugar_incidente" name="lugar_incidente" required></textarea>
  </div>
  
<div class="form-group">
    <label for="tipo_querella">Tipo de querella:</label>
<select class="form-control" id="tipo_querella" name="tipo_querella" required>
<option value="1">Asesinato / Homicidio</option>
<option value="2">Homicidio negligente</option>
<option value="3">Agresión sexual (forzada)</option>
<option value="4">Agresión sexual (no forzada)</option>
<option value="5">Agresión</option>
<option value="6">Agresión agravada</option>
<option value="7">Amenaza</option>
<option value="8">Robo</option>
<option value="9">Escalamiento</option>
<option value="10">Escalamiento agravado</option>
<option value="11">Hurto vehículo de motor</option>
<option value="12">Incendio</option>
<option value="13">Apropiación ilegal</option>
<option value="14">Amenaza de Explosivos</option>
<option value="15">Daño a la propiedad</option>
<option value="16">Acecho</option>
<option value="17">Violencia Doméstica</option>
<option value="18">Violencia en citas</option>
<option value="19">Otros</option>
</select>
  </div>
	
<div class="form-group">
    <label for="area_querella">Área:</label>
<select class="form-control" id="area_querella" name="area_querella" required>
<option value="1">A</option>
<option value="2">B</option>
<option value="3">C</option>
</select>
  </div>

<div class="form-group">
    <label for="sancion_arresto">Sanciones y/o arrestos por:</label>
<select class="form-control" id="sancion_arresto" name="sancion_arresto">
<option value="1">Violación a la Política Uso de Drogas</option>
<option value="2">Violación a la Política Uso de Alcohol</option>
<option value="3">Violación a la Política Uso de Armas</option>
<option value="4">Otros: Especifique</option>
</select>
  </div>

<div class="form-group">
    <label for="crimen_odio">Crimen por Odio</label>
<select class="form-control" name="crimen_odio" id="crimen_odio" required>
<option value="1">Sí</option>
<option value="2" selected>No</option>
</select>
  </div>
	
<div class="form-group col-md-6">
    <label for="descripcion_incidente">Descripción de la querella (qué, cómo, cuándo, dónde, quién):</label>
<textarea class="form-control col-md-6" rows="3" id="descripcion_incidente" name="descripcion_incidente" required></textarea>
  </div>
  
QUERELLADO(S)
<?php
$n_querellado=3;

for($i=1;$i<=$n_querellado;$i++)
{
?>

<div class="form-group col-md-12">
    <label for="nombre<?php echo $i;?>_querellado">Nombre querellado:</label>
    <input type="text" class="form-control" id="nombre<?php echo $i;?>_querellado" name="nombre<?php echo $i;?>_querellado" placeholder="Nombre Perjudicado" required>
  </div>
 
<div class="form-group col-md-12">
    <label for="direccion_residencial<?php echo $i;?>_querellado">Dirección residencial:</label>
    <input type="text" class="form-control" id="direccion_residencial<?php echo $i;?>_querellado" name="direccion_residencial<?php echo $i;?>_querellado" placeholder="Dirección residencial" required>
  </div>
 
<div class="form-group col-md-12">
    <label for="direccion_postal<?php echo $i;?>_querellado">Dirección postal:</label>
    <input type="text" class="form-control" id="direccion_postal<?php echo $i;?>_querellado" name="direccion_postal<?php echo $i;?>_querellado" placeholder="Dirección postal" required>
  </div>

<div class="form-group">
    <label for="tel<?php echo $i;?>_querellado">Teléfono:</label>
    <input type="tel" pattern="(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}(( |[x ])?\d{4})?" class="form-control" id="tel<?php echo $i;?>_querellado" name="tel<?php echo $i;?>_querellado" placeholder="Teléfono personal" required> 
  </div>
<?php
}
?>
<input type="hidden" name="n_querellado" value="<?php echo $n_querellado;?>">

Oficiales de seguridad que intervinieron
<?php
$n_oficiales_intervinieron=3;

for($i=1;$i<=$n_oficiales_intervinieron;$i++)
{
?>
<div class="form-group col-md-12">
    <label for="nombre<?php echo $i;?>_oficiales_intervinieron">Nombre oficial:</label>
    <input type="text" class="form-control" id="nombre<?php echo $i;?>_oficiales_intervinieron" name="nombre<?php echo $i;?>_oficiales_intervinieron" placeholder="Nombre Oficial" required>
  </div>
 
<div class="form-group col-md-12">
    <label for="turno1_oficiales_intervinieron">Turno:</label>
    <input type="text" class="form-control" id="turno<?php echo $i;?>_oficiales_intervinieron" name="turno<?php echo $i;?>_oficiales_intervinieron" placeholder="Turno" required>
  </div>
 
<div class="form-group col-md-12">
    <label for="numero_placa<?php echo $i;?>_oficiales_intervinieron">Número de placa:</label>
    <input type="text" class="form-control" id="numero_placa<?php echo $i;?>_oficiales_intervinieron" name="numero_placa<?php echo $i;?>_oficiales_intervinieron" placeholder="Número de placa" required>
  </div>
<?php
}
?>
<input type="hidden" name="n_oficiales_intervinieron" value="<?php echo $n_oficiales_intervinieron;?>">

Oficial de seguridad que atendió la querella
		
<div class="form-group col-md-12">
    <label for="ofical_atendio">Nombre oficial:</label>
    <input type="text" class="form-control" id="ofical_atendio" name="ofical_atendio" placeholder="Nombre Oficial" required>
  </div>
 
<div class="form-group col-md-12">
    <label for="placa_oficial">Número de placa:</label>
    <input type="text" class="form-control" id="placa_oficial" name="placa_oficial" placeholder="Número de placa" required>
  </div>


Certifico que la información que antecede es correcta y autorizo a realizar la investigación que fuera necesaria para la solución de este caso:



____________________________________	______________	______________________________________	____________	______________
Firma del querellante		        Fecha	       Firma del supervisor a cargo del área	        Placa	         Fecha


Caso referido a:		

<div class="form-group col-md-12">
    <label for="agente_se_notifico">Agente al cual se le notificó:</label>
    <input type="text" class="form-control" id="agente_se_notifico" name="agente_se_notifico" placeholder="Nombre Agente" required>
  </div>
 
<div class="form-group col-md-12">
    <label for="placa_agente">Número de placa:</label>
    <input type="text" class="form-control" id="placa_agente" name="placa_agente" placeholder="Número de placa" required>
  </div>

<div class="form-group col-md-12">
    <label for="numero_caso_policia">Número de caso de la policía:</label>
    <input type="text" class="form-control" id="numero_caso_policia" name="numero_caso_policia" placeholder="Número de caso de la policía" required>
  </div>


<div class="form-group">
    <label for="area_querella">Forma en que se refirió:</label>
<select class="form-control" id="area_querella" name="area_querella" required>
<option value="1">Personalmente</option>
<option value="2">Por teléfono</option>
<option value="3">Por escrito</option>
</select>
  </div>

	
Supervisor a cargo	Firma



<div class="form-group col-md-6">
    <label for="accion_tomada">Acción tomada:</label>
<textarea class="form-control col-md-6" rows="3" id="accion_tomada" name="accion_tomada"></textarea>
  </div>
  








__________________________________________________		_____________________________
Firma Director o su Representante					        Fecha


Revisado: marzo de 2015					     Profesionales en Seguridad
					    	              Sirviendo a la Comunidad Universitaria
        <button type="submit" class="btn btn-default">Iniciar sesión</button>
      </form>
    </div>
  </body>
</html>
