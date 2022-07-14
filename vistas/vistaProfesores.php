<!DOCTYPE html>
<?php require_once("../modelo/consultas.php"); 
$id_maestro = $_GET["profesor"];

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
  
  <title>maestros</title>
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
    <div class="container">
      <h2 class="mbr-section-title pb-3 align-center mbr-fonts-style display-2">
        Image features with buttons on mouseover
      </h2>
      <h3 class="mbr-section-subtitle display-5 align-center mbr-fonts-style mbr-light">
        In browser you will see buttons when hover on cards
      </h3>
      <div class="row justify-content-center">
       <?php $resultado = getConsultas::getCargaHoraria($id_maestro); 
      // print_r($resultado);
       foreach ($resultado as $key => $value) {
        ?>
        <div class="card p-3 col-12 col-md-6 col-lg-4">
          <div class="card-wrapper ">
            <div class="card-img" >
              <div class="mbr-overlay"></div>
              <div class="mbr-section-btn text-center">
                <form method="POST" name="form-datos" action="listarUnidades.php">
                  <input type="hidden" name="id_maestro" value="<?php echo($id_maestro); ?>">
                  <input type="hidden" name="idCarga" value="<?php echo($value["idCarga"]); ?>">
                  <input type="hidden" name="idGrupo" value="<?php echo($value["idGrupo"]); ?>">
                  <input type="hidden" name="idMaterias" value="<?php echo($value["idMaterias"]); ?>">
                  <input type="hidden" name="grupo" value="<?php echo($value["grupo"]); ?>">
                  <input type="hidden" name="asignatura" value="<?php echo($value["asignatura"]); ?>">
                  <button type="submit" class="btn btn-primary display-4">Explorar</button>
                </form>
              </div>
              <h4 class="card-title py-3 mbr-fonts-style display-1">
                <?php echo($value["grupo"]); ?>
              </h4>
              <h4 class="card-title py-3 mbr-fonts-style display-5">Materia: <?php echo($value["asignatura"]); ?>
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