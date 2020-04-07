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
	var spinner=null;
	var spinEquipo=null;
	var spinServicio=null;
	var panelServicio=$("#panelServicio");
	var panelEquipo=$("#panelEquipo");
	var panelFolio=$("#panelFolio");
	var confirServicio=$("#confirServicio");
	var confirEquipo=$("#confirEquipo");
	var combo=$("#comboId");
	var btnSig=$("#btn_sig");
	var btnCan=$("button#btn_cancel");
	btnSig.hide();
	btnCan.hide();
	mns=$('div#mns');
	mns.dialog({
		autoOpen:false,
		modal:false,
		width:300,
		height:150,
		title:"Aviso",
	});
	
	var opts = {
  lines: 13, // The number of lines to draw
  length: 5, // The length of each line
  width: 3, // The line thickness
  radius: 7, // The radius of the inner circle
  corners: 1, // Corner roundness (0..1)
  rotate: 0, // The rotation offset
  direction: 1, // 1: clockwise, -1: counterclockwise
  color: '#666666', // #rgb or #rrggbb or array of colors
  speed: 1, // Rounds per second
  trail: 50, // Afterglow percentage
  shadow: false, // Whether to render a shadow
  hwaccel: true, // Whether to use hardware acceleration
  className: 'spinner', // The CSS class to assign to the spinner
  zIndex: 2e9, // The z-index (defaults to 2000000000)
  top: 'auto', // Top position relative to parent in px
  left: 'auto' // Left position relative to parent in px
	};
	$('#fecha').datepicker({
      showAnim:"drop",
      showButtonPanel: true
     });
	var target = document.getElementById('spFolio');
	var target2 = document.getElementById('spEquipo');
	var target3 = document.getElementById('spServicio');
 

	btnFolio=$('#btn_folio'); //boton para agregar folio ajax
	frmFolio=$('#frmFolio') //formulario del Folio (primer formulario)
	folio=$('#folio'); // el folio creado del cliente
	btnEquipo=$('#btn_equipo'); //boton para agregar equipo ajax
	frm_equipo=$('#frmEquipo');
	btnServicio=$('#btn_servicio');
	frmServicio=$('#frmServicio');
	sidEq=$('#sidEq');
	sfolio=$('#sfolio');
	var idEq=$('#idEq');
	pidCli=$('#idCli').val();
	if(!pidCli)
		pidCli=0;
	/***************************Paneles*******************************************************/
	panelEquipo.hide();
	panelServicio.hide();
	confirServicio.hide();
	confirEquipo.dialog({
		autoOpen:false,
		modal:false,
		width:330,
		height:200,
		title:"Confirmación",
		buttons:{
			"Aceptar":function()
			{
				panelEquipo.slideUp("slow");
				panelServicio.slideDown("slow");
				confirEquipo.dialog("close");
				limpiarEquipo();
			},
			"Cancelar":function()
			{
				confirEquipo.dialog("close");
			}
		}
	})
	confirServicio.dialog({
		autoOpen:false,
		modal:true,
		width:300,
		height:200,
		buttons:{
			"Otro":function()
			{

				window.open(document.rutas.rutaPDF.value+'/'+folio.val(),'_blank');
				sidEq.val("");
				idEq.val("");
				folio.val("");
				$("#comboId option:first-child").attr('selected',true);
				panelServicio.slideUp("slow");
				panelFolio.slideDown("slow");
				confirServicio.dialog("close");
			},
			"Terminar":function()
			{
				//window.location='http://localhost/servicios';
				$("#clave").val(folio.val());
				window.open(document.rutas.rutaPDF.value+'/'+folio.val(),'_blank');
				$("#frm_clave").submit();
				//confirServicio.dialog("close");

			}
		}
	})
	/*************************Agregar Folio*********************************************************/
	btnFolio.on('click',function()
	{

		if($("#folio").val().length>0)
			{
				folio.val($("#folio").val());
				panelFolio.slideUp("slow");
				panelEquipo.slideDown("slow|");
			}
		else
			{
				rutaFolio=frmFolio.attr('action');
				$.ajax({
					url:rutaFolio,
					beforeSend:function()
					{
					 spinner = new Spinner(opts).spin(target);
							
					},
					dataType:'json',
					data:frmFolio.serialize(),
					type:"POST",
					success:function(resp)
					{ 
						if(!jQuery.isEmptyObject(resp))
							switch(resp.ban)
						{
							case "1":
								folio.val(resp.folio);
								panelFolio.slideUp("slow");
								panelEquipo.slideDown("slow|");
								break;
							case "2":
								mns.css('opacity','1');
								mns.dialog("open");
								document.querySelector('#mnsBan').innerHTML="La Sucursal No existe";
								break;
							case "3":
								mns.css('opacity','1');
								mns.dialog("open");
								document.querySelector('#mnsBan').innerHTML="El cliente ya no existe";
								break;
							case "50":
								mns.css('opacity','1');
								mns.dialog("open");
								document.querySelector('#mnsBan').innerHTML="Faltan datos por llenar, verifique";
								break;
							case "100":
								mns.css('opacity','1');
								mns.dialog("open");
								document.querySelector('#mnsBan').innerHTML="No se creo el folio, intente mas tarde";
								break;
							default:
								mns.css('opacity','1');
								mns.dialog("open");
								document.querySelector('#mnsBan').innerHTML="Ocurrio un error";
								break;
						}
					},
					error:function(xhr,estado,error)
					{
						alert(error);
					},
					complete:function(xhr)
					{
						spinner.stop();
					}
				})
			}
		
	})
	/*-------------------------------------------------------------------------------------------*/

	/********************************AGREGA EQUIPO DEL CLIENTE*********************************/
	btnEquipo.on('click',function()
	{

		pnomEquipo=document.frmEquipo.nomEquipo.value;
		pmarca=document.frmEquipo.marca.value;
		pmodelo=document.frmEquipo.modelo.value;
		pnumSerie=document.frmEquipo.numSerie.value;
		pdescripcion=document.frmEquipo.descripcion.value;
		pcolor=$('#color').val();
		pcontraseña=document.frmEquipo.con.value;
		rutaEquipo=frm_equipo.attr('action');
		$.ajax
		({
			url:rutaEquipo,
			beforeSend:function()
			{
				spinEquipo = new Spinner(opts).spin(target2);

			},
			dataType:"json",
			data:{idCli:pidCli,nomEquipo:pnomEquipo,modelo:pmodelo,numSerie:pnumSerie,marca:pmarca,descripcion:pdescripcion,color:pcolor,con:pcontraseña},
			type:"POST",

			success:function(resp){
				if(!jQuery.isEmptyObject(resp))
					switch(resp.ban)
					{
						case 0:
							mns.css('opacity','1');
							mns.dialog("open");
							document.querySelector('#mnsBan').innerHTML="Complete todos los datos";
							break;
						case "1":
							idEq.val(resp.idEq);
							sfolio.val(folio.val());//para el servicio
							sidEq.val(idEq.val());// para el servicio 
							limpiarEquipo();
							panelEquipo.slideUp("slow");
							panelServicio.slideDown("slow");
							break;
						case '2':
							mns.css('opacity','1');
							mns.dialog("open");
							document.querySelector('#mnsBan').innerHTML="El equipo ya existe";
							break;
						case "3":
							mns.css('opacity','1');
							mns.dialog("open");
							document.querySelector('#mnsBan').innerHTML="No existe el cliente";
							break;
						case 100:
							mns.css('opacity','1');
							mns.dialog("open");
							document.querySelector('#mnsBan').innerHTML="No se encontro el id";
							break;
						default:
							mns.css('opacity','1');
							mns.dialog("open");
							document.querySelector('#mnsBan').innerHTML="Ocurrio un error:"+resp.ban;
					}
					else
					{
						mns.css('opacity','1');
						mns.dialog("open");
						document.querySelector('#mnsBan').innerHTML="No se encontro, error";
					}
			},
			error:function(xhr,error,estado)
			{
				alert(error);
			},
			complete:function(xhr)
			{
				spinEquipo.stop();
			}
		});

	});
/*******************************Botones siguiente y cancelar Para ekipo************************/

btnSig.on('click',function()
{
	var rutaModiEquipo=$("#rutaModiEquipo").data('ruta');
	$.ajax({
		url:rutaModiEquipo,
		beforeSend:function()
		{

		},
		type:'post',
		data:{idEq:combo.val(),folio:folio.val()},
		dataType:'text',
		success:function(resp)
		{
			if(resp!=1 || resp!="1")
				alert('No se inserto bien, ocurrio un error')
		},
		error:function(error,xhr,estado){
			alert(xhr+" "+estado+" "+error)
		},
		complete:function(){

		}
	})
	panelEquipo.slideUp("slow");
	panelServicio.slideDown("slow");
	confirEquipo.dialog("close");
	limpiarEquipo();
});

btnCan.on('click',function()
{
	idEq.val("");
	sfolio.val("");//para el servicio
	sidEq.val("");// para el servicio 
	document.frmEquipo.nomEquipo.value="";
	document.frmEquipo.marca.value="";
	document.frmEquipo.modelo.value="";
	document.frmEquipo.numSerie.value="";
	document.frmEquipo.descripcion.value="";
	document.frmEquipo.color.value="";
	btnSig.slideUp(200);
	btnCan.slideUp(200);
	btnEquipo.slideDown(200)
	confirEquipo.dialog("close");
})
/********************************Servicio*************************************************/
btnServicio.on('click',function ()
{
	
	comprobarPass();
	
});

/**************************************combo *********************************************/
combo.on("change",function()
{
	limpiarEquipo();
	getEquipo($(this).val());
})
function getEquipo(id)
{
	$.ajax({
		url:document.rutas.rutaEquipo.value,
		beforeSend:function(){
			spinEquipo = new Spinner(opts).spin(target2);
		},
		type:"post",
		data:{comboId:id},
		dataType:"json",
		success:function(resp)
		{
			if(!jQuery.isEmptyObject(resp))
			{
				idEq.val(resp[0].idEq);
				sfolio.val(folio.val());//para el servicio
				sidEq.val(idEq.val());// para el servicio 
				document.frmEquipo.nomEquipo.value=resp[0].nomEquipo;
				document.frmEquipo.marca.value=resp[0].marca;
				document.frmEquipo.modelo.value=resp[0].modelo;
				document.frmEquipo.numSerie.value=resp[0].numSerie;
				document.frmEquipo.descripcion.value=resp[0].descripcion;
				document.frmEquipo.color.value=resp[0].color;
				document.frmEquipo.con.value=resp[0].contraseña;
				//confirEquipo.dialog("open");
				btnEquipo.hide();
				btnSig.slideDown(200);
				btnCan.slideDown(200);
			}
			else
				alert("ya no existe el equipo");
		},
		error:function(xhr,error,estado)
		{

		},
		complete:function(xhr)
		{
			spinEquipo.stop();
		}

	})
}
function limpiarEquipo()
{
	document.frmEquipo.nomEquipo.value="";
	document.frmEquipo.marca.value="";
	document.frmEquipo.modelo.value="";
	document.frmEquipo.numSerie.value="";
	document.frmEquipo.descripcion.value="";
	document.frmEquipo.color.value="";
	document.frmEquipo.con.value="";
}
function altaServicio()
{
	rutaServicio=frmServicio.attr('action');
		$.ajax({
			url:rutaServicio,
			beforeSend:function()
			{
				spinServicio = new Spinner(opts).spin(target3);
			},
			data:frmServicio.serialize(),
			dataType:"text",
			type:"post",
			success:function(resp)
			{
				
				switch(resp)
				{
					case "0":
						mns.css('opacity','1');
						mns.dialog("open");
						document.querySelector('#mnsBan').innerHTML="Complete todos los datos";
						break;
					case "1":
					case "2":
						//document.frmServicio.tecnico.value="";
						
						//document.frmServicio.tipo.value="no tiene";
						confirServicio.dialog("open");
						break;
					case "3":
						mns.css('opacity','1');
						mns.dialog("open");
						document.querySelector('#mnsBan').innerHTML="Ubo problema, con el equipo";
						break;
					case "4":
						mns.css('opacity','1');
						mns.dialog("open");
						document.querySelector('#mnsBan').innerHTML="No existe el cliente";
						break;
					case "6":
						mns.css('opacity','1');
						mns.dialog("open");
						document.querySelector('#mnsBan').innerHTML="Complete todos los campos";
						break;
					default:
						mns.css('opacity','1');
						mns.dialog("open");
						document.querySelector('#mnsBan').innerHTML="Ocurrio un error, intente mas tarde";
				}
			},
			error:function(xhr,error,estado)
			{
				alert(error+"  "+estado);
			},
			complete:function(xhr)
			{
				spinServicio.stop();
			}

		});
}
function comprobarPass()
{
	var rutaPass=$("#rutaPass").data('ruta');
	var bandera=1;
	$.ajax({
		url:rutaPass,
		beforeSend:function(){},
		type:'post',
		data:{pass:$("#pass").val()},
		dataType:'text',
		success:function(resp,txt)
		{
			if(resp!="1" && resp!=1)
			{
				$("#usuario").val(resp);
				altaServicio();
			}
			else 
				alert("verifica tu contraseña")
			if(resp=="1" || resp==1)
				alert('Verifica tu contraseña')
			//bandera=resp;
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

});
