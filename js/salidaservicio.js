$(document).on("ready",function()
{
    var idc=null;
    ocultar=$("div.ocultarInfo");
    ocultar.hide();
    var rutaCliente=$('#edi-cli').data('ruta');
    var idServ=null;
    var btnServ=$("#btnSrv");
    frmSrv=$("form#frmServicio1");
	tablaServicio=$('.table');
    var btnComment=$(".btnComment");
    var comentar=$("#comentar");
    var modalComentarios=$("#modalComentarios");
    modalEquipo=$("div#modalEquipo");
    modalServicio=$("#modalServicio");
    var btnEq=$('#btnEq');
    modalServicio.modal({
        backdrop:true,
        show:false
    });
    var editCliente=$(".editCliente");
    editServicio=$('.editServicio');
    editEquipo=$('.editEquipo');
    modalComentarios.modal({
        show:false,
        backdrop:false,
        keyboard:true

      });
    $(".soporte").on('click',function(ev){
          ev.preventDefault();
         var id_servicio=$(this).data('id');
         $("#aporte").val("");
         $("#usuario_pass").val("");
         $("#span-folio").text($(this).data('folio'));
         $("#id-servicio-soporte").val(id_servicio);
         console.log('esto es el id:'+id_servicio);
         $("#modal-soporte").modal('show');
      });
      $("#agregarSoporte").on('click',function(){
          $.ajax({
              url:$("#frm-soporte").attr('action'),
              beforeSend:function(){
                  $("#agregarSoporte").attr('disabled',true);
              },
              type:'POST',
              data:$("#frm-soporte").serialize(),
              dataType:'json',
              success:function(resp){
                  if(resp.ban){
                      $("#modal-soporte").modal('hide');
                  }else {
                      alert('Verifique su contraseña');
                  }
              },
              error:function(error){
                  alert(error)
              },
              complete:function(){
                  $("#agregarSoporte").attr('disabled',false);
              }
          })
      });

    //setInterval(cambiarFondo,10000);
   // setInterval(sonido,600000);
    tablaServicio.dataTable({
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
        "bAutoWidth":true,
        "ordering": false,
        "bJQueryUI":true
    });
    function cambiarFondo()
{
        if($('#urgente').text()>0)
        {
           //document.querySelector('#alertaAudio').play();
            $('.urgente').animate({'background-color':'#FF3399'},500);
        }
        else
        {
            ///$("#alertaAudio").attr('autoplay',false);
            $('.urgente').animate({'background-color':'#66FF99'},500);
        }
}
    function sonido()
{
        if($('#urgente').text()>0)
        {
           document.querySelector('#alertaAudio').play();
        }
}
    rutaEquipo=document.frmService.rutaEquipo.value;
    var id=null;
    var col3=null;
    var lugar=null;
    var fechau=null;
    var btnMostrar=$('.btnDatosServ')
    var ren=null;
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
    var url=$('#modalServ').data('ruta');
     editServicio.on('click',function()
    {
        modalServicio.modal('show');
        rutaService1=document.frmService.rutaService.value;
        idS=$(this).parent().parent().parent().parent().find('td:eq(2)').find('input[type=hidden]').val();

        $.getScript(url,function()
        {
            extraerServicio();
        });
       
    });
    $(".menulateral").css({display:'none'});
    divCli=$("#edi-cli");
    divCli.dialog({
        autoOpen:false,
            modal:true,
            height:340,
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
                     $.getScript(rutaCliente,function(){
                        updateCli(idc);
                      });
                    
        
                },
                Cancelar:function()
                {
                    divCli.dialog("close");
                }
            }
    });
    var  rutaGet=$('#ruta');
    editCliente.on('click',function(){
         idc= $(this).data('cliente');
        $.getScript(rutaCliente,function(){
           
            getCliente(idc);
        });
        divCli.dialog("open");
    });
    btnServ.on('click',function()
    {
        $.getScript(url,function(){
            modiServicio(modalServicio);
        });
    });
   
    modalEquipo.modal({
        show:false,
        backdrop:false,
        keyboard:true

      });
    editEquipo.on('click',function(){
        idEq=$(this).data('id');
        $('#idEquipo').val(idEq);
        $("#cliente").val($(this).data('cliente'));
        idS=$(this).parent().parent().parent().parent().find('td:eq(2)').find('input[type=hidden]').val();
        $("#eservicio").val(idS);

        $.getScript(url,function(){
            extraerEquipo();
        });
        modalEquipo.modal('show');
    });
    btnEq.on('click',function(){
        frmTeam=$('form#frmTeam');
        $.getScript(url,function(){
            modiEquipo();
        });
    });
    $("#proceso").modal({keyboard:false,show:false})
    $('.cambiar').on("click",function()
    {
       $("#id_folio").val(""); 
       $("#pass").val("");
       $("#lugar").val("");
       var id_folio=$(this).parent().parent().find('td:eq(1)').text();
       col3=$(this).parent().parent().find('td:eq(3)').find('.ubicacion');
       fechau=$(this).parent().parent().find('td:eq(3)').find('.fechaubicacion');
       lugar=$(this).parent().parent().find('td:eq(3)').find('.lugar');
       $("#id_folio").val(id_folio);
       // llamar getReparadores
       $('.ubicaciones').html("");
       getReparadores(id_folio);
        $("#proceso").modal("show");
    })
    $("#btnProceso").on("click",function()
{
    comprobarPass();
});
comentar.on('click',addComment);
btnComment.on('click',function(){
    $("#emisor").val("");
    $("#comentario").val("");
    idComment=$(this).parent().find('input').val();
    document.frmComment.idServ.value=idComment;
    document.querySelector('#contenidoComment').innerHTML="";
    getComment(idComment);
     modalComentarios.modal('show');
})
/**************************************getReparadores*****************************************/
function getReparadores(fol)
{
    var ruta=$("#proceso").data('ruta');
    $.ajax({
        url:ruta,
        beforeSend:function(){},
        type:'post',
        data:{folio:fol},
        dataType:'json',
        success:function(resp)
        {
            reparador=new Array();
           if(!jQuery.isEmptyObject(resp))
           {
                for(i=0;i<resp.length;i++)
                {
                    reparador[i]=document.createElement('div');
                    reparador[i].classList.add('well');
                    reparador[i].innerHTML="<div>"+resp[i].ubicacion+"</div><p>"+resp[i].fechaubicacion+"</p><p>"+resp[i].lugar+"</p>";
                    $(".ubicaciones").append(reparador[i]);
                }
           }
        },
        complete:function(xhr){
            
        },
        error:function(xhr,error,estado){
            alert(xhr+" "+error+" "+estado);
        }
    });
}
/***********************************************************************************************/
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
                modificarUbicacion();
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
/*function modificarUbicacion()
{
    var ruta=$("#frmUbicacion").attr('action');
    $.ajax({
        url:ruta,
        beforeSend:function(){},
        type:'post',
        data:{id_folio:$("#id_folio").val(),usuario:$("#usuario").val()},
        dataType:'text',
        success:function(resp){
            if(resp==1 || resp=="1")
            {
                col3.text($("#usuario").val());
                $("#proceso").modal("hide")
            }
            else
                alert('Recargue pagina y verifique password')
        },
        error:function(xhr,error,estado){
            alert(error+" "+" "+estado);
        },
        complete:function(xhr){

        }
    })
}*/

function modificarUbicacion()
{
    var ruta=$("#frmUbicacion").attr('action');
    $.ajax({
        url:ruta,
        beforeSend:function(){},
        type:'post',
        data:{id_folio:$("#id_folio").val(),usuario:$("#usuario").val(),lugar:$("#lugar").val()},
        dataType:'json',
        success:function(resp){
            //if(!jQuery.isEmptyObject(resp))
            if(resp.query==1 || resp.query=="1")
            {
                col3.text($("#usuario").val());
                fechau.text(resp.fechaubicacion);
                lugar.text(resp.lugar);
                $("#proceso").modal("hide") 
            }
            else
                alert('Recargue pagina y verifique password')
        },
        error:function(xhr,error,estado){
            alert(error+" "+" "+estado);
        },
        complete:function(xhr){

        }
    })
}
    $('#lstSuc').on('change',function(){
        $('#frmServicios').submit();
    });
    $('.btnVerInfoS').on('click',function(){
        $(this).parent().parent().find('.ocultarInfo').slideToggle();
   
    });
    btnFolio=$(" .btnEliFolio");
    modalServ=$('#modalServ');
    modalServ.modal( {keyboard:true,show:false,backdrop:false});
	
    btnMostrar.on('click',function()
    {
        //$('div.ocultarInfo').css({Opacity:"1"})
        $(this).parent().find('.ocultarInfo').slideToggle();

    })
    btnFolio.on('click',function()
        {
            document.querySelector('#mnsConfir').innerHTML="<font color='#485573'><b>Realmente deseas borrar el servicio? </b></font>";
            modalServ.modal('show');
            id=$(this).parent().find('input').val();
            ren=$(this).parent().parent().parent();
        });
    btnAceptar=$("button#btnAceptar");
    btnAceptar.on('click',function()
    {
        eliminarFolio(id,ren,modalServ);
    })
    function getComment(idComment)
    {
        var ruta=modalComentarios.data('ruta');
        $.ajax({
            url:ruta,
            beforeSend:function(){

            },
            data:{id_comentario:idComment},
            dataType:'json',
            type:'post',
            success:function(resp)
            {
                var comentario=new Array();
                var emisor=new Array();
                var container=new Array();
                for(i=0;i<resp.length;i++)
                {
                    comentario[i]=document.createElement('TEXTAREA');
                    emisor[i]=document.createElement('H4');
                    container[i]=document.createElement('DIV')
                    container[i].classList.add('comentarios');
                    comentario[i].classList.add('form-control')
                    comentario[i].value=resp[i].comentario;
                    comentario[i].disabled="disabled";
                    emisor[i].innerHTML=">>"+resp[i].emisor+"<< ["+resp[i].fecha_comentario+" ]";
                    if(i%2!=0)
                        emisor[i].style.textAlign="right"
                    nombre=emisor[i].cloneNode(true);
                    comment=comentario[i].cloneNode(true);
                    comment.value=resp[i].comentario;
                    container[i].appendChild(nombre);
                    container[i].appendChild(comment);
                    //emisor[i].style.textAlign="center";
                    $("#contenidoComment").append(container[i]);
                    //$("#contenidoComment").append(elemento[i]);
                }   
            },
            complete:function()
            {

            },
            error:function(){}
        })
    }
});

function eliminarFolio(id,ren,modalServ)
{   
    
    var ruta = document.querySelector('#rutaEliFolio').value;
    $.ajax({
        url:ruta,
        type:'post',
        data:{folio:id},
        dataType:'text',
        success:function(resp)
        {
            switch(resp)
            {
                case "1":
                
                    ren.remove();
                    modalServ.modal('hide');
                    break;
                case "2":
                    document.querySelector('#mnsConfir').innerHTML="<font color='#f2574b'><b>No se puede borrar, ya que utilizo refacciones</b></font>";
                    break;
                default:
                     document.querySelector('#mnsConfir').innerHTML="<font color='#f2574b'><b>Ocurrio un Error</b></font>";
            }
        },
        error:function(xhr,error,estado)
        {
            alert(error+" "+xhr+" "+estado);
        },
        complete:function(xhr)
        {
            // hhhhhhhhhhhhh
        }
    });

}

/*function sucSel () {
   var ruta=$('#frmServicios').attr('action');
   $.ajax({
        beforeSend:function(){

        },
        url:ruta,
        type:'post',
        data:$('#lstSuc').val(),
        dataType:'text',
        success:function(){

        },
        error:function(xhr,error,estado)
        {
            alert(error+" "+xhr+" "+estado);
        },
        complete:function(xhr)
        {
            
        },
        timeout:10000

   }); 
}*/
function addComment()
{
    var ruta=$("#frmComment").attr('action');
    $.ajax({
        url:ruta,
        beforeSend:function()
        {

        },
        dataType:'text',
        type:'post',
        data:$("#frmComment").serialize(),
        success:function(resp)
        {
           switch(resp)
           {
            case 1:
            case "1":
                $("#modalComentarios").modal("hide");
                break;
            case 2:
            case "2":
                alert("Completa los datos");
                break;
            default:
                alert('ocurrio un error inesperado')
           }
        },
        complete:function()
        {
            
        },
        error:function(xhr,error,estado)
        {
            alert(xhr+" "+error+" "+estado)
        }
    })
}
