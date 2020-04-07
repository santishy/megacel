<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1">
		<div class="btn-group">
			<form action="<?=base_url()?>serviciofolio/cambiarEstado" method="post">
				<input type="hidden" name="estado" value="pendiente">
				<button class="btn btn-info">Pendiente</button>
			</form>
		</div>
		<div class="btn-group">
			<form action="<?=base_url()?>serviciofolio/cambiarEstado" method="post">
				<input type="hidden" name="estado" value="Terminado">
				<button class="btn btn-primary">Terminado</button>
			</form>
		</div>
		
		<div class="btn-group">
			<form action="<?=base_url()?>serviciofolio/cambiarEstado" method="post">
				<input type="hidden" name="estado" value="entregado">
				<button class="btn btn-success">Entregado</button>
			</form>
		</div>
		<div class="btn-group">
			<form action="<?=base_url()?>serviciofolio/cambiarEstado" method="post">
				<input type="hidden" name="estado" value="urgente">
				<button class="btn btn-danger">Urgente</button>
			</form>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
	<ul style="display:inline-block" class="nav nav-pills nav-stacked">
	  <li class="active">
	    <a href="<?=base_url()?>serviciofolio/mostrarIncompletos">
	      <span class="badge pull-right"><?=$num?></span>
	      Incorrectos
	    </a>
	  </li>
	</ul>
</div>

</div>
<div class="row">
	<div class="col-md-7" id="buscadorServicios">
		<form class="form-horizontal" method="post"role="form" action="<?=base_url()?>serviciofolio/buscar">
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Buscar</label>
		    <div class="col-sm-8">
		      <input type="text" name="clave" class="form-control" placeholder=""/>
		    </div>
		    <div class="col-md-2"><button class="btn btn-warning"><span class="glyphicon glyphicon-hand-up"></span></button></div>
		  </div>
		 </form>
	</div>
	<div class="col-md-4 col-md-offset-1" id="estadoFolio"><?php foreach($query->result() as $row){ $estado=$row->estadogeneral;}?><?=$estado?></div>
</div>
<div class="row">
	<div style="margin-top:10px;border:3px dotted blue; padding:5px;" class="col-lg-8 col-md-8 col-sm-8 col-xs-8 ">
		<form action="<?=base_url()?>serviciofolio/consultaGeneral" class="form-horizontal" name="frmServicios" id="frmServicios" method="post">
			<div class="form-group" >
				<label for="lstSuc" class="col-md-2 control-label">Sucursal</label>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
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
				<div class="col-md-4" id="divSucsel"></div>
				<!-- <div class="col-md-4"><button class="btn btn-primary">Buscar</button></div> -->
			</div>
			
		</form>
	</div>
</div>
<div class="row">
	<div class="col-md-12 col-sm-12 col-lg-12">
		<span class="titleSection">SERVICIOS</span>
		<div class="table-responsive">
			<form rule="form">
				<input type="hidden" name="rutaEliFolio" id="rutaEliFolio" value="<?=base_url()?>serviciofolio/eliFolioAjax">
			</form>
			<table id="tablaServicio" class="table table-bordered table-hover table-condensed">
				
				<thead>
					<TH>Nombre</TH>
					<th>Folio</th>
					<th>Categoria</th>
					<th>Ubicacion</th>
					<?php if($ban==0) {?>
					<th>Imprimir</th>
					<th>Entregar</th>
					<th>Tecnico</th>
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
						<td><?=$row->nomEquipo?><input type="hidden" name="idServ" value="<?=$row->idServ?>"><hr> <span style="color:#336699;font-weight:bold;"><?=$row->comentario?></span><hr><button class="btn btn-primary btn-xs btnComment" type="button"><span class="glyphicon glyphicon-comment"></span> </button></td>
						<td><div class="ubicacion"><?=$row->ubicacion?></div><div class="fechaubicacion" style="font-weight:bold;"><?=$row->fechaubicacion?></div><button class="btn btn-warning cambiar btn-xs"><span class="glyphicon glyphicon-retweet"></span></button></td>
						
						<?php if($ban==0){?><td style="text-align:center"><a href="<?=base_url()?>serviciofolio/folioPDF/<?=$row->folio?>" target="_blank" style="color:white"><button type="button" class="btn btn-info btn-xs" title="imprimir ticket"><span class="glyphicon glyphicon-print" title="imprimir ticket" ></span></button></></td>
						<td style="text-align:center">
							<form action="<?=base_url()?>serviciofolio/cambiarEntregado" method="post"><input type="hidden" name="edo" value="Entregado"><input type="hidden" name="folio" value="<?=$row->folio?>">
							<input name="cont" type="hidden" value="<?=$cont?>"><center><button class="btn btn-success btn-xs" title="entregar equipo al cliente"><span class="glyphicon glyphicon-saved"></span></button></center></form>
							<form action="<?=base_url()?>serviciofolio/cambiarEntregado" method="post"><input type="hidden" name="edo" value="urgente"><input type="hidden" name="folio" value="<?=$row->folio?>">
							<input name="cont" type="hidden" value="<?=$cont?>"><center><button class="btn btn-warning btn-xs" title="entregar equipo al cliente">Urgente <span class="glyphicon glyphicon-warning-sign"></span></button></center></form>
						</td>
						<td><?=$row->entrego?></td>
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
		<center><?=$paginacion?></center>
	</div>
</div>
<div id="modalServ" class="modal fade">
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
<div id="proceso" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
       	<h4>En Proceso</h4>
      </div>
      <div class="modal-body">
        <form id="frmUbicacion" rule="form" action="<?=base_url()?>serviciofolio/modiUbicacion">
		    <div class="form-group">
				<label for="subtotal" class="col-md-3 control-label">Tecnico</label>
				<div id="rutaPass"class="col-md-9" data-ruta="<?=base_url()?>serviciofolio/comprobarPass">
					<input type="password" name="pass" id="pass" class="form-control" value="" placeholder="Contraseña">
					<input type="hidden" name="usuario" id="usuario">
					<input type="hidden" name="id_folio" id="id_folio">
				</div>
			</div>
        </form>
      </div>
      <div class="modal-footer">
      	<button type="button" id="btnProceso" class="btn btn-success">Cambiar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
       
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
<div id="edi-cli" class="row">	
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
</div><!--modal-->
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
					<select name="tipo" id="tipo" class="form-control">
						<option value="servicio">Servicio</option>
						<option value="garantia">Garantía</option>
						<option value="reingreso">Reingreso</option>
						<option value="diagnostico">Diagnostico</option>
					</select>
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
				<label for="discos" class=" control-label ">Display en buen estado</label>
				<select name="discos" id="discos" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
					<option value="NO SE PUEDE VERIFICAR">No se puede verificar</option>
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
				<label for="accesorios" >Carcasa estado estetico</label>
				<input type="text" name="accesorios" id="accesorios" class="form-control">
			</div>
			<div class="form-group">
				<label for="calcas" >Batería en buen estado</label>
				<select name="calcas" id="calcas" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
					<OPTION value="NO CONTIENE">NO CONTIENE</OPTION>
					<option VALUE="NO SE PUEDE VERIFICAR">NO SE PUEDE VERIFICAR</option>
				</select>
			</div>
			<div class="form-group">
				<label for="golpes">El dispositivo enciende</label>
				<select name="golpes" id="golpes" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
					<option value="NO SE PUEDO VERIFICAR">No se puede verificar</option>
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
</div>

</body>
</html>