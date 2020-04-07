$(document).on('ready',function(){
	var id;
	var Temple=$("#empleados");
	var ediemple=$('#edi-emple');
	var idEmpe;
	var rutaE=$('#rutaE');
	// ruta para el confirm de eliminar
	var rutaElimE=$('#rutaElimE');
	//click boton eliminar
	var btneli=$('tr .btn-eli');
	// tr temporal
	var trtemp;
	//confirmacion
	var confirm=$('.confirmacion');
	var nombre=$('#nombre');
	var telefono=$('#telefono');
	var domicilio=$("#domicilio");
	var celular=$('#celular');
	var tipo=$('#tipo');
	var ide=$('#ide');
	var btnmodiE=$('#btnmodiE');
	var rutamodiE=$('#frmemple').attr('action');
	var frmemple=$('#frmemple');
	var frme=$('#frmE');
	var colnombre;
	var coldomicilio;
	var coltelefono;
	var colcelular;
	var coltipo;
	Temple.dataTable({
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

	ediemple.hide();
	ediemple.dialog({
		autoOpen:false,
		modal:true,
		heigth:350,
		width:500,
		title:"Empleados",
		show:{
			effect:"fold",
			duration:600
		},
		hide:{
			effect:"fold",
			duration:600
		},
		buttons:{
			"Modificar": function(){
					$.ajax({
						url:rutamodiE,
						beforeSend:function(){

						},
						dataType:'text',
						data:{idemp:ide.val(),nombre:nombre.val(),domicilio:domicilio.val(),telefono:telefono.val(),
							celular:celular.val(),tipo:tipo.val()},
						type:'POST',
						success:function(resp){	
								// alert(celular.val());
								colnombre.find('.divNombreE').text(nombre.val());
								colnombre.find('.divDomicilioE').text(domicilio.val());
								colnombre.find('.divTelefonoE').text(telefono.val());
								colnombre.find('.divCelularE').text(celular.val());
								/*coldomicilio.text(domicilio.val());
								coltelefono.text(telefono.val());
								colcelular.text(celular.val());
								coltipo.text(tipo.val());*/
						},
						error:function(xhr,estado,error){
							alert(error);
						},
						complete:function(xhr)
						{
							ediemple.dialog("close");
						}

					});

			},
			Cancelar:function(){
				ediemple.dialog("close");
			}
		}
	})
	confirm.dialog({
		autoOpen:false,
		modal:true,
		heigth:120,
		width:350,
		title:"Empleados",
		show:{
			effect:"fold",
			duration:600
		},
		hide:{
			effect:"fold",
			duration:600
		},
		buttons:{
			OK:function(){
					EliminarEmpAjax();
					confirm.dialog('close');

			},
			Cancelar:function(){
					confirm.dialog('close');
			}
		}
	});	
	$('.pApellidosE').hide();
	$('.btnVerInfoE').on('click',function(){
		//alert($(this).parent().html());
		$(this).parent().parent().find('.pApellidosE').slideToggle();

		
	});
	tr=$('tr .btn-edi');
	tr.on("click",function(){
		ediemple.dialog("open");
		idEmpe=$(this).parent().parent().find(':input').val();
		getEmpleado(idEmpe);
		nombre.val('');
		domicilio.val('');
		telefono.val('');
		celular.val('');
		tipo.val('');
		ide.val('');
		colnombre=$(this).parent().parent().find('td:eq(0)');
		coldomicilio=$(this).parent().parent().find('td:eq(1)');
		coltelefono=$(this).parent().parent().find('td:eq(2)');
		colcelular=$(this).parent().parent().find('td:eq(3)');
		coltipo=$(this).parent().parent().find('td:eq(4)');

		//alert(rutaE.val());
		
	});

	function getEmpleado(idEmpe){
		$.ajax({
			url:rutaE.val(),
			dataType:'json',
			data:{idemp:idEmpe},
			type:'POST',
			success:function(resp){
				if(!jQuery.isEmptyObject(resp)){
					nombre.val(resp[0].nombre);
					domicilio.val(resp[0].domicilio);
					telefono.val(resp[0].telefono);
					celular.val(resp[0].celular);
					tipo.val(resp[0].tipo);
					ide.val(resp[0].idemp);

				}
				
			},
			error:function(xhr,estado,error){
				alert(error);
			},
			complete:function(xhr)
			{

			}
		});
	}

	

	btneli.click(function(){

		id=$(this).parent().parent().find(':input').val();
		trtemp=$(this).parent().parent();
		confirm.dialog('open');
		
		
	});

	function EliminarEmpAjax(){
		$.ajax({
			url:frme.attr('action'),
			dataType:'text',
			data:{idemp:id},
			type:'POST',
			success:function(resp){
				trtemp.remove();
			},
			error:function(xhr,estado,error){
				alert(error);
			},
			complete:function(){

			}


		});
	}
});