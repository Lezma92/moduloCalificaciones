<!DOCTYPE html>
<?php require_once("../modelo/consultas.php"); 
$id_alumno = $_GET["id_alumno"];

?>
<html lang="es">
<head>
  <!-- Site made with Mobirise Website Builder v4.11.5, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.11.5, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="../assets/images/logo4.png" type="image/x-icon">
  <meta name="description" content="">
  
  <title>Vista Alumnos</title>
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
  <section class="features18 popup-btn-cards cid-rL8icN4H7Y" id="features18-7">
    <?php $resultado = getConsultas::getMateriasAlumno($id_alumno); 
    //print_r($resultado); ?>
    <div class="container">
      <h2 class="mbr-section-title pb-3 align-center mbr-fonts-style display-2">
        Image features with buttons on mouseover
      </h2>
      <h3 class="mbr-section-subtitle display-5 align-center mbr-fonts-style mbr-light">
        GRUPO: <?php echo($resultado[0]["grupo"]); ?>
      </h3>
      <div class="row justify-content-center">
       <?php 
       foreach ($resultado as $key => $value) {
        ?>
        <div class="card p-3 col-12 col-md-6 col-lg-4">
          <div class="card-wrapper ">
            <div class="card-img" >
              <div class="mbr-overlay"></div>
              <div class="mbr-section-btn text-center">
                <form method="POST" name="form-datos" action="alumnosTareas.php">
                  <input type="hidden" name="id_alumno" value="<?php echo($value["idAlumno"]); ?>">
                  <input type="hidden" name="id_carga_alumno" value="<?php echo($value["idCarga"]); ?>">
                  <input type="hidden" name="id_grupo_alumno" value="<?php echo($value["idGrupo"]); ?>">
                  <input type="hidden" name="id_materias_alumno" value="<?php echo($value["idMateria"]); ?>">
                  <input type="hidden" name="grupo_alumno" value="<?php echo($value["grupo"]); ?>">
                  <input type="hidden" name="asignatura_alumno" value="<?php echo($value["asignatura"]); ?>">
                  <input type="hidden" name="id_maestro" value="<?php echo($value["idMaestro"]); ?>" >
                  <button type="submit" class="btn btn-primary display-4">Explorar</button>
                </form>

              </div>
              
              <h4 class="card-title py-4 mbr-fonts-style display-5">
                <strong>Materia:</strong><br>                
                <?php echo($value["asignatura"]); ?>
              </h4>
              <h4 class="card-title py-3 mbr-fonts-style display-7">Encargado: <?php echo($value["encargado"]); ?>
            </h4>
            <p class="mbr-text mbr-fonts-style display-7">Descripción: <?php echo($value["descripcion"]); ?>
          </p>
        </div>
      </div>
    </div>

  <?php } ?>
</div>
</div>
</section>


<script src="../assets/web/assets/jquery/jquery.min.js"></script>
<script src="../assets/popper/popper.min.js"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/tether/tether.min.js"></script>
<script src="../assets/smoothscroll/smooth-scroll.js"></script>
<script src="../assets/mbr-popup-btns/mbr-popup-btns.js"></script>
<script src="../assets/theme/js/script.js"></script>


</body>
</html>