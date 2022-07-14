<?php 
require_once("conexion.php");
class consultas{
	static public function prueba(){
		$con = Conexion::getConexion()->prepare("SELECT id,nombre,apellidos,matricula,telefono 
			from usuarios");
		$resultado = consultas::validarConsultas($con);
		if (isset($resultado)) {
			return $resultado;
		}
	}
	static public function selectMaterias($id_usu){
		$con = Conexion::getConexion()->prepare("SELECT 
			carga.id AS idCarga,
			gr.id AS idGrupo,
			mat.id AS idMaterias,
			CONCAT(gr.grupo, '-', gr.etiqueta) AS grupo,
			gr.descripcion,
			mat.asignatura
			FROM
			cargaprofesores AS carga
			INNER JOIN
			grupos AS gr ON gr.id = carga.id_grupo
			INNER JOIN
			materias AS mat ON mat.id = carga.id_materias
			WHERE
			carga.id_usuarios = :id_usuarios;");
		$con -> bindParam(":id_usuarios",$id_usu,PDO::PARAM_INT);

		$resultado = consultas::validarConsultas($con);
		if (isset($resultado)) {
			return $resultado;
		}

	}
	static public function selectUnidades($id_materias){
		$con = Conexion::getConexion()->prepare("select * from unidades where unidades.id_materias = :id_materias");
		$con -> bindParam(":id_materias",$id_materias,PDO::PARAM_INT);
		$resultado = consultas::validarConsultas($con);
		if (isset($resultado)) {
			return $resultado;
		}
	}

	static public function selectTareas($datos){
		$con = Conexion::getConexion() -> prepare("SELECT 
			carga.id AS idCarga,
			carga.id_usuarios AS idUsuarios,
			carga.id_grupo AS idGrupo,
			carga.id_materias AS idMaterias,
			tipo.id AS idTipo,
			tipo.id_unidades AS idUnidad,
			tipo.id_tipo,
			tipo.descripcion,
			tipo.fecha,
			tipo.valor
			FROM
			cargaprofesores AS carga
			INNER JOIN
			tipopuntos AS tipo ON tipo.id_cargaprofesor = carga.id
			AND carga.id_usuarios = :id_usuarios
			AND carga.id_grupo = :id_grupo
			AND carga.id_materias = :id_materias 
			AND tipo.id_unidades = :id_unidades");
		$con -> bindParam(":id_usuarios",$datos["id_usuarios"],PDO::PARAM_STR);
		$con -> bindParam(":id_grupo",$datos["id_grupo"],PDO::PARAM_STR);
		$con -> bindParam(":id_materias",$datos["id_materias"],PDO::PARAM_INT);
		$con -> bindParam(":id_unidades",$datos["id_unidades"],PDO::PARAM_INT);

		$resultado = consultas::validarConsultas($con);
		if (isset($resultado)) {
			return $resultado;
		}
	}
	static public function selectMateriasAlumnos($id_usuarios){

		$con = Conexion::getConexion() -> prepare("
			SELECT grupo.id AS idGrupo, alumnos.id_usuario AS idAlumno,
			carga.id AS idCarga, carga.id_usuarios AS idMaestro,
			CONCAT(grupo.grupo, '-', grupo.etiqueta) as grupo,
			mat.id AS idMateria, usu.matricula, usu.nombre, usu.apellidos,
			mat.asignatura,grupo.descripcion, (SELECT CONCAT(nombre, ' ', apellidos)
			FROM usuarios WHERE id = carga.id_usuarios) AS encargado
			FROM grupos AS grupo INNER JOIN alumnosgrupo AS alumnos 
			ON alumnos.id_grupo = grupo.id INNER JOIN usuarios AS usu 
			ON usu.id = alumnos.id_usuario INNER JOIN cargaprofesores AS carga 
			ON alumnos.id_grupo = carga.id_grupo INNER JOIN materias AS mat 
			ON mat.id = carga.id_materias
			WHERE alumnos.id_usuario = :id_usuarios;");
		$con -> bindParam(":id_usuarios",$id_usuarios,PDO::PARAM_INT);

		$resultado = consultas::validarConsultas($con);
		if (isset($resultado)) {
			return $resultado;
		}
	}
	static public function selectTareasAlumnos($datos){
		$con = Conexion::getConexion() -> prepare("
			SELECT usu.id AS idUsuarios, gr.id AS idGrupo,
			carga.id AS idCarga, mat.id AS idMaterias,
			uni.id AS idUnidades, uni.unidad, mat.asignatura,
			tipo.id AS idTipos, tipo.id_tipo, tipo.descripcion,
			tipo.valor, tipo.fecha, tareas.id AS idTareas,
			IFNULL(tipo.nota_tarea, 'Sin nota...') AS nota_tarea,
			IFNULL(tareas.nombre, 'SinEntregar') AS nombreTarea,
			IFNULL(tareas.dir, 'SinRuta') AS dir,
			IFNULL(tareas.fecha, 'S/F') AS fecha_subida,
			IFNULL(tareas.hora, 'S/F') AS hora,
			IFNULL(punt.puntos, 0) AS Pobtenido,
			IFNULL(punt.nota, 'Sin Comentarios...') AS nota,
			IFNULL(punt.fecha, 'Sin/Rev') AS FechaRevisado
			FROM
			alumnosgrupo AS alGr
			INNER JOIN usuarios AS usu ON usu.id = alGr.id_usuario
			INNER JOIN grupos AS gr ON gr.id = alGr.id_grupo
			INNER JOIN cargaprofesores AS carga ON carga.id_grupo = gr.id
			INNER JOIN materias AS mat ON mat.id = carga.id_materias
			INNER JOIN unidades AS uni ON uni.id_materias = mat.id
			INNER JOIN tipopuntos AS tipo ON tipo.id_unidades = uni.id
			AND carga.id = tipo.id_cargaprofesor
			LEFT JOIN tareasActividades AS tareas 
			ON tareas.id_alumnosgrupo = alGr.id_usuario AND tareas.id_tipopuntos = tipo.id 
			LEFT JOIN puntos AS punt ON punt.id_tareasActividades = tareas.id
			AND tareas.id_tipopuntos = tipo.id AND punt.mat = usu.matricula 
			WHERE usu.id = :id_alumno AND mat.id = :id_materias 
			AND carga.id_usuarios = :id_usuarios 
			AND uni.id = :id_unidades AND gr.id = :id_grupo order by tipo.id_tipo ASC;");

		$con -> bindParam(":id_alumno",$datos["id_alumno"],PDO::PARAM_INT);
		$con -> bindParam(":id_materias",$datos["id_materias"],PDO::PARAM_INT);
		$con -> bindParam(":id_usuarios",$datos["id_usuarios"],PDO::PARAM_INT);
		$con -> bindParam(":id_unidades",$datos["id_unidades"],PDO::PARAM_INT);
		$con -> bindParam(":id_grupo",$datos["id_grupo"],PDO::PARAM_INT);
		$resultado = consultas::validarConsultas($con);
		if (isset($resultado)) {
			return $resultado;
		}
	}
	static public function selectTareasGrupo($datos){
		$con = Conexion::getConexion() -> prepare("
			SELECT alumno.id_usuario AS idAlumno, tipo.id AS idTipo,
			usu.matricula, usu.nombre, usu.apellidos, usu.telefono, tipo.valor, 
			IFNULL(tareas.id, 7512014236) AS idTarea,
			IFNULL(tareas.nombre, 'Sin entregar') AS nombreTarea,
			IFNULL(tareas.fecha, 'S/F') AS fechaEntrega,
			IFNULL(tareas.hora, 'S/H') AS horaEntrega,
			IFNULL(tareas.dir, 'S/Dir') AS ruta,
			IFNULL(punt.id, 519700) AS idPuntos,
			IFNULL(punt.puntos, 'S/Calificar') AS puntos,
			IFNULL(punt.nota, 'S/Nota') AS nota
			FROM alumnosgrupo AS alumno
			INNER JOIN usuarios AS usu ON usu.id = alumno.id_usuario
			INNER JOIN grupos AS gru ON gru.id = alumno.id_grupo
			INNER JOIN cargaprofesores AS carga ON carga.id_grupo = gru.id
			INNER JOIN materias AS mat ON mat.id = carga.id_materias
			INNER JOIN unidades AS uni ON mat.id = uni.id_materias
			INNER JOIN tipopuntos AS tipo ON tipo.id_cargaprofesor = carga.id
			AND tipo.id_unidades = uni.id
			LEFT JOIN tareasActividades AS tareas ON tareas.id_tipopuntos = tipo.id
			AND tareas.id_alumnosgrupo = usu.id
			LEFT JOIN puntos AS punt ON punt.id_tareasActividades = tareas.id
			AND punt.mat = usu.matricula AND punt.id_tipo = tipo.id 
			WHERE gru.id = :idGrupo AND carga.id_usuarios = :id_usuarios
			AND mat.id = :id_materias AND uni.id = :id_unidades 
			AND tipo.id = :id_tipopuntos ORDER BY usu.matricula ASC,
			usu.nombre ASC; ");
		$con -> bindParam(":idGrupo",$datos["idGrupo"],PDO::PARAM_INT);
		$con -> bindParam(":id_usuarios",$datos["id_usuarios"],PDO::PARAM_INT);
		$con -> bindParam(":id_materias",$datos["id_materias"],PDO::PARAM_INT);
		$con -> bindParam(":id_unidades",$datos["id_unidades"],PDO::PARAM_INT);
		$con -> bindParam(":id_tipopuntos",$datos["id_tipopuntos"],PDO::PARAM_INT);

		$resultado = consultas::validarConsultas($con);
		if (isset($resultado)) {
			//print_r($resultado);
			return $resultado;
		}
	}

	static public function validarConsultas($x){
		if ($x -> execute()) {
			return $x -> fetchAll();
		}else{
			print_r($x -> errorInfo());
		}
	}

	static public function fechaActual(){
		$con  = Conexion::getConexion() -> prepare("SELECT CURDATE() AS fecha_actual, CURTIME() as hora_actual;");
		if ($con -> execute()) {
			return $con -> fetch();
		}else{
			print_r($con -> errorInfo());	
		}
	}

}
class insertar{
	static public function insertTarea($datos){
		$con = Conexion::getConexion() -> prepare("INSERT INTO tareasActividades VALUES(NULL,:id_alumnosgrupo,:id_tipopuntos,:nombreArchivo,CURDATE(),CURTIME(),:dir);");
		$con -> bindParam(":id_alumnosgrupo",$datos["id_alumnosgrupo"],PDO::PARAM_INT);
		$con -> bindParam(":id_tipopuntos",$datos["id_tipopuntos"],PDO::PARAM_INT);
		$con -> bindParam(":nombreArchivo",$datos["nombreArchivo"],PDO::PARAM_STR);
		$con -> bindParam(":dir",$datos["dir"],PDO::PARAM_STR);
		$resultado = insertar::validarInsertar($con);
		if (isset($resultado)) {
			return $resultado;
		}
	}
	static public function updateTareas($datos){
		$con = Conexion::getConexion() -> prepare("UPDATE tareasActividades SET nombre = :nombreArchivo,fecha = CURDATE(),hora = CURTIME(),dir = :dir WHERE id = :idTarea");
		$con -> bindParam(":nombreArchivo",$datos["nombreArchivo"],PDO::PARAM_STR);
		$con -> bindParam(":dir",$datos["dir"],PDO::PARAM_STR);
		$con -> bindParam(":idTarea",$datos["idTarea"],PDO::PARAM_INT);
		
		$resultado = insertar::validarInsertar($con);
		if (isset($resultado)) {
			return $resultado;
		}
	}
	static public function insertPuntos($datos){	
		$con = Conexion::getConexion() -> prepare("INSERT INTO puntos VALUES(NULL,:mat,:id_tipopuntos,:id_actividad,CURDATE(),:puntos,:nota)");
		$con -> bindParam(":mat",$datos["mat"],PDO::PARAM_INT);
		$con -> bindParam(":id_tipopuntos",$datos["id_tipopuntos"],PDO::PARAM_INT);
		$con -> bindParam(":id_actividad",$datos["id_actividad"],PDO::PARAM_INT);
		$con -> bindParam(":puntos",$datos["puntos"],PDO::PARAM_INT);
		$con -> bindParam(":nota", $datos["nota"],PDO::PARAM_STR);

		$resultado = insertar::validarInsertar($con);
		if (isset($resultado)) {
			return $resultado;
		}
	}
	static public function updatePuntos($datos){
		$con = Conexion::getConexion() -> prepare("UPDATE puntos SET fecha = CURDATE(), puntos = :puntos,nota = :nota WHERE id = :id_puntos;");
		$con -> bindParam(":puntos",$datos["puntos"],PDO::PARAM_INT);
		$con -> bindParam(":nota", $datos["nota"],PDO::PARAM_STR);
		$con -> bindParam(":id_puntos", $datos["id_puntos"],PDO::PARAM_STR);
		$resultado = insertar::validarInsertar($con);
		if (isset($resultado)) {
			return $resultado;
		}
		
	}
	static public function validarInsertar($x){
		if ($x -> execute()) {
			return "Ok";
		}else{
			echo("<script>Console.log('".print_r($x -> errorInfo())."');</script>");
		}
	}
}
?>