<div class="row">
	<div class="col-md-5 col-sm-6 col-md-offset-3 col-sm-offset-3">
		<div class="paneles panel panel-primary">
  			<div class="panel-heading"><b>CONSULTAR INGRESOS</b></div>
  			<div class="panel-body">
  				<form rule="form" action="<?=base_url()?>serviciofolio/fechasCorte" method="post">
  					<div class="form-group">
						<label for="fidsuc" class="control-label">Sucursal</label>
						<select class="form-control" name="idsuc" id="fidsuc" >
							<?php foreach ($query->result() as $row) {?>
								<option value="<?=$row->idsuc?>"><?=$row->nombre?></option>
							<?php }?>
							<option name></option>
						</select>
					</div>
  					<div class="form-group">
						<label for="inicio" class="control-label">De:</label>
						<input type="text" class="form-control" name="inicio" id="ini" >
					</div>
					<div class="form-group">
						<label for="fin" class="control-label">Hasta:</label>
						<input type="text" class="form-control" name="fin" id="fin" >
					</div>
					<div class="form-group">
						<button class="btn btn-primary">Mostrar</button>
					</div>
					<div><?=validation_errors()?></div>
  				</form>
  			</div>
  		</div><!--Panel principal-->
	</div>
</div>