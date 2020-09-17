var f = new Date(); // fecha para mostrar en los archivos de export 
Table = $('#table_clientes').DataTable({
    dom: 'Bfrtip',
    buttons: [
        {
            
            extend:    'pdfHtml5',
            text:      '<i class="fa fa-file-pdf AzulChicoBtb"></i>',
            titleAttr: 'PDF',
            message: 'Listado de clientes. Fecha de impresión ('+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+')',
            download: 'open',
            title: 'Clientes'
        },
        {
            extend: 'print',
            text:      '<i class="fa fa-print AzulChicoBtb" ></i>',
            titleAttr: 'Imprimir',
            message: 'Listado de clientes. Fecha de impresión ('+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+')',
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
             "width": "10%",
             "className": "dt-center",
       },{
            "targets": 1, // your case first column
            "className": "text-center",
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
        }
    ],            

    
  });

  function clientesAll(){

    $.ajax({
        type: "POST",
        url: "cli/listado",
        dataType: 'json',
        data: {
        },
        success: function (r) {
    
            console.log(r);
    
            $.each(r.listado,function(idx, value){
    
                var btn_edit = "<button class='btn btn-primary btn-xs edit_cliente' id='"+value.id+"' title='ver detalle'><i class='fas fa-info-circle'></i></button>";
               // var btn_troquel = "<button class='btn btn-secondary btn-xs troquel_cliente' id='"+value.id+"'><i class='far fa-file-pdf'></i></button>";
               
                btntroquel = "<button class='btn btn-secondary btn-xs troquel_cliente' id='"+value.id+"' title='ver troquel de envío'><i class='fas fa-map-marked-alt'></i></button>";
                Table.row.add( [
                    '<strong>'+value.nro_cliente+'<strong>',
                    value.apellido+', '+value.nombre,
                    value.dni,
                    value.fecha_nacimiento,
                    value.localidad_desc,
                    btn_edit+' '+btntroquel 
                    ]).draw();
            });
    
        }
    
      });
  }

  function localidadesAll(){

    $.ajax({
        type: "POST",
        url: "cli/localidades",
        dataType: 'json',
        data: {
        },
        success: function (r) {

            $.each(r.listado, function (i, item) {
                $('#loc_form').append($('<option>', { 
                    value: item.id,
                    text : item.descripcion 
                }));
            });
    
        }
    
      });
  }

  function localidadesAllAdd(){

    $.ajax({
        type: "POST",
        url: "cli/localidades",
        dataType: 'json',
        data: {
        },
        success: function (r) {

            $.each(r.listado, function (i, item) {
                $('#loc_form_add').append($('<option>', { 
                    value: item.id,
                    text : item.descripcion 
                }));
            });
    
        }
    
      });
  }

  $(document).ready(function(){

    clientesAll();
    localidadesAll();

    $(document).on("click","#nuevo_cliente", function(event){

         $('#loc_form_add').val('default');
         $('.campos_alta').val('');
         $('.campos_alta').removeClass('is-invalid');
        localidadesAllAdd();

        $('#modal_alta_cliente').modal('show');

    });
    

    $(document).on("click",".edit_cliente", function(event){    

        $.ajax({
            type: "POST",
            url: "cli/buscar_id",
            dataType: 'json',
            data: {

                id_cliente: this.id,
            },
            success: function (r) {
        
        
                $.each(r.listado,function(idx, value){
        
                 $('#nro_form').val(value.nro_cliente);
                 $('#nom_form').val(value.nombre);
                 $('#ape_form').val(value.apellido);
                 $('#dni_form').val(value.dni);
                 $('#nac_form').val(value.nac);
                 $('#loc_form').val(value.localidad_id);
                 $('#dom_form').val(value.domicilio);
                 $('#telefono_form').val(value.telefono);
                 $('#correo_form').val(value.correo);
    
                });
        
            }
        
          });
          $('#identificador').val(this.id);
          $('.campos-edit').removeClass('is-invalid');
          $('#modal_cliente').modal('show');

    });

    $(document).on("click",".troquel_cliente", function(event){    
        
        $.ajax({
            type: "POST",
            url: "cli/buscar_id",
            dataType: 'json',
            data: {

                id_cliente: this.id,
            },
            success: function (r) {
        
        
                $.each(r.listado,function(idx, value){

                    $('#nro').val(value.nro_cliente);
                    $('#localidad').val(value.localidad_desc);
                    $('#nombre').val(value.nombre);
                    $('#apellido').val(value.apellido);
                    $('#telefono').val(value.telefono);
                    $('#domicilio').val(value.domicilio);

                   
                    //$('#foot').append(botonPDF);
                    $('#title-troquel').html('Nº cliente: '+value.nro_cliente);
                    $('#nombre-troquel').html(value.apellido+', '+value.nombre);
                });

        
            }
        
          });

        $('#saldo_form').val('');
        $('#saldo_form').val(0);
        $('#saldo_form').removeClass('is-invalid');
         $('#myModalTroquel').modal('show');

     //   window.open('troquel','_blank','width=600,height=400');

    });

    $(document).on("click","#pdftroquel", function(event){    
    
        var saldo = $('#saldo_form').val();
        $('#saldo').val(saldo);
        $('#form-pfd').submit();

    });

     // validar los select //
    $.validator.addMethod("valueNotEquals", function(value, element, arg){
        return arg !== value;
       }, "Value must not equal arg.");
     
       // ALTA //   
       $('#form_nuevo_cliente').validate({
           
        submitHandler: function (form) {
            // cuando va bien

            //$('#body-cards-dias').empty();
            //$('#msj-error').hide();
            {ignore:":not(:visible)"} // con esta propiedad saltea los campos que no estan visibles.
            {ignore: ":disabled"} // con esta propiedad saltea los campos que no estan activos.
            
            // seteamos estos campos ocultos para luego realizar las consultas
            // $('#ttur_').val($('#tipo_turno option:selected').val());
            // $('#entidad_').val($('#oficina').val());
            // $('#mes_').val($('#mes').val());
            // $('#anio_').val($('#anio').val());
            // fin
                     
            $.ajax({
            type: "POST",
            url: 'cli/guardar',
            dataType: 'json',
            data: {
                nro : $('#nro_form_add').val(),
                nom : $('#nom_form_add').val(),
                ape: $('#ape_form_add').val(),
                dni: $('#dni_form_add').val(),
                nac: $('#nac_form_add').val(),
                dom: $('#dom_form_add').val(),
                loc: $('#loc_form_add option:selected').val(),
                tel: $('#telefono_form_add').val(),
                correo: $('#correo_form_add').val(),
            },
            success: function (r) {
                
                               


                if(r.exito == true){

                    Table.clear().draw();   

                    clientesAll();

                    $('#modal_alta_cliente').modal('hide');

                    toastr.success('Se guardó con éxito'); 

            }else{

                toastr.error(r.error.mensaje); 
            }
    
            }
        });
           
        },
        rules: {

            nro_form_add: {
               required: true,
               number: true,
               minlength: 1,
               maxlength: 5,
            },
            nom_form_add: {
                required: true,
             },
            ape_form_add: {
                required: true,
             },
            dni_form_add: {
                required: true,
                number: true,
                minlength: 7,
                maxlength: 8,
             },
             loc_form_add: {
                valueNotEquals: "default" ,
             },
             telefono_form_add: {
                number: true,
             },
             correo_form_add:{
                email: true,
             }             
       },   
    
        messages: {
    
            nro_form_add: {
                required: 'campo requerido',
                number: 'campo numérico',
                minlength: 'mínimo 1',
                maxlength: 'máximo 5',
             },
             nom_form_add: {
                 required: 'campo requerido',
              },
             ape_form_add: {
                 required: 'campo requerido',
              },
             dni_form_add: {
                 required: 'campo requerido',
                 number: 'campo numérico',
                 minlength: 'mínimo 7',
                 maxlength: 'máximo 8',
              },
              loc_form_add: {
                 valueNotEquals: 'debe seleccionar',
              },
              telefono_form_add: {
                number: 'campo numérico',
             },
              correo_form_add:{
                 email: 'correo incorrecto',
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

     // MODIFICAR //   
     $('#form_mod_cliente').validate({
           
        submitHandler: function (form) {
            // cuando va bien

            //$('#body-cards-dias').empty();
            //$('#msj-error').hide();
            {ignore:":not(:visible)"} // con esta propiedad saltea los campos que no estan visibles.
            {ignore: ":disabled"} // con esta propiedad saltea los campos que no estan activos.
            
            // seteamos estos campos ocultos para luego realizar las consultas
            // $('#ttur_').val($('#tipo_turno option:selected').val());
            // $('#entidad_').val($('#oficina').val());
            // $('#mes_').val($('#mes').val());
            // $('#anio_').val($('#anio').val());
            // fin
                     
            $.ajax({
            type: "POST",
            url: 'cli/modificar',
            dataType: 'json',
            data: {
                id_cli : $('#identificador').val(),
                nro : $('#nro_form').val(),
                nom : $('#nom_form').val(),
                ape: $('#ape_form').val(),
                dni: $('#dni_form').val(),
                nac: $('#nac_form').val(),
                dom: $('#dom_form').val(),
                loc: $('#loc_form option:selected').val(),
                tel: $('#telefono_form').val(),
                correo: $('#correo_form').val(),
            },
            success: function (r) {
                

                if(r.exito == true){

                    Table.clear().draw();   

                    clientesAll();

                    $('#modal_cliente').modal('hide');

                    toastr.success('Se modificó con éxito'); 

            }else{

                toastr.error(r.error.mensaje); 
            }
    
            }
        });
           
        },
        rules: {

            nro_form: {
               required: true,
               number: true,
               minlength: 1,
               maxlength: 5,
            },
            nom_form: {
                required: true,
             },
            ape_form: {
                required: true,
             },
            dni_form: {
                required: true,
                number: true,
                minlength: 7,
                maxlength: 8,
             },
             loc_form: {
                valueNotEquals: "default" ,
             },
             correo_form:{
                email: true,
             },
             telefono_form:{
                number: true,
             }              
       },   
    
        messages: {
    
            nro_form: {
                required: 'campo requerido',
                number: 'campo numérico',
                minlength: 'mínimo 1',
                maxlength: 'máximo 5',
             },
             nom_form: {
                 required: 'campo requerido',
              },
             ape_form: {
                 required: 'campo requerido',
              },
             dni_form: {
                 required: 'campo requerido',
                 number: 'campo numérico',
                 minlength: 'mínimo 7',
                 maxlength: 'máximo 8',
              },
              loc_form: {
                 valueNotEquals: 'debe seleccionar',
              },  
              correo_form:{
                email: 'correo incorrecto',
             },
             telefono_form:{
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
    // fin MODIFICAR //

  });