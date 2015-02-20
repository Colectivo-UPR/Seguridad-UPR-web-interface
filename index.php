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
      <?php  
      session_start();
      // echo $_SESSION['order'];
      // echo $_SESSION['token'];
      if (isset($_SESSION['token'])) {

      }
      else {
        header("location: login.php");
      }

      require_once("funciones.php");
      $servicio= "http://136.145.181.112:8080";
      ?>
      <nav class="topbar" >
        <a href="index.php" class="navbar-brand">Seguridad UPRRP</a>
        <ul class="nav panel panel-default">
          <li><a href="usuarios.php">Usuarios</a></li>
          <li class="navbar-right">
          <a href="logout.php">Logout</a></li>
        </ul>
      </nav>

      <nav class="sidebar">
        <ul class="vertical nav" >
          <li role="presentation"><a href="#world" role="tab" data-toggle="tab" ><img src="imagenes/world.png" /></a></li>
          <li role="presentation"><a href="#phone" role="tab" data-toggle="tab" ><img src="imagenes/phone.png" /></a></li>
          <li role="presentation"><a href="#sign" role="tab" data-toggle="tab" ><img src="imagenes/sign.png" /></a></li>
          <li role="presentation"><a href="#trolley" role="tab" data-toggle="tab" ><img src="imagenes/trolley.png" /></a></li>
          <li role="presentation"><a href="#stars" role="tab" data-toggle="tab" ><img src="imagenes/stars.png" /></a></li>
        </ul>
  </header>

  <body>
    <div class="tab-content container-fluid content" >
      <div role="tabpanel" class="tab-pane" id="world">
        <!--alertas y reportes-->
        <h1>Incidentes</h1>
        <button type="button" class="btn btn-default" data-toggle="collapse" data-target="#panel_incidenteN">
        Crear incidente
        </button>
        <form action="order.php">
        <input class="btn btn-default" type="submit" value="Cambiar el orden " id="order">
        </form>
        <div id="panel_incidenteN" class="collapse"><div id="incidenteN"></div></div>
        <script>
        $('#incidenteN').load('info_incidente.php').fadeIn("slow");
        </script>
        <div>
          <?php 
          $incidentes= curl_get($servicio, "incidents"  . $_SESSION['// se supone que sea order'], $_SESSION['token']);
          if(count($incidentes))
          {
            $i=0;
            foreach($incidentes['results'] as $incidente)
            {
            ?>
            <tr>
            <td>
                <button type="button" class="btn btn-default stacked" data-toggle="collapse" data-target="#panel_incidente<?php print $i;?>">
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
        </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="phone">
        <h1>Telefonos</h1>
        <!--mapa-->
        <?php 
        $phones=curl_get($servicio, "phones", $_SESSION['token']);

        if(count($phones))
          {
            $i=0;
            foreach($phones['results'] as $phones)
            {
                print nl2br("ID: " . $phones['id'] . "\r\n");
                print nl2br("Lugar: " . $phones['place'] . "\r\n");
                print nl2br("Descripcion: " . $phones['description'] . "\r\n");
                print nl2br("Lat:" . $phones['lat'] . "\r\n");
                print nl2br("Lon: " . $phones['lon'] . "\r\n");
            }
          }
            ?>
        <h4>Crear telefono</h4>
          <form>
            <div class="form-group">
              <label for="titulo" class="col-sm-3 control-label">Titulo</label>
              <div class="col-sm-9 form-padding">
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo" required>
              </div>
            </div>

            <div class="form-group">
              <label for="description" class="col-sm-3 control-label">Descripcion</label>
              <div class="col-sm-9 form-padding">
                <input type="text" class="form-control" id="descricion" name="description" placeholder="Descripcion" required>
              </div>
            </div> 

            <div class="form-group">
              <label for="lugar" class="col-sm-3 control-label">Lugar</label>
              <div class="col-sm-9 form-padding">
                <input type="text" class="form-control" id="lugar" name="lugar" placeholder="Lugar" required>
              </div>
            </div>

            <div class="form-group">
              <label for="lat" class="col-sm-3 control-label">Latitud</label>
              <div class="col-sm-9 form-padding">
                <input type="text" class="form-control" id="lat" name="lat" placeholder="Latitud" required>
              </div>
            </div> 

            <div class="form-group">
              <label for="lon" class="col-sm-3 control-label">Longitud</label>
              <div class="col-sm-9 form-padding">
                <input type="text" class="form-control" id="lon" name="lon" placeholder="Longitud" required>
              </div>
            </div> 
          </form>
      </div>

      <div role="tabpanel" class="tab-pane" id="sign">
          <h1>Rutas de desalojo</h1>
      </div>

      <div role="tabpanel" class="tab-pane" id="trolley">
          <h1>Rutas del trolley</h1>
      </div>

      <div role="tabpanel" class="tab-pane" id="stars">
          <h1>Servicios</h1>
          <?php
          // curl -X GET -H "Authorization: Token 709f60c18e51e49a971cc1f4642f76b6c5f4372f" http://136.145.181.112:8080/services/
          $servicio=curl_get($servicio, "servicio", $_SESSION['token']);
          ?>
      </div>

    </div>
  </body>
</html>