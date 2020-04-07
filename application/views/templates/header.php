<!DOCTYPE html>
<html lang="es">


<head>	
  <meta contentType="application/json"charset=utf-8>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  
	<title>
    <?php 
        if(isset($title))
          echo $nomSuc.' '.$title;
        else
          echo $nomSuc.'Servicio';
    ?>    
  </title>

 
  <link href="<?=base_url()?>css/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css">
  <link href="<?=base_url()?>css/bootstrap.min.css" rel="stylesheet" type="text/css">	
  <link href="<?=base_url()?>css/styles.less" rel="stylesheet/less" type="text/css">
  <link href="<?=base_url()?>css/dataTables.css" rel="stylesheet/less" type="text/css">
  <link href="<?=base_url()?>css/font-awesome.min.css" rel="stylesheet/less" type="text/css">

  <script src="<?=base_url()?>js/less.js" type="text/javascript"></script>
  <script src="<?=base_url()?>js/JQuery.js" type="text/javaScript"></script> 
  <script src="<?=base_url()?>js/jquery-ui-1.10.3.custom.min.js"></script>
  <script src="<?=base_url()?>js/jquery.dataTables.min.js"></script>
  
  <script src="<?=base_url()?>js/bootstrap.js"></script>
  <script src="<?=base_url()?>js/spin.js"></script>
  <script src="<?=base_url()?>js/ZeroClipboard.js" type="text/javascript"></script>
  <script src="<?=base_url()?>js/dataTables.tableTools.min.js" type="text/javaScript"></script>
  <script src="<?=base_url()?>js/<?=$ruta?>" type="text/javaScript"></script>
  <script src="<?=base_url()?>js/hola.js" type="text/javaScript"></script>
   
 
</head>
<body>

   <form name="frmInicial">
    <input type="hidden" name="dire" value="<?=base_url()?>/img/menupre.png">
    <input type="hidden" name="direN" value="<?=base_url()?>/img/menu.png">
   </form>
   
        <nav  class="navbar navbar-default navbar-fixed-top " role="navigation" style="margin-bottom:0px;border-radius:0px; width:100%;">
        <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=base_url()?>serviciofolio/consultaGeneral""></a>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
            </ul>
            <!-- <ul class="nav navbar-nav navbar-left">       
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" alt="configuración" title="configuración">$nomSuc</a>
                
              </li>
            </ul> -->
            <ul class="nav navbar-nav navbar-left">       
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sucursales <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?=base_url()?>sucursal/addSuc">Agregar </a></li>
                  <li><a href="<?=base_url()?>sucursal/mostrar">Consulta</a></li>
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-left">       
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Empleados <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?=base_url()?>empleados/AddEmpleado">Agregar</a></li>
                  <li><a href="<?=base_url()?>empleados/MostrarE">Consulta</a></li>
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-left">       
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuarios <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?=base_url()?>usuarios/VistaAdd">Agregar</a></li>
                  <li><a href="<?=base_url()?>usuarios/mostrarUsers">Consulta</a></li>
                 
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-left">       
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pedidos<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?=base_url()?>pedidos/addPedido">Agregar</a></li>
                  <li><a href="<?=base_url()?>pedidos/ver">Ver</a></li>
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-left">       
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" alt="configuración" title="configuración"><span class="glyphicon glyphicon-cog"></span>  Configuración<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?=base_url()?>serviciofolio/updateTicket">Ticket</a></li>  
				  <li><a href="<?=base_url()?>serviciofolio/updateMensaje">Mensaje de texto</a></li>                     	
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-left">
                 <li><a href="<?=base_url()?>usuarios/rendimiento">Rendimiento</a></li>
            </ul>
             <form class="navbar-form navbar-left" method="post" action="<?=base_url()?>serviciofolio/buscar">
              <div class="form-group">
                <input type="text"  placeholder="Buscar: Nombre / Folio" name="clave" class="form-control">
              </div>
            </form>
            <form method="post" action="<?=base_url()?>clientes/buscar" class="navbar-form navbar-left">
            <div class="form-group">
              <input type="text" name="nombre"class="form-control buscadorCliente" placeholder="Nombre del Cliente Registrado"> 
            </div>
              
          </form>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span><?=$usuario?></span> <i class="fa fa-user"></i><b class="caret"></b></a>  
                <ul class="dropdown-menu">
                  <li><a href="<?=base_url()?>usuarios/miUser">Perfil</a></li>
                  <li><a href="<?=base_url()?>login/cerrarSesion">Cerrar sesión</a></li>
                </ul>
              </li>
            </ul>
           
            
            <!--<p class="navbar-text navbar-right"><a href="<?=base_url()?>login/cerrarSesion" style="color:white" class="navbar-link">Cerrar Sesión</a></p>-->

          </div><!-- /.navbar-collapse -->
        </nav>
      <div class="container " id="contenedor-principal">
        <div class="row">
          <div class="col-md-2 col-sm-3 col-xs-4 menulateral" style="top:28px;">
            <div class="list-group paneles ">
              <a href="#" class="list-group-item active">
                Clientes
              </a>
             <a href="<?=base_url()?>clientes/addCliente" class="list-group-item menuIzq">Agregar</a>
              <a href="<?=base_url()?>clientes/mostrar" class="list-group-item menuIzq">Consulta</a>
            </div>
            <div class="paneles list-group">
              <a href="#" class="list-group-item active">
                Servicios
              </a>
              <a href="<?=base_url()?>serviciofolio/consultaGeneral" class="list-group-item menuIzq">Consulta</a>
              <a href="<?=base_url()?>serviciofolio/fechasCorte" class="list-group-item menuIzq">Corte</a>
            </div>
            <div class="paneles list-group">
              <a href="#" class="list-group-item active " style="background-color:#F80000 ">
                Mas de 30 dias
              </a>
              <a href="<?=base_url()?>serviciofolio/expirados" class="list-group-item menuIzq">Ver</a>
            </div>
          </div><!--menu Lateral-->
          <div class="col-md-10 col-sm-9 col-xs-8 col-lg-10 " id="contenedor-derecho">
         
        
