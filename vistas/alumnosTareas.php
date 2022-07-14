<?php 
require_once("../modelo/consultas.php"); 
require_once("../modelo/insertar.php");


session_start();
$r = getConsultas::getFecha();

$manejoTarea = 0;

if (isset($_POST["id_alumno"]) && isset($_POST["id_carga_alumno"]) && isset($_POST["grupo_alumno"])) {
  $_SESSION["id_alumno"] = $_POST["id_alumno"];
  $_SESSION["id_maestro"] = $_POST["id_maestro"];
  $_SESSION["id_carga_alumno"] = $_POST["id_carga_alumno"];
  $_SESSION["id_grupo_alumno"] = $_POST["id_grupo_alumno"];
  $_SESSION["id_materias_alumno"] = $_POST["id_materias_alumno"];
  $_SESSION["grupo_alumno"] = $_POST["grupo_alumno"];
  $_SESSION["asignatura_alumno"] = $_POST["asignatura_alumno"];
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <!-- Site made with Mobirise Website Builder v4.11.5, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.11.5, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="../assets/images/logo4.png" type="image/x-icon">
  <meta name="description" content="Website Builder Description">
  
  <title>vistaTrabajos</title>
  <link rel="stylesheet" href="../assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="../assets/tether/tether.min.css">
  <link rel="stylesheet" href="../assets/theme/css/style.css">
  <link rel="preload" as="style" href="../assets/mobirise/css/mbr-additional.css"><link rel="stylesheet" href="../assets/mobirise/css/mbr-additional.css" type="text/css">
  
  
  
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <header>
        <h4>
          Asignatura: 
          <?php echo($_SESSION["asignatura_alumno"]) ?>
        </h4>
      </header>
    </div>
  </div>
  <section class="services5 cid-rL8OE0GgB2">
    <div class="container">
      <div class="row">
        <!--Card-1-->
        <?php 

        $resultado = getConsultas::getUnidades($_SESSION["id_materias_alumno"]);
        foreach ($resultado as $key => $value) {?>

          <div class="card px-3 col-12">
            <div class="card-header pb-2 bg-primary text-white" >
             <h4 class="mbr-fonts-style display-5 text-bold">
              <strong>Unidad <?php echo($value["unidad"].": "); echo($value["tema"]);?></strong>
            </h4>
          </div>
          <?php 
          $result = getConsultas::getTareasAlumnos($_SESSION["id_alumno"],$_SESSION["id_materias_alumno"],$_SESSION["id_maestro"],$value["id"],$_SESSION["id_grupo_alumno"]); 
          $cont = 0;
         //print_r($result);
          foreach ($result as $key => $valor) { $cont++;?>
            <div class="card-wrapper media-container-row media-container-row">
              <div class="card-box" style="padding: 15px;">
                <div class="row">
                  <div class="col-md-4">
                    <h4 class="mbr-text mbr-fonts-style display-4">
                      <strong class="text-primary"><?php echo($valor["id_tipo"].": "); ?></strong> 
                      <?php echo($valor["descripcion"]); ?>
                    </h4>
                  </div>
                  <div class="col-md-3">
                    <h4 class="mbr-text mbr-fonts-style display-4">
                      <strong class="text-primary">Fecha entrega: </strong><?php echo($valor["fecha"]); ?></h4>
                    </div>
                    <div class="col-md-3">
                      <h4 class="mbr-text mbr-fonts-style display-4">
                        <strong class="text-primary">Status: </strong><?php if ($valor["Pobtenido"] != 0) {echo("Calificado");
                      }else{echo("En espera");}?>
                    </h4>
                  </div>
                  <div class="col-md-2">
                    <h4 class="mbr-text mbr-fonts-style display-4"><strong class="text-primary">Valor: </strong><?php echo($valor["Pobtenido"]."/".$valor["valor"]); ?></h4>
                  </div>
                  <div class="col-md-7">
                    <h4 class="mbr-text mbr-fonts-style display-4">
                      <strong class="text-primary">Comentarios: </strong> <?php echo($valor["nota"]); ?>
                    </h4>
                  </div>
                  <div class="col-md-5"> 
                    <h4 class="mbr-text mbr-fonts-style display-4">
                      <strong class="text-primary">Entregado: </strong> 
                      <?php 

                      if ($valor["nombreTarea"] == "SinEntregar") {
                       $nombreAr = $valor["nombreTarea"];
                     }else{
                      list($archivo, $tipo_dat) = explode(".", $valor["nombreTarea"]);
                      $nombreAr = substr($archivo,0,58).".".$tipo_dat;
                    }
                    echo($nombreAr); 
                    ?>
                  </h4>
                </div>
                <?php if($r["fecha_actual"] <= $valor["fecha"]){ if ($valor["Pobtenido"] == 0) {?>

                  <div class="col-md-12">
                    <div class="row justify-content-center">
                      <div class="col-md-10 align-center">
                        <p class="mbr-text mbr-fonts-style display-7" style="color: #000000">
                          <strong class="text-primary" >Descripción:</strong><br>
                          <?php echo($valor["nota_tarea"]); ?>
                        </p>
                        <div class="mbr-section-btn">
                          <?php 
                          $accion = "";
                          if ($valor["nombreTarea"] == "SinEntregar") {
                            $accion = "registrarDatos";
                          }else{
                            $accion = "actualizarDatos";
                          }
                          ?>
                          <form method="post" id="<?php echo("id_form_".$valor["idTipos"]); ?>" name="<?php echo("id_form_".$valor["idTipos"]); ?>" enctype="multipart/form-data">
                            <div class="form-row">
                              <div class="form-group col-md-12">
                                <input id="archivos" form="<?php echo("id_form_".$valor["idTipos"]); ?>"  class="form-control" accept=".ppt,.pdf,.zip,.doc, .docx,.xls,.xlsx" type="file" name="archivos" required>
                                <input type="hidden" form="<?php echo("id_form_".$valor["idTipos"]); ?>" name="id_alumnosgrupo" value="<?php echo($valor["idUsuarios"]); ?>">
                                <input type="hidden" form="<?php echo("id_form_".$valor["idTipos"]); ?>" name="id_tipopuntos" value="<?php echo($valor["idTipos"]); ?>">
                                <input type="hidden" form="<?php echo("id_form_".$valor["idTipos"]); ?>" name="accion" value="<?php echo($accion); ?>">
                                <input type="hidden" form="<?php echo("id_form_".$valor["idTipos"]); ?>" name="idTareas" value="<?php echo($valor["idTareas"]); ?>">
                                <input type="hidden" name="nombreTarea" value="<?php echo($valor["nombreTarea"]); ?>">

                              </div> 
                            </div>
                            <button type="submit" form="<?php echo("id_form_".$valor["idTipos"]); ?>" value ="1" name="<?php echo("subirArchivos".$cont); ?>" class="btn btn-primary btn-sm">Cargar Tarea</button>
                          </form>

                        </div>

                      </div>
                    </div>
                  </div>
                <?php }} ?>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    <?php } ?>
    <?php insertarDatos::guardarTarea(); ?>
  </section>



  <script src="../assets/web/assets/jquery/jquery.min.js"></script>
  <script src="../assets/popper/popper.min.js"></script>
  <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="../assets/tether/tether.min.js"></script>
  <script src="../assets/smoothscroll/smooth-scroll.js"></script>
  <script src="../assets/mbr-switch-arrow/mbr-switch-arrow.js"></script>
  <script src="../assets/theme/js/script.js"></script>


</body>
</html>