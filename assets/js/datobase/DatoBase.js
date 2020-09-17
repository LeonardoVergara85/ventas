var tablaDatos = null;

//Funciones
function listarDatos() {
	$.ajax({
		type: "POST",
		url: "base/listado",
		dataType: 'json',
		data: {
			tabla: $('#tabla').val(),
		},
		success: function (respuesta) {
			$('.alert-danger').hide();
			if(respuesta.exito) {
				tablaDatos.clear().draw();
				$.each(respuesta.listado, function (indice, dato) {
					tablaDatos.row.add([
						dato.ID,
						dato.DESCRIPCION,
						dato.ACTIVO,
						'<button type="button" class="btn btn-outline-info btn-sm mr-3 btnEditar" value="'+dato.ID+'"><i class="fas fa-pen"></i></button><button type="button" class="btn btn-outline-danger btn-sm mr-3  btnEliminar" value="'+dato.ID+'"><i class="fas fa-trash"></i></button>',
					]);
				});
				tablaDatos.columns.adjust().draw();
			}
			else {
				console.log(respuesta.error.descripcion);
				$('#lbl_msg').html(respuesta.error.mensaje);
     			$('.alert-danger').show();
			}
		},
		error: function (jqXHR, textStatus, thrownError) {
			console.log(thrownError);
			$('#lbl_msg').html('Error ' + jqXHR.status, 'Listado de datos');
     		$('.alert-danger').show();
		},
  	});
}

//Carga de la página
$(document).ready(function() {
	
	//Instancia la tabla
	tablaDatos  = $('#tablaDatos').DataTable({
		bLengthChange: false,
		info: false,
		language: {
        	url: "/repositorio/DataTables-1.10.19/table-spanish.json"
        },
		ordering: false,
		searching: true,
	});

	//Completa el listado
	if($('#tabla').val() == '') {
		$('#lbl_msg').html('No se especificó ninguna tabla.');
    	$('.alert-danger').show();
	}
	else {
		listarDatos();
	}	
});

//Eventos
$('#btnGuardar').click(function (){
	//Validación de los datos
	if($('#descripcion').val() == '') {
		$('#lbl_msg').html('Complete la descripción.');
    	$('.alert-danger').show();
		$('#modalDato').modal('hide');
		return;
	}

	if($('#tabla').val() == '') {
		$('#lbl_msg').html('No se especificó ninguna tabla.');
    	$('.alert-danger').show();
		$('#modalDato').modal('hide');
		return;
	}

	//Chequea si es un alta o una edición
	if($(this).val() == '') {
		var url = 'base/alta';
		var req =  {
			tabla: $('#tabla').val(),
			descripcion: $('#descripcion').val(),
			activo: $('#activo').val()
		};
	}
	else {
		var url = 'base/modificar';
		var req =  {
			tabla: $('#tabla').val(),
			id: $(this).val(),
			descripcion: $('#descripcion').val(),
			activo: $('#activo').val()
		};
	}
	
	$('#btnGuardar').prop('disabled', true);
	
	$.ajax({
		type: "POST",
		url: url,
		dataType: 'json',
		data: req,
		success: function (respuesta) {
			$('.alert-danger').hide();
			$('#btnGuardar').prop('disabled', false);
			
			if(respuesta.exito) {
				listarDatos();
			}
			else {
				console.log(respuesta.error.descripcion);
				$('#lbl_msg').html(respuesta.error.mensaje);
     			$('.alert-danger').show();
			}

			$('#modalDato').modal('hide');
		},
		error: function (jqXHR, textStatus, thrownError) {
			$('#btnGuardar').prop('disabled', false);
			console.log(thrownError);
			$('#lbl_msg').html('Error ' + jqXHR.status, 'Alta de datos');
			$('.alert-danger').show();
			$('#modalDato').modal('hide');
		},
  	});
});

$('#btnEliminarDato').click(function (){
	//Validación de los datos
	if($(this).val() == '') {
		$('#lbl_msg').html('Falta ID.');
    	$('.alert-danger').show();
		$('#modalEliminar').modal('hide');
		return;
	}

	if($('#tabla').val() == '') {
		$('#lbl_msg').html('No se especificó ninguna tabla.');
    	$('.alert-danger').show();
		$('#modalEliminar').modal('hide');
		return;
	}
	
	$('#btnEliminarDato').prop('disabled', true);
	
	$.ajax({
		type: "POST",
		url: "base/baja",
		dataType: 'json',
		data: {
			tabla: $('#tabla').val(),
			id: $(this).val()
		},
		success: function (respuesta) {
			$('.alert-danger').hide();
			$('#btnEliminarDato').prop('disabled', false);
			
			if(respuesta.exito) {
				listarDatos();
			}
			else {
				console.log(respuesta.error.descripcion);
				$('#lbl_msg').html(respuesta.error.mensaje);
     			$('.alert-danger').show();
			}

			$('#modalEliminar').modal('hide');
		},
		error: function (jqXHR, textStatus, thrownError) {
			$('#btnEliminarDato').prop('disabled', false);
			console.log(thrownError);
			$('#lbl_msg').html('Error ' + jqXHR.status, 'Baja de datos');
			$('.alert-danger').show();
			$('#modalEliminar').modal('hide');
		},
  	});
});

$('#tablaDatos').on('click', '.btnEditar', function () {
	$('#descripcion').val($(this).parent().parent().find("td:eq(1)").text());
	$('#activo').val($(this).parent().parent().find("td:eq(2)").text());
	$('#btnGuardar').val($(this).val());
	$('#modalDato').modal('show');
});

$('#modalDato').on('hidden.bs.modal', function (e) {
	$('#btnGuardar').val('');
	$('#descripcion').val('');
	$('#activo').val('S');
});

$('#tablaDatos').on('click', '.btnEliminar', function () {
	$('#btnEliminarDato').val($(this).val());
	$('#modalEliminar').modal('show');
});

$('#modalEliminar').on('hidden.bs.modal', function (e) {
	$('#btnEliminarDato').val('');
});

