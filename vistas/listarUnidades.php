<?php 
require_once("../modelo/consultas.php");
session_start();
unset($_SESSION['consulta']);
unset($_SESSION["id_unidad"]);
unset($_SESSION["id_tipopuntos"]);
if (isset($_POST["asignatura"]) && isset($_POST["id_maestro"])) {
  $_SESSION["asignatura"] = $_POST["asignatura"];
  $_SESSION["id_maestro"] = $_POST["id_maestro"];
  $_SESSION["id_grupo"] = $_POST["idGrupo"];
  $_SESSION["grupo"] = $_POST["grupo"];
  $_SESSION["idMaterias"] = $_POST["idMaterias"];
}
?>
<!DOCTYPE html>
<html  lang="es">
<head>
  <!-- Site made with Mobirise Website Builder v4.11.5, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.11.5, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/logo4.png" type="image/x-icon">
  <meta name="description" content="Website Builder Description">
  
  <title>vistaTrabajos</title>
  <link rel="stylesheet" type="text/css" href="../librerias/alertifyjs/css/alertify.css">
  <link rel="stylesheet" type="text/css" href="../librerias/alertifyjs/css/themes/default.css">
  <link rel="stylesheet" type="text/css" href="../librerias/select2/css/select2.css">
  <script src="../librerias/jquery-3.2.1.min.js"></script>
  <script src="../js/nuevo.js"></script>
  <script src="../librerias/bootstrap/js/bootstrap.js"></script>
  <script src="../librerias/alertifyjs/alertify.js"></script>
  <script src="../librerias/select2/js/select2.js"></script>

  <link rel="stylesheet" href="../assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="../assets/tether/tether.min.css">
  <link rel="stylesheet" href="../assets/theme/css/style.css">
  <link rel="preload" as="style" href="../assets/mobirise/css/mbr-additional.css">
  <link rel="stylesheet" href="../assets/mobirise/css/mbr-additional.css" type="text/css">
  
</head>
<body>
  <section class="accordion1 cid-rL4OdCv9Hl">
    <div class="container">
      <div class="text-title" style="text-align: center;">
        <div class="card">
          <div class="card-title">
            <h4>Revisión de Actividades y Tareas</h4>
          </div>
        </div>
      </div>
      <div class="media-container-row">
        <div class="col-md-12">
          <div class="section-head text-center">
            <h2 class="mbr-section-title pb-4 mbr-fonts-style display-4">
              Grupo: <?php echo($_SESSION["grupo"]); ?>
            </h2>
          </div>
          <div class="clearfix"></div>
          <div id="bootstrap-accordion_3" class="panel-group accordionStyles accordion" role="tablist" aria-multiselectable="true">
            <?php 
            $cont = 0;
            $resultado = getConsultas::getUnidades($_SESSION["idMaterias"]);
            //print_r($resultado);
            foreach ($resultado as $key => $value) { $cont++;?>
              <div class="card">
                <div class="card-header" role="tab" id="headingOne">
                  <a role="button" class="panel-title collapsed text-black" data-toggle="collapse" data-core="" href="#<?php  echo("collapse".$cont."_".$value["unidad"])?>" aria-expanded="false" aria-controls="<?php echo("collapse".$cont); ?>">
                    <h4 class="mbr-fonts-style display-7">
                      <span class="sign mbr-iconfont mbri-arrow-down inactive"></span>
                      Unidad <?php echo($value["unidad"].": "); echo($value["tema"]);?>
                    </h4>
                  </a>
                </div>
                <div id="<?php echo("collapse".$cont."_".$value["unidad"]) ?>" class="panel-collapse  collapse " role="tabpanel" aria-labelledby="headingOne" data-parent="#bootstrap-accordion_3">
                  <div class="panel-body p-4" style="font-style: normal; color: #030000;">
                    <table class="table table-hover table-condensed table-bordered tablaDatos">
                      <thead>
                        <tr class="table-heads ">     
                          <th class="head-item mbr-fonts-style display-7">
                            Tarea/Actividad
                          </th>
                          <th class="head-item mbr-fonts-style display-7">
                            Fecha de entrega
                          </th>
                          <th class="head-item mbr-fonts-style display-7">
                            Acción
                          </th>
                        </tr>
                      </thead>  

                      <?php  
                      $result = getConsultas::getTareas($_SESSION["id_maestro"],$_SESSION["id_grupo"],$value["id_materias"],$value["id"]);
                      //print_r($result);
                      foreach ($result as $key => $valor) {?>
                        <tbody>
                          <form method="POST" action="verTareas.php" name="<?php echo("form-tarea-".$valor["id_tipo"]); ?>">
                            <input type="hidden" name="id_unidad" value="<?php echo($valor["idUnidad"]); ?>">
                            <input type="hidden" name="id_tipopuntos" value="<?php echo($valor["idTipo"]); ?>">
                            <input type="hidden" name="nombreTarea" value="<?php echo($valor["id_tipo"].": ".$valor["descripcion"]); ?>">

                            <tr>
                              <td class="body-item mbr-fonts-style display-7">
                                <?php echo($valor["id_tipo"].": ".$valor["descripcion"]); ?>
                              </td>
                              <td class="body-item mbr-fonts-style display-7">
                                <?php echo($valor["fecha"]); ?>
                              </td>
                              <td class="body-item mbr-fonts-style display-7">
                                <button type="submit" class="btn-primary">Revisar</button> 
                              </td>
                            </tr>
                          </form>
                        </tbody>
                      <?php } ?>
                    </table>
                  </div>
                </div>
              </div>
            <?php } ?>

          </div>
        </div>
      </div>
    </div>
  </section>


  <script src="../assets/web/assets/jquery/jquery.min.js"></script>
  <script src="../assets/popper/popper.min.js"></script>
  <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="../assets/tether/tether.min.js"></script>
  <script src="../assets/smoothscroll/smooth-scroll.js"></script>
  <script src="../assets/theme/js/script.js"></script>


</body>
</html>