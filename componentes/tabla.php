<?php 
session_start();
require_once("../modelo/consultas.php");
?>

<table class="table table-hover table-condensed table-bordered tablaDatos">
	<thead>
		<tr class="table-heads ">			
			<th class="head-item mbr-fonts-style display-7">
				Matricula
			</th>
			<th class="head-item mbr-fonts-style display-7">
				Nombre
			</th>
			<th class="head-item mbr-fonts-style display-7">
				Trabajo
			</th>
			<th class="head-item mbr-fonts-style display-7">
				Fecha y hora
			</th>
			<th>
				Valor
			</th>
			<th class="head-item mbr-fonts-style display-7">
				Revisar
			</th>
			<th class="head-item mbr-fonts-style display-7">
				Calificar
			</th>
		</tr>
	</thead>

	<tbody>
		<?php 
		$resultado = getConsultas::getTareasGrupos($_SESSION["id_grupo"],$_SESSION["id_maestro"],$_SESSION["idMaterias"],$_SESSION["id_unidad"],$_SESSION["id_tipopuntos"]);
		//print_r($resultado);

		foreach ($resultado as $key => $value) {?>
			<?php
			$nombreAr = "";
			$p = 0;
			$accion = "calificar";
			if ($value["nombreTarea"] == "Sin entregar") {
				$color = "bg-danger text-white";
				$t = "mbri-edit2";
				$nombreAr = $value["nombreTarea"];
			}else{
				list($archivo, $tipo_dat) = explode(".", $value["nombreTarea"]);
				$nombreAr = substr($archivo,0,58).".".$tipo_dat;
				if ($value["puntos"] == "S/Calificar") {
					$color = "bg-white text-black"; 
					$t = "mbri-edit2";
				}else{
					$color = "text-white bg-info";
					$t = "mbri-update";
					$p = $value["puntos"];
					$accion = "actualizar";
				}
			}

			?>
			<tr class="<?php echo($color); ?> ">
				<td class="body-item mbr-fonts-style display-7">
					<?php echo($value["matricula"]); ?>
				</td>
				<td class="body-item mbr-fonts-style display-7">
					<?php echo($value["nombre"]." ".$value["apellidos"]); ?>
				</td>
				<td class="body-item mbr-fonts-style display-7">
					<?php echo($nombreAr); ?>
				</td>
				<td class="body-item mbr-fonts-style display-7 ">
					<?php echo($value["fechaEntrega"]." ".$value["horaEntrega"]); ?>
				</td>
				<td class="body-item mbr-fonts-style display-7 ">
					<?php echo($p."/".$value["valor"]); ?>
				</td>
				<td class="body-item mbr-fonts-style display-7">
					<a class="btn btn-success presion" href="<?php echo($value["ruta"]); ?>" target="_blank">
						<span class="mbri-preview"></span>	
					</a>
				
				</td>
				<td class="body-item mbr-fonts-style display-7">
					<button type="button"  class="btn btn-primary"   data-toggle="modal" data-target="#modalEdicion" onclick="setDatos(<?php echo($value["matricula"]); ?>,<?php echo($_SESSION["id_tipopuntos"]); ?>,<?php echo($value["idTarea"]); ?>,'<?php echo($accion); ?>',<?php echo($value["idPuntos"]); ?>);">
						<span class="<?php echo($t); ?>"></span>
					</button>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>