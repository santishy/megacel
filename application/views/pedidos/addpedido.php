<div class="row">
	<div class="col-md-4">
		<div class="panel panel-info">
		  <div class="panel-heading">Pedidos</div>
		  <div class="panel-body">
			<form rule="form" id="frmPedidos"method="post" action="<?=base_url()?>pedidos/addPedido">
				<div class="form-group">
					<label>Pedido</label>
					<textarea class="form-control" rows="5"id="orden" name="orden"></textarea>
				</div>
				<div class="form-group">
					<label>Para el</label>
					<input type="text" class="form-control" name="fecha_orden" id="fecha_orden" value="<?=$fecha?>">
				</div>
				<div class="form-group">
					<label id="pass" data-ruta="<?=base_url()?>pedidos/comprobarPass">Password</label>
					<input type="password" name="user" id="user" class="form-control">
				</div>
				<div class="form-group">
					<label>Anticipo</label>
					<input type="text" name="anticipo" id="anticipo" value="No Hay" class="form-control">
				</div>
				<div class="form-gropu">
					<button class="btn btn-primary" id="btnPedido" type="button">Guardar</button>
				</div>
			</form>
			<hr>
			<?=validation_errors()?>
			<div class="mensaje"><?=$mensaje?></div>
		</div>
	</div>
	</div><!--final panel-->
	<div class="col-md-8">
		<div class="panel panel-info">
		  <div class="panel-heading">Para el Miercoles <?=$fecha?></div>
		  <div class="panel-body">
		  	<table class="table table-bordered">
		  		<thead style="color:white;background-color:#00CCFF">	
		  			<th>Pedido</th>
		  			<th>Anticipo</th>
		  			<th>Password</th>
		  			<th>Opciones</th>
		  		</thead>
		  		<tbody>
		  			<?php foreach($query->result() as $row)
		  			{?>
		  				<tr <?php if($row->estado!= 'PENDIENTE') ECHO 'style="background-color:#CCF5FF;color:white;">';?>>
		  					<td><?=$row->orden?></td>
		  					<td><?=$row->anticipo?></td>
		  					<td><?=$row->user?></td>
		  					<td>
		  						<form method="post" action="<?=base_url()?>pedidos/eliminarPedido">
		  							<input type="hidden" name="id_pedido" value="<?=$row->id_pedido?>">
		  							<button class="btn btn-danger btn-xs">X</button>
		  						</form>
		  					</td>
		  				</tr>
		  			<?php }?>
		  		</tbody>
		  	</table>
		  </div>
		</div>
	</div>
</div>