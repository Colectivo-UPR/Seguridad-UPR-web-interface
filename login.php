    <?php
    session_start();
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
        <li role="presentation"><a href="alertas.php" ><img src="imagenes/alertas.png" /></a></li>
        <li role="presentation"><a href="usuarios.php" ><img src="imagenes/usuarios.png" /></a></li>
        <li role="presentation"><a href="mundo.php" ><img src="imagenes/world.png" /></a></li>
        <li role="presentation"><a href="servicios.php" ><img src="imagenes/stars.png" /></a></li>
      </ul>
    </nav>
  </header>

  <body>     
    <div class="container-fluid content"> 
      <form class="form-horizontal login" role="form" method="post" action="loginaction.php">
        <div class="form-group">
          <label for="nombres" class="col-sm-3 control-label">Usuario</label>
          <div class="col-sm-9">
            <input type="text" class="form-control form-login" id="username" name="username" placeholder="Usuario" value="colectivo.upr@gmail.com" required>
          </div>
        </div>

        <div class="form-group">
          <label for="apellidos" class="col-sm-3 control-label">Contraseña</label>
          <div class="col-sm-9">
            <input type="password" class="form-control form-login" id="password" name="password" placeholder="Contraseña" value="colectivo!uprrp" required>
          </div>
        </div>
        <button type="submit" class="btn btn-default">Iniciar sesión</button>
      </form>
    </div>
  </body>
</html>
