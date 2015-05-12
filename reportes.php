<?php  
require_once("headers.php");
?>
  <body>
 <?php
require_once("tabs.php");
?>
    <h2>Reportes Recibidos</h2>
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="reportes">
          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <?php
              $reportes = curl_get($server, "reports", $_SESSION['token']);
              $reportes = array_reverse($reportes);
              foreach($reportes as $reporte){
            ?>
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="heading<?php print $reporte['id']; ?>">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php print $reporte['id']; ?>" aria-expanded="true" aria-controls="collapse<?php print $reporte['id']; ?>">
                        <?php print $reporte['title']; ?>
                      </a>
                    </h4>
                  </div>
                <div id="collapse<?php print $reporte['id']; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php print $reporte['id']; ?>">
                  <div class="panel-body">
                    <div class="form-group row">
                      <label for="apellidos" class="col-sm-1 control-label">Fecha: </label>
                      <div class="col-sm-9">
                        <?php print date("Y-m-d H:i:s", strtotime($reporte["pub_date"]));?>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="apellidos" class="col-sm-1 control-label">Mensaje: </label>
                      <div class="col-sm-9">
                        <?php print $reporte['message'];?>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="apellidos" class="col-sm-1 control-label">Facultad: </label>
                      <div class="col-sm-9">
                        <?php print $reporte['faculty'];?>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="apellidos" class="col-sm-1 control-label">Latitud: </label>
                      <div class="col-sm-9">
                        <?php print $reporte['lat'];?>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="apellidos" class="col-sm-1 control-label">Longitud: </label>
                      <div class="col-sm-9">
                        <?php print $reporte['lon'];?>
                      </div>
                    </div>               
                  </div>
                </div>
              </div>
            <?php
              }
            ?>
          </div>
        </div>
      </div>
  </body>
</html>