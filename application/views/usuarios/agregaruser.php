<div class="row">
		<div class="col-md-11 col-sm-11 col-lg-11 col-md-offset-1 col-sm-offset-1 col-lg-offset-1">
		<div class="panel panel-primary">
			<div class="panel-heading"><b>REGISTRO DE USUARIOS DEL SISTEMA</b></div>
				<div class="panel-body">
					<form role="form" class="form-horizontal" action="<?=base_url()?>usuarios/AddUser"  method="post" id="frmUsers" name="frmUsers">
						<div class="row">
							<div class="col-md-5">
								<div class="form-group">
									<label for="txtnombre" class="control-label col-md-3">Nombre: </label>
									<div class="col-md-9">
										<input type="text" class="form-control " name="txtnombre" id="nombre" placeholder="Nombre" required>
									</div>
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<label for="txtap" class="control-label col-md-3">A.Pat</label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="txtap" id="apellidop" placeholder="Apellido paterno" required>
									</div>
								</div>
							</div>
						</div> <!-- row -->
						<div class="row">
							<div class="col-md-5">
								<div class="form-group">
									<label for="txtam" class="control-label col-md-3">A.Mat:</label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="txtam" id="apellidom" placeholder="Apellido materno" required>
									</div>
								</div>
							</div>

							<div class="col-md-5">
								<div class="form-group">
									<label for="txtname" class="control-label col-md-3">Usuario:</label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="txtname" id="nickname" placeholder="Nombre de acceso" required>
									</div>
								</div>
							</div>

							<div class="form-group col-md-2" >
								<small><a href="<?=base_url()?>usuarios/ValidaUser/1" id="lnkValidaU" style="color:green;"></a></small>
							<div id="divcomp"></div>
						</div></div>
					  <!--	<div class="form-group">
							<small><a href="<?=base_url()?>usuarios/ValidaUser/1" id="lnkValidaU" style="color:green;"></a></small>
							<div id="divcomp"></div>
						</div>	 -->
						<div class="row">
							<div class="col-md-5">
								<div class="form-group">
									<label for="txtemail" class="control-label col-md-3">E-mail:</label>
									<div class="col-md-9">
										<input type="email" class="form-control" name="txtemail" id="txtemail" placeholder="Correo eléctronico" required>
									</div>
								</div>
							</div>
							<!-- <div class="form-group">
								<small><a href="<?=base_url()?>usuarios/ValidaUser/2" id="lnkValidaC" style="color:green;"></a></small>
								<div id="divEmail"></div>
							</div> -->

							<div class="col-md-5">
								<div class="form-group">
									<label for="txtpass" class="control-label col-md-3">Clave:</label>
									<div class="col-md-9">
										<input type="password" class="form-control" name="txtpass" id="pass" min="8" title="El password debe tener minimo 8 caracteres" placeholder="Contraseña" required>	
									</div>
								</div>
							</div>

					  </div>
						<div class="row">
							<div class="col-md-5">
								<div class="form-group">
									<label for="lstTipo" class="control-label col-md-3">Tipo</label>
									<div class="col-md-9">
										<select name="lstTipo" class="form-control" id="lstTipo">
											<option value="1">Administrador</option>
											<option value="2">Empleado</option>
											<option value="3">Tecnico</option>
										</select>
									</div>
								</div>
							</div>
								<div class="col-md-5">
									<div class="form-group">
										<label for="lstSuc" class="control-label col-md-3">Sucursal</label>
										<div class="col-md-9">
											<select name="lstSuc" class="form-control" id="lstSuc">
												<?php foreach($query->result() as $row){
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
									</div>
								</div>
						</div>
							<div class="row">
								<div class="col-md-5">
									<input type="submit" class="btn btn-primary" value="Registrar">
									<div id="divuser" class="col-md-12"></div>
								</div>
							</div>
					</form><br><br><?php
								echo validation_errors();
							?>
				</div>
			</div>
	</div>
</div>
</div>
</body>
</html>
