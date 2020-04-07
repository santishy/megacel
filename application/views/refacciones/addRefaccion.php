
<div class="row">
	<div class="col-md-6 col-md-offset-3 col-sm-8">
		<div class="paneles panel panel-primary">
		  <div class="panel-heading"><b>REGISTRO DE REFACCIONES</b></div>
		  <div class="panel-body">
			<form role="form" id="frmAddRef" action="<?=base_url()?>refacciones/addRef" method="post">
				<div class="form-group">
					<label class="nombreAcc">Nombre</label>
					<input type="text" pattern="^(\w+\s?\w*)+$" title="Solo letras y numeros" name="nombreAcc" id="nombreAcc" class="form-control" placeholder="Nombre de la refacción o artículo" required>
				</div>
				<div class="form-group">
					<label class="marca">Marca</label>
					<input type="text" name="marca" pattern="^(\w+\s?\w*)+$" id="marca" title="Solo letras y numeros" class="form-control" placeholder="marca de la refacción o artículo" required>
				</div>			
				<div class="form-group">
					<label class="precio">Precio</label>
					<input type="number" pattern="[-+]?(?:\b[0-9]+(?:\.[0-9]*)?|\.[0-9]+\b)(?:[eE][-+]?[0-9]+\b)?" name="precio" id="precio" value="0" min="0" class="form-control" placeholder="precio de la refacción">
				</div>

				<div class="form-group">
					<label class="cant">Cantidad</label>
					<input type="number" pattern="^\d+$" name="cant" title="Solo numeros" id="cant" min="1" value="1" class="form-control" required>
				</div>

				<div class="form-group">
					<label class="descripcion">Descripcion</label>
					<input type="text" name="descripcion" title="Solo letras y numeros" pattern="^(\w+\s?\w*)+$" id="descripcion" class="form-control" placeholder="descripción de la refacción o artículo" required>
				</div>
				<div class="row">
					<div style="padding:10px;" class="col-lg-3"><button type="submit" id="btnAddRef" class="btn btn-primary">Guardar</button></div><?=validation_errors()?>
					<div style="padding:10px;" id="divMensaje" class="col-lg-7"></div>
				</div>
				<div class="exito"><?=$message?></div>
			</form>
		   </div>	
		 </div>
		</div>
	</div>
</div>