<?php 
require_once("../controlador/operaciones.php");
class getConsultas{
	static public function getPrueba(){
		$resultado = consultas::prueba();
		return $resultado;
	}
	static public function getCargaHoraria($id_usuarios){
		$resultado = consultas::selectMaterias($id_usuarios);
		return $resultado;
	}
	static public function getUnidades($id_materias){
		$resultado = consultas::selectUnidades($id_materias);
		return $resultado;
	}
	static public function getTareas($id_usuarios,$id_grupo,$id_materias,$id_unidades){
		$datos = array(
			'id_usuarios' => $id_usuarios,
			'id_grupo' => $id_grupo,
			'id_materias' => $id_materias,
			'id_unidades' => $id_unidades
		);
		$resultado = consultas::selectTareas($datos);
		return $resultado;
	}
	static public function getMateriasAlumno($id_usuario){
		$resultado = consultas::selectMateriasAlumnos($id_usuario);
		return $resultado;
	}
	static public function getTareasAlumnos($id_alumno,$id_materias,$id_usuarios,$id_unidades,$id_grupo){
		$datos = array(
			'id_alumno' => $id_alumno,
			'id_materias' => $id_materias,
			'id_usuarios' => $id_usuarios,
			'id_unidades' => $id_unidades,
			'id_grupo' => $id_grupo
		);
		$resultado = consultas::selectTareasAlumnos($datos);
		return $resultado;
	}
	static public function getTareasGrupos($id_grupo,$id_usuarios,$id_materias,$id_unidades,$id_tipopuntos){
		$datos = array(
			'idGrupo' => $id_grupo, 
			'id_usuarios' => $id_usuarios,
			'id_materias' => $id_materias,
			'id_unidades' => $id_unidades,
			'id_tipopuntos' => $id_tipopuntos
		);
		$resultado =consultas::selectTareasGrupo($datos);
		return $resultado;
	}
	static public function getFecha(){

		$resultado = consultas::fechaActual();
		return $resultado;
	}
}
?>