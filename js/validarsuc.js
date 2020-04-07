
$(document).on('ready',function()
{
	var btnEliSuc=$('.btnEliSuc');
	var id; // el id, de la sucursal
	var divsuc=$('div#modi_suc');
	var frmsuc=$('#frm_modi_suc');
	var cargador=$("div.cargador");
	var nombre=$('#nombre');
	var edonombre=$('#edo-nombre');
	var tabla=$('#tablasuc');
	var tr=$('tr .btn-edi ');
	var nombre=$('#nombre');
	var localidad=$('#localidad');
	var domicilio=$('#domicilio');
	var edo=$('#edo');
	var telefono=$('#telefono');
	var colNom;
	var colDom;
	var ren=null;
	var suc=null;
	var idsuc2=$('#frmidsuc')
		tabla.dataTable({
		"bJQueryUI":true,
		"oLanguage": {
			"sLengthMenu": "Mostrar _MENU_ resultados por página",
            "sSearch":"Búsqueda",
            "sInfo":"Total _TOTAL_ de (_START_ de _END_)",

        }
	});
	$('.btn-edi').tooltip({
    
    });
	var btnDesactivar=$("button#btnDesactivar");
	var modalSuc=$("div#modalSuc");
	modalSuc.modal({
		backdrop:false,
		show:false
	});
	cargador.dialog({
			autoOpen:false,
			modal:true,
			height:110,
			width:100,
			show: {
        effect: "fold",
        duration: 800
      },
      hide: {
        effect: "fold",
        duration: 800
      },
			title:"Cargando...."
	})
	divsuc.dialog(
		{
			autoOpen:false,
			modal:true,
			height:530,
			width:600,
			show: {
        effect: "fold",
        duration: 800
      },
      hide: {
        effect: "fold",
        duration: 800
      },
			title:"Sucursales",
			buttons:{
				"Modificar":function(){
					updateSuc(id,colNom,colDom);
				},
				Cancelar:function(){divsuc.dialog("close");}
			}
		});
	tr.on('click',function()
		{
		//alert($(this).parent().parent().find('td:eq(0)').html());
		//alert($(this).parent().parent().find('.idsuc').val());
		colDom=$(this).parent().parent().find('td:eq(1)');
		colNom=$(this).parent().parent().find('td:eq(0)');
		frmsuc.find(':input').val("");
		id=$(this).parent().parent().find(':input').val();
		getData(id);

		divsuc.dialog("open");	
	});
	btnEliSuc.on('click',function()
	{
		suc=$(this).parent().parent().find(':input').val();
		ren=$(this).parent().parent();
		document.querySelector('#mnsSuc').innerHTML="Si eliminas una sucursal, solo se desactivara.";
		modalSuc.modal('show');
	})
	btnDesactivar.on('click',function()
	{
		eliminarSuc(suc,ren,modalSuc);
	})
	function updateSuc(id,colNom,colDom)
	{
		document.frm_modi_suc.idsuc.value=id;
		rutaSuc=document.rutasSuc.rutaModiSuc.value;
		$.ajax({
			url:rutaSuc,
			beforeSend:function()
			{
				
			cargador.dialog("open");
			},
			dataType:'text',
			data:frmsuc.serialize(),
			type:"POST",
			success:function(resp)
			{
				switch(resp)
				{
					case "1":
						colDom.text(domicilio.val());
						colNom.text(nombre.val());
						divsuc.dialog("close");
						break;
					case "2":
						alert('Ya existe una sucursal, con el mismo domicilio');
						break;
					case "3":
						alert('Ya existe ese nombre');
						break;
					case "error":
						alert("Complete todos los campos");
						break;
					default:
						alert('ocurrio un error');
				}
			},
			error:function(xhr,estado,error)
			{
				alert(error);
			},
			complete:function(xhr)
			{
				cargador.dialog("close");
				//divsuc.dialog("close");
			}
		});
	}
	function getData(id)
	{
		var ruta=frmsuc.attr('action');
		//alert ("hola mundo");
		$.ajax({
			url:ruta,
			beforeSend:function()
			{
				
					
			},
			dataType:'json',
			data:{idsuc:id},
			type:"POST",
			success:function(resp)
			{
				
					//$.each(resp,function(c,v)
					//{
						nombre.val(resp[0].nombre);
						localidad.val(resp[0].localidad);
						domicilio.val(resp[0].domicilio);
						telefono.val(resp[0].telefono);
						edo.val(resp[0].edo);
					//})
				
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
			
		
	function identificador(valor,campo)
	{
		if(/^([\w-\-]+\s*)+$/.test(valor))
		{
			campo.removeClass('has-error').addClass('has-success')
			return true;
		}
		else
		{
			campo.removeClass('has-success').addClass('has-error')
			return false;
		}
	}
	nombre.on('blur',function()
	{
		identificador(nombre.val(),edonombre);
	});
});
function eliminarSuc(suc,ren,modalSuc)
{
	ruta=document.rutasSuc.rutaEliSuc.value;
	$.ajax({
		url:ruta,
		beforeSend:function()
		{
			document.querySelector('#mnsSuc').innerHTML="<font color='green'>Espere.....</font>";
		},
		type:'post',
		data:{idsuc:suc},
		dataType:'text',
		success:function(resp)
		{
			if(resp=="1")
			{
				ren.remove();
				modalSuc.modal('hide');
			}
			else
			{
				document.querySelector('#mnsSuc').innerHTML="No se pudo desactivar";
			}
		},
		error:function(xhr,error,estado)
		{
			alert(error+" "+estado);
		},
		complete:function(xhr)
		{

		}
	});
}