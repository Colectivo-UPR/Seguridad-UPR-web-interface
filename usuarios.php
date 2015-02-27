<?php  
session_start();
if (isset($_SESSION['token'])) {

}
else {
  header("location: login.php");
}
require_once("funciones.php");
$server= "http://136.145.181.112:8080";
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

    <form class="form-horizontal" role="form" method="post" action="useraction.php">
      <div class="form-group">
        <label for="nombres" class="col-sm-3 control-label">Nombre</label>
        <div class="col-sm-9">
          <input type="text" class="form-control form-login" id="nombre" name="nombre" placeholder="Nombre" required>
        </div>
      </div>

      <div class="form-group">
        <label for="apellidos" class="col-sm-3 control-label">Apellidos</label>
        <div class="col-sm-9">
          <input type="text" class="form-control form-login" id="apellidos" name="apellidos" placeholder="Apellidos" required>
        </div>
      </div>

      <div class="form-group">
        <label for="e-mail" class="col-sm-3 control-label">E-Mail</label>
        <div class="col-sm-9">
          <input type="text" class="form-control form-login" id="email" name="email" placeholder="E-Mail" required>
        </div>
      </div>

      <div class="form-group">
        <label for="telefono" class="col-sm-3 control-label">Password</label>
        <div class="col-sm-9">
          <input type="password" class="form-control form-login" id="password" name="password" placeholder="password" required>
        </div>
      </div>

      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default text-center">Env&iacute;a informaci&oacute;n</button>
      </div>  
    </form>

    <table class="table table-condensed">
    <?php
    //curl GET -H "Authorization: Token <token>" 136.145.181.112:8080/staff-users/
    $usuarios = curl_get($server, "staff-users", $_SESSION['token']);
    ?>
    <table class="table table-condensed table-editable">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Apellidos</th>
          <th>E-Mail</th>
        </tr>
      </thead>
      <tbody>
      <?php
      if(count($usuarios))
      {
        $i=0;
        foreach($usuarios['results'] as $usuario)
        {

          
      ?>
      <form class="form-horizontal" role="form" method="post" action="editarusuario.php">
        <tr>
          <td>      
          <input type="text" class="form-control edit" id="nombre" name="nombre" placeholder="Nombre" required
          <?php if(isset($usuario['first_name'])) print 'value="'. $usuario['first_name'].'"'?>>
          </td>
          <td>      
          <input type="text" class="form-control edit" id="apellidos" name="apellidos" placeholder="Apellidos" required
          <?php if(isset($usuario['last_name'])) print 'value="'. $usuario['last_name'].'"'?>>
          </td>
          <td>      
          <input type="text" class="form-control edit" id="email" name="email" placeholder="Email" required
          <?php if(isset($usuario['email'])) print 'value="'. $usuario['email'].'"'?>>
          </td>
          <td><input type="hidden" class="form-control edit" id="id" name="id" value="<?php print $usuario['id'];?>"></td>
          <td><input class="btn btn-default edit" type="submit" value="Editar Usuario" id="editar"></td>
        </tr>
      </form>
    <?php
      }
    }
    ?>
    </tbody>
    </table>
    </div>
  </body>
</html>
