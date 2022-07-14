<?php 
require_once("../controlador/operaciones.php");
class insertarDatos{
	static public function guardarTarea(){
		if (isset($_POST["subirArchivos1"]) || isset($_POST["subirArchivos2"]) || isset($_POST["subirArchivos3"]) || isset($_POST["subirArchivos4"]) || isset($_POST["subirArchivos5"])) {
			$accion = $_POST["accion"];
			$r = getConsultas::getFecha();
			$hoy = $r["fecha_actual"]."-".$r["hora_actual"];
			$img = $_FILES['archivos']["name"];
			list($nom, $tipo_dat) = explode(".", $img);
			$img = $nom."-".$hoy.".".$tipo_dat;
			$archivo = $_FILES['archivos']["tmp_name"];
			$ruta = "../documentos/".$img;
			$datos = array(
				'id_alumnosgrupo' => $_POST["id_alumnosgrupo"],
				'id_tipopuntos' => $_POST["id_tipopuntos"],
				'nombreArchivo' => $img,
				'dir' => $ruta,
				'idTarea' => $_POST["idTareas"]
			);
			print_r($accion);
			if ($accion == "registrarDatos") {
				move_uploaded_file($archivo,$ruta);
				insertarDatos::registrarTarea($datos);	
			}elseif ($accion == "actualizarDatos") {
				unlink("../documentos/".$_POST["nombreTarea"]);
				move_uploaded_file($archivo,$ruta);
				insertarDatos::actualizarTarea($datos);
			}
			//

		}

	}
	static public function registrarTarea($datos){
		$respuesta = insertar::insertTarea($datos);
		if ($respuesta == "Ok") {
			echo("<script> window.location.href = '../vistas/alumnosTareas.php';</script>");
		}
	}
	static public function actualizarTarea($datos){
		$respuesta = insertar::updateTareas($datos);
		if ($respuesta == "Ok") {
			echo("<script> window.location.href = '../vistas/alumnosTareas.php';</script>");
		}
	}
	static public function registrarPuntos($datos){
		$respuesta = insertar::insertPuntos($datos);
		return $respuesta;
	}
	static public function actualizarPuntos($datos){
		$respuesta = insertar::updatePuntos($datos);
		return $respuesta;
	}


}
?>