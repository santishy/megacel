<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-4">
				<form method="post" action="<?=base_url()?>ComprasController/comprasCorte">
					<div class="form-group">
						<label>De</label>
						<input type="date" name="inicio" class="form-control">
					</div>
					<div class="form-group">
						<label>Hasta</label>
						<input type="date" name="fin" class="form-control">
					</div>
					<div class="form-group">
						<button class="btn btn-info">Corte</button>
					</div>
				</form>
			</div>
		</div>
		<div class="col-md-12">
			<table class="table table-striped">
				<thead>
					<th>ID</th>
					<th>Nombre</th>
					<th>Modelo</th>
					<th>Marca</th>
					<th>Categoria</th>
					<th>Color</th>
					<th>Cant. Compras</th>
					<th>Exist</th>
					<th>Acciones</th>
				</thead>
				<tbody>
					<?php foreach($compras->result() as $compra){?>
						<tr>
							<td><?=$compra->id_det_color?></td>
							<td><?=$compra->nombre_producto?></td>
							<td><?=$compra->modelo?></td>
							<td><?=$compra->marca?></td>
							<td><?=$compra->categoria?></td>
							<td><?=$compra->color?></td>
							<td><?=$compra->cant_compra?></td>
							<td><?=$compra->exist?></td>
							<td>
								<form method="post" action="<?=base_url()?>ComprasController/eliminar">
									<input type="hidden" name="id_color" value="<?=$compra->id_color?>">
									<input type="hidden" name="total" value="<?=$compra->total?>">
									<input type="hidden" name="id" value="<?=$compra->id_det_compra?>">
									<button class="btn btn-xs btn-danger">X</button>
								</form>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
