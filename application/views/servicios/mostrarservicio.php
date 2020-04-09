<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
		<div class="panel panel-primary">
		  	<div class="panel-heading">Servicios</div>
		  	<div class="panel-body">
		  		<div class="col-md-4">
		  			<h3>Estados</h3>
		  			<hr>
		  			<div class="form-group">
						<form action="<?=base_url()?>serviciofolio/cambiarEstado" method="post">
							<input type="hidden" name="estado" value="pendiente">
							<button style="color:#ff6600;font-weight:bold"class="btn btn-default btn-block">Pendiente</button>
						</form>
					</div>
					<div class="form-group">
						<form action="<?=base_url()?>serviciofolio/cambiarEstado" method="post">
							<input type="hidden" name="estado" value="Terminado">
							<button style="color:#005ce6;font-weight:bold" class="btn btn-default btn-block">Terminado</button>
						</form>
					</div>

					<div class="form-group">
						<form action="<?=base_url()?>serviciofolio/cambiarEstado" method="post">
							<input type="hidden" name="estado" value="entregado">
							<button style="color:#339933;font-weight:bold"class="btn btn-default btn-block">Entregado</button>
						</form>
					</div>
					<!-- <div class="form-group">
						<form action="<?=base_url()?>serviciofolio/cambiarEstado" method="post">
							<input type="hidden" name="estado" value="urgente">
							<button class="btn btn-danger btn-block">Urgente</button>
						</form>
					</div> -->
		  		</div>
		  		<div class="col-md-4">
		  			<h3>Busqueda</h3>
		  			<hr>
		  			<form class="form-horizontal" method="post" action="<?=base_url()?>serviciofolio/buscar">
					  <div class="form-group">
					      <input type="text" placeholder="Busqueda General" name="clave" class="form-control"/>
					  </div>
					</form>
					<form action="<?=base_url()?>serviciofolio/consultaGeneral" class="form-horizontal" name="frmServicios" id="frmServicios" method="post">
						<div class="form-group" >

							<select name="lstSuc" id="lstSuc" class="form-control">
							<?php foreach($querySuc->result() as $row){
								if($sucSel==$row->idsuc)
								   {
							?>
				  				   <option selected value="<?=$row->idsuc?>"><?=$row->nombre?></option>
				  			 <?php }
				  				else{
				  			?>
				  				<option value="<?=$row->idsuc?>"><?=$row->nombre?></option>
				  			<?php   }
				  				}?>
							</select>

						</div>
					</form>
					<form method="post" action="<?=base_url()?>clientes/buscar" class="form-horizontal">
						<div class="form-group">
							<input type="text" name="nombre"class="form-control buscadorCliente" placeholder="Buscar cliente registrado">
						</div>

					</form>
		  		</div>
		  		<div class="col-md-4">
		  			<h3>Estado Actual</h3>
		  			<hr>
		  			<div  id="estadoFolio"><?php foreach($query->result() as $row){ $estado=$row->estadogeneral;}?><?=$estado?></div>
		  			<!-- <div class="urgente">
						Urg. <span id="urgente"><?php if(isset($urgente)) echo $urgente;?></span>
					</div>
					<div>
						<ul  class="nav nav-pills nav-stacked">
						  <li class="active">
						    <a href="<?=base_url()?>serviciofolio/mostrarIncompletos">
						      <span class="badge pull-right"><?=$num?></span>
						      Incorrectos
						    </a>
						  </li>
						</ul>
					</div>
 -->
		  		</div>
		  		<hr>
		  		<div  >
		  			<hr>
		  			<h3>Busqueda por estados:</h3>
		  			<hr>
		  			<form action="<?=base_url()?>servicioFolio/buscarEdo" method="post">
		  				<div class="col-md-4">
								<div class="radio">
								  <label>
								    <input type="radio" name="edo" id="blankRadio1" value="pendiente" aria-label="..." requerid>
								    Pendiente
								  </label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="radio">
								  <label>
								    <input type="radio" name="edo" id="blankRadio1" value="Terminado" aria-label="...">
								    Terminado
								  </label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="radio">
								  <label>
								    <input type="radio" name="edo" id="blankRadio1" value="Entregado" aria-label="...">
								    Entregado
								  </label>
								</div>
							</div>
		  				<div class="form-group">
		  					<input name="clave" class="form-control" placeholder="Introduce el nombre , el número de folio, modelo marca, marca modelo, marca, modelo , falla"type="text" required>
		  				</div>
		  			</form>
		  		</div>
		  	</div>
		  	<table id="tablaServicio" style="position:relative;left:0px"class="table table-bordered table-hover table-condensed">

				<thead>
					<TH>Nombre</TH>
					<th>Folio</th>
					<th>Categoria</th>
					<th>Ubicacion</th>
					<?php if($tipo!="2" && $tipo!=2){?>
					<th>Ver</th>
					<?php }?>
					<th>Eliminar</th>
					<?php if($ban==0) {?>
					<th>Imprimir</th>
					<th>Entregar</th>
					<th>Entrada/Salida</th>
					<?php }?>
					<?php if($ban==1){?>
					<th>Completar</th><?php }?>
				</thead>
				<tbody>
					<?php foreach ($query->result() as $row)
					 {?>
					<tr>
						<td><div><?=$row->nombre?></div><div><button type="button" class="btn btn-info btn-xs btnVerInfoS">más datos</button></div>
							<div  class="ocultarInfo"><label>Direccion : </label><div style="display:inline-block"><?=$row->direccion?></div> <br>
								<label for="">Fecha :</label><div style="display:inline-block"><?=$row->fecha?></div> <br>
								<label for="">Solución :</label><div style="display:inline-block"><p><?=$row->solucion?></p></div> <br>
								<label for="">Refacciones :</label><div style="display:inline-block"><?=$row->subtotal?></div> <br>
								<label for="">Servicio :</label><div style="display:inline-block"><?=$row->total?></div> <br>
								<label>Total:</label><div style="display:inline-block"><mark><?=$row->total+$row->subtotal?></mark></div>
							</div>
						</td>
						<td><?=$row->folio?></td>
						<td><?=$row->nomEquipo?><input type="hidden" name="idServ" value="<?=$row->idServ?>"><hr><span style="color:#FF33FF;font-weight:bold;"><?=$row->emisor?></span><hr style="margin:2px"> <span style="color:#336699;font-weight:bold;"><?=$row->comentario?></span><hr><button class="btn btn-primary btn-xs btnComment" type="button"><span class="glyphicon glyphicon-comment"></span> </button></td>
						<td><div class="ubicacion"><?=$row->ubicacion?></div><div class="fechaubicacion"style="font-weight:bold;"><?=$row->fechaubicacion?></div><div class="lugar" style="font-weight:bold;"><?=$row->lugar?></div><button style="color:#8000ff;border:2px solid #6600cc" class="btn btn-default cambiar btn-xs btn-block"><span class="glyphicon glyphicon-map-marker"></span></button></td>
						<?php if($tipo!="2"){?>
						<td style="text-align:center">
							<div class="btn-group">
							  <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							    Acciones <span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu" role="menu">
							    <li><a href="#"><form action="<?=base_url()?>serviciofolio/cargarVariable" method="post" role="form">
								<input type="hidden" name="folio" value="<?=$row->folio?>">
								<input type="hidden" name="pag" value="<?=$cont?>">
								<center><button class="btn btn-info btn-xs" title="editar servicio">Salida<span class="glyphicon glyphicon-check"></span></button></center>
								</form></a></li>
							    <li class="editEquipo" data-cliente="<?=$row->idcli?>" data-id="<?=$row->idEq?>"><a href="#">Editar Equipo</a></li>
							    <li class="editServicio" ><a href="#">Editar Servicio</a></li>
							    <li class="divider"></li>
							    <li class="editCliente" data-cliente="<?=$row->idcli?>"><a href="#">Editar Cliente</a></li>
							  </ul>
							</div>
						</td>
						<?php }?>
						<td style="text-align:center"><form action="" method=""><input type="hidden" name="folio" value="<?=$row->folio?>"><button type="button" class="btn btn-danger btn-xs btnEliFolio" title="eliminar servicio" ><span class="glyphicon glyphicon-remove"></span></button></form></td>
						<?php if($ban==0){?><td style="text-align:center"><a href="<?=base_url()?>serviciofolio/folioPDF/<?=$row->folio?>" target="_blank" style="color:white;<?php if(($tipo!=1 || $tipo!="1") and $estado=="Terminado") echo 'pointer-events:none;opacity:0.6;text-decoration:line-through';?>" ><button type="button" class="btn btn-info btn-xs" title="imprimir ticket"><span class="glyphicon glyphicon-print" title="imprimir ticket" ></span></button></></td>
						<td style="text-align:center">
						<a href="#" class="btn btn-xs full-width btn-success soporte" data-folio="<?=$row->folio?>"data-id="<?=$row->idServ?>">Mi aporte <i class="fa fa-handshake-o" aria-hidden="true"></i></a>
							<form action="<?=base_url()?>serviciofolio/cambiarEntregado" method="post"><input type="hidden" name="edo" value="Entregado"><input type="hidden" name="folio" value="<?=$row->folio?>">
							<input name="cont" type="hidden" value="<?=$cont?>"><center><button class="btn btn-success btn-xs" title="entregar equipo al cliente"><span class="glyphicon glyphicon-saved"></span></button></center></form>
							<hr>
							<form action="<?=base_url()?>serviciofolio/cambiarUrgente" method="post"><input type="hidden" name="edo" value="urgente"><input type="hidden" name="folio" value="<?=$row->folio?>">
							<input name="cont" type="hidden" value="<?=$cont?>"><center><button class="btn btn-warning btn-xs" title="entregar equipo al cliente">Urgente <span style="color:blue" class="glyphicon glyphicon-warning-sign"></span></button></center></form>
						</td>
						<td>
							<p style="border-bottom:solid"><strong>Entrada:</strong> <?=$row->atendio?></p>
							<p><strong>Salida:</strong><?=$row->entrego?></p>
						</td>
						<?php }?>
						<?php if($ban==1){?>
						<td style="text-align:center"><form action="<?=base_url()?>clientes/addF" method="post"><input type="hidden" name="folio" value="<?=$row->folio?>">
							<input type="hidden" name="idCli" value="<?=$row->idcli?>"><input type="hidden" name="nombre" value="<?=$row->nombre?>"></a>
							<center><button class="btn btn-success btn-xs"><span class="glyphicon glyphicon-repeat" title="conpletar datos del servicio" ></span></button></center></form></td>

							<?php }?>

					</tr>
					<?php }?>
				</tbody>
			</table>

		</div>

	</div>

<center><?=$paginacion?></center>
</div>
</div>

<!--div class="row">
	<div class="col-md-4 col-md-offset-8" style="padding:10px">
		<audio  id="alertaAudio" src="<?=base_url()?>alert/alerta.mp3" controls>
		</audio>
	</div>
</div-->

			<form rule="form">
				<input type="hidden" name="rutaEliFolio" id="rutaEliFolio" value="<?=base_url()?>serviciofolio/eliFolioAjax">
			</form>




<div class="col-md-2 col-sm-3 col-xs-4" style="top:28px;">
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

<div id="modalServ" class="modal fade" data-ruta="<?=base_url()?>js/salida.js">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><font color="red">Confirmación</font></h4>
      </div>
      <div class="modal-body">
        <p id="mnsConfir">Realmente desea borrar este servicio?</p>
      </div>
      <div class="modal-footer">
      	<button type="button" id="btnAceptar" class="btn btn-danger">Eliminar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="proceso" class="modal fade" data-ruta="<?=base_url()?>serviciofolio/getReparadores">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
       	<h4>En Proceso</h4>
      </div>
      <div class="modal-body">
        <form id="frmUbicacion" rule="form" action="<?=base_url()?>serviciofolio/modiUbicacion">
		    <div class="form-group">
				<label for="subtotal" class="col-md-2 control-label">Tecnico</label>
				<div id="rutaPass"class="col-md-4" data-ruta="<?=base_url()?>serviciofolio/comprobarPass">
					<input type="password" name="pass" id="pass" class="form-control" value="" placeholder="Contraseña">
					<input type="hidden" name="usuario" id="usuario">
					<input type="hidden" name="id_folio" id="id_folio">
				</div>
				<label for="subtotal" class="col-md-2 control-label">Lugar</label>
				<div class="col-md-4" >
					<input type="text" name="lugar" id="lugar" class="form-control" value="" placeholder="Lugar">

				</div>
			</div>
        </form>
        <div class="ubicaciones" style="margin-top:60px;">
	    </div>
      </div>
      <div class="modal-footer">
      	<button type="button" id="btnProceso" class="btn btn-success">Cambiar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- modal para servicio-->
<!-- modal para servicio-->
<div id="modalServicio" class=" modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 id="tit_servicio" class="modal-title"></h4><div class="col-md-12" style="float:right"id="spSalida"></div>
      </div>
      <div class="modal-body">
       	<form  id="frmServicio1" name="frmServicio1" role="form" action="<?=base_url()?>serviciofolio/modiServicioAjax" method="post">
			<div class="form-group">
				<label for="tipo">Tipo</label>
					<input type="text" name="tipo" id="tipo" class="form-control">
			</div>
			<div class="form-group">
				<label for="falla1" >Falla</label>
				<input type="hidden" name="idSrv" id="idSrv" >
				<textarea class="form-control" name="falla" id="falla" rows="3"></textarea>
			</div>
			<div class="form-group">
				<label for="cables" >Touch en buen estado</label>
				<select name="cables" id="cables" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
					<option value="NO SE PUEDE VERIFICAR">NO SE PUEDE VERIFICAR</option>
				</select>
			</div>
			<div class="form-group">
				<label for="chip" class=" control-label ">Contiene chip?</label>
				<select name="chip" id="chip" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
					<option value="NO SE PUEDE VERIFICAR">No se puede verificar</option>
				</select>
			</div>
			<div class="form-group">
				<label for="memoria" class=" control-label ">Contiene memoria?</label>
				<select name="memoria" id="memoria" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
					<option value="NO SE PUEDE VERIFICAR">No se puede verificar</option>
				</select>
			</div>
			<div class="form-group">
				<label for="cotizacion" class=" control-label ">Cotizacion</label>
				<input type="text" name="cotizacion" id="cotizacion" class="form-control">
			</div>
			<div class="form-group">
				<label for="" >Estado de la carcasa?</label>
				<select name="accesorios" id="accesorios" class="form-control">
					<option value="BUENA">Buena</option>
					<option value="DESPINTADA">Despintada</option>
					<option value="DOBLADA">Doblada</option>
					<option VALUE="MALTRATADA">Maltratada</option>
				</select>
			</div>
			<div class="form-group">
				<label for="calcas" >Batería en buen estado</label>
				<select name="calcas" id="calcas" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
					<option VALUE="NO SE PUEDE VERIFICAR">NO SE PUEDE VERIFICAR</option>
				</select>
			</div>
			<div class="form-group">
				<label for="calcas" >Contiene Batería?</label>
				<select name="contiene_bateria" id="contiene_bateria" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
					<option VALUE="NO SE PUEDE VERIFICAR">NO SE PUEDE VERIFICAR</option>
				</select>
			</div>
			<div class="form-group">
				<label for="golpes">El dispositivo enciende?</label>
				<select name="enciende" id="enciende" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
				</select>
			</div>
			<div class="form-group">
				<label for="" >Contiene tapa?</label>
				<select name="tapa" id="tapa" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
					<option VALUE="MALTRATADA">Maltratada</option>
				</select>
			</div>
			<div class="form-group">
				<label for="" >-Estado del marco?</label>
				<select name="tapa" id="marco" class="form-control">
					<option value="BUENO">Bueno</option>
					<option value="MALTRATADO">Maltratado</option>
					<option VALUE="ROTO">Roto</option>
				</select>
			</div>
			<div class="form-group">
				<label for="">Botones</label>
				<input type="text" class="form-control" name="botones" id="botones" value="">
			</div>
			<div class="form-group">
				<label for="" >El equipo enciende?</label>
				<select name="enciende" id="enciende" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
				</select>
			</div>
			<div class="form-group">
				<label for="" >Viene mojado?</label>
				<select name="mojado" id="mojado" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
				</select>
			</div>
		</form>
      </div>
      <div class="modal-footer">
      	<div id="spServicioInfe"></div>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" id="btnSrv"class="btn btn-primary">Guardar Cambios</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="modal-soporte" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Soporte</h4>
      </div>
      <div class="modal-body">
        <form class="" id="frm-soporte" action="<?=base_url()?>serviciofolio/agregarSoporte" method="post">
			<div class="form-group">
				<h3>Folio: <span id="span-folio"></span></h3>
			</div>
			<div class="form-group">
				<label for="">Aporte al servicio</label>
				<textarea name="aporte" class="form-control" rows="5"></textarea>
				<input type="hidden" name="id_servicio" id="id-servicio-soporte" value="">
			</div>
			<div class="form-group">
				<label for="">Password de Usuario</label>
				<input type="password" class="form-control" name="usuario_pass" id="usuario_pass" value="">
			</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" id="agregarSoporte" class="btn btn-primary">Listo</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="modalComentarios" data-ruta="<?=base_url()?>serviciofolio/getComment">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Comentarios</h4>
      </div>
      <div class="modal-body" >
      	<div id="contenidoComment" ></div>
      	<form rule="form" class="form-horizontal" method="post" name="frmComment" action="<?=base_url()?>serviciofolio/addComment"id="frmComment">
      		<div class="mensajes">
	      		<div class="form-group">
					<div class="col-lg-12" >
						<input type="text" class="form-control" name="emisor" id="emisor" placeholder="Escribe tu nombre aqui para poder comentar">
						<input type="hidden" name="idServ" id="id_servicio">
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12" >
						<textarea name="comentario" class="form-control" id="comentario"></textarea>
					</div>
				</div>
			</div>
      	</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="comentar">Comentar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<form id="frmService" name="frmService" action="" method="">
	<input type="hidden" name="rutaService" id="rutaService" value="<?=base_url()?>serviciofolio/getServicioAjax">
	<input type="hidden" name="rutaEquipo" id="rutaEquipo" value="<?=base_url()?>equipos/getEquipoAjax2">

</form>
<!-- Modal -->
<div id="modalEquipo" class="modal " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 id="tit_equipo" class="modal-title"></h4><div class="col-md-12" style="float:right"id="spEquipo"></div>
      </div>
      <div class="modal-body">
       <form rule="form" name="frmTeam" id="frmTeam" action="<?=base_url()?>equipos/modiEquipoAjax" method="post">
       		<div class="form-group">
    			<label for="nomEquipo1">Nombre del Equipo</label>
   				 <input type="text" class="form-control" id="nomEquipo1" name="nomEquipo" placeholder="Introuce el Nombre">
   				 <input type="hidden" name="idEquipo" id="idEquipo" value="">
   				 <input type="hidden" name="servicio" id="eservicio" value="">
   				 <input type="hidden" name="idCli" id="cliente" value="">
  			</div>
       		<div class="form-group">
    			<label for="marca1">Marca</label>
   				 <input type="text" class="form-control" id="marca1" name="marca" placeholder="Introuce la marca">
  			</div>
       		<div class="form-group">
    			<label for="modelo1">Modelo</label>
   				 <input type="text" class="form-control" id="modelo1" name="modelo" placeholder="Introuce el Modelo">
  			</div>
       		<div class="form-group">
    			<label for="numSerie">IMEI</label>
   				 <input type="text" class="form-control" id="numSerie1" name="numSerie" placeholder="Introuce el Nombre">
  			</div>

       		<div class="form-group">
    			<label for="descripcion1">Descripción</label>
   				 <textarea class="form-control" id="descripcion1" name="descripcion" rows="2"></textarea>
  			</div>
       		<div class="form-group">
    			<label for="color1">Color</label>
   				 <input type="text" class="form-control" id="color1" name="color" placeholder="Introuce el Color">
  			</div>
  			<div class="form-group">
    			 <label for="pass">Contraseña</label>
   				 <input type="text" class="form-control" id="pass" name="pass" placeholder="Introuce el Color">
  			</div>
       </form>

      <div class="modal-footer">
      		<div id="spEquipoInfe"></div>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" id="btnEq" class="btn btn-primary">Guardar Cambios</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>
<div id="edi-cli" class="row" data-ruta="<?=base_url()?>js/clientesgeneral.js">
	<form class="form-horizontal" id="frm-cli" rule="form" action="<?=base_url()?>clientes/modiCliAjax" method="post">
  			<div class="panel-body">
  				<div class="row">
                    <div class="col-md-6">
						<div class="form-group">
							<label for="nombre" class="control-label col-md-3">Nombre</label>
							<div class="col-md-9">
								<input class="form-control" type="text" name="nombre" id="nombre" placeholder=""/>
								<input  type="hidden" name="idCli" id="idCli" />

								<input type="hidden" name="ruta" id="ruta" value="<?=base_url()?>clientes/rellenarAjaxCli"/>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="direccion" class="control-label col-md-3">Dirección</label>
							<div class="col-md-9">
								<input class="form-control" type="text" name="direccion" id="direccion"/>
							</div>
						</div>
					</div>
				</div> <!--row-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="telefono" class="control-label col-md-3">Telefono</label>
							<div class="col-md-9">
								<input class="form-control" type="text" name="telefono" id="telefono"/>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="fecha" class="control-label col-md-3">Municipio</label>
							<div class="col-md-9">
								<input class="form-control" type="text" name="fecha" id="fecha"/>
							</div>
						</div>
					</div>
				</div><!--row-->
				<div class="row">
					<div class="col-md-6">

					</div>

				</div><!--row-->
				<div class="row">

					<div class="col-md-6">
						<p style="color:red;text-align:center" id="mnsModi"></p>
					</div>
			</form>

</div>
</body>
</html>
