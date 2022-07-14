<?php
session_start();

if (isset($_SESSION["id_maestro"]) && isset($_SESSION["id_grupo"]) && isset($_SESSION["idMaterias"]) && isset($_SESSION["grupo"]) && isset($_SESSION["asignatura"])) {
  if (isset($_POST["id_unidad"]) && isset($_POST["id_tipopuntos"])) {
   $_SESSION["id_unidad"] = $_POST["id_unidad"];
   $_SESSION["id_tipopuntos"] = $_POST["id_tipopuntos"];
   $_SESSION["nombreTarea"] = $_POST["nombreTarea"];
 }
}
?>
<!DOCTYPE html>
<html lang="ES">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>listado de tareas <?php echo($_SESSION["asignatura"]);  ?></title>
  <link rel="stylesheet" type="text/css" href="../librerias/alertifyjs/css/alertify.css">
  <link rel="stylesheet" type="text/css" href="../librerias/alertifyjs/css/themes/default.css">
  <script src="../librerias/jquery-3.2.1.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../librerias/select2/css/select2.css">
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/web/assets/mobirise-icons/mobirise-icons.css">
  
  <body>

    <div class="container-fluid">
      <div class="pb-2">
        <div class="card">
          <div class="card-header d-flex justify-content-center">
            <div class="align-center">
              <h4 class="mbr-text mbr-fonts-style display-5 d-flex justify-content-center">
                <strong class="text-primary">Calificación de tareas</strong>
              </h4>
              <h4 class="mbr-text mbr-fonts-style display-5 d-flex justify-content-center">
                <strong class="text-primary"><?php echo($_SESSION["asignatura"]); ?></strong>
              </h4>
              <h4 class="mbr-text mbr-fonts-style display-7 d-flex justify-content-center">
                <strong class="text-primary"><?php echo($_SESSION["grupo"]); ?></strong>
              </h4>
              <h4 class="mbr-text mbr-fonts-style display-7 d-flex justify-content-center">
                <strong class="text-primary"><?php echo($_SESSION["nombreTarea"]); ?></strong>
              </h4>
            </div>


          </div>
        </div>
        <div>
          <div id="tabla">

          </div>
        </div>

      </div>

      <?php include("../modales/modal_puntos.php"); ?>
      <!-- Modal para edicion de datos -->

    </body>
    </html>

  

    <script src="../librerias/alertifyjs/alertify.js"></script>
  
    <script type="text/javascript"  src="../assets/bootstrap/js/bootstrap.min.js"></script> 
    <script src="../js/nuevo.js"></script>
    <script type="text/javascript">
    </script>

