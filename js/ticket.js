$(document).on('ready',function(){
	var spinner=null;
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
	var logo=document.getElementById('logo');
	logo.addEventListener('change',subirImagen,false);
	var target = $("#divTicket")[0];
	$('#frmTicket').on('submit',function(e){
		e.preventDefault();
		$.ajax({
			beforeSend:function(){
				spinner = new Spinner(opts).spin(target);
			},
			url:$('#frmTicket').attr('action'),
			type:'post',
			data:$('#frmTicket').serialize(),
			success:function(resp){
				if(resp == '1'){
					$("#divTicket").html("<img src='../images/pa.png' /><span style='color:green;'>Modificado</span>");
				}
				else
					$("#divTicket").html("<img src='../images/x.png' /><span style='color:red;'>Error</span>");
			},
			error:function(jqXHR,estado,error){
				console.log(estado);
				console.log(error);
				},
			complete:function(XHR){
				spinner.stop();

			},
			timeout:10000

		})
	});
});
function subirImagen(e)
{

	var barra=document.querySelector('#barra_logo');
      barra.style.width='0%';
      var ruta=$("#ruta_logo").val();
     
      
      barra.innerHTML="";
      files=e.target.files;
      for(i=0;i<files.length;i++)
      {
        file=files[i];
        if(window.FormData)
        {
          var fd=new FormData();
          fd.append('logo',file);
          if(file.type.match(/image.*/)){
            if(file.size<=2097152)
            {
              var ajax=new XMLHttpRequest();
              ajax.open('POST',ruta,true);
              ajax.addEventListener('load',function()
              { 
                if(this.status==200)
                {
                  if(this.response!="error")
                  {
                    barra.innerHTML='<font color="black"><b>Completo</b></font>';
                    document.querySelector('#url_logo').value=this.response;
                  }
                  else
                  {
                    
                    alert('Archivo no valido , debe tener extensión .jpg');
                  }
                }
              }); //ajax
              ajax.upload.addEventListener('progress',function(e){
                if(e.lengthComputable)
                  barra.style.width=((e.loaded/e.total)*100)+'%';
              })
              ajax.send(fd);
            }
            else 
            {
              alert('El archivo debe pesar máximo 2mb');
            }
          }else
        {
        	alert('El formato del archivo no es correcto, debe corresponder a una imagen')
        }
        }//formdata
        else
        {
        	alert('Utilize otro navegador mas moderno');
        }
      }//for 
}