
<div class="row">
	<form  role="form" method="post" action="addsuc">
	<div class=" col-md-6 col-md-offset-3">
		<div class="paneles panel panel-primary">
  <div class="panel-heading"><B>REGISTRO DE SUCURSALES</B></div>
  <div class="panel-body">
			<div id="edo-nombre" class="form-group">
				<label for="nombre">Nombre</label>
				<input class="form-control" type="text" id="nombre" name="nombre" placeholder="Nombre de la sucursal"required/>
			</div>
			<div class="form-group">
				<label for="domicilio">Domicilio</label>
				<input type="text" class="form-control" id="domicilio" name="domicilio" placeholder="Domcilio de la sucursal"required/>
			</div>
			<div class="form-group">
				<label for="localidad">Localidad</label>
				<input type="text" class="form-control" id="localidad"  name="localidad" placeholder="Localidad"required/>
			</div>
			<div class="form-group">
				<label for="edo">Estado</label>
				<input type="text" class="form-control" id="edo" name="edo" placeholder="Estado" value="Michoacán" required/>
			</div>
			<div class="form-group">
				<label for="telefono">Telefono</label>
				<input type="text" class="form-control" id="telefono" name="telefono" placeholder="teléfono"required/>
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button><?=validation_errors()?>
			<div class="<?php if(!empty($error)) echo 'error';?>" ><?=$error?></div>
			<div class="exito"><?=$message?></div>
		</form>
</div></div><!--paneles-->
	</div>
</div>

</body>
</html>