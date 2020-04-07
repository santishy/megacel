$(function(){
	var btnm = $('.btnMensaje');
	var ruta = $('#frmMensaje').attr('action');

	btnm.on('click',function(){
		$.ajax({
			beforeSend:function(){
				$('#divMensaje').html('<i class="fa fa-spinner fa-spin"></i>');
			},
			url:ruta,
			type:'post',
			data:$('#frmMensaje').serialize(),
			dataType:'text',
			success:function(resp){
				if(resp == '1')
					$('#divMensaje').html("<img src='../images/pa.png' /><small><span style='color:green;'>Modificado</span></small>");
				else
					$("#divMensaje").html("<img src='../images/x.png' /><span style='color:red;'>Error</span>");
					
			},
			error:function(jqXHR,estado,error){
				alert(estado+" "+error);
				},
			complete:function(XHR){
				
			},
			timeout:10000


		});
	});
});