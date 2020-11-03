var f = new Date(); // fecha para mostrar en los archivos de export 
Table = $('#table_productos_stock').DataTable({
    dom: 'Bfrtip',
    buttons: [
        {
            
            extend:    'pdfHtml5',
            text:      '<i class="fa fa-file-pdf AzulChicoBtb"></i>',
            titleAttr: 'PDF',
            message: 'Listado de productos con stock. Fecha de impresión ('+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+')',
            download: 'open',
            title: 'Productos con stock'
        },
        {
            extend: 'print',
            text:      '<i class="fa fa-print AzulChicoBtb" ></i>',
            titleAttr: 'Imprimir',
            message: 'Listado de productos con stock. Fecha de impresión ('+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+')',
            messageBottom: null,
            title: 'Productos con stock'
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
             "width": "5%",
             "className": "dt-right",
       },{
            "targets": 1, // your case first column
            "className": "text-left",
            "width": "25%",
        },{
            "targets": 2, // your case first column
            "className": "text-center",
            "width": "7%",
        },{
            "targets": 3, // your case first column
            "className": "text-center",
            "width": "9%",
        },{
            "targets": 4, // your case first column
            "className": "text-left",
            "width": "7%",
            "className": "dt-center",
        },{
            "targets": 5, // your case first column
            "className": "text-left",
            "width": "7%",
            "className": "dt-center",
        },{
            "targets": 6, // your case first column
            "className": "text-left",
             "width": "15%",
             "className": "dt-center",
       },{
            "targets": 7, // your case first column
            "className": "text-center",
             "width": "5%",
             "className": "dt-center",
       },{
            "targets": 8, // your case first column
            "className": "text-center",
            "width": "5%",
            "className": "dt-center",
        },{
            "targets": 9, // your case first column
            "className": "text-left",
            "width": "5%",
            "className": "dt-center",
        },{
            "targets": 10, // your case first column
            "className": "text-left",
            "width": "5%",
            "className": "dt-center",
        }
    ],            

    
  });
  

  var f = new Date(); // fecha para mostrar en los archivos de export 
  Table2 = $('#table_productos_sin_stock').DataTable({
    dom: 'Bfrtip',
    buttons: [
        {
            
            extend:    'pdfHtml5',
            text:      '<i class="fa fa-file-pdf AzulChicoBtb"></i>',
            titleAttr: 'PDF',
            message: 'Listado de productos con stock. Fecha de impresión ('+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+')',
            download: 'open',
            title: 'Productos sin stock'
        },
        {
            extend: 'print',
            text:      '<i class="fa fa-print AzulChicoBtb" ></i>',
            titleAttr: 'Imprimir',
            message: 'Listado de productos con stock. Fecha de impresión ('+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+')',
            messageBottom: null,
            title: 'Productos sin stock'
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
             "width": "5%",
             "className": "dt-right",
       },{
            "targets": 1, // your case first column
            "className": "text-left",
            "width": "25%",
        },{
            "targets": 2, // your case first column
            "className": "text-center",
            "width": "7%",
        },{
            "targets": 3, // your case first column
            "className": "text-center",
            "width": "9%",
        },{
            "targets": 4, // your case first column
            "className": "text-left",
            "width": "7%",
            "className": "dt-center",
        },{
            "targets": 5, // your case first column
            "className": "text-left",
            "width": "7%",
            "className": "dt-center",
        },{
            "targets": 6, // your case first column
            "className": "text-left",
             "width": "15%",
             "className": "dt-center",
       },{
            "targets": 7, // your case first column
            "className": "text-center",
             "width": "5%",
             "className": "dt-center",
       },{
            "targets": 8, // your case first column
            "className": "text-center",
            "width": "5%",
            "className": "dt-center",
        },{
            "targets": 9, // your case first column
            "className": "text-left",
            "width": "5%",
            "className": "dt-center",
        },{
            "targets": 10, // your case first column
            "className": "text-left",
            "width": "5%",
            "className": "dt-center",
        }
    ],            

    
  });

  function productosSinStockAll(){

    $('#divsearchicon').show();

    $.ajax({
    type: "POST",
    url: "prod_stock/listado_sin_stock",
    dataType: 'json',
    data: {
    },
    success: function (r) {

     //   console.log(r);
     $('#divsearchicon').hide();
        Table2.clear().draw();   

        $.each(r.listado,function(idx, value){


           var btn_edit = "<button class='btn btn-primary btn-xs edit' id='"+value.ID+"'><i class='fas fa-info'></i></button>";
           var btn_delete = "<button class='btn btn-danger btn-xs delete' name='"+value.CODIGO+"*"+value.DESCRIPCION+"' id='"+value.ID+"'><i class='far fa-trash-alt'></i></button>";
            var med_desc = '';
            var med = '';
            var color_punto = 'orange';
            var color_stock = 'green';

            if(value.MEDIDA_DESC != null){
                 med_desc = value.MEDIDA_DESC;
            }
            if(value.MEDIDA != 0){
                med = value.MEDIDA;
           }

           if(parseInt(value.punto_reposicion) > parseInt(value.stock)){

                var color_punto = 'red';
                var color_stock = 'red';
            }

            Table2.row.add( [
                value.CODIGO,
                value.DESCRIPCION,
                med+' '+med_desc,
                value.AROMAS,
                value.TALLES,
                value.COLOR,
                '<strong>'+value.FAMILIA+'</strong>',
                '$ '+value.PRECIO_COSTO,
                value.PRECIO_SUGERIDO,
                '<font color="'+color_stock+'"><strong>'+value.stock+'</strong></font>',
                btn_edit+' '+btn_delete
                ]).draw();
        });

    }

  });

}


  function productosStockAll(){

    

    Table.clear().draw(); 
    $('#divsearchicon').show();

    $.ajax({
    type: "POST",
    url: "prod_stock/listado",
    dataType: 'json',
    data: {
    },
    success: function (r) {

     //   console.log(r);
     $('#divsearchicon').hide();

        $.each(r.listado,function(idx, value){


            var btn_edit = "<button class='btn btn-primary btn-xs edit' id='"+value.ID+"'><i class='fas fa-info'></i></button>";
            var btn_delete = "<button class='btn btn-danger btn-xs delete' name='"+value.CODIGO+"*"+value.DESCRIPCION+"' id='"+value.ID+"'><i class='far fa-trash-alt'></i></button>";
            var med_desc = '';
            var med = '';
            var color_punto = 'orange';
            var color_stock = 'green';

            if(value.MEDIDA_DESC != null){
                 med_desc = value.MEDIDA_DESC;
            }
            if(value.MEDIDA != 0){
                med = value.MEDIDA;
           }

           if(parseInt(value.punto_reposicion) > parseInt(value.stock)){

                var color_punto = 'red';
                var color_stock = 'red';
            }

            Table.row.add( [
                value.CODIGO,
                value.DESCRIPCION,
                med+' '+med_desc,
                value.AROMAS,
                value.TALLES,
                value.COLOR,
                '<strong>'+value.FAMILIA+'</strong>',
                '$ '+value.PRECIO_COSTO,
                value.PRECIO_SUGERIDO,
                '<font color="'+color_stock+'"><strong>'+value.stock+'</strong></font>',
                btn_edit+' '+btn_delete
                ]).draw();
        });

    }

  });

}

$(document).ready(function(){

    productosStockAll();
    familiasAll();


    // alta //
    $(document).on("click","#nuevo-prod", function(event){

        $('.inp-form').removeClass('is-invalid');
        $('.span').hide();

        $('#id_producto').val('');
        $('#codigo_form').val('');
        $('#desc_form').val('');
        $('#familia_form').val(1);
        $('#med_form').val('');
        $('#med_tipo_form').val('');
        $('#talle_form').val('');
        $('#color_form').val('');
        $('#aroma_form').val('');
        $('#costo_form').val('');
        $('#sugerido_form').val('');
        $('#reposicion_form').val('0');
        $('#stock_form').val('0');

        $('#tipo_accion').val(1);
        
        $('#exampleModalLongTitleProd').html('Nuevo Producto');
        $('#accion-modal').html('Guardar');
        $('#modal_producto').modal('show');

    });

    // editamos //
    $(document).on("click",".edit", function(event){

        $('.inp-form').removeClass('is-invalid');
		$('.span').hide();

        $.ajax({
            type: "POST",
            url: "prod/buscar_stock_id",
            dataType: 'json',
            data: {
                id_producto: this.id,
            },
            success: function (r) {
        
        
                $.each(r.listado,function(idx, value){
                    
                 $('#id_producto').val(value.ID);
                 $('#codigo_form').val(value.CODIGO);
                 $('#desc_form').val(value.DESCRIPCION);
                 $('#familia_form').val(value.FAMILIA_ID);
                 $('#med_form').val(value.MEDIDA);
                 $('#med_tipo_form').val(value.MEDIDA_DESC);
                 $('#talle_form').val(value.TALLES);
                 $('#color_form').val(value.COLOR);
                 $('#aroma_form').val(value.AROMAS);
                 $('#costo_form').val(value.PRECIO_COSTO);
                 $('#sugerido_form').val(value.PRECIO_SUGERIDO);
                 $('#reposicion_form').val(value.punto_reposicion);
                 $('#stock_form').val(value.stock);

                });
        
            }
        
          });

          $('#tipo_accion').val(2);
          $('#exampleModalLongTitleProd').html('Detalle del producto');
          $('#accion-modal').html('Modificar');
          $('#modal_producto').modal('show');

    });

     // ALTA/MODIFICAR PRODUCTO //   
     $('#form_producto_stock').validate({
           
        submitHandler: function (form) {
            // cuando va bien
            {ignore:":not(:visible)"} // con esta propiedad saltea los campos que no estan visibles.
            {ignore: ":disabled"} // con esta propiedad saltea los campos que no estan activos.
            
            var url = 'prod/alta_stock';
            var msj = '';

            if($('#tipo_accion').val() == 1){
                url = 'prod/alta_stock'; 
                msj = 'Se guardó con éxito!'; 
            }else if($('#tipo_accion').val() == 2){
                url = 'prod/modifcar_stock'; 
                msj = 'Se modificó con éxito!'; 
            }
            
            $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                idp : $('#id_producto').val(),
                cod : $('#codigo_form').val(),
                desc: $('#desc_form').val(),
                familia: $('#familia_form option:selected').val(),
                med: $('#med_form').val(),
                tipo_med: $('#med_tipo_form').val(),
                talle: $('#talle_form').val(),
                color: $('#color_form').val(),
                aroma: $('#aroma_form').val(),
                costo: $('#costo_form').val(),
                sugerido: $('#sugerido_form').val(),
                repo: $('#reposicion_form').val(),
                stock: $('#stock_form').val(),
            },
            success: function (r) {
                
                    if(r.exito == true){

                        Table.clear().draw();

                        productosStockAll();
                        productosSinStockAll();

                        $('#modal_producto').modal('hide');

                        toastr.success(msj); 

                    }else{

                        toastr.error(r.error.mensaje); 
                    }
    
            }
        });
           
        },
        rules: {

            codigo_form: {
               required: true,
            },
            desc_form: {
                required: true,
             },
             familia_form: {
                required: true,
             },
             med_form: {
                number: true,
             },
             costo_form: {
                required: true,
                number: true,
             },
             sugerido_form: {
                required: true,
                number: true,
             },
             reposicion_form: {
                required: true,
                number: true,
             },
             stock_form: {
                required: true,
                number: true,
             }               
       },   
    
        messages: {

            codigo_form: {
                required: 'campo requerido',
             },
             desc_form: {
                 required: 'campo requerido',
              },
              familia_form: {
                 required: 'campo requerido',
              },
              med_form: {
                 number: 'campo numérico',
              },
              costo_form: {
                 required: 'campo requerido',
                 number: 'campo numérico',
              },
              sugerido_form: {
                 required: 'campo requerido',
                 number: 'campo numérico',
              },
              reposicion_form: {
                 required: 'campo requerido',
                 number: 'campo numérico',
              },
              stock_form: {
                 required: 'campo requerido',
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
    // fin ALTA/MODIFICAR PRODUCTO //

    $(document).on("click",".delete", function(event){

        var cod = this.name.split('*')[0];
        var desc = this.name.split('*')[1];
		$('#producto_id_eliminar').val(this.id);
		$('#titleModalTitle_delete').html('Producto: '+cod);
		$('#nombreModalEstado_delete').html(desc);

		$('#myModalDelete').modal('show');
		
		
    });
    
    
    $(document).on("click","#eliminar_producto", function(event){

        var idp = $('#producto_id_eliminar').val();
        
        $.ajax({
            type: "POST",
            url: "prod/delete_prod_stock",
            dataType: 'json',
            data: {
                id_producto: idp,
            },
            success: function (r) {

                if(r.exito == true){
                    
                    Table.clear().draw();   
                    
                    productosStockAll();
                    productosSinStockAll();

                    $('#myModalDelete').modal('hide');

                    toastr.success('Se eliminó con éxito'); 


                }else{

                    toastr.error(r.error.mensaje); 

                }
        
        
            }
        
          });
		
		
    });

    $(document).on("click","#prod-tab", function(event){
        productosStockAll();
    });

    $(document).on("click","#prod-sin-tab", function(event){
        productosSinStockAll();
    });

});