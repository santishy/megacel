 var ruta;
 var target;
 var opts = {
      lines: 13, // The number of lines to draw
      length:13, // The length of each line
      width: 5, // T:he line thickness
      radius: 2, // The radius of the inner circle
      corners: 1, // Corner roundness (0..1)
      rotate: 0, // The rotation offset
      direction: 1, // 1: clockwise, -1: counterclockwise
      color: '#666666', // #rgb or #rrggbb or array of colors
      speed: 1, // Rounds per second
      trail: 60, // Afterglow percentage
      shadow: false, // Whether to render a shadow
      hwaccel: true, // Whether to use hardware acceleration
      className: 'spinner', // The CSS class to assign to the spinner
      zIndex: 2e9, // The z-index (defaults to 2000000000)
      top: 'auto', // Top position relative to parent in px
      left: 'auto' // Left position relative to parent in px
    };
$(document).on('ready',function(){
    var id=null;
    var ren=null;
    var suc;
	var ref=$("#ref");
    modalRef=$("div#confirRef");
    var confir=$('#confirRef');
    var btnRef=$('tr .btnEliRef');
    var btnInser=$('#btnAddRef');
    var spinner=null;  
    target=$('#divMensaje')[0];
    $('.btnDelete').tooltip({
    
    });
    $('#idsuc').on('change',function(){
       $('#frmGetref').submit();
    });
    modalRef.dialog({
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
                OK:function()
                {
                    eliminarRef(id,ren,modalRef,suc) ;
            
                },
                Cancelar:function()
                {
                    modalRef.dialog('close');
                }
            }
        });
	ref.dataTable({
		"oLanguage": {
            "sLengthMenu": "Mostrar _MENU_ resultados por página",
            "sSearch":"Busqueda",
            "sZeroRecords": "No no se encontraron resultados",
            "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ resultados",
            "sInfoEmpty": "Rango de 0 a 0 de 0 resultados",
            "sInfoFiltered": "(Filtrado de _MAX_ registros totales)"
        },
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "bSort": false,
        "bInfo": false,
        "bAutoWidth": false,
        "bJQueryUI":true
	});
    btnInser.on('click',function(e){
        e.preventDefault();
        ruta=$(this).parent().parent().parent().attr('action');
        addRef();
    });
    btnRef.on('click',function()
    {
        id=$(this).parent().find('input[name=idref]').val();
        suc=$(this).parent().find('input[name=idsuc]').val();
        ren=$(this).parent().parent();
        document.querySelector('#mnsRef').innerHTML="<font color=red><center>¿Realmente deseas borrarla?</center></font>";
        modalRef.css('opacity','1');
        modalRef.dialog('open');
    })
});

function addRef ( ) {   
   $.ajax({

        beforeSend:function(){
            spinner = new Spinner(opts).spin(target);
        },
        url:ruta,
        type:'post',
        data:$('#frmAddRef').serialize(),

        success:function(resp){
            switch(resp){
                case '1':
                        $('#divMensaje').html("<img src='../images/pa.png' /><small><span style='color:green;'>refacción existente se agrego la cantidad a la existencia</span></small>");
                        break;
                case '2':
                        $('#divMensaje').html("<img src='../images/pa.png' /><small><span style='color:green;'>refacción existente se actualizo en todas las sucursales</span></small>");
                          break;
                case '3':
                        $('#divMensaje').html("<img src='../images/pa.png' /><small><span style='color:green;'>refacción agregada</span></small>");
                          break;
                case '4':
                        $('#divMensaje').html("<img src='../images/x.png' /><span style='color:red;'>error con la sucursal</span>");  
                          break;
                case '5':
                        $('#divMensaje').html("<img src='../images/x.png' /><span style='color:red;'>error consulte a su proveedor de sistema</span>");  
                          break;
                default:
                        $('#divMensaje').html("<img src='../images/x.png' /><span style='color:red;'>error con la sucursal</span>");  

            }

        },
        error:function(jqXHR,estado,error){
                console.log(estado);
                console.log(error);
                },
        complete:function(XHR){
            spinner.stop();

        },
        timeout:10000


    });
}
function eliminarRef(idr,ren,modalRef,suc)
{
    ruta=$("#rutaEliRef").val();
    $.ajax({
        url:ruta,
        type:'post',
        data:{idref:idr,idsuc:suc},
        dataType:'text',
        success:function(resp)
        {
            switch(resp)
            {
                case "1":
                    ren.parent().find('td:eq(4)').text('0');
                    modalRef.dialog('close');
                    break;
                case "2":
                    document.querySelector('#mnsRef').innerHTML="<font color=red>Esta sucursal, a sido desahabilitada</font>";
                    break;
                default:
                    document.querySelector('#mnsRef').innerHTML="<font color=red>Ocurrio un error</font>";
            }
        },
        error:function(xhr,error,estado)
        {
            alert(error+" "+estado);
        },
        complete:function()
        {

        }
    });
}