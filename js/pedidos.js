$(document).on('ready',function()
{
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
	$('#fecha_orden').datepicker({
      showAnim:"drop",
      showButtonPanel: true
     });
	$("#btnPedido").on('click',function(){
		comprobarPass();
	});
});
function comprobarPass()
{
	var rutaPass=$("#pass").data('ruta');
	$.ajax({
		url:rutaPass,
		beforeSend:function(){},
		type:'post',
		data:{pass:$("#user").val()},
		dataType:'text',
		success:function(resp,txt)
		{	
			//alert(resp)
			if(resp!=0)
			{
				$('#user').val(resp);
				$('#frmPedidos').submit();
			}
			else
				alert('Verifique su password');
		},
		error:function(xhr,error,estado)
		{
			alert(xhr+" "+error+" "+" "+estado)
		},
		complete:function(xhr){
			
		}
		
	});
	return bandera;
}
