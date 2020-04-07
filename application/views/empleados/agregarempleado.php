
<div class="row">
	<div class="col-md-6 col-md-offset-3 col-sm-8">
		<div class="paneles panel panel-primary">
		  <div class="panel-heading"><b>REGISTRO DE EMPLEADOS</b></div>
		  <div class="panel-body">
			<form rule="form" action="<?=base_url()?>empleados/AddEmpleado" method="post">
				<div class="form-group">
					<label for="nombre">Nombre: </label>
					<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre del empleado" required>
				</div>
				<div class="form-group">
					<label for="domicilio">Domicilio: </label>
					<input type="text" class="form-control" name="domicilio" id="domicilio" placeholder="Domicilio" required>
				</div>
				<div class="form-group">
					<label for="telefono">Telefono: </label>
					<input type="text" class="form-control" name="telefono" id="telefono" placeholder="teléfono" required>
				</div>
				<div class="form-group">
					<label for="celular">Celular: </label>
					<input type="text" class="form-control" name="celular" id="celular" placeholder="Número de celular" required>
				</div>
				<div class="form-group">
					<label for="tipo">Tipo: </label>
					<select name="tipo" id="tipo" class="form-control">
						<option value="tecnico">Técnico</option>
						<option value="secretaria">Secretaria</option>
						<option value="recepcionista">Recepcionista</option>
					</select>
					
				</div>
				<div class="form-group">
					<button class="btn btn-primary">Registrar </button>
					<?php 

						echo $message; 
						echo $error;
						echo validation_errors();
					?>	

				</div>
			</form>
		</div>
		</div>			
	</div>
</div>
</body>
</html>