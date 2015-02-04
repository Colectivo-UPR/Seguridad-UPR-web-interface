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
        <h1>Incidentes</h1>
        <button type="button" class="btn btn-default" data-toggle="collapse" data-target="#panel_incidenteN">
        Crear incidente
        </button>
        <div id="panel_incidenteN" class="collapse"><div id="incidenteN"></div></div>
        <script>
        $('#incidenteN').load('info_incidente.php').fadeIn("slow");
        </script>
        <div>
          <h2> </h2>
          <?php  
          session_start();
          require_once("funciones.php");
          $servicio= "http://136.145.181.112:8080";
          $token = $_SESSION['token'];
          $incidentes= curl_get($servicio, "incidents", $token);
          ?>

          <?php 
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
          <h1>Phone</h1>
      </div>

      <div role="tabpanel" class="tab-pane" id="sign">
          <h1>Sign</h1>
      </div>

      <div role="tabpanel" class="tab-pane" id="trolley">
          <h1>Trolley</h1>
      </div>

      <div role="tabpanel" class="tab-pane" id="stars">
          <h1>Stars</h1>
      </div>
    </div>
  </body>
</html>
