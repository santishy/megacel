<div class="row">
	<div class="col-md-7 col-sm-7 col-lg-7 col-md-offset-3 col-sm-offset-3 col-lg-offset-3">
		<div class="panel panel-primary">
			<div class="panel-heading"><i class="fa fa-user fa-2x"></i> PERFIL DE USUARIO</div>
			<div class="panel-body">
				<?php
					if($query->num_rows()>0)
						foreach($query->result() as $row)
							{?>
								<form action="<?=base_url()?>usuarios/updateMyuser" method="post" class="form-horizontal" id="frmMiuser" role="for7">
										<div class="form-group">
											<label for="txtUser" class="col-lg-3 control-label">Usuario</label>
											<div class="col-lg-7">
												<input type="text" name="usuario_nickname" id="txtUser" class="form-control" value="<?=$row->usuario_nickname?>">
												<input type="hidden" id="txtId" name="iduser" value="<?=$row->iduser?>">
												<input type="hidden" id="txtPassh" name="txtPassh" value="<?=$row->usuario_pass?>">
											</div>
										</div>
										<div class="form-group">
											<label for="txtPass" class="col-lg-3 control-label">Contraseña</label>
											<div class="col-lg-7">
												<input type="password" name="usuario_pass" id="txtPass" class="form-control" value="<?=$row->usuario_pass?>">
											</div>
										</div>
									<div class="row">
										<div style="padding:10px;" class="col-lg-3 col-lg-offset-3"><button type="submit" id="btnAddRef" class="btn btn-primary">Modificar</button></div>
										<div style="padding:10px;" id="divMsg" class="col-lg-4"></div>
									</div>
								</form>
					 <?php } ?>
			</div>
		</div>
	</div>
</div>

</div>
</body>
</html>
