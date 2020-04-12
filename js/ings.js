var ruta;
var metod;
var url;
$(document).on('ready',function(){
	$('#frmIngreso').on('submit',function(e){
		e.preventDefault();
		ruta=$(this).attr('action');
		init();
	});


 });
function init () {

		$.ajax({
			beforeSend:function(){
				$('#divAvisoIngreso').html("<i class='fa fa-spinner fa-spin'></i>");
			},
			url:ruta,
			type:'post',
			dataType:'json',
			data:$('#frmIngreso').serialize(),
			success:function(resp){
				switch(resp.ban){
					case '1':
							$('#divAvisoIngreso').html("");
							url="http://tecno.appmegacel.com/login/bienvenida";
							$(location).attr('href',url);
							//error("Acceso correcto","success");
							break;
					case '2':
							$('#divAvisoIngreso').html("");
							error("Usuario o contraseña incorrecto","error");
							break;
					case '3':
							$('#divAvisoIngreso').html("");
							error("Error de sucursal","error");
							break;
					default:
							$('#divAvisoIngreso').html("");
							error("Error","error");


				}
			},
			error:function(jqXHR,estado,error){
				console.log(estado);
				console.log(error);
				},
			complete:function(XHR){

		},
			timeout:10000

		});



}


function error(mensaje,tipo){
	showNotification({
                       message: mensaje,
                       type: tipo
    });

}
