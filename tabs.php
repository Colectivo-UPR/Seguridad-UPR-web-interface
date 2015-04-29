<?php
$activo=$_SERVER['PHP_SELF'];
$activo=substr($activo,strrpos($activo,"/")+1);
?>
    <div class="tab-content container-fluid content" >
 <!--     <h1>Avisos de Emergencia</h1> -->
      <div role="tabpanel">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" <?php if($activo=='alertas.php') echo 'class="active"';?>><a href="alertas.php" aria-controls="alertas">Avisos</a></li>
          <li role="presentation" <?php if($activo=='reportes.php') echo 'class="active"';?>><a href="reportes.php" aria-controls="reportes" >Reportes</a></li>
          <li role="presentation" <?php if($activo=='querella_lista.php') echo 'class="active"';?>><a href="querella_lista.php" aria-controls="querellas">Querellas</a></li>
          <li role="presentation" <?php if($activo=='querella.php') echo 'class="active"';?>><a href="querella.php" aria-controls="querellas">Crear Querella</a></li>
        </ul>
	</div>
