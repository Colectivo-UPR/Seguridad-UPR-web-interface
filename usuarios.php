<?php
require_once("connect.php");
require_once("headers.php");
?>
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
        <label for="tipo" class="col-sm-3 control-label">Tipo(s)</label>
          <div class="col-sm-9" style="padding-top: 7px">
            <input type="checkbox" name="director" value="is_director"> Director
            <input type="checkbox" name="manager" value="is_chief_manager"> Ecargado de Turno
            <input type="checkbox" name="official" value="is_official"> Oficial
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
          <?php print 'value="'. $usuario['first_name'].'"'?>>
          </td>
          <td>      
          <input type="text" class="form-control edit" id="apellidos" name="apellidos" placeholder="Apellidos" required 
          <?php print 'value="'. $usuario['last_name'].'"'?>>
          </td>
          <td>      
          <input type="text" class="form-control edit" id="email" name="email" placeholder="Email" required 
          <?php print 'value="'. $usuario['email'].'"'?>>    
          </td>
          <td>
            <div class="col-sm-9" style="padding-top: 7px">
              <input type="checkbox" name="director" value="is_director" <?php print ($usuario['is_director']=="true" ? 'checked' : '');?> > Director
              <input type="checkbox" name="manager" value="is_chief_manager" <?php print ($usuario['is_shift_manager']=="true" ? 'checked' : '');?> > Ecargado de Turno
              <input type="checkbox" name="official" value="is_official" <?php print ($usuario['is_official']=="true" ? 'checked' : '');?> > Oficial
            </div>
          </td>
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
