<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1">
		<form role="form" class="form-horizontal" action="<?=base_url()?>refacciones/consultaGeneral" method="post" id="frmGetref" name="frmGetref">
			<div class="form-group">
    			<label for="idsuc" class="col-md-2 control-label">Sucursal</label>
    			<div class="col-sm-8">
      				<select name="idsuc" class="form-control" id="idsuc">
      					<?php foreach($suc->result() as $row){
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
    			<!-- <div class="col-md-4"><button class="btn btn-primary">Buscar</button></div> -->
  			</div>	
  		</form>		
	</div>
</div><br>
<div class="row">
	<div class="col-md-11 col-sm-11 col-lg-11 col-md-offset-1 col-lg-offset-1 col-sm-offset-1">
		<span class="titleSection">CONSULTA DE REFACCIONES</span>
		<div class="table-responsive">
			<table class="table table-bordered table-hover" id="ref">
				<thead>
					<th>Nombre</th>
					<th>Marca</th>
					<th>Precio</th>
					<th>Descripcion</th>
					<th>Cantdad</th>
					<th>Editar</th>
					<th>Eliminar</th>
				</thead>
				<tbody>
					<?php foreach ($query->result() as $row)
					{?>
						<tr>
							<td><?=$row->nombreAcc?></td>
							<td><?=$row->marca?></td>
							<td><?=$row->precio?></td>
							<td><?=$row->descripcion?></td>
							<td><?=$row->cant?></td>
							<td>
								<form role="form" action="<?=base_url()?>refacciones/getRefaccion" method="post">
								<input type="hidden" name="idsuc" value="<?=$row->idsuc?>">
								<input type="hidden" name="idref" value="<?=$row->idref?>">
								<button  class="btn btn-info btn-xs btn-edi"><span class="glyphicon glyphicon-pencil"></span>
								</button>
								</form>
							</td>
							<td>
								<form role="form" action="" method="post">
								<input type="hidden" name="idref" value="<?=$row->idref?>">
								<input type="hidden" name="idsuc" value="<?=$row->idsuc?>">
								<button type="button" class="btnEliRef btn btn-danger btn-xs btnDelete" id="btnDelete"  title="Cambia la existencia a 0 en esta sucursal"><span class="glyphicon glyphicon-trash "></span></button>
								</form>
							</td>
						</tr>
					<?php }?>
				</tbody>
			</table>
			<center><?=$paginacion?></center>
	</div>
	</div>
</div>
<div id="confirRef" style="opacity:0" class="row">
	<p id="mnsRef"></p>
</div>
<form rule="form">
	<input type="hidden" name="rutaEliRef" id="rutaEliRef" value="<?=base_url()?>refacciones/eliminarRef">
</form>