var f = new Date(); // fecha para mostrar en los archivos de export 
Table = $('#table_productos').DataTable({
    dom: 'Bfrtip',
    buttons: [
        {
            
            extend:    'pdfHtml5',
            text:      '<i class="fa fa-file-pdf AzulChicoBtb"></i>',
            titleAttr: 'PDF',
            message: 'Listado de productos. Fecha de impresión ('+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+')',
            download: 'open',
            title: 'Productos'
        },
        {
            extend: 'print',
            text:      '<i class="fa fa-print AzulChicoBtb" ></i>',
            titleAttr: 'Imprimir',
            message: 'Listado de productos. Fecha de impresión ('+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+')',
            messageBottom: null
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
            "width": "34%",
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
            "className": "text-left",
            "width": "20%",
            "className": "dt-center",
        },{
            "targets": 5, // your case first column
            "className": "text-left",
            "width": "8%",
            "className": "dt-center",
        },{
            "targets": 6, // your case first column
            "className": "text-left",
             "width": "8%",
             "className": "dt-center",
       },{
            "targets": 7, // your case first column
            "className": "text-left",
             "width": "5%",
             "className": "dt-center",
       }
    ],            

    
  });

function productosAll(){

    $.ajax({
    type: "POST",
    url: "prod/listado",
    dataType: 'json',
    data: {
    },
    success: function (r) {

        console.log(r);

        $.each(r.listado,function(idx, value){

            var btn_edit = "<button class='btn btn-primary btn-xs edit' id='"+value.ID+"'><i class='fas fa-info'></i></button>";

            Table.row.add( [
                value.CODIGO,
                value.DESCRIPCION,
                value.MEDIDA,
                value.TALLES,
                '<strong>'+value.FAMILIA+'</strong>',
                '$ '+value.PRECIO_COSTO,
                '$ '+value.PRECIO_SUGERIDO,
                btn_edit
                ]).draw();
        });

    }

  });

}

function familiasAll(){

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

function familiasAllBusqueda(){

    $.ajax({
    type: "POST",
    url: "prod/familias",
    dataType: 'json',
    data: {
    },
    success: function (r) {

        $.each(r.listado,function(idx, value){

            $('#familias').append($('<option>', { 
                value: value.id,
                text : value.descripcion 
            }));

        });

    }

  });

}


$(document).ready(function(){

    $('.input-modal').prop('disabled',false);

    $(document).on("click",".edit", function(event){

        $('.inp-form').removeClass('is-invalid');
		$('.span').hide();

        familiasAll();
        

        $.ajax({
            type: "POST",
            url: "prod/buscar_id",
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

                });
        
            }
        
          });

          $('#modal_producto').modal('show');

    });


    //productosAll();
    familiasAllBusqueda();
    listasAll();

     // validar los select //
     $.validator.addMethod("valueNotEquals", function(value, element, arg){
        return arg !== value;
       }, "Value must not equal arg.");
     
       // MODIFICAR PRODUCTO //   
       $('#form_producto').validate({
           
        submitHandler: function (form) {
            // cuando va bien

            //$('#body-cards-dias').empty();
            //$('#msj-error').hide();
            {ignore:":not(:visible)"} // con esta propiedad saltea los campos que no estan visibles.
            {ignore: ":disabled"} // con esta propiedad saltea los campos que no estan activos.
            
            var url = 'prod/modifcar'; 
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
            },
            success: function (r) {
                
                if(r.exito == true){

                    Table.clear().draw();   

                    $('#modal_producto').modal('hide');

                    toastr.success('Se modificó con éxito'); 

                    $('#searchicon').show();
                    $('#divsearchicon').show();
                    
                    var url = 'prod/buscar_familia'; 
                    $.ajax({
                    type: "POST",
                    url: url,
                    dataType: 'json',
                    data: {
                        familia: $('#familias option:selected').val(),
                        lista: $('#listas option:selected').val(),
                    },
                    success: function (r) {
                        
                        if(r.exito == true){

                            $('#searchicon').hide(1000);
                            $('#divsearchicon').hide(1000);

                            Table.clear().draw(); 
                            
                            $.each(r.listado,function(idx, value){

                                var btn_edit = "<button class='btn btn-primary btn-xs edit' id='"+value.ID+"'><i class='fas fa-info'></i></button>";
                    
                                Table.row.add( [
                                    value.CODIGO,
                                    value.DESCRIPCION,
                                    value.MEDIDA,
                                    value.TALLES,
                                    '<strong>'+value.FAMILIA+'</strong>',
                                    '$ '+value.PRECIO_COSTO,
                                    '$ '+value.PRECIO_SUGERIDO,
                                    btn_edit
                                    ]).draw();
                            });
                        

                    }else{

                        toastr.error(r.error.mensaje); 
                    }
            
                    }
                });
                    

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
             costsugerido_form: {
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
              costsugerido_form: {
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
    // fin MODIFICAR PRODUCTO //

    // BUSCAR PRODUCTOS //
    $('#form-familias').validate({
           
        submitHandler: function (form) {
            // cuando va bien
            $('#searchicon').show();
            $('#divsearchicon').show();
            
            var url = 'prod/buscar_familia'; 
            $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                familia: $('#familias option:selected').val(),
                lista: $('#listas option:selected').val(),
            },
            success: function (r) {
                
                if(r.exito == true){

                    $('#searchicon').hide(1000);
                    $('#divsearchicon').hide(1000);

                    Table.clear().draw(); 
                      
                    $.each(r.listado,function(idx, value){

                        var btn_edit = "<button class='btn btn-primary btn-xs edit' id='"+value.ID+"'><i class='fas fa-info'></i></button>";
            
                        Table.row.add( [
                            value.CODIGO,
                            value.DESCRIPCION,
                            value.MEDIDA,
                            value.TALLES,
                            '<strong>'+value.FAMILIA+'</strong>',
                            '$ '+value.PRECIO_COSTO,
                            '$ '+value.PRECIO_SUGERIDO,
                            btn_edit
                            ]).draw();
                    });
                  

            }else{

                toastr.error(r.error.mensaje); 
            }
    
            }
        });
           
        },
        rules: {

            familias: {
                valueNotEquals: "default" ,
            },
            listas: {
                valueNotEquals: "default" ,
            },
                     
       },   
    
        messages: {

            familias: {
                valueNotEquals: "debe seleccionar!" ,
            },
            listas: {
                valueNotEquals: "debe seleccionar!" ,
            },
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
    // FIN BUSCAR PRODUCTOS //

});