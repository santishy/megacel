<div class="row">
	<div class="col-md-6 col-md-offset-2">
		<div class="paneles panel panel-primary">
  <div class="panel-heading"><B>MODIFICAR REFACCIÓN</B></div>
  <div class="panel-body">
		<form role="form" action="<?=base_url()?>refacciones/modiRef" method="post">
			<?php if($query->num_rows()>0) foreach($query->result() as $row){?>
			<div class="form-group">
				<label for="nombreAcc">Nombre</label>
				<input type="text" class="form-control" name="nombreAcc" id="nombreAcc" value="<?=$row->nombreAcc?>">
			</div>
			<div class="form-group">
				<label for="marca">Marca</label>
				<input type="text" class="form-control" name="marca" id="marca" value="<?=$row->marca?>">
			</div>
			<div class="form-group">
				<label for="precio">Precio</label>
				<input type="text" pattern="[-+]?(?:\b[0-9]+(?:\.[0-9]*)?|\.[0-9]+\b)(?:[eE][-+]?[0-9]+\b)?" class="form-control" name="precio" id="precio" value="<?=$row->precio?>">
			</div>
			<div class="form-group">
				<label for="descripcion">Descripción</label>
				<input type="text" class="form-control" name="descripcion" id="descripcion" value="<?=$row->descripcion?>">
			</div>
			<div class="form-group">
				<label for="cant">Cantidad</label>
				<input type="number" class="form-control" name="cant" id="cant" value="<?=$row->cant?>">
			</div>
			<input type="hidden" name="idsuc" value="<?=$row->idsuc?>">
			<input type="hidden" name="idref" value="<?=$row->idref?>"><?php };?>
			<div class="form-group">
				<button class="btn btn-primary">Modificar</button>
			</div>	<?=validation_errors()?><div class="exito"><?=$message?></div>
			
		</form>
	</div>
</div><!--paneles-->
	</div>
</div>