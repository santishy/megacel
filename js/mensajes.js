/*var target;
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
    };*/
$(document).on('ready',function(){
	/*var spinner=null;  
	var ruta=$('#frmMensaje').attr('action');
	target=$('#divAviso')[0];
	$('#frmMensaje').on('click',function(e){
		e.preventDefault();
		$.ajax({

			beforeSend:function(){
						spinner = new Spinner(opts).spin(target);
			},
			dataType:'text',
			url:ruta,
			type:'post',
			data:$(this).serialize(),

			success:function(resp){
				alert(resp);
			},
			error:function(jqXHR,estado,error){
                alert(estado);
                alert(error);
                },
        	complete:function(XHR){
            	spinner.stop();

        	},
        	timeout:10000

		});
	});*/

});