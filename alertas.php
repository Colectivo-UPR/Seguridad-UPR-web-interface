<?php  
require_once("headers.php");
require_once("sendAlert.php"); 
?>
  <body>
 <?php
require_once("tabs.php");
?>

         <h2>Generar Aviso de Emergencia</h2>
       <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="alertas">
            <br></br>
            <div id="incidenteN"></div>
<?
if(isset($_GET['datos']))
{
  $datos=json_decode($_GET['datos'],true);
?>
  <div class="panel panel-default">
    <div class="panel-heading">T&iacute;tulo</div>
    <div class="panel-body">
    <?php print $datos['title'];?>
    </div>
  </div>
  
  <div class="panel panel-default">
    <div class="panel-heading">Creado por</div>
    <div class="panel-body">
    <?php print $datos['owner'];?>
    </div>
  </div>
  
  <div class="panel panel-default">
    <div class="panel-heading">Fecha incidente</div>
    <div class="panel-body">
    <?php print date("Y-m-d H:i:s", strtotime($datos["pub_date"]));?>
    </div>
  </div>
  
  <div class="panel panel-default">
    <div class="panel-heading">Mensaje</div>
    <div class="panel-body">
    <?php print $datos['message'];?>
    </div>
  </div>
  
  <div class="panel panel-default">
    <div class="panel-heading">Facultad</div>
    <div class="panel-body">
    <?php print $datos['faculty'];?>
    </div>
  </div>
  
  <div class="panel panel-default">
    <div class="panel-heading">Latitud, longitud</div>
    <div class="panel-body">
    <?php print $datos['lat'].", ".$datos['lon'];?>
    </div>
  </div>
  
<?php
}
elseif(!$_POST['sometido'])
{
?>
 <form class="form-horizontal" role="form" method="post" action="alertas.php">

  <div class="form-group">
    <label for="title" class="col-sm-3 control-label">T&iacute;tulo</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="title" name="title" placeholder="T&iacute;tulo" required
      <?php if(isset($datos_proyecto['title'])) print 'value="'.$datos_proyecto['title'].'"'?>
      >
    </div>
  </div>

  <div class="form-group">
    <label for="message" class="col-sm-3 control-label">Mensaje</label>
    <div class="col-sm-9">
      <textarea class="form-control" id="message" name="message" placeholder="Mensaje" required>
<?php if(isset($datos_proyecto['message'])) print 'value="'.$datos_proyecto['message'].'"'?></textarea>
    </div>
  </div>

  <div class="form-group">
    <label for="faculty" class="col-sm-3 control-label">Facultad</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="faculty" name="faculty" placeholder="Facultad" required
      <?php if(isset($datos_proyecto['faculty'])) print 'value="'.$datos_proyecto['faculty'].'"'?>
      >
    </div>
  </div>

  <div class="form-group">
    <label for="lat" class="col-sm-3 control-label">Latitud</label>
    <div class="col-sm-9">
      <input type="text" pattern="-?\d{1,3}\.\d+" class="form-control" id="lat" name="lat" placeholder="Latitud" required
      <?php if(isset($datos_proyecto['lat'])) print 'value="'.$datos_proyecto['lat'].'"'?>
      >
    </div>
  </div>

  <div class="form-group">
    <label for="lon" class="col-sm-3 control-label">Longitud</label>
    <div class="col-sm-9">
      <input type="text" pattern="-?\d{1,3}\.\d+" class="form-control" id="lon" name="lon" placeholder="Longitud" required
      <?php if(isset($datos_proyecto['lon'])) print 'value="'.$datos_proyecto['lon'].'"'?>
      >
    </div>
  </div>

      <input type="hidden" class="form-control" id="sometido" name="sometido" value="1">

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Envía información</button>
    </div>
  </div>
  
</form>
<?php
}
else
{
  echo $_POST; 
  unset($_POST['sometido']);

  // Aquí falta create-alert en nuestra db: 
  // usar server y route creados abajo
  $server= "http://136.145.181.112:8080";
  $route = "create-alert";

  // Enviar request al endpoint en nuestro API que avisa 
  // a Amazon a que envíe una alerta
  $b=send_alert("hola mundito cruel");
  
}
?>
          </div>
          <div role="tabpanel" class="tab-pane" id="reportes">...2</div>
          <div role="tabpanel" class="tab-pane" id="querellas">...3</div>
        </div>
      </div>
    </div>
  </body>
</html>
