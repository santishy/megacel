<div class="row">
	<?php  
		foreach($query->result() as $row){
			$idMensaje=$row->id_mensaje;
			$mensaje=$row->mensaje_celular;
			
		}

	?>
	<div class="col-md-11 col-sm-11 col-lg-11 col-md-offset-1 col-sm-offset-1 col-lg-offset-1">
		<div class="panel panel-primary">
			<div class="panel-heading">EDICIÓN DE MENSAJE DE TEXTO</div>
			<div class="panel-body">
				<form action="<?=base_url()?>serviciofolio/updateMensajeBd" method="post" name="frmMensaje" id="frmMensaje">
					<input type="hidden" id="idM" name="id_mensaje" value="<?=$idMensaje?>">
					<div class="form-group">
						<label for="txtMensaje">Mensaje de texto</label>
						<textarea name="txtMensaje" id="txtMensaje" class="form-control" cols="30" rows="5" maxlength="110" ><?=$mensaje?></textarea>
					</div>
					<div class="row">
						<div class="col-lg-2">
							<div class="form-group">
								<button type="button" class="btn btn-info btnMensaje">Modificar</button>
							</div>
						</div>	
						<div class="col-lg-3" id="divMensaje"></div>
					</div>	
				</form>
			</div>
			
		</div>
	</div>	
</div>

</div>
</body>
</html>