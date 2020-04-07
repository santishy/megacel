var id=null;
var colNom=null;
var colDir=null;


$(window).on('load',function()
{
   var cargador=$(".cargador");
      cargador.hide();
   var tablaCli=$('#tabla-clientes');
 tablaCli.dataTable({
        "oLanguage": {
            "sLengthMenu": "Mostrar _MENU_ resultados por página",
            "sSearch":"Busqueda",
            'sPaginationType': 'ellipses',
            "sZeroRecords": "No no se encontraron resultados",
            "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ resultados",
            "sInfoEmpty": "Rango de 0 a 0 de 0 resultados",
            "sInfoFiltered": "(Filtrado de _MAX_ registros totales)"

        },
        "bPaginate":false,
        "bLengthChange": true,
        "bFilter": false,
        //"":false,
        "bSort": false,
        "bInfo": false,
        "bAutoWidth": false,
        "bJQueryUI":true
    });
  $(function($){
    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'yy-mm-dd',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
});
 // var ciudad=$("#ciudad");
    var idCli;
    var ren;
   
    var btnEli=$("tr button.btnEliCli");

    var modalCli=$('div#modalCli');
  
    divCli=$('#edi-cli');
    nombre=$('#nombre');
    //correo=$('#correo');
    telefono=$('#telefono');
    //celular=$('#celular');
    direccion=$('#direccion');
    fecha=$('#fecha');
    //estado=$('#estado');
    frmCli=$('#frm-cli')
    /*fecha.datepicker({
      showAnim:"drop",
      showButtonPanel: true
     });*/

  
   //  var colCel=null;
    // var id=null;
    divCli.hide();
    modalCli.dialog({
        autoOpen:false,
            modal:false,
            height:180,
            width:320,
            show: {
        effect: "bounce",
        duration: 600
      },
      hide: {
        effect: "drop",
        duration: 400
      },
            title:"Confirmación",
             buttons:{
                "Aceptar":function()
                {
                    eliminarCliente(idCli,ren,modalCli) ;
            
                },
                Cancelar:function()
                {
                    modalCli.dialog('close');
                }
            }
        });
    
      divCli.dialog({
        autoOpen:false,
            modal:true,
            height:370,
            width:800,
            show: {
        effect: "fold",
        duration: 800
      },
      hide: {
        effect: "fold",
        duration: 800
      },
            title:"Cliente",
            buttons:{
                "Modificar":function()
                {
                    updateCli(id);
        
                },
                Cancelar:function()
                {
                    divCli.dialog("close");
                }
            }
    });
   // tr=$(' tr td:nth-child(5) button');
    tr=$('tr .btn-edi');
    rutaGet=$('#ruta');
	
   
   
	
   /* tr.on('click',function() esta es otra forma de seleccion! 
    {
     alert($(this).parent().parent().find('td:eq(0)').text());
    })*/
    btnEli.on('click',function()
    {
        document.querySelector('#mnsCli').innerHTML="<B>¿Realmente deseas borrar al cliente?</B>";
        idCli=$(this).parent().parent().find(':input').val();
        ren=$(this).parent().parent();

         modalCli.dialog('open');
    })
    tr.on("click",function()
    {
      id=$(this).parent().find(':input').val();
      divCli.dialog("open");
     // colCel=$(this).parent().parent().find('td:eq(2)');
      colDim=$(this).parent().parent().find('td:eq(1)');
      colNom=$(this).parent().parent().find('td:eq(0)');
      nombre.val("");
     // correo.val("");
      telefono.val("");
     // estado.val("");
     // celular.val("");
      fecha.val("");
      direccion.val("");
     // ciudad.val("")
      document.querySelector('#mnsModi').innerHTML="";
      getCliente(id);
            // frmCli.find(':input').val("");
    });

   
    
    frmCli.on('submit',function(e)
    {
        return false;
    })
})

function eliminarCliente(idEli,ren,modalCli)
{
    ruta=$('input#rutaEliCli').val();
    $.ajax({
        url:ruta,
        beforeSend:function()
        {

        },
        type:'post',
        dataType:'text',
        data:{idCli:idEli},
        success:function(resp)
        {
            
            switch(resp)
            {
                case "1":
                    ren.remove();
                    modalCli.dialog('close');
                    break;
                case "2":
                    document.querySelector('#mnsCli').innerHTML="<B>Ese cliente ya fue borrado</B>";
                    break;
                default:
                     document.querySelector('#mnsCli').innerHTML="<B><font color='red'>Ocurrio un error</font></B>";
                    
            }
        }
    })  
}

 function getCliente(id)
    {
       nombre=$('#nombre');
       rutaGet=$('#ruta');
    //correo=$('#correo');
    telefono=$('#telefono');
    //celular=$('#celular');
    direccion=$('#direccion');
    fecha=$('#fecha');
    //estado=$('#estado');
    frmCli=$('#frm-cli')
        $.ajax({
            url:rutaGet.val(),
            beforeSend:function()
            {
                
                    
            },
            dataType:'json',
            data:{idCli:id},
            type:"POST",
            success:function(resp)
            {
           // if(!jQuery.isEmptyObject(resp)){
               nombre.val(resp[0].nombre);
           //    correo.val(resp[0].correo);
               telefono.val(resp[0].telefono);
              // estado.val(resp[0].estado);
       // celular.val(resp[0].celular);
               fecha.val(resp[0].municipio);
               direccion.val(resp[0].direccion);
         //      ciudad.val(resp[0].ciudad)


            },
            error:function(xhr,estado,error)
            {
                alert(error);
            },
            complete:function(xhr)
            {
                
            }
        });
    }

    function updateCli(id)
    {
      var cargador=$(".cargador");
      cargador.hide();
    cargador.dialog({
        autoOpen:false,
            modal:false,
            height:100,
            width:150,
            show: {
        effect: "bounce",
        duration: 600
      },
      hide: {
        effect: "drop",
        duration: 400
      },
            title:"Cargando...."
        });
        rutaModi=frmCli.attr('action');
       idCli1=$('#idCli');
        idCli1.val(id);
        $.ajax({
            url:rutaModi,
            dataType:"text",
            beforeSend:function(){
               cargador.dialog("open");
            },
            data:frmCli.serialize(),
            type:"POST",
            success:function(resp)
            {
                switch(resp)/*comparar con otros valores para validar, valores k devuelve procedure*/
                {
                  case "0":
                    document.querySelector('#mnsModi').innerHTML="<b>Faltan Datos</b>";
                    break;
                  case "1":
                    if(typeof colDim != "undefined")
                    {
                      colDim.text(direccion.val());
                      colNom.text(nombre.val());  
                    }
                    
             //       colCel.text(celular.val());
                    divCli.dialog("close");
                    break;
                  case "2":
                    document.querySelector('#mnsModi').innerHTML="<b>Ya existe ese cliente</b>";
                    break;
                  case "4":
                    document.querySelector('#mnsModi').innerHTML="<b>Ese correo no es valido</b>";
                    break;
                  default:
                    document.querySelector('#mnsModi').innerHTML="<b>Ocurrio un error, inesperado</b>";
                }
               
            },
            error:function(xhr,error,estado)
            {
                alert(error+"  "+estado);
            },
            complete:function()
            {
                cargador.dialog("close");
                
            }
        })
    }