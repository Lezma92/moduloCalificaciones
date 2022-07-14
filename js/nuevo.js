function eliminarDatos(id){
	cadena="id=" + id;
	$.ajax({
		type:"POST",
		url:"php/eliminarDatos.php",
		data:cadena,
		success:function(r){
			if(r==1){
				$('#tabla').load('componentes/tabla.php');
				alertify.success("Eliminado con exito!");
			}else{
				alertify.error("Fallo el servidor :(");
			}
		}
	});
}
$(document).ready(function(){
	$('#tabla').load('../componentes/tabla.php');

	$('#guardarPuntos').click(function(){
		matricula = $('#matricula').val();
		id_tipopuntos = $('#id_tipopuntos').val();
		id_actividad = $('#id_actividad').val();
		txtPuntos = $('#txtPuntos').val();
		textComentario = $('#textComentario').val();
		accion = $('#accion').val();
		
		
		if (matricula != "" && id_tipopuntos != "" && id_actividad != 7512014236) {
			if (txtPuntos != "" && textComentario!= "") {
				console.log(matricula);
				console.log(id_tipopuntos);
				console.log(id_actividad);
				console.log(txtPuntos);
				console.log(textComentario);
				var datos = new FormData();
				datos.append("matricula",matricula);
				datos.append("id_tipopuntos",id_tipopuntos);
				datos.append("id_actividad",id_actividad);
				datos.append("txtPuntos",txtPuntos);
				datos.append("textComentario",textComentario);
				datos.append("accion",accion);
				if (accion == "actualizar") {
					id_puntos = $("#id_puntos").val();
					datos.append("id_puntos",id_puntos);
				}	
				$.ajax({
					url:"../modelo/ajax.php",
					method: "POST",
					data: datos,
					cache: false,
					contentType: false,
					processData: false,
					dataType:"json",
					success: function(respuesta){
						console.log(respuesta);
						if (respuesta == "OkRegistro") {
							$('#tabla').load('../componentes/tabla.php');
							alertify.success("Puntos asignados correctamente!");
						}
						if (respuesta == "OkActualizacion") {
							$('#tabla').load('../componentes/tabla.php');
							alertify.success("Puntos modificados correctamente!");
						}
					}
				})
			}else{
				$("#mensaje").val("Todos los campos son obligatorios");
			}
			
		}


	});
});

function setDatos(mat,idTp,idAct,accion,idP){
	var matricula = mat;
	var id_tipopuntos = idTp;
	var id_actividad = idAct;
	var id_puntos = idP;
	console.log(id_tipopuntos);
	console.log(id_actividad);
	console.log(matricula);
	console.log(accion);
	console.log(id_puntos);

	$("#matricula").val(mat);
	$("#id_tipopuntos").val(id_tipopuntos);
	$("#id_actividad").val(id_actividad);
	$("#accion").val(accion);
	if (accion == "calificar") {
		$("#myModalLabel").html("Registrar calificación");
		$("#guardarPuntos").html("Guardar");
	}else{
		$("#myModalLabel").html("Actualizar calificación");
		$("#guardarPuntos").html("Actualizar");
		$("#id_puntos").val(id_puntos);

	}


}