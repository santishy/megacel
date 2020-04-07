$(document).on('ready',function()
{
	btnVender=$('tr .btn_vender');
	var tablaRef=$('table#tabla-ref');
	var barraRef=$("div#barraRef");
	barraRef.hide();
	var nombre="";
	var precio=0;
	var cantidad=0;
	var ruta=$('#ruta').val();
	var pid=0;
	var pidServ=0;
	tablaRef.dataTable({
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
	barraRef.dialog({
        autoOpen:false,
            modal:true,
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
	btnVender.on('click',function()
	{
		seleccion=$(this).parent().parent();
		nombre=seleccion.find('td:eq(0)').text();
		precio=seleccion.find('td:eq(2)').text()
		cantidad=seleccion.find('input[name=cant]').val();
		pidServ=seleccion.find('input[name=idServ]').val();
		pid=seleccion.find('input[name=idref]').val();
		$.ajax({
			url:ruta,
			beforeSend:function()
			{
				barraRef.dialog("open");
			},
			data:{id:pid,qty:cantidad,price:precio,name:nombre,idServ:pidServ},
			dataType:"text",
			type:"post",
			success:function(resp)
			{
			},
			error:function(xhr,error,estado)
			{

			},
			complete:function(xhr)
			{
				barraRef.dialog("close");
			}
		})
	})
})