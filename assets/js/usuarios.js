var f = new Date(); // fecha para mostrar en los archivos de export 
TableUsuario = $('#table_usuarios').DataTable({
    dom: 'Bfrtip',
    buttons: [
        {
            
            extend:    'pdfHtml5',
            text:      '<i class="fa fa-file-pdf AzulChicoBtb"></i>',
            titleAttr: 'PDF',
            message: 'Listado de usuarios. Fecha de impresión ('+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+')',
            download: 'open',
            title: 'Usuarios'
        },
        {
            extend: 'print',
            text:      '<i class="fa fa-print AzulChicoBtb" ></i>',
            titleAttr: 'Imprimir',
            message: 'Listado de usuarios. Fecha de impresión ('+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+')',
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
             "width": "20%",
             "className": "dt-center",
       },{
            "targets": 1, // your case first column
            "className": "text-center",
            "width": "30%",
        },{
            "targets": 2, // your case first column
            "className": "text-center",
            "width": "30%",
        },{
            "targets": 3, // your case first column
            "className": "text-center",
            "width": "10%",
        },{
            "targets": 4, // your case first column
            "className": "text-center",
            "width": "10%",
            "className": "dt-center",
        }
    ],            

    
  });

  function usuariosAll(){

    $.ajax({
        type: "POST",
        url: "usu/listado",
        dataType: 'json',
        data: {
        },
        success: function (r) {
    
            console.log(r);
    
            $.each(r.listado,function(idx, value){
    
                TableUsuario.row.add( [
                    value.username,
                    value.nombre,
                    value.apellido,
                    value.dni,
                    value.tipo,
                    ]).draw();
            });
    
        }
    
      });
  }

  $(document).ready(function(){

    usuariosAll();

  });