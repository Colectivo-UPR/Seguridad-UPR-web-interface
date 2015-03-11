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
        <li role="presentation"><a href="servicios.php" ><img src="imagenes/stars.png" /></a></li>
      </ul>
  </header>

  <body>
    <div class="container-fluid content" >
      <!-- Servicios: CSS -->
      <style>

        hr {
          width: 80%;
          height: 2px;
          margin-left: auto;
          margin-right: auto;
          background-color:#FF0000;
          color:#FF0000;
          border: 0 none;
          margin-top: 25px;
          margin-bottom: 30px;
        }

        #createForm {
          padding-left: 20%;
          padding-right: 20%;
        }

      </style>
     
      <h1>Servicios</h1>
      <hr>
      <h3>Crear Servicio</h3><br>

        <!-- Form for creating a new service. -->
        <form id='createForm' class='form-inline' role='form' method='post' action='createService.php' target='_self'>
          <div class='form-group'> 
            <label for='nombre' class='control-label'> Servicio: </label>
            <input type='text' class='form-control edit' maxlength='40' id='name' name='name' placeholder='Nombre' required>
          </div>
          <div class='form-group'>
            <label for='telefono' class='control-label'> Telefono: </label>
            <input type='tel' class='form-control edit' maxlength='12' pattern='[\d-]{10,12}' id='telephone' name='telephone' placeholder='Numero' required>
          </div>
          <button type='submit' class='btn btn-default'> Crear </button>
        </form>
          
      <hr>
      <!-- REMOVE? --><!-- <h3>Servicios Disponibles</h3> -->

      <?php
      // curl -X GET -H "Authorization: Token 709f60c18e51e49a971cc1f4642f76b6c5f4372f" http://136.145.181.112:8080/services/
      $servicio = curl_get($servicio, "services", $_SESSION['token']) ;
      ?>

      <!-- Code for displaying available services -->
      <?php  
        // Displays services in a table if available
        if(count($servicio))
        {
          // Prints table tags if services are available
          $i = 0 ;
          print("<table class='table table-striped table-hover table-condensed table-editable'>\n") ;
          print("\t\t<caption style='text-align: center;'><h3> Servicios Disponibles </h3></caption>\n") ;
          print("\t\t<thead>\n\t\t  <tr>\n") ;
          print("\t\t    <th> # </th>\n") ;  
          print("\t\t    <th> Servicio </th>\n") ;
          print("\t\t    <th> Telefono </th>\n") ;
          print("\t\t  </tr>\n\t\t</thead>\n") ;
          print("\t\t<tbody>") ;
          // Displays services
          foreach($servicio['results'] as $servicio)
          {
      ?> 
            <!-- Form for viewing, and editing, each available service -->
            <form class='form-horizontal' role='form' method='put' action='editService.php'>
              <tr class='form-group form-inline'>
                <td>

                  <?php $i++ ; print "$i" . "\n" ?>
                </td>
                <td>
                  <div class='form-group'>
                    <input type='text' class='form-control edit' maxlenght='40' pattern='[a-zA-Z\d.*]{3,}' id='name' name='name' placeholder='Nombre' required
                    <?php if(isset($servicio['name'])) print 'value=\'' . $servicio['name'] . '\''; ?>>
                  <div> 
                </td>
                <td>
                  <div class='form-group'>
                    <input type='tel' class='form-control edit' maxlength='10' pattern='[\d]{10}' id='telephone' name='telephone' placeholder='Numero' required
                    <?php if(isset($servicio['telephone'])) print 'value=\'' . $servicio['telephone'] . '\''; ?>>
                  <div>
                </td>
                <td class='form-group'>
                  <div class='form-group'>
                    <input type='hidden' id='id' name='id' value='<?php print $servicio['id']; ?>'>
                    <button type='submit' class='btn-default form-control edit'  value='Actualizar' id='editar'> Editar </button>
                    <button type='submit' class='btn-default form-control edit'  value='Borrar' id='borrar' formmethod='delete' formaction='deleteService.php' formtarget='_self'> Borrar </button>
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
