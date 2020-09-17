
function tipoTurnos(){

	$.ajax({
			type: "POST",
			url: "turno_tipo",
			dataType: 'json',
			data: {
		    },
			success: function (r) {

				if(r.exito == true){
					$.each(r.listado,function(idx, value){

						$('#tipo_turno').append("<option value='"+value.ID+"'>"+value.DESCRIPCION+"</option>");

					});
				}else{

					console.log(r.error);
				}

			}

		  });		  
}

function listarEstados(){

	$.ajax({
			type: "POST",
			url: "listado_estados",
			dataType: 'json',
			data: {
		    },
			success: function (r) {

				if(r.exito == true){
					$.each(r.listado,function(idx, value){

						$('#estados').append("<option value='"+value.ID+"'>"+value.DESCRIPCION+"</option>");

					});
				}else{

					console.log(r.error);
				}

			}

		  });		  
}

function tipoTurnosHijos(){

	$.ajax({
			type: "POST",
			url: "turno_tipo_hijos",
			dataType: 'json',
			data: {
		    },
			success: function (r) {

				if(r.exito == true){
					$.each(r.listado,function(idx, value){

						$('#tipo_turno').append("<option value='"+value.ID+"'>"+value.DESCRIPCION+"</option>");

					});
				}else{

					console.log(r.error);
				}

			}

		  });		  
}



function listarOficinasCargadas(idtt){

	$('#oficina').empty();
	$('#oficina').append("<option value='default' selected>Seleccionar...</option>");
    $.ajax({
        type: "POST",
        url: "listado_oficinas_cargadas",
        dataType: 'json',
        data: {
			id: idtt
        },
        success: function (r) {

            if(r.exito == true){
                $.each(r.listado, function (i, item) {
                    $('#oficina').append($('<option>', { 
                        value: item.ID,
                        text : item.DESCRIPCION 
                    }));
                });
            }else{

                console.log(r.error);
            }

        }

      });	

}

function listarOficinasGrupos(){

	$('#oficina').empty();
    $('#oficina').append("<option value='default' selected>Seleccionar...</option>");
    
    $.ajax({
        type: "POST",
        url: "listado_oficinas_grupo",
        dataType: 'json',
        data: {
        },
        success: function (r) {

            if(r.exito == true){
                $.each(r.listado, function (i, item) {
                    $('#oficina').append($('<option>', { 
                        value: item.ID,
                        text : item.DESCRIPCION 
                    }));
                });
            }else{

                console.log(r.error);
            }

        }

      });	

}

function listasAll(){

    $.ajax({
    type: "POST",
    url: "prod/listas",
    dataType: 'json',
    data: {
    },
    success: function (r) {

        $.each(r.listado,function(idx, value){

            $('#listas').append($('<option>', { 
                value: value.fecha_alta,
                text : value.fecha 
            }));

        });

    }

  });

}

function familiasAll(){

    $('#familia_form').empty();

    $.ajax({
    type: "POST",
    url: "prod/familias",
    dataType: 'json',
    data: {
    },
    success: function (r) {

        $.each(r.listado,function(idx, value){

            $('#familia_form').append($('<option>', { 
                value: value.id,
                text : value.descripcion 
            }));

        });

    }

  });

}

