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
  $servicio = "http://136.145.181.112:8080";
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
        <li ><a href="mundo.php" ><img src="imagenes/world.png" /></a></li>
        <li role="presentation"><a href="alertas.php"  ><h1><i class="fa fa-exclamation-circle"></i></h1></i></a></li>
        <li role="presentation"><a href="usuarios.php" ><h1><i class="fa fa-user"></i></h1></a></li>
        <li role="presentation"><a href="securityPhones.php" ><img src="imagenes/stars.png" /></a></li>
      </ul>
  </header>

  <body>
    <div class="tab-content container-fluid content" >
    </div>
  </body>
</html>
