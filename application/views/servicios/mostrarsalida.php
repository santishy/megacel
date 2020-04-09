<div class="row">
	<div class="col-md-11 col-sm-11 col-lg-11 col-md-offset-1 col-sm-offset-1 col-lg-offset-1">
		<div id="servicio" class="encabezado">Servicio<br><small> Click aquí para editarlo</small></div>
			<div class="table-responsive">
				<table id="tabla_detservicio" class="table table-bordered table-hover table-condensed">
					<thead>
						<tr class="success">
							<th>Folio</th>
							<th>Tipo</th>
							<th>Tecnico</th>
							<th>Falla</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($query->result() as $row) {?>
						<tr class="active">
							<td><?=$row->folio?></td>
							<td><?=$row->tipo?></td>
							<td><?=$row->entrego?></td>
							<td><?=$row->falla?></td><?php
									$folio=$row->folio;
									$solucion=$row->solucion;

								}?>
						</tr>
					</tbody>
				</table>
			</div><!--responsive tabla detservicio-->
		<div class="table-responsive">
			<div id="equipo" class="encabezado">Equipo <br><small> Click aquí para editarlo</small></div>
			<table class="table table-hover table-bordered table-condensed" id="tablaEquipo">
				<thead>
					<tr class="success">
					<th>Nombre</th>
					<th>Marca</th>
					<th>Modelo</th>
					<th>Nom. Serie</th>
					<!-- <th>Descripción</th> -->
					<th>Color</th>
					<th>Contraseña</th>
				</tr>
				</thead>
				<tbody>
					<?php foreach($query->result() as $row){ $total=$row->total;?>
					<tr class="active">
						<td><?=$row->nomEquipo?></td>
						<td><?=$row->marca?></td>
						<td><?=$row->modelo?></td>
						<td><?=$row->numSerie?></td>
						<!-- <td>$row->descripcion</td> -->
						<td><!-- <div id="idColor"><input type="color" value=""></div>--><?=$row->color?></td>
						<td><?=$row->contraseña?></td>
						<?php $id=$row->idServ;?>
					</tr><?php $idEquipo=$row->idEq;
								$idCli=$row->idCli;
								$nombreEquipo=$row->nomEquipo.' '.$row->marca;}?>
				</tbody>
			</table>
		</div><!--responsive tabla detservicio-->
		<div class="table-responsive">
			<div class="encabezado">Cliente</div>
			<table class="table table-hover table-bordered table-condensed" id="tablaCliente">
				<thead>
					<tr class="success">
					<th>Nombre</th>
					<th>Direccion</th>
					<th>Telefono</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($query->result() as $row){?>
					<tr class="active">
						<td><?=$row->nombre?></td>
						<td><?=$row->direccion?></td>
						<td><?=$row->telefono?></td>
					</tr><?php $idC=$row->idCli;
								$nombreCli=$row->nombre;
							}?>
				</tbody>
			</table>
		</div>
	</div>
<div class="row" style="display:none">
	<div class="col-md-11 col-sm-11 col-lg-11 col-md-offset-1 col-sm-offset-1 col-lg-offset-1">
		<div class="col-md-3">
			<div class="list-group">
  <a href="#" class="list-group-item active">
  Refacciones
  </a>
		<a href="#" class="list-group-item"><form action="<?=base_url()?>refacciones/cargarServicio" method="post">
			<!--input type="hidden" name="servicio" value="<?=$cont?>"-->
			<?php foreach($query->result() as $row){?>
			<input type="hidden" name="idServ" id="idServ" value="<?=$row->idServ?>">
			<?php $id=$row->idServ;}?>
			<button class="btn btn-xs btn-info" title="Agregar refacciones temporalmente">Agregar<span class="glyphicon glyphicon-wrench"></span></button>
		</form></a>
		<a href="#" class="list-group-item">
		<form action="<?=base_url()?>refacciones/destruir" method="post">
				<!--input type="hidden" name="uri" value="<?=$cont?>"-->
			<button class="btn btn-xs btn-danger" title="Quitar refacciones">Deshacer<span class="glyphicon glyphicon-trash"></span></button>
		</form></a>
		<a href="" class="list-group-item">
		<form action="<?=base_url()?>refacciones/terminar" method="post">
				<!--input type="hidden" name="uri" value="<?=$cont?>"-->
			<button class="btn btn-xs btn-success" title="Agrega al servicio las refacciones temporales">Terminar <span class="glyphicon glyphicon-ok"></span></button>
		</form></a></div></div>
		<div class="col-md-9">
			<div class="encabezado">Refacciones Utilizadas</div>
		<div class="table-responsive">
			<table class="table table-bordered table-condensed table-hover">
				<thead>
					<tr class="success">
					<th>Nombre</th>
					<th>Precio</th>
					<th>Cantidad</th>
					<th>Subtotal</th>
					<th>Modificar</th>
					</tr>
				</thead>
				<tbody><form action="<?=base_url()?>refacciones/actualizar" method="post"?>
					<?php $i=1;
					foreach($this->cart->contents() as $items){ if($items['idServ']==$id){?>
					<tr class="active">
						<input type="hidden" name="<?=$i?>[rowid]" value="<?=$items['rowid']?>">
						<td><?=$items['name']?></td>
						<td><?php echo $this->cart->format_number($items['price']);?></td>
						<td><input class="form-control"name="<?=$i?>[qty]" value="<?=$items['qty']?>"></td>
						<td><?php echo $this->cart->format_number($items['subtotal']);?>
							<!--input type="hidden" name="uri" value="<?=$cont?>"></td-->
						<td><button class="btn btn-xs btn-success" title="modifica la cantidad , cantidad 0 tiene el mismo efecto que boton Deshacer"><span class="glyphicon glyphicon-edit"></span></button></td>
					<tr>
						<?php $i++;}else break;}?></form>
						<tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>
<div class="well">
	<div class="row">
		<div class="col-md-11 col-sm-11 col-lg-11 col-md-offset-1 col-sm-offset-1 col-lg-offset-1">
		<form id="frmSalida"class="form-horizontal" role="form" action="<?=base_url()?>serviciofolio/salida" method="post" name="frmSalida">
			<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="estado" class="col-md-3 control-label">Estado</label>
					<div class="col-md-9">
						<select id="estado1" name="estado" class="form-control">
							<option value="pendiente">Pendiente</option>
							<option value="Terminado">Terminado</option>
							<option class="Entregado">Entregado</option>
						</select>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="subtotal" class="col-md-3 control-label">Tecnico</label>
					<div id="rutaPass"class="col-md-9" data-ruta="<?=base_url()?>serviciofolio/comprobarPass">
						<input type="password" name="pass" id="pass" class="form-control" value="" placeholder="Contraseña">
						<input type="hidden" name="usuario" id="usuario">
					</div>
				</div>
			</div>
			</div>
			<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="subtotal" class="col-md-3 control-label">Mano de obra</label>
					<div class="col-md-9">
						<input type="hidden" name="idServ" value="<?php if(isset($id) || !empty($id)) echo $id; else redirect('serviciofolio/mostrarServicios');?>"/>
						<input class="form-control" name="mano_obra" id="total" type="number" min="0" value="<?php if(isset($total)) echo $total;?>" />
						<input type="hidden" id="hdnFolio" name="hdnFolio" value="<?=$folio?>">
						<input type="hidden" id="hdnEquipo" name="hdnEquipo" value="<?=$nombreEquipo?>">
						<input type="hidden" id="hdnCli" name="hdnCli" value="<?=$nombreCli?>">

					</div>
				</div>


			</div>


			<div class="col-md-6">
				<div class="form-group">
					<label for="subtotal" class="col-md-3 control-label">Solución</label>
					<div class="col-md-9">
						<textarea class="form-control" name="solucion" id="solucion"><?php if(isset($solucion)) echo $solucion;?></textarea>
					</div>
				</div>

			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="col-md-3 control-label">Total Refacciones</label>
					<div class="col-md-9">
						<input name="refaccion" class="form-control" value="0" type="number">
					</div>

				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<button type="button" id="btnSalidaServicio" class="btn btn-primary" >Salida</button>
				</div>
			</div>
		</div>
		</form></div></div></div>
	<!--center><?=$paginacion?></center-->
</div><!--row principal-->
<form id="frmService" name="frmService" action="" method="">
	<input type="hidden" name="rutaService" id="rutaService" value="<?=base_url()?>serviciofolio/getServicioAjax">
	<input type="hidden" name="rutaEquipo" id="rutaEquipo" value="<?=base_url()?>equipos/getEquipoAjax2">
	<input type="hidden" name="idS" id="idS" value="<?=$id?>">
</form>
<!-- Modal -->
<div id="modalEquipo" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
   				 <input type="hidden" name="idEquipo" id="idEquipo" value="<?=$idEquipo?>">
   				 <input type="hidden" name="servicio" id="eservicio" value="<?=$id?>">
   				 <input type="hidden" name="idCli" value="<?=$idC?>">
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
      </div>
      <div class="modal-footer">
      		<div id="spEquipoInfe"></div>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" id="btnEq" class="btn btn-primary">Guardar Cambios</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
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
				<select name="marco" id="marco" class="form-control">
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


</div>
</body>
</html>
