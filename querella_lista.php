<?php
	require_once('headers.php');
?>

	<body>

	<?php
    	require_once("tabs.php");
      $querellas = curl_get($server, "querellas", $token) ;
	?>
    <h2>Lista Querellas</h2>
    <div class="alert alert-success" id="eventsResult" data-en="Select a case row.">
      <!-- Aquí se muestra el resultado del evento. -->
      Seleccione una querella. 
    </div>
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
                foreach($querellas as $querella){
                  $tablas = array("querellante");
                  foreach($tablas as $tt)
                  {
                    $$tt=curl_get_sin_dash($server, "querella/".str_replace("_","-",$tt)."/?search=".$querella['id'], $token);
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
                $result.text('Cargando datos...');
                window.location.href = "querella.php?id_querella=" + row['id'] ;
            })
        });
    </script>
	</body>
</html>