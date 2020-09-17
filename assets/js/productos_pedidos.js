var f = new Date(); // fecha para mostrar en los archivos de export 
TableProdPed = $('#table_productos_pedidos').DataTable({
    dom: 'Bfrtip',
    buttons: [
        {
            extend: 'excel',
            text:      '<i class="fa fa-file-excel AzulChicoBtb"></i>',
       },
        {
            
            extend:    'pdfHtml5',
            text:      '<i class="fa fa-file-pdf AzulChicoBtb"></i>',
            titleAttr: 'PDF',
            message: 'Listado de productos pedidos. Fecha de impresión ('+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+')',
            download: 'open',
            title: 'Productos'
        },
        {
            extend: 'print',
            text:      '<i class="fa fa-print AzulChicoBtb" ></i>',
            titleAttr: 'Imprimir',
            message: 'Listado de productos pedidos. Fecha de impresión ('+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+')',
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
            "width": "25%",
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
            "width": "15%",
            "className": "dt-center",
        },{
            "targets": 5, // your case first column
            "className": "text-left",
            "width": "10%",
            "className": "dt-center",
        },{
            "targets": 6, // your case first column
            "className": "text-left",
            "width": "10%",
            "className": "dt-center",
        },{
            "targets": 7, // your case first column
            "className": "text-left",
            "width": "10%",
            "className": "dt-center",
        },{
            "targets": 8, // your case first column
            "className": "text-center",
            "width": "5%",
            "className": "dt-center",
        }
    ],            

    
  });

  function productosPedidosAll(){

    $('#searchicon').show();
    $('#divsearchicon').show();

    $.ajax({
    type: "POST",
    url: "pedido/productospedidos",
    dataType: 'json',
    data: {
    },
    success: function (r) {

       // console.log(r);
       $('#searchicon').hide(1000);
       $('#divsearchicon').hide(1000);

        $.each(r.listado,function(idx, value){

            var med = '';
            if(value.medida_prod != 0){
                med = value.medida_prod+'-'+value.tipomedida;
            }
            TableProdPed.row.add( [
                '<strong>'+value.codigo_prod+'</strong>',
                value.DESCRIPCION,
                med,
                value.talle,
                value.color,
                value.aroma,
                '<strong>'+value.FAMILIA+'</strong>',
                '<span class="adge badge-pill badge-info">'+value.cantidad+'</span>',
                value.nro_cliente
                ]).draw();
        });

    }

  });

}


$(document).ready(function(){

    productosPedidosAll();

})