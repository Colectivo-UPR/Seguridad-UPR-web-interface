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
            <br></br>
            <div id="incidenteN"></div>
            <script>
            $('#incidenteN').load('info_incidente.php');
            </script>
            <div>
              <?php 
              $incidentes= curl_get($servicio, "incidents", $_SESSION['token']);
              if(count($incidentes))
              {
                $i=0;
                foreach($incidentes['results'] as $incidente)
                {
                ?>
                <tr>
                <td>
                    <button type="button" class="btn btn-default stacked" data-toggle="collapse" data-target="#panel_incidente<?php print $i;?>">
                      <?php print $incidente["title"].' '.date("Y-m-d H:i:s", strtotime($incidente["pub_date"]));?>
                    </button>
                    <div id="panel_incidente<?php print $i;?>" class="collapse"><div id="incidente<?php print $i;?>"></div></div>
                    <script>
                      $('#incidente<?php print $i;?>').load('info_incidente.php?datos=<?php print urlencode(json_encode($incidente));?>').fadeIn("slow");
                    </script>
                </td>
                </tr>
                <?php
                  $i++;
                }
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
