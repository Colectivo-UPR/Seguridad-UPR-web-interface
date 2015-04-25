<?php  
  session_start();
  if (isset($_SESSION['token'])) {

  }
  else{
    header("location: login.php");
  }
  require_once("funciones.php");
  $server = "http://136.145.181.112:8080";
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
       
        <h1>Servicios</h1>
        <hr>
        <h3>Crear Servicio</h3>

          <!-- Form for creating a new service. -->
          <form class='center-form form-inline form-padding' role='form' method='post' action='createService.php'>
            
            <div class='form-group form-padding'> 
              <p class='center-form-p'><label for='nombre' class='control-label'> Servicio: </label></p>
              <p><input type='text' class='form-control form-width' maxlength='30' pattern='[a-zA-Z\s\d]{5,30}' id='name' name='name' placeholder='Nombre' required></p>
            </div>

            <div class='form-group form-padding'>
              <p class='center-form-p'><label for='telefono' class='control-label'> Telefono: </label></p>
              <p><input type='tel' class='form-control form-width' maxlength='20' pattern='(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}(( |[x ])?\d{4})?' id='telephone' name='telephone' placeholder='Numero' required></p>
            </div>

            <button type='submit' class='btn center-form-btn btn-default btn-primary'> Crear </button>

          </form>
            
        <hr>

        <!-- Code for displaying available services -->
        <?php
          $servicios = curl_get($server, "services", $_SESSION['token']) ;

          // Displays services in a table if available
          if(count($servicios))
          {
            // Prints table tags if services are available
            $i = 0 ;
            print("<table class='table table-striped table-hover table-condensed table-editable' style='cellspacing: 0px;'>\n") ;
            print("\t\t<caption style='text-align: center;'><h3> Servicios Disponibles </h3></caption>\n") ;
            print("\t\t<thead>\n\t\t  <tr>\n") ;
            print("\t\t    <th style='padding-left: 10%;'> # </th>\n") ;  
            print("\t\t    <th style='padding-left: 20px; width:25%;'> Servicio </th>\n") ;
            print("\t\t    <th style='padding-left: 20px; width:60%;'> Telefono </th>\n") ;
            print("\t\t  </tr>\n\t\t</thead>\n") ;
            print("\t\t<tbody>") ;
            //Displays services
            foreach($servicios as $servicio)
            {
        ?> 
              <!-- Form for viewing, and editing, each available service -->
              <form class='form-horizontal' role='form' method='put' action='editService.php'>
                <tr class='form-group form-inline'>
                  <td style='padding-left: 10%;'>
                    <?php $i++ ; print $i . "\n" ?>
                  </td>
                  <td>
                    <div class='form-group form-padding'>
                      <input type='text' class='form-control form-width' maxlenght='30' pattern='[a-zA-Z\s\d]{5,30}' id='name' name='name' placeholder='Nombre' required
                      <?php if(isset($servicio['name'])) print 'value=\'' . $servicio['name'] . '\''; ?>>
                    <div> 
                  </td>
                  <td>
                    <div class='form-group form-padding'>
                      <input type='tel' class='form-control edit' maxlenght='20' pattern='(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}(( |[x ])?\d{4})?' id='telephone' name='telephone' placeholder='Numero' required
                      <?php if(isset($servicio['telephone'])) print 'value=\'' . $servicio['telephone'] . '\''; ?>>
                    </div>
                    <div class='form-group form-padding'>
                      <input type='hidden' id='id' name='id' value='<?php print $servicio['id']; ?>'>
                      <button type='submit' class='btn-default form-control edit btn-primary'  value='Actualizar' id='editar'> Editar </button>
                      <button type='submit' class='btn-default form-control edit btn-danger'  value='Borrar' id='borrar' formmethod='delete' formaction='deleteService.php'> Borrar </button>
                    </div>
                  </td>     
                </tr>
              </form>               
        <?php
            }
            print("  </tbody>\n") ;
            print("\t      </table>\n") ;
          }
        ?>

      </div>
  </body>
</html>