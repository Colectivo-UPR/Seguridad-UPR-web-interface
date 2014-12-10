
  <form class="form-horizontal" role="form" method="post" action="info_encargado.php">

  <div class="form-group">
    <label for="nombres" class="col-sm-3 control-label">Nombres</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Nombres" required
      <?php if(isset($datos_encargado['nombres'])) print 'value="'.$datos_encargado['nombres'].'"'?>
    </div>
  </div>

  <div class="form-group">
    <label for="apellidos" class="col-sm-3 control-label">Apellidos</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos" required
      <?php if(isset($datos_encargado['apellidos'])) print 'value="'.$datos_encargado['apellidos'].'"'?>
    </div>
  </div>

  <div class="form-group">
    <label for="username" class="col-sm-3 control-label">Nombre usuario</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="username" name="username" placeholder="Nombre usuario" required
      <?php if(isset($datos_encargado['username'])) print 'value="'.$datos_encargado['username'].'"'?>
    </div>
  </div>

  <div class="form-group">
    <label for="email" class="col-sm-3 control-label">email</label>
    <div class="col-sm-9">
      <input type="email" class="form-control" id="email" name="email" placeholder="email" required
      <?php if(isset($datos_encargado['email'])) print 'value="'.$datos_encargado['email'].'"'?>
    </div>
  </div>

  <div class="form-group">
    <label for="email" class="col-sm-3 control-label">Tel&eacute;fono</label>
    <div class="col-sm-9">
      <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Tel&eacute;fono"
      <?php if(isset($datos_encargado['telefono'])) print 'value="'.$datos_encargado['telefono'].'"'?>

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
  
</form>
<?php
}
else
{
	unset($_POST['sometido']);
	$_POST['id']=$id;
	inserta_BD("encargado",$_POST);
	header("Location: panel.php?seleccion=encargado");
}
?>
