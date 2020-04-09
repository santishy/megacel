$(window).load(function () {

	btnEq=$('button#btnEq');
	equipo=$("div#equipo");
	var btnSalida=$("#btnSalidaServicio");
	frmSrv=$("form#frmServicio1");
	btnSrv=$("#btnSrv");
	frmService=$("form#frmService");
	rutaService1=document.frmService.rutaService.value;
	rutaEquipo=document.frmService.rutaEquipo.value;
	servicio=$("div#servicio");
	modalEquipo=$("div#modalEquipo");
	modalServicio=$("div#modalServicio");
	idS=$("#idS").val();
	idEq=$("#idEquipo").val();
	modalServicio.modal({
		backdrop:true,
		show:false
	})
	btnEq.on('click',modiEquipo);
	equipo.on("click",function()
	{
		document.frmTeam.nomEquipo.value="";
		document.frmTeam.marca.value="";
		document.frmTeam.modelo.value="";
		document.frmTeam.numSerie.value="";
		//document.frmTeam.descripcion.value="";
		document.frmTeam.color.value="";
		document.frmTeam.pass.value="";
		modalEquipo.modal("show");
		extraerEquipo();
	})
	//--------------------comprobar pass------------------------------------------------------------
$(btnSalida).on("click",function()
{
	comprobarPass();
});

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
				document.frmSalida.submit();
			}
			else
				alert("verifica tu contraseña")

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
	servicio.on("click",function()
	{
		document.frmServicio1.tipo.value="";
		document.frmServicio1.idSrv.value="";
		document.frmServicio1.falla.value="";
		document.frmServicio1.cables.value="";
		document.frmServicio1.discos.value="";
		document.frmServicio1.accesorios.value="";
		document.frmServicio1.golpes.value="";
		document.frmServicio1.calcas.value="";
		document.frmServicio1.tapa.value="";
		document.frmServicio1.marco.value="";
		document.frmServicio1.contiene_bateria.value="";
		document.frmServicio1.enciende.value="";
		document.frmServicio1.mojado.value="";
		modalServicio.modal("show");
		extraerServicio();
	})
	btnSrv.on("click",function()
	{
		modiServicio(modalServicio);
	})

})// fin del ready
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
  top: '2px', // Top position relative to parent in px
  left: '0px' // Left position relative to parent in px
	};

	// sacar el servicio del cliente--------------------------------------------------------------
	function extraerServicio()
	{
		titulo=document.querySelector("#tit_servicio");
		btn=document.getElementById('btnSrv');
		$.ajax({
			url:rutaService1,
			beforeSend:function()
			{
				var target = document.getElementById('spSalida');
				spSalida = new Spinner(opts).spin(target);
				titulo.innerHTML="Cargando......";
				btn.disabled=true;
			},
			type:"post",
			data:{idServ:idS},
			dataType:"json",
			success:function(resp)
			{
				if(!jQuery.isEmptyObject(resp))
				{
					document.frmServicio1.tipo.value=resp[0].tipo;
					document.frmServicio1.idSrv.value=resp[0].idServ;
					document.frmServicio1.falla.value=resp[0].falla;
					document.frmServicio1.cables.value=resp[0].cables;
					//document.frmServicio1.discos.value=resp[0].discos;
					document.frmServicio1.accesorios.value=resp[0].accesorios;
					document.frmServicio1.tapa.value=resp[0].tapa;
					document.frmServicio1.contiene_bateria.value=resp[0].contiene_bateria;
					document.frmServicio1.marco.value=resp[0].marco;
					document.frmServicio1.mojado.value=resp[0].mojado;
					document.frmServicio1.enciende.value=resp[0].enciende;
					//document.frmServicio1.golpes.value=resp[0].golpes;
					document.frmServicio1.calcas.value=resp[0].calcas;
					document.frmServicio1.chip.value=resp[0].chip;
					document.frmServicio1.memoria.value=resp[0].memoria;
					document.frmServicio1.cotizacion.value=resp[0].cotizacion;
				}
			},
			error:function(xhr,error,estado)
			{

			},
			complete:function(xhr)
			{
				spSalida.stop();
				titulo.innerHTML="<font color='#0054cc'>Editar Servicio</font>";
				btn.disabled=false;
			}

		})
	}
	// ------------------------Modificar Servicio-----------------------------------------
	function modiServicio(modalServicio)
	{
		btn=document.getElementById('btnSrv');
		$.ajax({
			url:frmSrv.attr("action"),
			beforeSend:function()
			{
				btn.disabled=true;
				var target = document.getElementById('spServicioInfe');
				spServicio = new Spinner(opts).spin(target);
			},
			type:"post",
			data:frmSrv.serialize(),
			dataType:"text",
			success:function(resp)
			{

				switch(resp)
				{

					case "0":
						alert('Complete los datos');
						break;
					case "1":
						modalServicio.modal("hide");
						tabla=$('table#tabla_detservicio');
						tabla.find('tr:eq(1)').find('td:eq(1)').text(document.frmServicio1.tipo.value);
						//tabla.find('tr:eq(1)').find('td:eq(2)').text(document.frmServicio1.tecnico.value);
						tabla.find('tr:eq(1)').find('td:eq(3)').text(document.frmServicio1.falla.value);
						break;
					case "2":
						document.querySelector("#tit_servicio").innerHTML="<font color='red'>El cliente a sido borrado</font>";
						break;
					default:
						alert("Ocurrio un Error, intentelo desde mostrar folios:"+resp);
				}
			},
			error:function(xhr,error,estado)
			{
				alert(error+" "+estado)
			},
			complete:function(xhr)
			{
				btn.disabled=false;
				spServicio.stop();
			}
		});

	}
// Rellenar modal equipo---------------------------------------------------------------
	function extraerEquipo()
	{
		btnsave=document.querySelector('#btnEq');
		btnsave.disabled=true;
		var target=document.querySelector('#spEquipo');
		$.ajax({
			url:rutaEquipo,
			beforeSend:function()
			{
				spEquipo = new Spinner(opts).spin(target);
				document.querySelector("#tit_equipo").innerHTML="Cargando....."
			},
			type:"post",
			data:{idEquipo:idEq},
			dataType:"json",
			success:function(resp)
			{
				if(!jQuery.isEmptyObject(resp))
				{
					document.frmTeam.nomEquipo.value=resp[0].nomEquipo;
					document.frmTeam.marca.value=resp[0].marca;
					document.frmTeam.modelo.value=resp[0].modelo;
					document.frmTeam.numSerie.value=resp[0].numSerie;
					document.frmTeam.descripcion.value=resp[0].descripcion;
					document.frmTeam.color.value=resp[0].color;
					document.frmTeam.pass.value=resp[0].contraseña;
				}
			},
			error:function(xhr,error,estado)
			{
				alert(error+" "+estado);
			},
			complete:function(xhr)
			{
				btnsave.disabled=false;
				spEquipo.stop();
				document.querySelector("#tit_equipo").innerHTML="<font color='#0054cc'>Editar Equipo</font>"
			}

		})
	}

	// -------------------------- modificar equipo---------------------------------------
	function modiEquipo()
{
	tabla=$("table#tablaEquipo");
	btnsave=document.querySelector("#btnEq");
	frmTeam=$('form#frmTeam');
	ruta=frmTeam.attr('action');
	$.ajax({
		url:ruta,
		beforeSend:function()
		{
			btnsave.disabled=true;
			var target = document.getElementById('spEquipoInfe');
			spEquipo = new Spinner(opts).spin(target);
		},
		type:"POST",
		data:frmTeam.serialize(),
		dataType:'text',
		success:function(resp)
		{

			switch(resp)
			{

				case "0":
					alert('Complete los datos');
					break;
				case "1":
					tabla.find("tr:eq(1)").find('td:eq(0)').text(document.frmTeam.nomEquipo.value);
					tabla.find("tr:eq(1)").find('td:eq(1)').text(document.frmTeam.marca.value);
					tabla.find("tr:eq(1)").find('td:eq(2)').text(document.frmTeam.modelo.value);
					tabla.find("tr:eq(1)").find('td:eq(3)').text(document.frmTeam.numSerie.value);
					//tabla.find("tr:eq(1)").find('td:eq(4)').text(document.frmTeam.descripcion.value);
					tabla.find("tr:eq(1)").find('td:eq(4)').text(document.frmTeam.color.value);
					tabla.find("tr:eq(1)").find('td:eq(5)').text(document.frmTeam.pass.value);
					//$('#idColor').html('<input type="color" value='+ document.frmTeam.color.value +' >');
					$("div#modalEquipo").modal('hide');
					break;
				case "2":
					alert("Ya existe un equipo con esas caracteristicas");
					break;
				default:
					alert("Ocurrio un Error, intente mas tarde");
			}
		},
		error:function(xhr,error,estado)
		{
			alert(error);
		},
		complete:function()
		{
			spEquipo.stop();
			btnsave.disabled=false;
		}
	});//ajax

}
