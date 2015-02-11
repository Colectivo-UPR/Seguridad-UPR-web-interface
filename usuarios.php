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
    <?php  
    session_start();
      if (isset($_SESSION['token'])) {

      }
      else {
        header("location: login.php");
      }
      ?>
  </head>

<!-- topbar y sidebar -->
  <header >
      <nav class="topbar">
        <a href="index.php" class="navbar-brand">Seguridad UPRRP</a>
        <ul class="nav panel panel-default">
          <li><a class="activo" href="usuarios.php">Usuarios</a></li>
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
    <div class="tab-content container-fluid content">
        <h1>Usuarios</h1>
  <form class="form-horizontal" role="form" method="post" action="info_encargado.php">

  <div class="form-group">
    <label for="nombres" class="col-sm-3 control-label">Nombres</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Nombres" required
      <?php if(isset($datos_encargado['nombres'])) print 'value="'.$datos_encargado['nombres'].'"'?>
      >
    </div>
  </div>

  <div class="form-group">
    <label for="apellidos" class="col-sm-3 control-label">Apellidos</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos" required
      <?php if(isset($datos_encargado['apellidos'])) print 'value="'.$datos_encargado['apellidos'].'"'?>
    >
    </div>
  </div>

  <div class="form-group">
    <label for="username" class="col-sm-3 control-label">Nombre usuario</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="username" name="username" placeholder="Nombre usuario" required
      <?php if(isset($datos_encargado['username'])) print 'value="'.$datos_encargado['username'].'"'?>
      >
    </div>
  </div>

  <div class="form-group">
    <label for="email" class="col-sm-3 control-label">email</label>
    <div class="col-sm-9">
      <input type="email" class="form-control" id="email" name="email" placeholder="email" required
      <?php if(isset($datos_encargado['email'])) print 'value="'.$datos_encargado['email'].'"'?>
      >
    </div>
  </div>

  <div class="form-group">
    <label for="email" class="col-sm-3 control-label">Tel&eacute;fono</label>
    <div class="col-sm-9">
      <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Tel&eacute;fono"
      <?php if(isset($datos_encargado['telefono'])) print 'value="'.$datos_encargado['telefono'].'"'?>
      >

    </div>
  </div>
<!--
  <div class="form-group">
    <label for="color" class="col-sm-3 control-label">color</label>
    <div class="col-sm-9">
      <input type="color" class="form-control" id="color" name="color"
      <?php if(isset($datos_encargado['color'])) print 'value="'.$datos_encargado['color'].'"';else print 'value="#ffffff"'?>
      >
    </div>
  </div>
-->
      <input type="hidden" class="form-control" id="sometido" name="sometido" value="1">
      <input type="hidden" class="form-control" id="id" name="id" value="<?php print $id;?>">

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Env&iacute;a informaci&oacute;n</button>
    </div>
  </div>
        <table class="table table-condensed">
          <tbody>
            <tr><td>Ejemplo</td></tr>
            <tr><td>Ejemplo</td></tr>
            <tr><td>Ejemplo</td></tr>
            <tr><td>Ejemplo</td></tr>
          </tbody>
        </table>
    </div>
  </body>
</html>