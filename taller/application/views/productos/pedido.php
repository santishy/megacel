<div class="col-md-12">
	<div class="panel panel-primary sombras">
	  <!-- Default panel contents -->
	  <div class="panel-body">
	  	<div class="col-md-12">
		  	<p class="tit">Productos</p>
		  	<hr>  
	  	</div>
	  	<div class="row">
	  		<div class="col-md-6 col-md-offset-3">
		  		<form action="<?=base_url()?>producto/buscarList" method="post" >
		  			<div class="form-group">
		  				<label>Categoria</label>
			  			<select name="cate" class="form-control">
							<?php foreach($query->result() as $row)
							{ ?>
								<option value="<?=$row->categoria?>" <?php if(set_value('id_categoria')==$row->categoria) echo 'selected';?>><?=$row->categoria?></option>
							<?php }?>
						</select>
		  			</div>
					<div class="input-group">
					  <span class="input-group-addon " id="basic-addon1 "><span class="glyphicon glyphicon-search"></span></span>
					  <input type="search" name="clave"class="form-control" placeholder="Nombre Modelo" aria-describedby="basic-addon1">
					</div>
				</form>
		  	</div> 
	  	</div>
	  </div>
	  <!-- Table -->
	  <table class="table tabla table-striped table-hover" id="tabla-productos">
	  	<thead>
	  		<th>ID</th>
	  		<TH>NOMBRE</TH>
	  		<TH>MODELO</TH>
	  		<TH>MARCA</TH>
	  		<TH>CATEGORIA</TH>
	  		<th>COLOR</th>
	  		<th>COMPRAR</th>
	  		<th>Fondo Fijo</th>
	  		<TH>EXIST</TH>
	  		<th><span class="glyphicon glyphicon-print"></span></th>
	  	</thead>
	  	<tbody>
	  		<?php $cont=0; foreach($productos->result() as $row) 
	  		{?>
	  		<form method="post" action="<?=base_url()?>producto/crearPedido">
	  			<tr>	
	  				<td><?=$row->id?></td>
		  			<td><?=$row->nombre_producto?></td>
		  			<td><?=$row->modelo?></td>
		  			<td><?=$row->marca?></td>
		  			<td><?=$row->categoria?></td>
		  			<td><?=$row->color?></td>
		  			<td style="width:10%"><div class="col-md-12">
						<input type="text" name="cant_<?=$cont?>" class="form-control" value="<?php if($row->existencia>$row->fondo_fijo) echo '0'; else echo ($row->fondo_fijo-$row->existencia);?>"></div></td>
					<td><a href="#"
						data-pk='<?=$row->id?>'
							data-url='<?=base_url()?>Producto/updateFondoFijo'
							data-value="<?=$row->fondo_fijo?>"
							data-name="fondo_fijo"
							data-title='Fondo Fijo'
							data-type="text"
							class="set-fondo"
					></a></td>
		  			<td class="exist"> 
		  				<!--label>Total</label>
						<p><?=$row->existencia?></p>
						<label>Color</label>
						<p--><?=$row->exist?><!--/p-->
					</td>		

					<td style="background-color:<?php if($row->existencia==0) echo '#ff4d4d'; else if($row->existencia==1) echo '#ccccff';?>">
						<label>
						  <input type="checkbox" name="check_<?=$cont?>" value="1">
						</label>
						<input type="hidden" name="modelo_<?=$cont?>" value="<?=$row->modelo?>">
						<input type="hidden" name="nombre_<?=$cont?>" value="<?=$row->nombre_producto?>">
						<input type="hidden" name="marca_<?=$cont?>" value="<?=$row->marca?>">
						<input type="hidden" name="categoria_<?=$cont?>"  value="<?=$row->categoria?>">
						<input type="hidden" name="color_<?=$cont?>" value="<?=$row->color?>">
						<input type="hidden" name="id_<?=$cont?>" value="<?=$row->id?>">
					</td>
	  			</tr>

	  		<?php $cont+=1; }?>
	  			<tr>
	  				<td colspan="6" style="text-align:right">Imprime solo los seleccionados</td>
	  				<td><a href="<?=base_url()?>Producto/pdfPedido" class="btn btn-info btn-xs btn-block" target="_blank"><span class="glyphicon glyphicon-print"></span></a></td>
	  				<td colspan="2"><button class="btn btn-block btn-xs btn-default"><span class="glyphicon glyphicon-save-file"></span></button></td>
	  			</tr>
	  			<input name="cont" type="hidden" value="<?=$cont?>">
	  		</form>
	  		
	  	</tbody>
	  	<center><?=$paginacion?></center>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js">
</script>
<script>
	$(document).on('ready',function(){
		$(".set-fondo").editable({
			dataType:'JSON',
			type:'post',
			success:function(response){
				if(response.success=="false")
					alert('Ese no es un numero o a ocurrido un error. Vuelve a ingresar el numero');
			}
		});
	})
</script>
