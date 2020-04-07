
<div class="row">
	<form class="form-horizontal" rule="form" action="addCliente" method="post">
	<div class="col-md-11 col-sm-11 col-lg-11 col-md-offset-1 col-sm-offset-1 col-lg-offset-1">
		<div class="paneles panel panel-primary">
 			 <div class="panel-heading"><B>REGISTRO DE CLIENTES<B></div>
  			<div class="panel-body">	
  				<div class="row">
  					
                    <div class="col-md-6">
						<div class="form-group">
							<label for="nombre" class="control-label col-md-3">Nombre</label>
							<div class="col-md-9">
								<input class="form-control" type="text" placeholder="Nombre completo" title="Debe tener al menos, un nombre y un apellido" name="nombre" id="nombre" placeholder="" required/>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="fecha" class="control-label col-md-3">Municipio</label>
							<div class="col-md-9">
								<input class="form-control" type="text" name="fecha" id="fecha" required/>
							</div>
						</div>
					</div>
					<!--div class="col-md-6">
						<div class="form-group">
							<label for="correo" class="control-label col-md-3">Correo</label>
							<div class="col-md-9">
								<input class="form-control" type="text" placeholder="e-mail" name="correo" id="correo" required/>
							</div>
						</div>
					</div-->
				</div> <!--row-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="telefono" class="control-label col-md-3">Telefono</label>
							<div class="col-md-9">
								<input class="form-control" pattern="^([0-9]{1,3})(\-?[0-9])+" type="text" placeholder="Número de teléfono" title="Solo puede contener un guion a la vez, y terminar en un numero" name="telefono" id="telefono"/>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="direccion" class="control-label col-md-3">Dirección</label>
							<div class="col-md-9">
								<input class="form-control" type="text" name="direccion" placeholder="Calle y número" id="direccion"required/>
							</div>
						</div-->
						<!--div class="form-group">
							<label for="estado" class="control-label col-md-3">Estado</label>
							<div class="col-md-9">
								<select name="estado" id="estado" class="form-control">
									<option value="Aguascalientes">Aguascalientes</option>
									<option value="Baja California">Baja California</option>
									<option value="Baja California Sur">Baja California Sur</option>
									<option value="Campeche">Campeche</option>
									<option value="Chiapas">Chiapas</option>
									<option value="Chihuahua">Chihuahua</option>
									<option value="Coahuila">Coahuila</option>
									<option value="Colima">Colima</option>
									<option value="Distrito Federal">Distrito Federal</option>
									<option value="Durango">Durango</option>
									<option value="Estado de México">Estado de México</option>
									<option value="Guanajuato">Guanajuato</option>
									<option value="Guerrero">Guerrero</option>
									<option value="Hidalgo">Hidalgo</option>
									<option value="Jalisco">Jalisco</option>
									<option value="Michoacán" selected>Michoacán</option>
									<option value="Morelos">Morelos</option>
									<option value="Nayarit">Nayarit</option>
									<option value="Nuevo León">Nuevo León</option>
									<option value="Oaxaca">Oaxaca</option>
									<option value="Puebla">Puebla</option>
									<option value="Querétaro">Querétaro</option>
									<option value="Quintana Roo">Quintana Roo</option>
									<option value="San Luis Potosí">San Luis Potosí</option>
									<option value="Sinaloa">Sinaloa</option>
									<option value="Sonora">Sonora</option>
									<option value="Tabasco">Tabasco</option>
									<option value="Tamaulipas">Tamaulipas</option>
									<option value="Tlaxcala">Tlaxcala</option>
									<option value="Veracruz">Veracruz</option>
									<option value="Yucatán">Yucatán</option>
									<option value="Zacatecas">Zacatecas</option>
								</select>
								
							</div>
						</div!-->
					</div>
					<!--div class="col-md-6">
						<div class="form-group">
							<label for="celular"  class="control-label col-md-3">Celular</label>
							<div class="col-md-9">
								<input class="form-control" type="text" pattern="^[0-9]{10}" title="Deben ser solo diez numeros" placeholder="Número de cel  (10 digitos)" name="celular" id="celular"required/>
							</div>
						</div>
					</div!-->
				</div><!--row-->
				<div class="row">
					<div class="col-md-1">
						
					</div>
					<div class="col-md-6">
						<button class="btn btn-primary">Guardar</button>
					</div>
				</div><!--row-->
				<div class="row">
					<!--div class="col-md-6">
						<label for="ciudad" class="control-label col-md-3">Ciudad</label>
						<div class="col-md-9">
							<select name="ciudad" id="ciudad" class="form-control">
								<option value="Sahuayo">Sahuayo</option>
								<option value="Jiquilpan">Jiquilpan</option>
								<option value="Los reyes">Los reyes</option>
								<option value="Cotija">Cotija</option>
							</select>
						</div>
					</div-->
					
					
				</div><!--row-->
				<div class="row">
					<div class="col-md-12">
						<?=validation_errors()?>
					</div>
				</div>
			</form>
	</DIV>
</DIV>
	</div><!--col-md-12-->
</div>
</body>
</html>