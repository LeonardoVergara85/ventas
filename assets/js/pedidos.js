var f = new Date(); // fecha para mostrar en los archivos de export 
TablePedidos = $('#table_pedidos_general').DataTable({
    dom: 'Bfrtip',
    buttons: [
        {
            
            extend:    'pdfHtml5',
            text:      '<i class="fa fa-file-pdf AzulChicoBtb"></i>',
            titleAttr: 'PDF',
            message: 'Listado de pedidos. Fecha de impresión ('+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+')',
            download: 'open',
			title: 'Pedidos',
			exportOptions: {
				columns: [ 0, 1, 2, 3, 4, 5, 6 ]
			}
        },
        {
            extend: 'print',
            text:      '<i class="fa fa-print AzulChicoBtb" ></i>',
            titleAttr: 'Imprimir',
            message: 'Listado de pedidos. Fecha de impresión ('+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+')',
			messageBottom: null,
			exportOptions: {
				columns: [ 0, 1, 2, 3, 4, 5, 6 ]
			}
        }
    ],

    responsive: true,
    colReorder: true,
    rowReorder: {
        selector: 'td:nth-child(2)'
    },
    
    "language": {
        "url": "assets/libs/js/DataTables-1.10.12/extensions/table-spanish.json"
    },
    'columnDefs': [
        {
            "targets": 0, // your case first column
             "width": "10%",
             "className": "dt-center",
       },{
            "targets": 1, // your case first column
            "className": "text-left",
            "width": "50%",
        },{
            "targets": 2, // your case first column
            "className": "text-center",
            "width": "10%",
        },{
            "targets": 3, // your case first column
            "className": "text-center",
            "width": "10%",
        },{
            "targets": 4, // your case first column
            "className": "text-center",
            "width": "15%",
            "className": "dt-center",
        },{
            "targets": 5, // your case first column
            "className": "text-left",
            "width": "5%",
            "className": "dt-center",
        },{
            "targets": 6, // your case first column
            "className": "text-left",
            "width": "5%",
            "className": "dt-center",
        },{
            "targets": 7, // your case first column
            "className": "text-left",
            "width": "5%",
            "className": "dt-center",
        }
    ],            

    
  });
  
  TablePedidos2 = $('#table_pedidos_finalizados').DataTable({
    dom: 'Bfrtip',
    buttons: [
        {
            
            extend:    'pdfHtml5',
            text:      '<i class="fa fa-file-pdf AzulChicoBtb"></i>',
            titleAttr: 'PDF',
            message: 'Listado de pedidos. Fecha de impresión ('+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+')',
            download: 'open',
			title: 'Pedidos Finalizados',
			exportOptions: {
				columns: [ 0, 1, 2, 3, 4, 5, 6 ]
			}
        },
        {
            extend: 'print',
            text:      '<i class="fa fa-print AzulChicoBtb" ></i>',
            titleAttr: 'Imprimir',
            message: 'Listado de pedidos. Fecha de impresión ('+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+')',
			messageBottom: null,
			title: 'Pedidos Finalizados',
			exportOptions: {
				columns: [ 0, 1, 2, 3, 4, 5, 6 ]
			}
        }
    ],

    responsive: true,
    colReorder: true,
    rowReorder: {
        selector: 'td:nth-child(2)'
    },
    
    "language": {
        "url": "assets/libs/js/DataTables-1.10.12/extensions/table-spanish.json"
    },
    'columnDefs': [
        {
            "targets": 0, // your case first column
             "width": "10%",
             "className": "dt-center",
       },{
            "targets": 1, // your case first column
            "className": "text-left",
            "width": "50%",
        },{
            "targets": 2, // your case first column
            "className": "text-center",
            "width": "10%",
        },{
            "targets": 3, // your case first column
            "className": "text-center",
            "width": "10%",
        },{
            "targets": 4, // your case first column
            "className": "text-center",
            "width": "15%",
            "className": "dt-center",
        },{
            "targets": 5, // your case first column
            "className": "text-left",
            "width": "5%",
            "className": "dt-center",
        },{
            "targets": 6, // your case first column
            "className": "text-left",
            "width": "5%",
            "className": "dt-center",
        },{
            "targets": 7, // your case first column
            "className": "text-left",
            "width": "5%",
            "className": "dt-center",
        }
    ],            

    
  });

function sumatoria(){

	
	var importe_total = 0;

		$(".precio").each(
			function(index, value) {

				if($('#precio-total'+this.name).is(':disabled')){

					// si esta deshabilitado no sumar //

				}else{

					if ( $.isNumeric( $(this).val() ) ){
						importe_total = (importe_total + eval(this.value));
					//	importe_total = (importe_total + this.value).toFixed(2);
					}
					
				}

				
			
		  }
	   );

	return (importe_total).toFixed(2);  
}




// funcion que busca los productos vigentes del mes activo = 'S' y los que tiene Stock
function listado_productos(){

	function obtenerProductos(){
		return new Promise(function(resolve, reject){
			$.ajax({
				type: "POST",
				url: "prod/listado_pedido",
				dataType: 'json',
				data: {
				},
			}).done(resolve).fail(reject);
		});
	};
	obtenerProductos().then(
		function resolve(data) {
			productos = data.listado;
		 
			$('#producto').empty();
			$('#producto').autocomplete({
			   
				minLength: 0,
				source: productos,
				// eventos del autocompletar
				select : function (event, ui) {
					$('#producto').val(ui.item.label); // display the selected text
					$('#producto_id').val(ui.item.value); // save selected id to hidden input
					// una vez obtenido el id del organismo se lo pasamos como parametro a la funcion para buscar la autoridad
					var id = ui.item.value;
					$('#add-producto').show();
					return false;
				},
				focus: function (event, ui) {
						 $('#producto').val(ui.item.label); // display the selected text
						 $('#producto_id').val(ui.item.value); // save selected id to hidden input
						 // una vez obtenido el id del organismo se lo pasamos como parametro a la funcion para buscar la autoridad
						 var id = ui.item.value;
						 
						return false;
				},
				change: function( event, ui ) {
					 $( "#producto_id" ).val( ui.item? ui.item.value : 0 );
					 $('#add-producto').show();
				} 
			 });
		},
		function reject(reason) {
			console.log('Error en el proceso');
			console.log(reason);
		}
	);
}


// funcion que busca los productos vigentes del mes selccionados solamente.
function  listado_productos2(){

	function obtenerProductos2(){
		return new Promise(function(resolve, reject){
			$.ajax({
				type: "POST",
				url: "prod/listado_pedido_2",
				dataType: 'json',
				data: {
					lista : $('#listas option:selected').val(),
				},
			}).done(resolve).fail(reject);
		});
	};
	obtenerProductos2().then(
		function resolve(data) {
			productos = data.listado;
		 
			$('#producto').empty();
			$('#producto').autocomplete({
				minLength: 0,
				source: productos,
				// eventos del autocompletar
				select : function (event, ui) {
					$('#producto').val(ui.item.label); // display the selected text
					$('#producto_id').val(ui.item.value); // save selected id to hidden input
					// una vez obtenido el id del organismo se lo pasamos como parametro a la funcion para buscar la autoridad
					var id = ui.item.value;
					$('#add-producto').show();
					return false;
				},
				focus: function (event, ui) {
						 $('#producto').val(ui.item.label); // display the selected text
						 $('#producto_id').val(ui.item.value); // save selected id to hidden input
						 // una vez obtenido el id del organismo se lo pasamos como parametro a la funcion para buscar la autoridad
						 var id = ui.item.value;
						 
						return false;
				},
				change: function( event, ui ) {
					 $( "#producto_id" ).val( ui.item? ui.item.value : 0 );
					 $('#add-producto').show();
				} 
			 });
		},
		function reject(reason) {
			console.log('Error en el proceso');
			console.log(reason);
		}
	);

}



function listado_envios(){

	function listadoFormaEnvio(){
		return new Promise(function(resolve, reject){
			$.ajax({
				type: "POST",
				url: "fe/listado",
				dataType: 'json',
				data: {
				},
			}).done(resolve).fail(reject);
		});
	};
	listadoFormaEnvio().then(
		function resolve(data) {
			$('#tipo_envio').empty();

			$('#tipo_envio').append($('<option>', { 
				value: 'default',
				text : 'Seleccionar..' 
			}));
			$.each(data.listado,function(idx, value){
		
				$('#tipo_envio').append($('<option>', { 
					value: value.id,
					text : value.descripcion 
				}));
	
			});
		},
		function reject(reason) {
			console.log('Error en el proceso');
			console.log(reason);
		}
	);

}

function listado_fpagos(){
	function listadoFormaPago(){
		return new Promise(function(resolve, reject){
			$.ajax({
				type: "POST",
				url: "fp/listado",
				dataType: 'json',
				data: {
				},
			}).done(resolve).fail(reject);
		});
	};
	listadoFormaPago().then(
		function resolve(data) {

			$('#tipo_pago').empty();

			$('#tipo_pago').append($('<option>', { 
				value: 'default',
				text : 'Seleccionar..' 
			}));

			$.each(data.listado,function(idx, value){
		
				$('#tipo_pago').append($('<option>', { 
					value: value.id,
					text : value.descripcion 
				}));
	
			});
		},
		function reject(reason) {
			console.log('Error en el proceso');
			console.log(reason);
		}
	);
}





function buscarProductoId(id){

	$.ajax({
		type: "POST",
		url: "prod/buscar_id",
		dataType: 'json',
		data: {

			id_producto: id,
		},
		success: function (r) {
	
	
			$.each(r.listado,function(idx, value){
	
			 $('#codigo_form').val(value.CODIGO);
			 $('#desc_form').val(value.DESCRIPCION);
			 $('#familia_form').val(value.FAMILIA);
			 $('#med_form').val(value.MEDIDA);
			 $('#med_tipo_form').val(value.MEDIDA_DESC);
			 $('#talle_form').val(value.TALLES);
			 $('#color_form').val(value.COLOR);
			 $('#aroma_form').val(value.AROMAS);
			 $('#costo_form').val('$ '+value.PRECIO_COSTO);
			 $('#sugerido_form').val('$ '+value.PRECIO_SUGERIDO);

			});
	
		}
	
	  });
}

function buscarProductosPedidosId(id){

	$('#searchicon').show();
	$('#divsearchicon').show();
	
	// limpiamos la tabla de productos
	$("#table-add-prod > tbody").empty();
    //buscamos todos los productos del pedido, pasando el id del pedido
	$.ajax({
		type: "POST",
		url: "pedido/productosid",
		dataType: 'json',
		data: {
			idp: id,
		},
		success: function (r) {

			$('#searchicon').hide(1000);
    		$('#divsearchicon').hide(1000);
			//$('#btn-formulario').prop('disabled',false);

			$.each(r.listado,function(idx, value){

			var idp = value.ID;	
			var cod2 = $('#cod2').val();
			valores = new Array(); 
			// colocamos los datos de la tabla en un arreglo
			for (i = 1; i < $('#table-add-prod tr').length; i++) {
				valores[i] = new Array();
				for (j = 0; j < 12; j++) {
					valores[i][j] = $('#table-add-prod').find('tr:eq(' + i + ') td:eq(' + j + ')').html();
				}
			}
	
			//console.log(valores);
			//verificamos si existe el producto en la lista
			for (i = 1; i < $('#table-add-prod tr').length; i++) {
				if (valores[i][0] == idp) {
	
					idp = idp+cod2;
					
					$('#cod2').val(parseInt(cod2)+parseInt(1));
				}
			}	
				var cod = value.CODIGO;	
				var cod = value.CODIGO;	
				var desc = value.DESCRIPCION;	
				var familia = value.FAMILIA;
				var disabledinput = '';
				var colorfila = 'cornflowerblue';
				var costo = value.PRECIO_COSTO;	
				var totprod = costo*value.cantidad;
				var check = 'checked';
				if(value.llego == 'N'){

					disabledinput = 'disabled';
					colorfila = 'darkgray';
					//totprod = 0;
					check = '';
				}
				var codigo_prod = "<input class='text-center' id='codigo_prod"+idp+"' type='text' style='width: 40px;' name='cod-prod' value='"+value.codigo_prod+"' "+disabledinput+">";
				//var codigo_prod = "<input class='text-center' id='codigo_prod"+idp+"' type='text' style='width: 40px;' name='cod-prod' value='"+value.codigo_prod+"' "+disabledinput+">";
				var medidacant = "<input class='text-center' id='medidacant"+idp+"' type='text' style='width: 40px;' value='"+value.medida_prod+"' disabled>";
				//var medidacant = "<input class='text-center' id='medidacant"+idp+"' type='text' style='width: 40px;' value='"+value.medida_prod+"' "+disabledinput+">";
				if((value.tipo_medida_prod == 0) || (value.tipo_medida_prod == null)){
					var medida = "<input type='text' class='medida-tipo' id='medidas-form"+idp+"' name='"+idp+"' style='width: 115px;font-size: small;' disabled><input type='hidden' id='medidas_id"+idp+"' name='medidas_id"+idp+"' >";

					//var medida = "<select class='medida-tipo' id='medidas-form"+idp+"' name='"+idp+"' style='width: 115px;font-size: small;' "+disabledinput+"><option value='0'>... </option></select>";
				}else{
					var medida = "<input type='text' class='text-center' class='medida-tipo' id='medidas-form"+idp+"' name='"+idp+"' style='width: 115px;font-size: small;' value='"+value.tipomedida+"' disabled><input type='hidden' id='medidas_id"+idp+"' name='medidas_id"+idp+"' >";
					//var medida = "<select class='medida-tipo' id='medidas-form"+idp+"' name='"+idp+"' style='width: 115px;font-size: small;' "+disabledinput+"><option value='0'>... </option><option value='"+value.tipo_medida_prod+"' selected>"+value.tipomedida+"</option></select>";
				}
				if((value.talle_prod == 0) || (value.talle_prod == null)){
					var talle = "<input type='text' class='text-center' id='talles-form"+idp+"' style='width: 55px;font-size: small;' disabled><input type='hidden' id='talles_id"+idp+"' name='talles_id"+idp+"' value=''>";
					//var talle = "<select id='talles-form"+idp+"' style='width: 55px;font-size: small;' "+disabledinput+"><option value='0'>... </option></select>";
				}else{
					var talle = "<input type='text' class='text-center' id='talles-form"+idp+"' style='width: 55px;font-size: small;' value='"+value.talle+"' disabled><input type='hidden' id='talles_id"+idp+"' name='talles_id"+idp+"' value='"+value.talle_prod+"'>";
					//var talle = "<select id='talles-form"+idp+"' style='width: 55px;font-size: small;' "+disabledinput+"><option value='0'>... </option><option value='"+value.talle_prod+"' selected>"+value.talle+"</option></select>";
				}
				if((value.color_prod == 0) || (value.color_prod == null)){
					var color = "<input type='text' class='text-center' id='colores-form"+idp+"' style='width: 115px;font-size: small;' disabled><input type='hidden' id='colores_id"+idp+"' name='colores_id"+idp+"' >";
					//var color = "<select id='colores-form"+idp+"' style='width: 115px;font-size: small;' "+disabledinput+"><option value='0'>... </option></select>";
				}else{
					var color = "<input type='text' class='text-center' id='colores-form"+idp+"' style='width: 115px;font-size: small;' value='"+value.color+"' disabled><input type='hidden' id='colores_id"+idp+"' name='colores_id"+idp+"' value='"+value.color_prod+"' >";
					//var color = "<select id='colores-form"+idp+"' style='width: 115px;font-size: small;' "+disabledinput+"><option value='0'>... </option><option value='"+value.color_prod+"' selected>"+value.color+"</option></select>";
				}
				if((value.aroma_prod == 0) || (value.aroma_prod == null)){
					var aromas = "<input type='text' class='text-center' id='aromas-form"+idp+"' style='width: 115px;font-size: small;' disabled><input type='hidden' id='aromas_id"+idp+"' name='aromas_id"+idp+"' value=''>";
					//var aromas = "<select id='aromas-form"+idp+"' style='width: 115px;font-size: small;' "+disabledinput+"><option value='0'>... </option></select>";
				}else{
					var aromas = "<input type='text' class='text-center' id='aromas-form"+idp+"' style='width: 115px;font-size: small;' value='"+value.aroma+"' disabled><input type='hidden' id='aromas_id"+idp+"' name='aromas_id"+idp+"' value='"+value.aroma_prod+"' >";
					//var aromas = "<select id='aromas-form"+idp+"' style='width: 115px;font-size: small;' "+disabledinput+"><option value='0'>... </option><option value='"+value.aroma_prod+"'selected>"+value.aroma+"</option></select>";
				}
						
				
				
				var btneliminar = "<button type='button' class='btn btn-danger btn-sm delete-prod' id='eliminar-"+idp+"' "+disabledinput+">x</button>";
				var cant = "<input type='hidden' id='costo-hidden"+idp+"' value='"+value.PRECIO_COSTO+"'><input class='cant-add text-center' id='cant-"+idp+"' name='cant' type='text' style='width: 50px;' value='"+value.cantidad+"' "+disabledinput+">";
				var total = "<input class='precio text-center' id='precio-total"+idp+"' name='"+idp+"' type='text' style='width: 80px;' value='"+totprod+"' "+disabledinput+">";
				var llego = "<input class='check' id='llego"+idp+"' name='"+idp+"' type='checkbox' "+check+" ><input type='hidden' id='familia_id"+idp+"' name='familia_id"+idp+"' value='"+value.FAMILIA_ID+"' >";
				var fila = "<tr id='newProd"+idp+"' style='background-color: "+colorfila+";'><td style='display:none;'>"+value.ID+"</td><td style='font-size: small;'>"+codigo_prod+"</td><td style='font-size: small;'>"+desc+"</td><td style='font-size: small;'>"+medidacant+"</td><td style='font-size: small;'>"+medida+"</td><td>"+talle+"</td><td>"+color+"</td><td>"+aromas+"</td><td style='font-size: small;'>$ "+costo+"</td><td style='display:none' id='cant-hidden"+idp+"'>"+value.cantidad+"</td><td style='font-size: small;'>"+cant+"</td><td style='font-size: small;'>"+total+"</td><td style='font-size: small;'>"+llego+"</td><td style='font-size: small;'>"+btneliminar+"</td></tr>";

				$('#table-add-prod tbody').append(fila);
				var total_precio = $('#total_pedido').val();

				$('#tipo_descuento_pedido').prop('disabled',false);
				$('#descuento_pedido_porc').prop('disabled',false);
				$('#descuento_pedido_cant').prop('disabled',false);
				
				

					// listadoMedidas(idp,value.FAMILIA_ID);
					// listadoTalles(idp,value.FAMILIA_ID);
					// listadoColores(idp);
					// listadoAromas(idp);

					// setTimeout(function() { 

					// 	$('#medidas-form'+idp).val(value.tipo_medida_prod);	
					// 	$('#talles-form'+idp).val(value.talle_prod);	
					// 	$('#colores-form'+idp).val(value.color_prod);	
					// 	$('#aromas-form'+idp).val(value.aroma_prod);	
						
					// }, 1000);
			

								

				});

				

				
			
	
		}
	
	  });


}
function buscarPedidoId(id){

	$.ajax({
		type: "POST",
		url: "pedido/id",
		dataType: 'json',
		data: {

			idp: id,
		},
		success: function (r) {
	
	
			$.each(r.listado,function(idx, value){
	
			  var tot = value.precio_total;
			  $('#id_pedido').val(value.id);
			  $('#id_pdf').val(value.id);
			  $('#nro_pdf').val(value.nro_cliente);
			  $('#cliente_id').val(value.cliente_id);
			  $('#cliente').val(value.apellido_cli+', '+value.nombre_cli+' ('+value.nro_cliente+')');
			  $('#total_pedido').val((eval(value.precio_total)).toFixed(2));
			  $('#tipo_pago').val(value.forma_pago_id);
			  $('#tipo_descuento_pedido').val(value.tipo_descuento_id);
			  $('#domicilio_pdf').val(value.domicilio);
			  $('#localidad_pdf').val(value.localidad_desc);
			  $('#correo_pdf').val(value.correo);
			  $('#telefono_pdf').val(value.telefono);
			  $('#cliente_pdf').val(value.apellido_cli+', '+value.nombre_cli);
			  $('#dni_pdf').val(value.dni);
			  $('#senia_pdf').val(value.senia);
			  $('#saldo_pdf').val((value.precio_total - value.senia).toFixed(2));
			  $('#total_pdf').val(value.precio_total);
			  $('#descuento_pdf').val(value.descuento);
			  $('#tipodescuento_pdf').val(value.tipo_descuento_id);
			  $('#usuario-title').html("usuario: <span class='badge badge-primary'>"+value.nombre_usu+"</span>");

			  if(value.tipo_descuento_id == 1){

				$('#descuento_pedido_porc').show();
				$('#descuento_pedido_cant').hide();  
				$('#descuento_pedido_porc').val(value.descuento);

			  }else{

				$('#descuento_pedido_porc').hide();
				$('#descuento_pedido_cant').show();  
				$('#descuento_pedido_cant').val(value.descuento);

			  }
			  
			  
			  $('#tipo_envio').val(value.envio_id);
			  $('#fecha_cierre').val(value.fecha_cierre);
			  $('#fecha_pdf').val(value.fecha_pedido_);
			  $('#fechacierre_pdf').val(value.fecha_cierre_);
			  $('#senia_pedido').val(value.senia);
			  $('#saldo_pedido').val((value.precio_total - value.senia).toFixed(2));
			  $('#observacion').val(value.observacion);

			});
	
		}
	
	  });
}



function listadoMedidas(id_prod,familia){

	$.ajax({
		type: "POST",
		url: "pedido/medidas",
		dataType: 'json',
		data: {

			familia_id : familia, 
		},
		success: function (r) {
	
			var datos = r.listado;

				$('#medidas-form'+id_prod).autocomplete({
					minLength: 0,
					source: datos,
					// eventos del autocompletar
					select : function (event, ui) {
						$('#medidas-form'+id_prod).val(ui.item.label); // display the selected text
						$('#medidas_id'+id_prod).val(ui.item.value); // save selected id to hidden input
						var id = ui.item.value;
						return false;
					},
					focus: function (event, ui) {
							 $('#medidas-form'+id_prod).val(ui.item.label); // display the selected text
							 $('#medidas_id'+id_prod).val(ui.item.value); // save selected id to hidden input
							 var id = ui.item.value;
							return false;
					},
					change: function( event, ui ) {
						 $('#medidas_id'+id_prod).val( ui.item? ui.item.value : 0 ); 
						 
					}
				 });
	
		}
	
	  });
}


function listadoTalles(id_prod,familia){

	$.ajax({
		type: "POST",
		url: "pedido/talles",
		dataType: 'json',
		data: {
			familia_id : familia,
		},
		success: function (r) {
	
	
			var datos = r.listado;

				$('#talles-form'+id_prod).autocomplete({
					minLength: 0,
					source: datos,
					// eventos del autocompletar
					select : function (event, ui) {
						$('#talles-form'+id_prod).val(ui.item.label); // display the selected text
						$('#talles_id'+id_prod).val(ui.item.value); // save selected id to hidden input
						var id = ui.item.value;
						return false;
					},
					focus: function (event, ui) {
							 $('#talles-form'+id_prod).val(ui.item.label); // display the selected text
							 $('#talles_id'+id_prod).val(ui.item.value); // save selected id to hidden input
							 var id = ui.item.value;
							return false;
					},
					change: function( event, ui ) {
						 $('#talles_id'+id_prod).val( ui.item? ui.item.value : 0 ); 
						 
					}
				 });
	
		}
	
	  });
}

function listadoColores(id_prod){

	$.ajax({
		type: "POST",
		url: "pedido/colores",
		dataType: 'json',
		data: {
		},
		success: function (r) {
	
	
			var datos = r.listado;

				$('#colores-form'+id_prod).autocomplete({
					minLength: 0,
					source: datos,
					// eventos del autocompletar
					select : function (event, ui) {
						$('#colores-form'+id_prod).val(ui.item.label); // display the selected text
						$('#colores_id'+id_prod).val(ui.item.value); // save selected id to hidden input
						var id = ui.item.value;
						return false;
					},
					focus: function (event, ui) {
							 $('#colores-form'+id_prod).val(ui.item.label); // display the selected text
							 $('#colores_id'+id_prod).val(ui.item.value); // save selected id to hidden input
							 var id = ui.item.value;
							return false;
					},
					change: function( event, ui ) {
						 $('#colores_id'+id_prod).val( ui.item? ui.item.value : 0 ); 
						 
					}
				 });
	
		}
	
	  });
}

function listadoAromas(id_prod){

	$.ajax({
		type: "POST",
		url: "pedido/aromas",
		dataType: 'json',
		data: {
		},
		success: function (r) {
	
	
			var datos = r.listado;

				$('#aromas-form'+id_prod).autocomplete({
					minLength: 0,
					source: datos,
					// eventos del autocompletar
					select : function (event, ui) {
						$('#aromas-form'+id_prod).val(ui.item.label); // display the selected text
						$('#aromas_id'+id_prod).val(ui.item.value); // save selected id to hidden input
						var id = ui.item.value;
						return false;
					},
					focus: function (event, ui) {
							 $('#aromas-form'+id_prod).val(ui.item.label); // display the selected text
							 $('#aromas_id'+id_prod).val(ui.item.value); // save selected id to hidden input
							 var id = ui.item.value;
							return false;
					},
					change: function( event, ui ) {
						 $('#aromas_id'+id_prod).val( ui.item? ui.item.value : 0 ); 
						 
					}
				 });
	
		}
	
	  });
}

function listadoPedidos(){

	$('#divsearchicon').show();

	$.ajax({
		type: "POST",
		url: "pedido/listado",
		dataType: 'json',
		data: {
		},
		success: function (r) {
	
			TablePedidos.clear().draw(); // limpiamos la tabla

			$('#divsearchicon').hide();
			$.each(r.listado,function(idx, value){

				var btn_edit = "<button class='btn btn-primary btn-xs edit_pedido' id='"+value.id+"'><i class='fas fa-info'></i></button>";
				//var btneditar = '<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Detalle</button>';
				var btnest = '<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-asterisk"></i></button>';
				var btnelim = '<div class="dropdown-menu" aria-labelledby="btnGroupDrop1"><a class="dropdown-item edit_estados" id ="'+value.id+'" name="'+'<strong>'+value.nro_cliente+'</strong> - '+value.apellido_cli+', '+value.nombre_cli+'*'+value.estado_id+'" href="#">Cambiar estado</a><a class="dropdown-item eliminar" href="#" id ="'+value.id+'" name="'+'<strong>'+value.nro_cliente+'</strong> - '+value.apellido_cli+', '+value.nombre_cli+'">Eliminar</a></div>';
				var btn = '<div class="btn-group" role="group">'+btnest+btnelim+'</div></div>';
                TablePedidos.row.add( [
                    '<strong>'+value.id+'<strong>',
                    '<strong>'+value.nro_cliente+'</strong> - '+value.apellido_cli+', '+value.nombre_cli,
                    value.fecha_cierre_,
                    value.formapago,
					value.envio,
					'<span class="adge badge-pill badge-success">'+'$ '+(eval(value.precio_total)).toFixed(2)+'</span>',
					value.estado,
					btn_edit+' '+btn
                    ]).draw();
				
			});
	
		}
	
	  });
}

function listadoPedidosFinalizados(){

	$('#divsearchicon').show();

	$.ajax({
		type: "POST",
		url: "pedido/listado_finalizados",
		dataType: 'json',
		data: {
		},
		success: function (r) {

			TablePedidos2.clear().draw(); // limpimos la tabla
	
	
			$('#divsearchicon').hide();
			$.each(r.listado,function(idx, value){

				var btn_edit = "<button class='btn btn-primary btn-xs edit_pedido' id='"+value.id+"'><i class='fas fa-info'></i></button>";
				//var btneditar = '<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Detalle</button>';
				var btnest = '<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-asterisk"></i></button>';
				var btnelim = '<div class="dropdown-menu" aria-labelledby="btnGroupDrop1"><a class="dropdown-item edit_estados" id ="'+value.id+'" name="'+'<strong>'+value.nro_cliente+'</strong> - '+value.apellido_cli+', '+value.nombre_cli+'*'+value.estado_id+'" href="#">Cambiar estado</a><a class="dropdown-item eliminar" href="#" id ="'+value.id+'" name="'+'<strong>'+value.nro_cliente+'</strong> - '+value.apellido_cli+', '+value.nombre_cli+'">Eliminar</a></div>';
				var btn = '<div class="btn-group" role="group">'+btnest+btnelim+'</div></div>';
                TablePedidos2.row.add( [
                    '<strong>'+value.id+'<strong>',
                    '<strong>'+value.nro_cliente+'</strong> - '+value.apellido_cli+', '+value.nombre_cli,
                    value.fecha_cierre_,
                    value.formapago,
					value.envio,
					'<span class="adge badge-pill badge-success">'+'$ '+(eval(value.precio_total)).toFixed(2)+'</span>',
					value.estado,
					btn_edit+' '+btn
                    ]).draw();
				
			});
	
		}
	
	  });
}



function listadoEstados(){

	$.ajax({
		type: "POST",
		url: "pedido/listado_estados_all",
		dataType: 'json',
		data: {
		},
		success: function (r) {
	
			$("#estado_id").empty();
			$.each(r.listado,function(idx, value){
	
				$('#estado_id').append($('<option>', { 
                    value: value.id,
                    text : value.descripcion 
                }));

			});
	
		}
	
	  });
}

function listasAll(){

    $.ajax({
    type: "POST",
    url: "prod/listas2",
    dataType: 'json',
    data: {
    },
    success: function (r) {

		$("#listas").empty();
        $.each(r.listado,function(idx, value){

            $('#listas').append($('<option>', { 
                value: value.fecha_alta,
                text : value.fecha 
            }));

        });

    }

  });

}


$(document).ready(function(){

	listadoPedidos(); // listamos los pedidos
	clientes_listado(); // listamos los clientes
	listado_envios();  // listamos los tipos de envíos
	listado_fpagos()  // listamos los tipos de pagos

	listado_productos(); // listamos los productos


	

	$(document).on("click","#btn-verificar", function(event){

		// mostramos en pantalla que está verificando
		$('#'+this.id).html('verificando..');

		var importe_total = 0

		// realizamos la sumatoria de los totales de cada producto que esté activo
		$(".precio").each(
			function(index, value) {
				if($('#precio-total'+this.name).is(':disabled')){

				}else{
					if ( $.isNumeric( $(this).val() ) ){
						importe_total = importe_total + eval($(this).val());
						//console.log(importe_total);
						 }
				}	
			
		  }
	   );

	   // verficamos si tiene descuento y lo calculamos
	   if(($("#tipo_descuento_pedido option:selected").val() == 1) && ($('#descuento_pedido_porc option:selected').val() != 0)){

        var desc = $('#descuento_pedido_porc option:selected').val();
		$('#total_pedido').val((importe_total-(importe_total*desc/100)).toFixed(2));

	   }else if(($("#tipo_descuento_pedido option:selected").val() == 2) && ($('#descuento_pedido_cant').val() != "")){

		var desc = $('#descuento_pedido_cant').val();
		$('#total_pedido').val((importe_total-(desc)).toFixed(2));

	   }
	   
	   // restamos la seña al monto total
	   setTimeout(function(){
		var senia = $('#senia_pedido').val();		
		var tot = $('#total_pedido').val();
		$('#saldo_pedido').val((tot - senia).toFixed(2));
	  },500);
	   
		
		

		setTimeout(function(){

			$('#btn-verificar').html('<i class="fa fa-check"></i> Verificado');
			$('#btn-verificar').removeClass('btn-outline-info');
			$('#btn-verificar').addClass('btn-outline-success');
			$('#btn-verificar').prop('disabled',true);

			$('#btn-formulario').removeClass('btn-secondary');
			$('#btn-formulario').addClass('btn-primary');
			$('#btn-formulario').prop('disabled',false);

		  },1500);			

	});

	$(document).on("click","#btnlistavieja", function(event){

		if(this.value == 1){

			$('#divbtnnuevolistas').hide();
			$('#divlistas').hide();
			$('#divbtnnuevonormal').show();

			$('#btnlistavieja').text('lista vieja');
			$('#btnlistavieja').val('0');

		}else{

			listasAll();
			$('#divbtnnuevolistas').show();
			$('#divlistas').show();
			$('#divbtnnuevonormal').hide();

			$('#btnlistavieja').text('lista actual');
			$('#btnlistavieja').val('1');

		}
		

	});

    $(document).on("click","#nuevo_pedido", function(event){

		//clientes_listado();
		listado_productos();
		//listado_envios();
		//listado_fpagos();

		$('#btn-formulario').removeClass('btn-secondary');
		$('#btn-formulario').addClass('btn-primary');
		$('#btn-formulario').prop('disabled',false);

		$('#btn-verificar').hide();
		$('.inp-form').removeClass('is-invalid');
		$('.span').hide();
		/////////////
		$('#cod2').val(1);
		/////////////
		$('#usuario-title').html('');
		$('#tipo_accion').val(1);	
		$('#cliente_id').val('');	
		$('#cliente').val('');	
		$('#observacion').val('');	
		$('#total_pedido').val('');	
		$('#tipo_pago').val('default');	
		$('#tipo_envio').val('default');	
		$('#fecha_cierre').val('');	
		$('#descuento_pedido_cant').val('');
		$('#descuento_pedido_porc').val('0');
		$('#senia_pedido').val('0');
		$('#saldo_pedido').val('0');
		$('#tipo_descuento_pedido').prop('disabled',true);
		$('#descuento_pedido_cant').prop('disabled',true);
		$('#descuento_pedido_porc').prop('disabled',true);
		$('#cliente').prop('disabled',false);
		$('#modificar-cli').hide();
		

		$("#table-add-prod > tbody").empty();
		
		$('#form-btn-imp-pedido').hide();
		$('#modal-header-tot').css("background-color", "darkseagreen");
		$('#modal-title-alta').html('Nuevo Pedido');
		$('#btn-formulario').text('Guardar');	
        $('#myModalPedido').modal('show');
        
	});

	$(document).on("click","#nuevo_pedido_2", function(event){

		//clientes_listado();
		listado_productos2();
		//listado_envios();
		//listado_fpagos();

		$('#btn-formulario').removeClass('btn-secondary');
		$('#btn-formulario').addClass('btn-primary');
		$('#btn-formulario').prop('disabled',false);

		$('#btn-verificar').hide();
		$('.inp-form').removeClass('is-invalid');
		$('.span').hide();
		/////////////
		$('#cod2').val(1);
		/////////////
		$('#usuario-title').html('');
		$('#tipo_accion').val(1);	
		$('#cliente_id').val('');	
		$('#cliente').val('');	
		$('#observacion').val('');	
		$('#total_pedido').val('');	
		$('#tipo_pago').val('default');	
		$('#tipo_envio').val('default');	
		$('#fecha_cierre').val('');	
		$('#descuento_pedido_cant').val('');
		$('#descuento_pedido_porc').val('0');
		$('#senia_pedido').val('0');
		$('#saldo_pedido').val('0');
		$('#tipo_descuento_pedido').prop('disabled',true);
		$('#descuento_pedido_cant').prop('disabled',true);
		$('#descuento_pedido_porc').prop('disabled',true);
		$('#cliente').prop('disabled',false);
		$('#modificar-cli').hide();
		

		$("#table-add-prod > tbody").empty();
		
		$('#form-btn-imp-pedido').hide();
		$('#modal-header-tot').css("background-color", "darkseagreen");
		$('#modal-title-alta').html('Nuevo Pedido');
		$('#btn-formulario').text('Guardar');	
        $('#myModalPedido').modal('show');
        
	});

	$(document).on("click","#modificar-cli", function(event){

        $('#cliente').prop('disabled',false);
        $('#modificar-cli').hide();
        
	});

	$(document).on("click","#close-deshabilitar", function(event){

		if($('#llego'+this.value).is(':checked')){

			$('#llego'+this.value).prop("checked", false);
			$('#myModalDeshabilitar').modal('hide');
			
		}else{

			$('#llego'+this.value).prop("checked", true);
			$('#myModalDeshabilitar').modal('hide');
		}
		
	
        
	});
	

	///////////////////////
	// agregar productos //
	///////////////////////
	$(document).on("click","#add-producto", function(event){

		var id_prod = $('#producto_id').val(); //obtenemos el id del producto
		var id_prod_2 = id_prod;
		var cod2 = $('#cod2').val();

		valores = new Array(); 
		// colocamos los datos de la tabla en un arreglo
		for (i = 1; i < $('#table-add-prod tr').length; i++) {
			valores[i] = new Array();
			for (j = 0; j < 12; j++) {
				valores[i][j] = $('#table-add-prod').find('tr:eq(' + i + ') td:eq(' + j + ')').html();
			}
		}

		//console.log(valores);
		//verificamos si existe el producto en la lista
		for (i = 1; i < $('#table-add-prod tr').length; i++) {
			if (valores[i][0] == id_prod) {

				id_prod_2 = id_prod+cod2;
				
				$('#cod2').val(parseInt(cod2)+parseInt(1));
			}
		}


		$('#add-producto').hide();
		$('#producto').val('');
		$('#producto_id').val('');

		// si estan activos los decuentos los volvemos a setear
		$('#descuento_pedido_cant').val('');
		$('#descuento_pedido_porc').val('0');

		$.ajax({
			type: "POST",
			url: "prod/buscar_id",
			dataType: 'json',
			data: {
	
				id_producto: id_prod,
			},
			success: function (r) {
		
		
				$.each(r.listado,function(idx, value){

				var cod = value.CODIGO;	
				var desc = value.DESCRIPCION;	
				var familia = value.FAMILIA;
		
				var codigo_prod = "<input class='text-center' id='codigo_prod"+id_prod_2+"' type='text' style='width: 40px;' name='cod-prod' value='"+cod+"'>";
				var medidacant = "<input class='text-center' id='medidacant"+id_prod_2+"' type='text' style='width: 40px;' value=''>";
				var medida = "<input type='text' class='medida-tipo' id='medidas-form"+id_prod_2+"' name='"+id_prod_2+"' style='width: 115px;font-size: small;'><input type='hidden' id='medidas_id"+id_prod_2+"' name='medidas_id"+id_prod_2+"' >";
				var talle = "<input type='text' class='text-center' id='talles-form"+id_prod_2+"' style='width: 55px;font-size: small;'><input type='hidden' id='talles_id"+id_prod_2+"' name='talles_id"+id_prod_2+"' >";
				var color = "<input type='text' class='text-center' id='colores-form"+id_prod_2+"' style='width: 115px;font-size: small;'><input type='hidden' id='colores_id"+id_prod_2+"' name='colores_id"+id_prod_2+"' >";
				var aromas = "<input type='text' class='text-center' id='aromas-form"+id_prod_2+"' style='width: 115px;font-size: small;'><input type='hidden' id='aromas_id"+id_prod_2+"' name='aromas_id"+id_prod_2+"' >";
					
					
					
				var costo = value.PRECIO_COSTO;	
				
				var btneliminar = "<button type='button' class='btn btn-danger btn-sm delete-prod' id='eliminar-"+id_prod_2+"'>x</button>";
				var cant = "<input type='hidden' id='costo-hidden"+id_prod_2+"' value='"+value.PRECIO_COSTO+"'><input class='cant-add text-center' id='cant-"+id_prod_2+"' name='cant' type='text' style='width: 50px;' value='1'>";
				var total = "<input class='precio text-center' id='precio-total"+id_prod_2+"' type='text' style='width: 80px;' value='"+costo+"' >";
				var llego = "<input class='check' id='llego"+id_prod_2+"' name='llego"+id_prod_2+"' type='checkbox' checked disabled><input type='hidden' id='familia_id"+id_prod_2+"' name='familia_id"+id_prod_2+"' value='"+value.FAMILIA_ID+"' >";
				var fila = "<tr id='newProd"+id_prod_2+"' style='background-color: cornflowerblue;'><td style='display:none;'>"+id_prod+"</td><td style='font-size: small;'>"+codigo_prod+"</td><td style='font-size: small;'>"+desc+"</td><td style='font-size: small;'>"+medidacant+"</td><td style='font-size: small;'>"+medida+"</td><td>"+talle+"</td><td>"+color+"</td><td>"+aromas+"</td><td style='font-size: small;'>$ "+costo+"</td><td style='display:none' id='cant-hidden"+id_prod_2+"'>1</td><td style='font-size: small;'>"+cant+"</td><td style='font-size: small;'>"+total+"</td><td style='font-size: small;'>"+llego+"</td><td style='font-size: small;'>"+btneliminar+"</td></tr>";

				$('#table-add-prod tbody').append(fila);
				var total_precio = $('#total_pedido').val();

				var sum = sumatoria();

				
				$('#total_pedido').val(sum);

				$('#senia_pedido').change();

				$('#tipo_descuento_pedido').prop('disabled',false);
				$('#descuento_pedido_porc').prop('disabled',false);
				$('#descuento_pedido_cant').prop('disabled',false);
			
				listadoMedidas(id_prod_2,value.FAMILIA_ID);
				listadoTalles(id_prod_2,value.FAMILIA_ID);
				listadoColores(id_prod_2);
				listadoAromas(id_prod_2);

				});
		
			}
		
		  });

		 // reseteamos los botones
		$('#btn-verificar').show();
		$('#btn-verificar').html('Verificar Cálculo');
		$('#btn-verificar').removeClass('btn-outline-success');
		$('#btn-verificar').addClass('btn-outline-info');
		$('#btn-verificar').prop('disabled',false);

		$('#btn-formulario').addClass('btn-secondary');
		$('#btn-formulario').prop('disabled',true);
		// fin

		  
        
	});

	$(document).on("click",".edit_pedido", function(event){

		// eliminamos las clases de error y los span con mensajes de error
		$('.inp-form').removeClass('is-invalid');
		$('.span').hide();
		// fin

		// reseteamos los botones
		$('#btn-verificar').show();
		$('#btn-verificar').html('Verificar Cálculo');
		$('#btn-verificar').removeClass('btn-outline-success');
		$('#btn-verificar').addClass('btn-outline-info');
		$('#btn-verificar').prop('disabled',false);

		$('#btn-formulario').addClass('btn-secondary');
		$('#btn-formulario').prop('disabled',true);
		// fin

		// seteamos a cero los campos
		$('#cliente_id').val('');	
		$('#cliente').val('');	
		$('#observacion').val('');	
		$('#total_pedido').val('');	
		$('#tipo_pago').val('default');	
		$('#tipo_envio').val('default');	
		$('#fecha_cierre').val('');	
		$('#senia_pedido').val('0');
		$('#senia_pedido').val('0');
		$('#saldo_pedido').val('0');
		$('#descuento_pedido_cant').val('');
		$('#descuento_pedido_porc').val('0');
		$('#tipo_descuento_pedido').prop('disabled',false);
		$('#descuento_pedido_cant').prop('disabled',false);
		$('#descuento_pedido_porc').prop('disabled',false);
		$('#tipo_accion').val(2);		
		$('#cliente').prop('disabled',true);
		$('#modificar-cli').show();
		$("#table-add-prod > tbody").empty();

		$('#btn-formulario').prop('disabled',false);

		$('#btn-formulario').text('Modificar');	
		// fin seteo

		// buscamos los datos para rellenar los select

		//clientes_listado();
		//listado_productos();
		//listado_envios();
		//listado_fpagos();

		// fin busqueda

		// buscamos los datos del pedido
	  	buscarPedidoId(this.id);
		// fin busqueda

		// buscamos los productos del pedido
	  	buscarProductosPedidosId(this.id);
	  	// fin busqueda
		
		// seteamos el modal y lo abrimos
	  	$('#form-btn-imp-pedido').show();
	  	$('#modal-header-tot').css("background-color", "lavender");
	  	$('#modal-title-alta').html("Detalle del Pedido <span class='badge badge-info'>"+this.id+"</span>");	
		 
		//alert();  
		$('#btn-formulario').prop('disabled',true);  
		// abrimos el modal del pedido
	  	$('#myModalPedido').modal('show');
		// fin seteo modal
	});
	
	
	$(document).on("click",".check", function(event){

		if( $('#llego'+this.name).is(':checked') ) {

			$('#myModalDeshabilitar').modal('show');
			var nom = $('#codigo_prod'+this.name).val();
		
			$('#titleModalTitle_deshabilitar').html('código '+nom);
			$('#msjModalHabilitar').html('Desea Habilitar el producto?');
			$('#deshabilitar_producto').val(this.name);
			$('#close-deshabilitar').val(this.name);
			$('#tipoHabilitacion').val(1);


		}else{

			$('#myModalDeshabilitar').modal('show');
			var nom = $('#codigo_prod'+this.name).val();
		
			$('#titleModalTitle_deshabilitar').html('código '+nom);		
			$('#msjModalHabilitar').html('Desea Deshabilitar el producto?');
			$('#deshabilitar_producto').val(this.name);
			$('#close-deshabilitar').val(this.name);
			$('#tipoHabilitacion').val(0);
		}

		$('#myModalDeshabilitar').modal('show');
		var nom = $('#codigo_prod'+this.name).val();
	
		$('#titleModalTitle_deshabilitar').html('código '+nom);
		$('#deshabilitar_producto').val(this.name);
		$('#close-deshabilitar').val(this.name);
		
	});

	$(document).on("click","#deshabilitar_producto", function(event){
		
		 if($('#tipoHabilitacion').val() == 0){

			$('#newProd'+this.value).css("background-color", "darkgray");
			$('#eliminar-'+this.value).prop('disabled',true);
			$('#codigo_prod'+this.value).prop('disabled',true);
			$('#medidacant'+this.value).prop('disabled',true);
			$('#medidas-form'+this.value).prop('disabled',true);
			$('#talles-form'+this.value).prop('disabled',true);
			$('#colores-form'+this.value).prop('disabled',true);
			$('#aromas-form'+this.value).prop('disabled',true);
			$('#cant-'+this.value).prop('disabled',true);
			//$('#llego'+this.value).prop('disabled',true);
			$('#precio-total'+this.value).prop('disabled',true);

			var subtotal = $('#precio-total'+this.value).val();
			var aux = ($('#total_pedido').val()-subtotal);
			$('#total_pedido').val(aux.toFixed(2));
			$('#senia_pedido').change();

			//$('#precio-total'+this.value).val(0);
			
		    $('#myModalDeshabilitar').modal('hide');
			// reseteamos los botones
			$('#btn-verificar').show();
			$('#btn-verificar').html('Verificar Cálculo');
			$('#btn-verificar').removeClass('btn-outline-success');
			$('#btn-verificar').addClass('btn-outline-info');
			$('#btn-verificar').prop('disabled',false);

			$('#btn-formulario').addClass('btn-secondary');
			$('#btn-formulario').prop('disabled',true);
			// fin

		 }else{

			$('#eliminar-'+this.value).prop('disabled',false);
			$('#newProd'+this.value).css("background-color", "cornflowerblue");
			$('#codigo_prod'+this.value).prop('disabled',false);
			// $('#medidacant'+this.value).prop('disabled',false);
			// $('#medidas-form'+this.value).prop('disabled',false);
			// $('#talles-form'+this.value).prop('disabled',false);
			// $('#colores-form'+this.value).prop('disabled',false);
			// $('#aromas-form'+this.value).prop('disabled',false);
			$('#cant-'+this.value).prop('disabled',false);
			$('#precio-total'+this.value).prop('disabled',false);
			//$('#llego'+this.value).prop('disabled',true);

			var subtotal = $('#precio-total'+this.value).val();
			var auxiliar = (parseFloat($('#total_pedido').val())+parseFloat(subtotal));
			
			$('#total_pedido').val(auxiliar.toFixed(2));
			$('#senia_pedido').change();

			//$('#precio-total'+this.value).val(0);
			setTimeout(function(){
				$('#btn-formulario').focus();
			  },150);
			
		    $('#myModalDeshabilitar').modal('hide');
			// reseteamos los botones
			$('#btn-verificar').show();
			$('#btn-verificar').html('Verificar Cálculo');
			$('#btn-verificar').removeClass('btn-outline-success');
			$('#btn-verificar').addClass('btn-outline-info');
			$('#btn-verificar').prop('disabled',false);

			$('#btn-formulario').addClass('btn-secondary');
			$('#btn-formulario').prop('disabled',true);
			// fin

		 }
	
			
	});

	

	$(document).on("click",".eliminar", function(event){

		$('#pedido_id_eliminar').val(this.id);
		$('#titleModalTitle_eliminar').html('Pedido: '+this.id);
		$('#nombreModalEstado_eliminar').html('Cliente: '+this.name);

		$('#myModalEliminar').modal('show');
		
		
	});
	
	$(document).on("click","#eliminar_pedido", function(event){

	var idp = $('#pedido_id_eliminar').val();

	$.ajax({
		type: "POST",
		url: 'pedido/eliminar',
		dataType: 'json',
		data: {

			idpedido : idp
		},
		success: function (r) {

			if(r.exito == true){

				TablePedidos.clear().draw();   

				listadoPedidos();
				listadoPedidosFinalizados();

				$('#myModalEliminar').modal('hide');

				toastr.success('Se eliminó con éxito'); 

		}else{

			toastr.error(r.error.mensaje); 
		}

		}
	});
		
		
	});


	$(document).on("click",".delete-prod", function(event){

		var ide = this.id;
		var res = ide.split('-')[1];
		//alert(res);
		var preciotot = $('#precio-total'+res).val();
		var total = $('#total_pedido').val();
		var aux = (total-preciotot);
		$('#total_pedido').val(aux.toFixed(2));
		$('#senia_pedido').change();
		$("#newProd"+res).remove();

		// reseteamos los botones
		$('#btn-verificar').show();
		$('#btn-verificar').html('Verificar Cálculo');
		$('#btn-verificar').removeClass('btn-outline-success');
		$('#btn-verificar').addClass('btn-outline-info');
		$('#btn-verificar').prop('disabled',false);

		$('#btn-formulario').addClass('btn-secondary');
		$('#btn-formulario').prop('disabled',true);
		// fin
		
	});

	$(document).on("change",".cant-add", function(event){

		var ide = this.id;
		var res = ide.split('-')[1];
		var costo = $('#costo-hidden'+res).val();
		$('#cant-hidden'+res).text(this.value);
		$('#precio-total'+res).val(costo*this.value);
		
		
		var sum = sumatoria();


		$('#total_pedido').val(sum);

		// si estan activos los decuentos los volvemos a setear
		$('#descuento_pedido_cant').val('');
		$('#descuento_pedido_porc').val('0');
		$('#senia_pedido').change();


	  
	});

	$(document).on("change","#senia_pedido", function(event){

		
		var tot = $('#total_pedido').val();
		$('#saldo_pedido').val((tot - this.value).toFixed(2));

		// reseteamos los botones
		$('#btn-verificar').show();
		$('#btn-verificar').html('Verificar Cálculo');
		$('#btn-verificar').removeClass('btn-outline-success');
		$('#btn-verificar').addClass('btn-outline-info');
		$('#btn-verificar').prop('disabled',false);

		$('#btn-formulario').addClass('btn-secondary');
		$('#btn-formulario').prop('disabled',true);
		// fin
	
	  
	});

	$(document).on("change","#tipo_descuento_pedido", function(event){

		var importe_total = 0
		
		$(".precio").each(
			function(index, value) {

			if($('#precio-total'+this.name).is(':disabled')){

			}else{

				if ( $.isNumeric( $(this).val() ) ){

					importe_total =  importe_total + eval($(this).val()) ;
					
					//console.log(importe_total);
				}
			}
			
		  }
	   );

		$('#total_pedido').val(importe_total.toFixed(2)); // sumamos todo de nuevo
		$('#senia_pedido').change(); // activamos la seña para que actualice
		if(this.value == 1){

			$('#descuento_pedido_cant').val('');
			$('#descuento_pedido_porc').val('0');
			$('#descuento_pedido_cant').hide();
			$('#descuento_pedido_porc').show();

		}else{

			$('#descuento_pedido_cant').val('');
			$('#descuento_pedido_porc').val('0');
			$('#descuento_pedido_cant').show();
			$('#descuento_pedido_porc').hide();

		}

		// reseteamos los botones
		$('#btn-verificar').show();
		$('#btn-verificar').html('Verificar Cálculo');
		$('#btn-verificar').removeClass('btn-outline-success');
		$('#btn-verificar').addClass('btn-outline-info');
		$('#btn-verificar').prop('disabled',false);

		$('#btn-formulario').addClass('btn-secondary');
		$('#btn-formulario').prop('disabled',true);
		// fin
		
	});

	$(document).on("click",".edit_estados", function(event){

		listadoEstados();

		$('#pedido_id').val(this.id);
		$('#titleModalTitle').html('Pedido: '+this.id);

		var name = this.name.split('*')[0];
		var idestado = this.name.split('*')[1];

		$('#nombreModalEstado').html('Cliente: '+name);
		
		setTimeout(function(){

			$('#estado_id').val(idestado);
			$('#myModalEstados').modal('show');

		  },150);

		
		
	});
	

	$(document).on("change","#descuento_pedido_porc", function(event){

		var importe_total = 0

		$(".precio").each(
			function(index, value) {
				if($('#precio-total'+this.name).is(':disabled')){

				}else{
					if ( $.isNumeric( $(this).val() ) ){
						importe_total = importe_total + eval($(this).val());
						//console.log(importe_total);
						 }
				}	
			
		  }
	   );

	   
		$('#total_pedido').val((importe_total-(importe_total*this.value/100)).toFixed(2));

		$('#senia_pedido').change();
		
	});
	

	$(document).on("change","#descuento_pedido_cant", function(event){

		var importe_total = 0

		$(".precio").each(
			function(index, value) {
				if($('#precio-total'+this.name).is(':disabled')){

				}else{
					if ( $.isNumeric( $(this).val() ) ){
						importe_total = importe_total + eval($(this).val());
						//console.log(importe_total);
						 }
					
				}	
			
		  }
	   );

	    
		$('#total_pedido').val((importe_total-(this.value)).toFixed(2));

		$('#senia_pedido').change();
		
	});

	// $(document).on("click","#btn-imprimir", function(event){

	// 	alert();

	// 	$('#form-pedido-pfd').submit();
	// 	//$('#form-pfd').submit();

	// });

	$(document).on("click","#pdfpedido", function(event){    
    
		
		var productos = new Array();

		 //devulve las filas del body de tu tabla segun el ejemplo que brindaste
		var filas = $("#table-add-prod").find("tr");
		// for Recorre las filas 1 a 1  
		for(i=1; i< filas.length; i++){

			  productos[i] = new Array();

			  var celdas = $(filas[i]).find("td"); //devolverá las celdas de una fila

			  codigo = $(celdas[0]).html();
			  codnew= $($(celdas[1]).children("input[type='text']")[0]).val();
			  desc = $(celdas[2]).html();
		  	  medida = $($(celdas[3]).children("input[type='text']")[0]).val();
		  	  tipomedida = $($(celdas[4]).children("input[type='text']")[0]).val();
		  	  talle = $($(celdas[5]).children("input[type='text']")[0]).val();
		  	  color = $($(celdas[6]).children("input[type='text']")[0]).val();
		  	  aroma = $($(celdas[7]).children("input[type='text']")[0]).val();
			  cant = $(celdas[9]).html();
			  precio_unitario = $($(celdas[10]).children("input[type='hidden']")[0]).val();
			  precio_tot = $($(celdas[11]).children("input[type='text']")[0]).val();
			  llego = $(celdas[12]).children("input[type='checkbox']").is(':checked');


			  ///
			//   medida = $($(celdas[3]).children("input[type='text']")[0]).val();
			//   tipomedida = $($(celdas[4]).children("input[type='hidden']")[0]).val();
			//   tipomedida_desc = $($(celdas[4]).children("input[type='text']")[0]).val();
			//  // talle = $($(celdas[5]).children("select")[0]).children('option:selected').val();
			// talle = $($(celdas[5]).children("input[type='hidden']")[0]).val();
			// talle_desc = $($(celdas[5]).children("input[type='text']")[0]).val();
			//   color = $($(celdas[6]).children("input[type='hidden']")[0]).val();
			//   color_desc = $($(celdas[6]).children("input[type='text']")[0]).val();
			//   aroma = $($(celdas[7]).children("input[type='hidden']")[0]).val();
			//   aroma_desc = $($(celdas[7]).children("input[type='text']")[0]).val();
			// cant = $(celdas[9]).html();
			// llego = $(celdas[12]).children("input[type='checkbox']").is(':checked');
			// familia = $($(celdas[12]).children("input[type='hidden']")[0]).val();
			  ///
				
			  //guardarmos los datos en el arreglo
				productos[i][0]= codigo;
				productos[i][1]= codnew;
				productos[i][2]= desc;
				productos[i][3]= medida;
				productos[i][4]= tipomedida;
				productos[i][5]= talle;
				productos[i][6]= color;
				productos[i][7]= aroma;
				productos[i][8]= cant;
				productos[i][9]= precio_unitario;
				productos[i][10]= precio_tot;
				productos[i][11]= llego;

		  }
		// fin for
		// console.log(productos);
		// return false;
		$('#arreglo_pdf').val(JSON.stringify(productos));

		$('#form-pedidopfd').submit();


    });

// validar los select //
$.validator.addMethod("valueNotEquals", function(value, element, arg){
	return arg !== value;
	}, "Value must not equal arg.");	
	
// ALTA //   
$('#alta_pedido').validate({
           
	submitHandler: function (form) {
		// cuando va bien

	
		var productos = new Array();

		var filas = $("#table-add-prod").find("tr"); //devulve las filas del body de tu tabla segun el ejemplo que brindaste
		// for Recorre las filas 1 a 1  
		for(i=1; i< filas.length; i++){

			  productos[i] = new Array();

			  var celdas = $(filas[i]).find("td"); //devolverá las celdas de una fila

			  codigo = $(celdas[0]).html();
			  codnew= $($(celdas[1]).children("input[type='text']")[0]).val();
			  desc = $(celdas[2]).html();
		  	  medida = $($(celdas[3]).children("input[type='text']")[0]).val();
		  	  tipomedida = $($(celdas[4]).children("input[type='hidden']")[0]).val();
		  	  tipomedida_desc = $($(celdas[4]).children("input[type='text']")[0]).val();
		  	 // talle = $($(celdas[5]).children("select")[0]).children('option:selected').val();
			  talle = $($(celdas[5]).children("input[type='hidden']")[0]).val();
			  talle_desc = $($(celdas[5]).children("input[type='text']")[0]).val();
		  	  color = $($(celdas[6]).children("input[type='hidden']")[0]).val();
		  	  color_desc = $($(celdas[6]).children("input[type='text']")[0]).val();
		  	  aroma = $($(celdas[7]).children("input[type='hidden']")[0]).val();
		  	  aroma_desc = $($(celdas[7]).children("input[type='text']")[0]).val();
			  cant = $(celdas[9]).html();
			  llego = $(celdas[12]).children("input[type='checkbox']").is(':checked');
			  familia = $($(celdas[12]).children("input[type='hidden']")[0]).val();
			
				
			  //guardarmos los datos en el arreglo
				productos[i][0]= codigo;
				productos[i][1]= codnew;
				productos[i][2]= desc;
				productos[i][3]= medida;
				productos[i][4]= tipomedida;
				productos[i][5]= talle;
				productos[i][6]= color;
				productos[i][7]= aroma;
				productos[i][8]= cant;
				productos[i][9]= llego;
				productos[i][10]= tipomedida_desc;
				productos[i][11]= talle_desc;
				productos[i][12]= color_desc;
				productos[i][13]= aroma_desc;
				productos[i][14]= familia;

		  }
		// fin for
		{ignore:":not(:visible)"} // con esta propiedad saltea los campos que no estan visibles.
		{ignore: ":disabled"} // con esta propiedad saltea los campos que no estan activos.

			var tipoaccion = $('#tipo_accion').val();	
			var url = '';
			var tipo = '';
			var tipo2 = '';

			if(tipoaccion == 1){
				url = 'pedido/guardar';
				tipo = 'guardó';
			}else if(tipoaccion == 2){
				url = 'pedido/modificar';
				tipo = 'modificó';
				if($('#tipo_accion_mod').val() == 'finalizados'){
					tipo2 = 'si';
				}
				
			}	
		//$('#btn-formulario').prop('disabled',true);	
		// console.log(productos);
		// return false;
		setTimeout(function() { 

		$.ajax({
		type: "POST",
		url: url,
		dataType: 'json',
		data: {
			idp : $('#id_pedido').val(),
			array: productos,
			cliente : $('#cliente_id').val(),
			envio : $('#tipo_envio option:selected').val(),
			usu:  $('#usuario_id').val(),
			fechac: $('#fecha_cierre').val(),
			fpago: $('#tipo_pago option:selected').val(),
			tipod: $('#tipo_descuento_pedido option:selected').val(),
			total: $('#total_pedido').val(),
			senia: $('#senia_pedido').val(),
			descuentop: $('#descuento_pedido_porc option:selected').val(),
			descuentoc: $('#descuento_pedido_cant').val(),
			fechap: '',
			observacion: $('#observacion').val(),
		},
		success: function (r) {

			if(r.exito == true){

				TablePedidos.clear().draw();   

				$('#cod2').val(1);

				$('#myModalPedido').modal('hide');

				toastr.success('Se '+tipo+' con éxito'); 

				$('#btn-formulario').prop('disabled',false);	

				if(tipo2 == 'si'){

					listadoPedidosFinalizados();

				}else{

					listadoPedidos();
				}

				
		}else{

			toastr.error(r.error.mensaje); 
			$('#btn-formulario').prop('disabled',false);	
			
		}

		}
	  });
	}, 1000);	   
	},
	rules: {  //reglas

		cliente: {
		   required: true,
		},
		tipo_envio: {
			valueNotEquals: "default" ,
		 },
		 tipo_pago: {
			valueNotEquals: "default" ,
		 },
		 tipo_descuento_pedido: {
			valueNotEquals: "default" 
		 },
		 loc_form_add: {
			valueNotEquals: "default" ,
		 },
		 total_pedido: {
			required: true,
		 },
		 senia_pedido : {
			number: true,
		 }             
   },   

	messages: { // mensajes si falla

		cliente: {
			required: 'campo requerido',
		 },
		 tipo_envio: {
			valueNotEquals: 'debe seleccionar',
		  },
		  tipo_pago: {
			valueNotEquals: 'debe seleccionar',
		  },
		  tipo_descuento_pedido: {
			valueNotEquals: 'debe seleccionar',
		  },
		  loc_form_add: {
			valueNotEquals: 'debe seleccionar',
		  },
		  total_pedido: {
			required: 'campo requerido',
		  },
		  senia_pedido : {
			number: 'campo numérico',
		 }   
	},
	errorElement: 'span',
	errorClass: 'help-block span',
	highlight: function (element, errorClass, validClass) {
	$(element).addClass('is-invalid');
	},
	unhighlight: function (element, errorClass, validClass) {
		$(element).removeClass('is-invalid');
	},
	invalidHandler: function (event, validator) {
		toastr.error('Compruebe los campos');
	},
});  
// fin ALTA //

// MOD ESTADO //   
$('#form_estado_cliente').validate({
           
	submitHandler: function (form) {
		// cuando va bien
		$.ajax({
		type: "POST",
		url: 'pedido/mod_estado',
		dataType: 'json',
		data: {
			id : $('#pedido_id').val(),
			estado : $('#estado_id option:selected').val(),
		},
		success: function (r) {

			if(r.exito == true){

				TablePedidos.clear().draw();   

				listadoPedidos();
				listadoPedidosFinalizados();

				$('#cod2').val(1);

				$('#myModalEstados').modal('hide');

				toastr.success('Se modificó con éxito'); 

		}else{

			toastr.error(r.error.mensaje); 
		}

		}
	});
	   
	},
	rules: {

	            
   },   

	messages: {

	},
	errorElement: 'span',
	errorClass: 'help-block span',
	highlight: function (element, errorClass, validClass) {
	$(element).addClass('is-invalid');
	},
	unhighlight: function (element, errorClass, validClass) {
		$(element).removeClass('is-invalid');
	},
	invalidHandler: function (event, validator) {
		toastr.error('Compruebe los campos');
	},
}); 

// fin MOD ESTADO //
	$(document).on("click","#pedidos-tab", function(event){
		listadoPedidos();
		$('#tipo_accion_mod').val('actuales');
	});
	$(document).on("click","#pedidos-finalizados", function(event){
		listadoPedidosFinalizados();
		$('#tipo_accion_mod').val('finalizados');
	});

});


function clientes_listado(){

	function obtenerClientes_(){
		return new Promise(function(resolve, reject){
			$.ajax({
				type: "POST",
				url: "cli/listado_autocompletar",
				dataType: 'json',
				data: {
				},
			}).done(resolve).fail(reject);
		});
	}
	// fin de función
	// realizo las acciones correspondiente dependiendo de la promesa de completar la busqueda
	obtenerClientes_().then(
		function resolve(data) {
			clientes = data.listado;
		 
			$('#cliente').autocomplete({
			   
				minLength: 0,
				source: clientes,
				// eventos del autocompletar
				select : function (event, ui) {
					$('#cliente').val(ui.item.label); // display the selected text
					$('#cliente_id').val(ui.item.value); // save selected id to hidden input
					// una vez obtenido el id del organismo se lo pasamos como parametro a la funcion para buscar la autoridad
					var id = ui.item.value;
					// console.log(id);
				   // getAutoridades(id);
				   $('#cliente').prop('disabled',true);
						 $('#modificar-cli').show();
					return false;
				},
				focus: function (event, ui) {
						 $('#cliente').val(ui.item.label); // display the selected text
						 $('#cliente_id').val(ui.item.value); // save selected id to hidden input
						 // una vez obtenido el id del organismo se lo pasamos como parametro a la funcion para buscar la autoridad
						 var id = ui.item.value;
						 
						return false;
				},
				change: function( event, ui ) {
					 $( "#cliente_id" ).val( ui.item? ui.item.value : 0 );
					 $('#cliente').prop('disabled',true);
					 $('#modificar-cli').show();
					 
					 
				} 
			 });
		
		},
		function reject(reason) {
			console.log('Error en el proceso');
			console.log(reason);
		}
	);
	// fin de las acciones de cliente

};



