<?php
require_once("insertar.php");

if (isset($_POST["matricula"]) && isset($_POST["id_tipopuntos"]) && isset($_POST["id_actividad"]) && isset($_POST["txtPuntos"]) && isset($_POST["textComentario"]) && $_POST["accion"] == "calificar") {
	$datos = array(
		'mat' => $_POST["matricula"],
		'id_tipopuntos' => $_POST["id_tipopuntos"],
		'id_actividad' => $_POST["id_actividad"],
		'puntos'  => $_POST["txtPuntos"],
		'nota' => $_POST["textComentario"]
	);

	$respuesta = insertarDatos::registrarPuntos($datos);
	if ($respuesta == "Ok") {
		echo json_encode("OkRegistro");
	}

	}elseif (isset($_POST["matricula"]) && isset($_POST["id_tipopuntos"]) && isset($_POST["id_actividad"]) && isset($_POST["txtPuntos"]) && isset($_POST["textComentario"]) && $_POST["accion"] == "actualizar") {
		$datos = array(
			'id_puntos' => $_POST["id_puntos"],
			'puntos'  => $_POST["txtPuntos"],
			'nota' => $_POST["textComentario"]
		);

		$respuesta = insertarDatos::actualizarPuntos($datos);
		if ($respuesta == "Ok") {
			echo json_encode("OkActualizacion");
		}

	}

	?>