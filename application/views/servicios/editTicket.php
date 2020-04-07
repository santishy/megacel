<div class="row">
	<?php  
		foreach($query->result() as $row){
			$idTicke=$row->id_ticket;
			$header=$row->ticket_header;
			$mensaje=$row->ticket_mensaje;
			$mensajet=$row->ticket_mensajet;
			$sitio=$row->ticket_sitio;
			$logo=$row->ticket_logo;
			
		}

	?>
	<div class="col-md-11 col-sm-11 col-lg-11 col-md-offset-1 col-sm-offset-1 col-lg-offset-1">
		<div class="panel panel-primary">
			<div class="panel-heading">EDICIÓN DE TICKET DE SERVICIOS</div>
			<div class="panel-body">
				<form action="<?=base_url()?>serviciofolio/updateTicketBd" method="post" name="frmTicket" id="frmTicket">
					<div class="form-group">
						<label for="txtHeader">Encabezado</label>
						<input type="text" name="txtHeader" id="txtHeader" class="form-control" value="<?=$header?>" autofocus>
					</div>
					<div class="form-group">
						<label for="txtMensaje">Pie de ticket llegada de servicio</label>
						<textarea name="ticket_mensaje" id="txtMensaje" class="form-control" cols="30" rows="5" maxlength="250" ><?=$mensaje?></textarea>
					</div>
					<div class="form-group">
						<label for="txtMensaje2">Pie de ticket servicio terminado o entregado</label>
						<textarea name="ticket_mensajet" id="txtMensaje2" class="form-control" cols="30" rows="5" maxlength="250" ><?=$mensajet?></textarea>
					</div>
					<div class="form-group">
						<label for="txtSitio">Logo</label>
						<input type="file" name="logo" id="logo" class="form-control" value="">
						<input type="hidden" id="url_logo" name="url_logo" value="<?=$logo?>">
						<input type="hidden" id="ruta_logo" name="ruta_logo" value="<?=base_url()?>serviciofolio/subirArchivo">
					</div>
					<div class="form-group">
						<div class="progress progress-striped active">
					  		<div id="barra_logo"class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
					    		<span class="sr-only">40% Complete (success)</span>
					  		</div>
						</div>
					</div>
					<div class="form-group">
						<label for="txtSitio">Sitio web</label>
						<input type="text" name="ticket_sitio" id="txtSitio" class="form-control" value="<?=$sitio?>">
						<input type="hidden" id="idT" name="id_ticket" value="<?=$idTicke?>">
					</div>
					<div class="row">
						<div class="col-lg-2">
							<div class="form-group">
								<button class="btn btn-info">Modificar</button>
							</div>
						</div>	
						<div class="col-lg-3" id="divTicket"></div>
					</div>	
				</form>
			</div>
			
		</div>
	</div>	
</div>

</div>
</body>
</html>