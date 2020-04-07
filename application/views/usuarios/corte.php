<div class="col-md-12">
	<div class="panel panel-primary sombras">
		<div class="panel-heading">
			<h3>Corte Tecnicos</h3>
		</div>
		<div class="panel-body">
			<div class="container-body">
	 			<div class="col-md-4">
	 				<h3>Ver por estado:</h3>
	 				<hr>
		 			<ul class="nav nav-pills nav-stacked">
		  				<li role="presentation">
		  					<a style="color:#008FB2;font-weight:bold" class="btn btn-default" href="<?=base_url()?>usuarios/corteTecnicoPredifinido/dia">Dia</a>
		  				</li>
		  				<li role="presentation">
							<a style="color:#008FB2;font-weight:bold" class="btn btn-default" href="<?=base_url()?>usuarios/corteTecnicoPredifinido/semana">Semana</a>
		  				</li>
		  				<li role="presentation">
							<a style="color:#008FB2;font-weight:bold" class="btn btn-default" href="<?=base_url()?>usuarios/corteTecnicoPredifinido/mes">Mes</a>			
		  				</li>
					</ul>
					<?=validation_errors()?>
				</div>
				<div class="col-md-4">
	 				<h3>Corte por fechas</h3>
	 				<hr>
	 				<form action="<?=base_url()?>usuarios/ReporteTecnicos" method="post">
	 					<div class="form-group">
	 						<label>De:</label>
	 						<input name="de" id="de" class="form-control" value="">
	 					</div>
	 					<div class="form-group">	
	 						<label>Hasta:</label>
	 						<input name="hasta" id="hasta"class="form-control" value="">
	 					</div>
	 					<div class="form-group">
	 						<button class="btn btn-default">Realizar</button>
	 					</div>
	 				</form>
				</div>
				<?php if(isset($total)){?>
				<div class="col-md-4">
					<h3>Resultados:</h3>
					<hr>
					<p class="reporte"><label>Total:</label> $<?=number_format($total,2)?></p>
					
				</div>
				<?php }?>
			</div>
			
		</div>
		<?php 
				$cantidad=0;
				$total=0;
				if(isset($query))
					for($i=0;$i<count($query['users']);$i++)  
						{?>
							<table class="table table-striped <?php if(($i%2)==0) echo 'tabla'; else echo 'tabla-creditos';?>">
								<thead>
									<th>
										Nombre
									</th>
									<th>Folio</th>
									<th>Fecha Salida</th>
									<th>Total</th>
								</thead>
								<tbody>
									<?php $total=0; foreach ($query['tecnicos'][$i]->result() as $row) {
										$cantidad+=1;
										$total+=$row->total;
										?>
										<tr>
											<td><?=$row->entrego?></td>
											<td><?=$row->folio?></td>
											<td><?=$row->fecha_salida?></td>
											<td><?=$row->total?></td>
										</tr>
									<?php }?>
										<tr class="total">
											<td colspan="6" style="text-align:right">Total</td>
											<td  style="text-align:center;background-color:#204060;color:white"><?=$total?></td>
										</tr>

								</tbody>
							</table>
						<?php 	}?>
	</div>
</div>
<script src="<?=base_url()?>js/reportes.js"></script>