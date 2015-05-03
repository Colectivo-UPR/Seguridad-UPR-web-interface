<?php
	require_once('headers.php');
?>


	<body>

	<?php
    	require_once("tabs.php");

      $querellas = curl_get($server, "querellas", $token) ;
	?>
    <h2>Lista Querellas</h2>
    <table id="eventsTable"
       data-toggle="table"
       data-sort-name="fecha_informada"
       data-sort-order="desc"
       data-pagination="true"
       data-search="true"
       data-toolbar="#toolbar"
       data-show-footer="true">
        <thead>
        <tr>
            <th data-field="numero_fila" data-formatter="runningFormatter" data-width="50">#</th>
            <th data-field="id" data-id-field="id" data-visible="true" data-width="50">ID</th>
            <th data-field="numero_caso" data-sortable="true">Número de Caso</th>
            <th data-field="nombre" data-sortable="true">Nombre de Querellante</th>
            <th data-field="fecha_informada" data-sortable="true">Fecha</th> 
        </tr>
        </thead>
        <tbody>
            <?php
                $i = 0;
                foreach($querellas as $id){
                  $querella=curl_get($server, 'querellas/'.$id['id'], $token);
                  $tablas = array("querellante");
                  foreach($tablas as $tt)
                  {
                    $$tt=curl_get_sin_dash($server, "querella/".str_replace("_","-",$tt)."/?search=".$id['id'], $token);
                  }
            ?>
                <tr>
                    <td></td>
                    <td><?php echo $querella['id'] ; ?></td>
                    <td><?php if(isset($querella['numero_caso'])) echo $querella['numero_caso'] ; else echo 'N/a' ; ?></td>
                    <td><?php if(isset($querellante[0]['nombre'])) echo $querellante[0]['nombre'] ; else echo 'N/a' ; ?></td>
                    <td><?php if(isset($querella['fecha_informada'])) echo str_replace("Z","",$querella['fecha_informada']) ; else echo 'N/a' ; ?></td>
                </tr>
            <?php   
              }
            ?>
        </tbody>
    </table>

    <script>

        function runningFormatter(value, row, index) {
            return index+1;
        }

        $(function () {
            var $result = $('#eventsResult');
            $('#eventsTable').on('all.bs.table', function (e, name, args) {
                console.log('Event:', name, ', data:', args);
            })
            .on('click-row.bs.table', function (e, row, $element) {
                $result.text('Cargando datos...' + JSON.stringify(row));
                window.location.href = "http://localhost:8080/querella_lista.php?id_querella=" + row['id'] + "#loaded_data" ;
            })
        });

    </script>

    <div id="loaded_data" style="height: 50px;"></div>

    <div class="alert alert-success" id="eventsResult" data-en="Select a case row.">
      <!-- Aquí se muestra el resultado del evento. -->
      <?php 
        if (isset($_GET['id_querella'])) {
          /**************************************************************************************************************/
          $id_querella=$_GET['id_querella'];
          $numero_fila=$_GET['numero_fila'];
          $simples = array("querella","querellante");
          $querella = curl_get($server, 'querellas/'.$id_querella, $token);
          $tablas = array("querellante","perjudicado","querellado","testigo","officiales_intervinieron");
          foreach($tablas as $tt)
          {
              $$tt=curl_get_sin_dash($server, "querella/".str_replace("_","-",$tt)."/?search=$id_querella", $token);
          }

          $rutas=array('area_geografica','sancion_arresto','tipo_incidente','medio_notificacion','forma_se_refirio','sector');
          foreach($rutas as $ruta)
          {
            $ans=curl_get($server, 'querella/'.str_replace("_","-",$ruta), $token);
            $$ruta=$ans;
          }
        /**************************************************************************************************************/
          echo "Querella seleccionada: " ;
          echo "<br><span style='margin-left:2em;'>Id:</span> "    . $id_querella ;
          echo "<br><span style='margin-left:2em;'>Caso:</span> "  . $querella['numero_caso'] ; 
          echo "<br><span style='margin-left:2em;'>Nombre:</span> " ; 
          echo isset($querellante[0]['nombre']) ? $querellante[0]['nombre'] : 'N/a' ;
          echo "<br><span style='margin-left:2em;'>Fecha:</span> " . $querella['fecha_informada'] ;
          }
        else
          echo "Seleccione una querella." ; 
      ?>
    </div>

    <?php 
      if (isset($id_querella))
      {
    ?>     
        <form id="eventResponse" class="form-inline" role="form" method="post" action="#">
            <div class="form-group col-md-8">
                <label for="numero_caso">Número de caso:</label>
                <input type="text" class="form-control-corrada col-md-8" id="numero_caso" name="numero_caso" <?php if(isset($querella['numero_caso'])) echo 'value="'.$querella['numero_caso'].'"';?> placeholder="Número de caso" required>
              </div>
             
            <div class="form-group col-md-4">
                <label for="area_geografica">Área geográfica:</label>
            <select class="form-control-corrada col-md-4" id="area_geografica" name="area_geografica" required>
            <?php
            foreach($area_geografica as $id => $tipo)
            {
            ?>
            <option value="<?php echo $tipo['id'];?>" <?php if(isset($querella['area_geografica']) and $querella['area_geografica']==$tipo['id']) echo "selected";?>><?php echo $tipo['tipo'];?></option>
            <?php
            }
            ?>
            </select>
             </div>      

            <div class="form-group col-md-5">
                <label for="nombre_querellante">Nombre del querellante:</label>
                <input type="text" class="form-control-corrada col-md-5" <?php if(isset($querellante[0]['nombre'])) echo 'value="'.$querellante[0]['nombre'].'"';?> id="nombre_querellante" name="nombre_querellante" placeholder="Nombre del querellante" required>
              </div>

            <div class="form-group col-md-5">
                <label for="fecha_informada">Fecha informada:</label>
                <input type="datetime-local" <?php if(isset($querella['fecha_informada'])) echo 'value="'.str_replace("Z","",$querella['fecha_informada']).'"';?> class="form-control-corrada col-md-5" id="fecha_informada" name="fecha_informada" required>
              </div>

            <div class="form-group col-md-4">
                <label for="direccion_residencial">Dirección residencial:</label>
            <textarea class="form-control-box col-md-4" rows="4" id="direccion_residencial_querellante" name="direccion_residencial_querellante" required><?php if(isset($querellante[0]['direccion_residencial'])) echo $querellante[0]['direccion_residencial'];?></textarea>
            <br>
                <label for="direccion_postal">Dirección postal:</label>
            <textarea class="form-control-box col-md-4" rows="4" id="direccion_postal_querellante" name="direccion_postal_querellante" required><?php if(isset($querellante[0]['direccion_postal'])) echo $querellante[0]['direccion_postal'];?></textarea>
              </div>
              
            <div class="form-group col-md-4">
                <label for="numero_identificacion">Número de identificación:</label>
                <input type="text" class="form-control-corrada col-md-4" <?php if(isset($querellante[0]['numero_identificacion'])) echo 'value="'.$querellante[0]['numero_identificacion'].'"';?> id="numero_identificacion_querellante" name="numero_identificacion_querellante" placeholder="Número de identificación">
              </div>

            <div class="form-group col-md-4">
                <label for="medio_notificacion">Medio de notificación:</label>
            <select class="form-control-corrada col-md-4" id="medio_notificacion" name="medio_notificacion" required>
            <?php
            foreach($medio_notificacion as $id => $tipo)
            {
            ?>
            <option value="<?php echo $tipo['id'];?>" <?php if(isset($querella['medio_notificacion']) and $querella['medio_notificacion']==$tipo['id']) echo "selected";?>><?php echo $tipo['tipo'];?></option>
            <?php
            }
            ?>
            </select>
              </div>

            <div class="form-group col-md-4">
                <label for="lugar_trabajo_querellante">Lugar de trabajo:</label>
                <input type="text" class="form-control-corrada col-md-4" <?php if(isset($querellante[0]['lugar_trabajo'])) echo 'value="'.$querellante[0]['lugar_trabajo'].'"';?> id="lugar_trabajo_querellante" name="lugar_trabajo_querellante" placeholder="Lugar de trabajo"> 
              </div>

            <div class="form-group col-md-4">
                <label for="tel_trabajo_querellante">Teléfono y extensión de trabajo:</label>
                <input type="tel" <?php if(isset($querellante[0]['tel_trabajo'])) echo 'value="'.$querellante[0]['tel_trabajo'].'"';?> pattern="(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}(( |[x ])?\d{4})?" class="form-control-corrada col-md-4" id="tel_trabajo_querellante" name="tel_trabajo_querellante" placeholder="Teléfono trabajo"> 
              </div>

            <div class="form-group col-md-4">
                <label for="tel_personal_querellante">Teléfono o celular personal:</label>
                <input type="tel" <?php if(isset($querellante[0]['tel_personal'])) echo 'value="'.$querellante[0]['tel_personal'].'"';?> pattern="(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}(( |[x ])?\d{4})?" class="form-control-corrada col-md-4" id="tel_personal_querellante" name="tel_personal_querellante" placeholder="Teléfono personal" required> 
              </div>

            <div class="form-group col-md-4">
                <label for="sector_querellante">Sector del querellante:</label>
            <select class="form-control-corrada col-md-4" id="sector_querellante" name="sector_querellante" required>
            <?php
            foreach($sector as $id => $tipo)
            {
            ?>
            <option value="<?php echo $tipo['id'];?>" <?php if(isset($querellante[0]['sector']) and $querellante[0]['sector']==$tipo['id']) echo "selected";?>><?php echo $tipo['tipo'];?></option>
            <?php
            }
            ?>
            </select>
              </div>
                

            <div class="form-group col-md-4">
                <label for="fotos">¿Se tomaron fotos?</label>
            <select class="form-control-corrada col-md-4" name="hay_fotos" id="hay_fotos" required>
            <option value="true" <?php if(isset($querella['hay_fotos']) and $querella['hay_fotos']==true) echo "selected";?>>Sí</option>
            <option value="false" <?php if(isset($querella['hay_fotos']) and $querella['hay_fotos']==false) echo "selected";?>>No</option>
            </select>
              </div>
                
             
            <div class="form-group col-md-4">
                <label for="genero_querellante">Sexo</label>
            <select class="form-control-corrada col-md-4" name="genero_querellante" id="genero_querellante" required>
            <option value="0" <?php if(isset($querellante[0]['genero']) and $querellante[0]['genero']==0) echo "selected";?>>F</option>
            <option value="1" <?php if(isset($querellante[0]['genero']) and $querellante[0]['genero']==1) echo "selected";?>>M</option>
            </select>
              </div>
                
            <div class="form-group col-md-12">
            </div>

            <div class="form-group col-md-4">
                <label for="tipo_identificacion_querellante">Tipo ID:</label>
                <input type="text" <?php if(isset($querellante[0]['tipo_identificacion'])) echo 'value="'.$querellante[0]['tipo_identificacion'].'"';?> class="form-control-corrada col-md-4" id="tipo_identificacion_querellante" name="tipo_identificacion_querellante" placeholder="Tipo ID" required>
              </div>
             
            <div class="form-group col-md-4">
                <label for="numero_identificacion_querellante">Número ID:</label>
                <input type="text" <?php if(isset($querellante[0]['numero_identificacion'])) echo 'value="'.$querellante[0]['numero_identificacion'].'"';?> class="form-control-corrada col-md-4" id="numero_identificacion_querellante" name="numero_identificacion_querellante" placeholder="Número ID" required>
              </div>
             
            <div class="form-group col-md-4">
                <label for="email_querellante">Correo electrónico:</label>
                <input type="email" <?php if(isset($querellante[0]['email'])) echo 'value="'.$querellante[0]['email'].'"';?> class="form-control-corrada col-md-4" id="email_querellante" name="email_querellante" placeholder="Correo electrónico" required>
              </div>
            <div class="form-group col-md-12">
            <hr> 
            </div>
             
            <div class="form-group col-md-12">
            <h3>Personas perjudicadas</h3>
            </div>

            <?php
            $n_perjudicado=3;

            for($i=1;$i<=$n_perjudicado;$i++)
            {
            ?>

            <div class="form-group col-md-4">
                <label for="nombre<?php echo $i;?>_perjudicado">Nombre Perjudicado:</label>
                <input type="text" <?php if(isset($perjudicado[$i-1]['nombre'])) echo 'value="'.$perjudicado[$i-1]['nombre'].'"';?> class="form-control-corrada col-md-4" id="nombre<?php echo $i;?>_perjudicado" name="nombre<?php echo $i;?>_perjudicado" placeholder="Nombre Perjudicado" <?php if($i==1)echo 'required';?>>
            <br>
                <label for="telefono<?php echo $i;?>_perjudicado">Teléfono:</label>
                <input type="tel" <?php if(isset($perjudicado[$i-1]['telefono'])) echo 'value="'.$perjudicado[$i-1]['telefono'].'"';?> pattern="(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}(( |[x ])?\d{4})?" class="form-control-corrada col-md-4" id="tel<?php echo $i;?>_perjudicado" name="telefono<?php echo $i;?>_perjudicado" placeholder="Teléfono personal" <?php if($i==1)echo 'required';?>> 
              </div>
             
            <div class="form-group col-md-4">
                <label for="direccion_residencial<?php echo $i;?>_perjudicado">Dirección residencial:</label>
            <textarea class="form-control-box col-md-4" rows="4" id="direccion_residencial<?php echo $i;?>_perjudicado" name="direccion_residencial<?php echo $i;?>_perjudicado" placeholder="Dirección residencial" <?php if($i==1)echo 'required';?>><?php if(isset($perjudicado[$i-1]['direccion_residencial'])) echo $perjudicado[$i-1]['direccion_residencial'];?></textarea>
              </div>
             
            <div class="form-group col-md-4">
                <label for="direccion_postal<?php echo $i;?>_perjudicado">Dirección postal:</label>
            <textarea class="form-control-box col-md-4" rows="4" id="direccion_postal<?php echo $i;?>_perjudicado" name="direccion_postal<?php echo $i;?>_perjudicado" placeholder="Dirección postal" <?php if($i==1)echo 'required';?>><?php if(isset($perjudicado[$i-1]['direccion_postal'])) echo $perjudicado[$i-1]['direccion_postal'];?></textarea>
              </div>
            <div class="form-group col-md-12">
            <hr> 
            </div>
            <?php
            }
            ?>
            <input type="hidden" name="n_perjudicado" value="<?php echo $n_perjudicado;?>">


            <div class="form-group col-md-12">
            <h3>Testigos</h3>
            </div>

            <?php
            $n_testigo=3;

            for($i=1;$i<=$n_testigo;$i++)
            {
            ?>

            <div class="form-group col-md-4">
                <label for="nombre<?php echo $i;?>_testigo">Nombre Testigo:</label>
                <input type="text" <?php if(isset($testigo[$i-1]['nombre'])) echo 'value="'.$testigo[$i-1]['nombre'].'"';?> class="form-control-corrada col-md-4" id="nombre<?php echo $i;?>_testigo" name="nombre<?php echo $i;?>_testigo" placeholder="Nombre Testigo" <?php if($i==1)echo 'required';?>>
            <br>
                <label for="telefono<?php echo $i;?>_testigo">Teléfono:</label>
                <input type="tel" <?php if(isset($testigo[$i-1]['telefono'])) echo 'value="'.$testigo[$i-1]['telefono'].'"';?> pattern="(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}(( |[x ])?\d{4})?" class="form-control-corrada col-md-4" id="telefono<?php echo $i;?>_testigo" name="telefono<?php echo $i;?>_testigo" placeholder="Teléfono personal" <?php if($i==1)echo 'required';?>> 
              </div>
             
            <div class="form-group col-md-4">
                <label for="direccion_residencial<?php echo $i;?>_testigo">Dirección residencial:</label>
                <textarea class="form-control-box col-md-4" rows="4" id="direccion_residencial<?php echo $i;?>_testigo" name="direccion_residencial<?php echo $i;?>_testigo" placeholder="Dirección residencial" <?php if($i==1)echo 'required';?>><?php if(isset($testigo[$i-1]['direccion_residencial'])) echo $testigo[$i-1]['direccion_residencial'];?></textarea>
              </div>
             
            <div class="form-group col-md-4">
                <label for="direccion_postal<?php echo $i;?>_testigo">Dirección postal:</label>
                <textarea class="form-control-box col-md-4" rows="4" id="direccion_postal<?php echo $i;?>_testigo" name="direccion_postal<?php echo $i;?>_testigo" placeholder="Dirección postal" <?php if($i==1)echo 'required';?>><?php if(isset($testigo[$i-1]['direccion_postal'])) echo $testigo[$i-1]['direccion_postal'];?></textarea>
              </div>

            <div class="form-group col-md-12">
            <hr> 
            </div>
            <?php
            }
            ?>
            <input type="hidden" name="n_testigo" value="<?php echo $n_testigo;?>">


            <div class="form-group col-md-12">
            <h3>Datos sobre el incidente</h3>
            </div>
            <div class="form-group col-md-4">
                <label for="fecha_incidente">Fecha:</label>
                <input type="datetime-local" <?php if(isset($querella['fecha_incidente'])) echo 'value="'.str_replace("Z","",$querella['fecha_incidente']).'"';?> class="form-control-corrada col-md-6" id="fecha_incidente" name="fecha_incidente" required>
              </div>

            <div class="form-group col-md-6">
                <label for="lugar_incidente">Lugar:</label>
                <input type="text" <?php if(isset($querella['lugar_incidente'])) echo 'value="'.$querella['lugar_incidente'].'"';?> class="form-control-box col-md-6" id="lugar_incidente" name="lugar_incidente" required>
              </div>

            <div class="form-group col-md-2">
                <label for="area_incidente">Área:</label>
            <select class="form-control-corrada col-md-2" id="area_incidente" name="area_incidente" required>
            <option value="A" <?php if(isset($querella['area_incidente']) and $querella['area_incidente']=="A") echo "selected";?>>A</option>
            <option value="B" <?php if(isset($querella['area_incidente']) and $querella['area_incidente']=="B") echo "selected";?>>B</option>
            <option value="C" <?php if(isset($querella['area_incidente']) and $querella['area_incidente']=="C") echo "selected";?>>C</option>
            </select>
              </div>
              
            <div class="form-group col-md-5">
                <label for="tipo_incidente">Tipo de querella:</label>
            <select class="form-control-corrada col-md-5" id="tipo_incidente" name="tipo_incidente" required>
            <?php
            foreach($tipo_incidente as $id => $tipo)
            {
            ?>
            <option value="<?php echo $tipo['id'];?>" <?php if(isset($querella['tipo_incidente']) and $querella['tipo_incidente']==$tipo['id']) echo "selected";?>><?php echo $tipo['tipo'];?></option>
            <?php
            }
            ?>
            </select>
              </div>
                

            <div class="form-group col-md-4">
                <label for="sancion_arresto">Sanciones y/o arrestos por:</label>
            <select class="form-control-corrada col-md-4" id="sancion_arresto" name="sancion_arresto">
            <?php
            foreach($sancion_arresto as $id => $tipo)
            {
            ?>
            <option value="<?php echo $tipo['id'];?>" <?php if(isset($querella['sancion_arresto']) and $querella['sancion_arresto']==$tipo['id']) echo "selected";?>><?php echo $tipo['tipo'];?></option>
            <?php
            }
            ?>
            </select>
              </div>

            <div class="form-group col-md-3">
                <label for="crimen_odio">Crimen por Odio</label>
            <select class="form-control-corrada col-md-3" name="crimen_odio" id="crimen_odio" required>
            <option value="true" <?php if(isset($querella['crimen_odio']) and $querella['crimen_odio']==true) echo "selected";?>>Sí</option>
            <option value="false" <?php if(isset($querella['crimen_odio']) and $querella['crimen_odio']==false) echo "selected";?>>No</option>
            </select>
              </div>
                
            <div class="form-group col-md-6">
                <label for="descripcion_incidente">Descripción de la querella (qué, cómo, cuándo, dónde, quién):</label>
            <textarea class="form-control-box col-md-6" rows="4" id="descripcion_incidente" name="descripcion_incidente" required><?php if(isset($querella['descripcion_incidente'])) echo $querella['descripcion_incidente'];?></textarea>
              </div>
              
            <div class="form-group col-md-12">
            <h3>Querellado(s)</h3>
            </div>

            <?php
            $n_querellado=3;

            for($i=1;$i<=$n_querellado;$i++)
            {
            ?>

            <div class="form-group col-md-4">
                <label for="nombre<?php echo $i;?>_querellado">Nombre querellado:</label>
                <input type="text" <?php if(isset($querellado[$i-1]['nombre'])) echo 'value="'.$querellado[$i-1]['nombre'].'"';?> class="form-control-corrada col-md-4" id="nombre<?php echo $i;?>_querellado" name="nombre<?php echo $i;?>_querellado" placeholder="Nombre Perjudicado" <?php if($i==1)echo 'required';?>>
            <br>
                <label for="telefono<?php echo $i;?>_querellado">Teléfono:</label>
                <input type="tel" <?php if(isset($querellado[$i-1]['telefono'])) echo 'value="'.$querellado[$i-1]['telefono'].'"';?> pattern="(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}(( |[x ])?\d{4})?" class="form-control-corrada col-md-4" id="telefono<?php echo $i;?>_querellado" name="telefono<?php echo $i;?>_querellado" placeholder="Teléfono personal" <?php if($i==1)echo 'required';?>> 
              </div>
             
            <div class="form-group col-md-4">
                <label for="direccion_residencial<?php echo $i;?>_querellado">Dirección residencial:</label>
                <textarea class="form-control-box col-md-4" rows="4" id="direccion_residencial<?php echo $i;?>_querellado" name="direccion_residencial<?php echo $i;?>_querellado" placeholder="Dirección residencial" <?php if($i==1)echo 'required';?>><?php if(isset($querellado[$i-1]['direccion_residencial'])) echo $querellado[$i-1]['direccion_residencial'];?></textarea>
              </div>
             
            <div class="form-group col-md-4">
                <label for="direccion_postal<?php echo $i;?>_querellado">Dirección postal:</label>
                <textarea class="form-control-box col-md-4" rows="4" id="direccion_postal<?php echo $i;?>_querellado" name="direccion_postal<?php echo $i;?>_querellado" placeholder="Dirección postal" <?php if($i==1)echo 'required';?>><?php if(isset($querellado[$i-1]['direccion_postal'])) echo $querellado[$i-1]['direccion_postal'];?></textarea>
              </div>
            <div class="form-group col-md-12">
            <hr> 
            </div>

            <?php
            }
            ?>
            <input type="hidden" name="n_querellado" value="<?php echo $n_querellado;?>">

            <div class="form-group col-md-12">
            <h3>Oficiales de seguridad que intervinieron</h3>
            </div>

            <?php
            $n_officiales_intervinieron=3;

            for($i=1;$i<=$n_officiales_intervinieron;$i++)
            {
            ?>
            <div class="form-group col-md-4">
                <label for="nombre<?php echo $i;?>_officiales_intervinieron">Nombre oficial:</label>
                <input type="text" <?php if(isset($officiales_intervinieron[$i-1]['nombre'])) echo 'value="'.$officiales_intervinieron[$i-1]['nombre'].'"';?> class="form-control-corrada col-md-4" id="nombre<?php echo $i;?>_officiales_intervinieron" name="nombre<?php echo $i;?>_officiales_intervinieron" placeholder="Nombre Oficial" <?php if($i==1)echo 'required';?>>
              </div>
             
            <div class="form-group col-md-4">
                <label for="turno<?php echo $i;?>_officiales_intervinieron">Turno:</label>
                <input type="text" <?php if(isset($officiales_intervinieron[$i-1]['turno'])) echo 'value="'.$officiales_intervinieron[$i-1]['turno'].'"';?> class="form-control-corrada col-md-4" id="turno<?php echo $i;?>_officiales_intervinieron" name="turno<?php echo $i;?>_officiales_intervinieron" placeholder="Turno" <?php if($i==1)echo 'required';?>>
              </div>
             
            <div class="form-group col-md-4">
                <label for="numero_placa<?php echo $i;?>_officiales_intervinieron">Número de placa:</label>
                <input type="text" <?php if(isset($officiales_intervinieron[$i-1]['numero_placa'])) echo 'value="'.$officiales_intervinieron[$i-1]['numero_placa'].'"';?> class="form-control-corrada col-md-4" id="numero_placa<?php echo $i;?>_officiales_intervinieron" name="numero_placa<?php echo $i;?>_officiales_intervinieron" placeholder="Número de placa" <?php if($i==1)echo 'required';?>>
              </div>
            <div class="form-group col-md-12">
            <hr> 
            </div>
            <?php
            }
            ?>
            <input type="hidden" name="n_officiales_intervinieron" value="<?php echo $n_officiales_intervinieron;?>">

            <div class="form-group col-md-12">
            <h3>Oficial de seguridad que atendió la querella</h3>
            </div>
                    
            <div class="form-group col-md-4">
                <label for="official_atendio">Nombre oficial:</label>
                <input type="text" <?php if(isset($querella['official_atendio'])) echo 'value="'.$querella['official_atendio'].'"';?> class="form-control-corrada col-md-4" id="official_atendio" name="official_atendio" placeholder="Nombre Oficial" required>
              </div>
             
            <div class="form-group col-md-4">
                <label for="placa_official">Número de placa:</label>
                <input type="text" <?php if(isset($querella['placa_official'])) echo 'value="'.$querella['placa_official'].'"';?> class="form-control-corrada col-md-4" id="placa_official" name="placa_official" placeholder="Número de placa" required>
              </div>

            <div class="form-group col-md-12">
            <hr> 
            </div>

            <div class="form-group col-md-4">
                <label for="referido_a">Caso referido a:</label>
                <input type="text" <?php if(isset($querella['referido_a'])) echo 'value="'.$querella['referido_a'].'"';?> class="form-control-corrada col-md-4" id="referido_a" name="referido_a" placeholder="Referido" required>
              </div>
             
            <div class="form-group col-md-4">
                <label for="agente_se_notifico">Agente al cual se le notificó:</label>
                <input type="text" <?php if(isset($querella['agente_se_notifico'])) echo 'value="'.$querella['agente_se_notifico'].'"';?> class="form-control-corrada col-md-4" id="agente_se_notifico" name="agente_se_notifico" placeholder="Nombre Agente" required>
              </div>
             
            <div class="form-group col-md-4">
                <label for="placa_agente">Número de placa:</label>
                <input type="text" <?php if(isset($querella['placa_agente'])) echo 'value="'.$querella['placa_agente'].'"';?> class="form-control-corrada col-md-4" id="placa_agente" name="placa_agente" placeholder="Número de placa" required>
              </div>

            <div class="form-group col-md-4">
                <label for="numero_caso_policia">Número de caso de la policía:</label>
                <input type="text" <?php if(isset($querella['numero_caso_policia'])) echo 'value="'.$querella['numero_caso_policia'].'"';?> class="form-control-corrada col-md-4" id="numero_caso_policia" name="numero_caso_policia" placeholder="Número de caso de la policía" required>
              </div>


            <div class="form-group col-md-4">
                <label for="forma_se_refirio">Forma en que se refirió:</label>
            <select class="form-control-corrada col-md-4" id="forma_se_refirio" name="forma_se_refirio" required>
            <?php
            //print_r($forma_se_refirio);
            foreach($forma_se_refirio as $id => $tipo)
            {
            ?>
            <option value="<?php echo $tipo['id'];?>" <?php if(isset($querella['forma_se_refirio']) and $querella['forma_se_refirio']==$tipo['id']) echo "selected";?>><?php echo $tipo['tipo'];?></option>
            <?php
            }
            ?>
            </select>
              </div>

                
            <div class="form-group col-md-12">
            <hr> 
            </div>

            <div class="form-group col-md-8">
                <label for="accion_tomada">Acción tomada:</label>
            <textarea class="form-control-box col-md-8" rows="4" id="accion_tomada" name="accion_tomada"><?php if(isset($querella['accion_tomada'])) echo $querella['accion_tomada'];?></textarea>
              </div>

            <div class="form-group col-md-4 col-md-offset-4">
            <?php if(isset($id_querella))echo '<input type="hidden" name="id_querella" value="'.$id_querella.'">';?>
                    <button type="submit" class="btn btn-default">Actualizar?</button>
            </div>
        </form>
    <?php
      }
    ?>
    <br>

	</body>
</html>