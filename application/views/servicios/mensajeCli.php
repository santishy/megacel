<div class="row">
	<?php  
		foreach($query->result() as $row){
			$mensaje=$row->mensaje_celular;
			
		}

	?>
	<div class="col-md-7 col-md-offset-3 col-sm-7 col-lg-7 col-lg-offset-3 col-sm-offset-3" >
		<div class="panel panel-primary">
			<div class="panel-heading">Mensaje de texto</div>
			<div class="panel-body">
				<form action="http://www.masmensajes.com.mx/wss/smsapi11.php" method="post" role="form" id="frmMensaje" target="_blank">
					<div class="form-group">
						<label for="mensaje">Texto del mensaje</label>
						<textarea name="mensaje" id="mensaje" cols="10" rows="10" maxlength="110" class="form-control"><?=$cliente.' '?><?=$mensaje?></textarea>
					</div>
					<div class="form-group">
						<label for="celular">Número de celular</label>
						<input type="text" id="celular" name="celular" value="+52<?=$celular?>" class="form-control col-lg-2">
					</div>
					<input type="hidden" id="usuario" name="usuario" value="ISCO">
					<input type="hidden" id="password" name="password" value="02b666">
					<div class="row">
						<div style="padding:10px;" class="col-lg-3"><button type="submit" id="btnAddRef" class="btn btn-primary">Enviar</button></div>
						<div style="padding:10px; font-weight:bold;" id="divMensaje" class="col-lg-3"><a href="<?=base_url()?>serviciofolio/mostrarServicios">No enviar</a></div>
						<div id="divAviso" class="col-lg-2"></div>
					</div>
					
				</form>
			</div>
		</div>
	</div>
</div>

</div>
</body>
</html>