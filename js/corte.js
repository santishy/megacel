$(document).ready( function () {
    $('#tablaCorte').dataTable( {
        "bJQueryUI": true,
        "sDom": 'T<"clear">lfrtip',
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "bSort": false,
        "bInfo": false,
        "bAutoWidth": true,
        "oLanguage": {
            "sSearch":"Búsqueda",
        },
        "oTableTools": {
            "aButtons": [ 
                    {
                    "sExtends": "copy",
                        "sButtonText": "Copiar  |"
                    },
                    {
                        "sExtends": "xls",
                        "sButtonText": "Excel  |"
                    },
                    {
                        "sExtends": "pdf",
                        "sButtonText": "Pdf  |"
                    },
                    {
                        "sExtends":"print",
                        "sButtonText":"Imprimir tamaño carta"
                    }
            ]

        }
        
    } );

    $('#imp').click(function(){
                
                
                var ventimp=window.open(' ','popimpr');
                ventimp.document.write(tablaCorteTicket.outerHTML);
                ventimp.document.close();
                ventimp.print();
                ventimp.close();
            });

} );