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
        <label for="tipo" class="col-sm-3 control-label">Tipo</label>
          <div class="col-sm-9">
            <select  class="form-control" name="tipo">
              <option value="is_director">Director</option>
              <option value="is_chief_manager">Ecargado de Turno</option>
              <option value="is_official">Oficial</option>
            </select>
          </div>
      </div> 

      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default text-center">Env&iacute;a informaci&oacute;n</button>
      </div> 
 
    </form>

    <table class="table table-condensed table-editable">
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
          <th>Tipo</th>
          <th>Modificar</th>
        </tr>
      </thead>
      <tbody>

      <?php
      var_dump($usuarios);
      if(count($usuarios))
      {
        $i=0;
        foreach($usuarios as $usuario)
        {

          
      ?>
      <form class="form-horizontal" role="form" method="put" action="editarusuario.php">
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
          <td>
          <select  class="form-control" name="tipoCambio">
            <option value"NO" ></option>
            <option value="is_director">Director</option>
            <option value="is_chief_manager">Ecargado de Turno</option>
            <option value="is_official">Oficial</option>
          </select>
          </div>
          </td>
          <td class='form-group form-inline'>
            <div class='form-group'>
              <input type='hidden' id='id' name='id' value='<?php print $usuario['id']; ?>'>
              <input type='hidden' id='tipoActual' name='tipoActual' value='<?php print $usuario[' LO QUE DIGA EL TIPO']; ?>'>
              <button type='submit' class='btn-default form-control edit'  value='' id='editar'> Editar </button>
              <button type='submit' class='btn-default form-control edit'  value='Borrar' id='borrar' formmethod='delete' 
              formaction='borrarUsuario.php' formtarget='_self'> Borrar </button>
            </div>
          </td>  
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
