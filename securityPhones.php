<?php
	session_start() ;
	if(isset($_SESSION['token'])){

	}
	else{
		header('location: login.php') ;
	}
	require_once('funciones.php') ;
	$server = 'http://136.145.181.112:8080' ;
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

  	<div class="tab-content container-fluid content" >

  		<style>

        table { 
          table-layout: fixed; 
        }

				h1, h3 {
	        text-align: center;
	      }

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
              padding-left: 33%;
        }

	    </style>

  		<h1>Telefonos de Oficiales de Seguridad</h1>
  		<hr>
  		<h3>Crear Telefono</h3>

        <?php $staffUsers = curl_get($server, "staff-users", $_SESSION['token']); ?>

  		  <form id='createForm' class='form-inline form-padding' role='form' method='post' action='createSecPhone.php' target='_self'>

          <label for='oficial' class='control-label'> Oficial: </label>
          <div class='form-group' style='max-width:17%;'>
            <select class='form-control' style='max-width:100%;' id='selected_opt' name='selected_opt'>
              <?php foreach($staffUsers['results'] as $staffUser) { ?>
                <option value="<?php print $staffUser['id'] ?>" ?> 
                  <?php print $staffUser['first_name'] ?>
                </option>
              <?php } ?>
            </select>
          </div>

          <label for='telefono' class='control-label'> Telefono: </label>
          <div class='form-group'>
            <input type='tel' class='form-control edit' maxlength='10' pattern='[\d]{10}' id='number' name='number' placeholder='Numero' required>
          </div>
          <button type='submit' class='btn btn-default btn-primary'> Crear </button>

        </form>

      <hr>

      <!-- Code for displaying available security officials(staff-users) with their current phones. -->
      
      <?php 
        $officialPhones = curl_get($server, "official-phones", $_SESSION['token']);
    
        // Displays security phones with the official using it, in a table, if available.
        if(count($officialPhones && count($staffUsers)))
        {
          $i = 0 ;  // For enumerating security phones available.
          // Prints table tags
          print("<table class='table table-striped table-hover table-condensed table-editable' style=''>\n") ;
          print("\t\t<caption style='text-align: center;'><h3> Telefonos Disponibles </h3></caption>\n") ;
          print("\t\t<thead>\n\t\t  <tr>\n") ; 
          print("\t\t    <th style='padding-left: 10%;'> # </th>\n") ;
          print("\t\t    <th style='padding-left: 20px; width:25%;'> Nombre </th>\n") ;
          print("\t\t    <th style='padding-left: 20px; width:60%;'> Telefono </th>\n") ;
          print("\t\t </tr>\n\t\t</thead>\n") ;
          print("\t\t<tbody>") ;
          // Displays officials phones.
           foreach($officialPhones['results'] as $officialPhone)
           { 
      ?> 
            <!-- Form for viewing, and editing, each available official security phone. -->
            <form class='form-horizontal' role='form' method='put' action='editSecPhone.php'>
              <tr class='form-group form-inline'>
                <td style='padding-left: 10%;'>
                  <?php $i++ ; print $i . "\n" ; ?>
                </td>
                <td>
                  <div class='form-group form-padding'>
                    <!-- Official(staff-user) drop down select list -->
                    <select class='form-control' style='max-width:40%;' id='selected-opt' name='selected-opt'>
                      <!-- For each official phone, creates an option for each staff-user available, and selects the one currently
                           using the official phone. -->
                      <?php foreach($staffUsers['results'] as $staffUser) { ?>
                        <option value="<?php print $staffUser['id'] ?>" 
                          <?php if($officialPhone['official'] == $staffUser['id']) print 'selected' ?> > 
                          <?php print $staffUser['first_name'] ?>
                        </option>
                      <?php } ?>
                    </select>
                  </div>
                </td>
                <td>
                  <div class='form-group form-padding'>
                          <!-- Displays each official security phone. -->
                          <input type='tel' class='form-control edit' maxlength='10' pattern='[\d]{10}' id='number' name='number' placeholder='Numero' readonly
                          <?php if(isset($officialPhone['phone_number'])) print 'value=\'' . $officialPhone['phone_number'] . '\''; ?>>
                  </div>
                  <div class='form-group form-padding'>
                    <input type='hidden' id='id' name='id' value='<?php print $officialPhone['id']; ?>'>
                    <button type='submit' class='btn-default form-control edit btn-primary'  value='Actualizar' id='editar'> Editar </button>
                    <button type='submit' class='btn-default form-control edit btn-danger'  value='Borrar' id='borrar' formmethod='delete' formaction='deleteSecPhone.php'> Borrar </button>
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