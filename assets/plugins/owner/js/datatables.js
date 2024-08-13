
$('#tablaDatos').DataTable( {
        dom: "<'row'<'col-sm-5'B><'col-sm-3'l><'col-sm-4'f>>"+
                "<'row'<'col-sm-12'tr>>"+
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                {
                    text: '<i class="bi-plus-lg"></i>',
                    className: 'btn btn-light border border-success',
                    attr: {
                        id: 'btnInsertar',
                        onclick: 'gestionRegistro(this);',
                        'data-accion': 'insertarRegistro'
                    }
                },
                {
                    extend:    'copyHtml5',
                    text:      '<i class="fa-regular fa-copy"></i>',
                    className: 'btn btn-light border border-primary',
                    titleAttr: 'Copiar'
                },
                {
                    extend:    'excelHtml5',
                    text:      '<i class="fas fa-file-excel"></i>',
                    className: 'btn btn-light border border-primary',
                    titleAttr: 'Excel'
                },
                {
                    extend:    'pdfHtml5',
                    text:      '<i class="fa-regular fa-file-pdf"></i>',
                    className: 'btn btn-light border border-primary',
                    titleAttr: 'PDF'
                },
                {
                    extend: 'print',
                    text: '<i class="bi-printer"></i>',
                    className: 'btn btn-light border border-primary',
                    titleAttr: 'Imprimir',
                    autoPrint: false
                },
                {
                    text: '<i class="bi-youtube"></i>',
                    className: 'btn btn-light border border-primary',
                    attr: {
                        id: 'btnYoutube'
                    },
                    action: function(e, dt, node, config){
                        var win = window.open("https://youtube.com", '_blank');
                        win.focus();
                    }
                }
            ],
        language:{
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        "scrollCollapse": true,
        "paging":         true,
        "fnDrawCallback": function() {
        //jQuery('.switch').bootstrapToggle();
        },
        initComplete: function (settings, json) {
        },


} );

