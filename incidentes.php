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
  <header>
      <nav class="topbar">
        <a href="index.php" class="navbar-brand">Seguridad UPRRP</a>
        <ul class="nav panel panel-default">
          <li><a class="activo" href="incidentes.php">Incidentes</a></li>
          <li><a href="usuarios.php">Usuarios</a></li>
        </ul>
      </nav>
      <nav class="sidebar">
        <ul class="vertical nav" >
          <li role="presentation"><a href="#world" role="tab" data-toggle="tab" ><img src="imagenes/world.png" /></a></li>
          <li role="presentation"><a href="#phone" role="tab" data-toggle="tab" ><img src="imagenes/phone.png" /></a></li>
          <li role="presentation"><a href="#sign" role="tab" data-toggle="tab" ><img src="imagenes/sign.png" /></a></li>
          <li role="presentation"><a href="#trolley" role="tab" data-toggle="tab" ><img src="imagenes/trolley.png" /></a></li>
          <li role="presentation" class="menu"><a href="#stars" role="tab" data-toggle="tab" ><img src="imagenes/stars.png" /></a></li>
        </ul>
  </header>

  <body>
    <div class="tab-content container-fluid content"> 

      <div role="tabpanel" class="tab-pane active" id="incidentes">
        <h1>Incidentes</h1>
        <button type="button" class="btn btn-default" data-toggle="collapse" data-target="#panel_incidenteN">Crear incidente</button>
        <div id="panel_incidenteN" class="collapse"><div id="incidenteN"></div></div>
        <script>
        $('#incidenteN').load('info_incidente.php').fadeIn("slow");
        </script>
      </div>
      
      <div role="tabpanel" class="tab-pane" id="world">
          <h1>World</h1>
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