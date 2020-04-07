$(document).on('ready',function()
{
	menu=$(".menuIzq");
	menu.hover(function()
	{
			$(this).animate({'width':'185px'},500);
			$(this).animate({'background-color':'#ffe6f7'},0);
		},function(){
			//$(this).animate({'opacity':'.4'},1000);
			$(this).animate({'width':'100%'},200);
			$(this).animate({'background-color':'white'},50);
	})
	/*var submenu=$('.submenu');
	
	menuIcon=document.frmInicial.dire.value;
	menuIconN=document.frmInicial.direN.value;
	submenu.hide();
	var item=$('.item-logo');
	var menuItem=$('#menu div ');
	var txtEmp=$('#txtEmp');
	/*jQuery.fn.rotate = function(degrees) {
    $(this).css({'-webkit-transform' : 'rotate('+ degrees +'deg)',
                 '-moz-transform' : 'rotate('+ degrees +'deg)',
                 '-ms-transform' : 'rotate('+ degrees +'deg)',
                 'transform' : 'rotate('+ degrees +'deg)'});
};
	$('#menu').hover(function()
		{
			//$(this).animate({'opacity':'1'},500)
			$(this).animate({'background-color':'rgba(153,204,255,1)'},500);
		},function(){
			//$(this).animate({'opacity':'.4'},1000);
			$(this).animate({'background-color':'rgba(153,204,255,0.0)'},500);
		});
	menuItem.hover(function()
	{
		
	$(this).find(item).css({'background-image':'url('+menuIcon+')'});
	},
		function(){
			$(this).find('ul').hide('drop',500);
			$(this).find('.texto').show('shake',500);
			$(this).find(item).css({'background-image':'url('+menuIconN+')','margin-top':'0px'});

		});
	menuItem.on('click',function()
	{
		
		$(this).find('.texto').hide('drop',500);
		$(this).find('ul').show('shake',500);
		$(this).find('.item-logo').animate({'margin-top':'10px'},500);
		
	})
	/*$('#item-empleado').hover(
		function()
		{
				txtEmp.hide();
				$('#subEmp').show('bounce',500);
		},
		function()
		{
			txtEmp.show('clip',500);
			$('#subEmp').hide();
		});*/
});
