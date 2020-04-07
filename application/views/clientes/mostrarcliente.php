<div class="row">
	<div class="col-md-11 col-sm-11 col-lg-11 col-md-offset-1 col-lg-offset-1 col-sm-offset-1">
		<div class="table-responsive">
			<span class="titleSection">CONSULTA DE CLIENTES</span>
			<div class="busquedaCliente">
				<div class="row">

				  <div class="col-lg-6 pull-right">
				  	<form method="post" action="<?=base_url()?>clientes/buscar">
				    <div class="input-group">
				      <span class="input-group-btn">
				        <button class="btn btn-default" >Ir</button>
				      </span>
				      <input type="text" name="nombre"class="form-control" placeholder="Buscar">
				  </form>
				    </div><!-- /input-group -->
				  </div><!-- /.col-lg-6 -->
				</div><!--row-->
			</div>
			<table id="tabla-clientes" class="table table-bordered table-hover">
				<thead>
					
						<th>Nombre</th>
						<th>Direccion</th>
						<th>Editar</th>
						<th>Eliminar</th>
						<th>Servicio</th>
		
				</thead>
				<tbody>
					<?php if($query->num_rows()>0)
					foreach($query->result() as $row)
					{?>
						<tr>
								
							<td><?=$row->nombre?></td>
							<td><?=$row->direccion?></td>
							<td><input type="hidden" name="idCli" value="<?=$row->idCli?>"><button type="button" class="btn btn-info btn-xs btn-edi" title="editar datos del cliente"><span class="glyphicon glyphicon-pencil"></span>
							</button></td>
							<td><button type="button" class="btnEliCli btn btn-danger btn-xs" title="eliminar cliente"><span class="glyphicon glyphicon-trash "></span></button></td>
							<td><form action="<?=base_url()?>clientes/addF" method="post">
									<input type="hidden" name="idCli" value="<?=$row->idCli?>">
									<input type="hidden" name="nombre" value="<?=$row->nombre?>">
									<button class="btn btn-primary btn-xs" title="agregar servicio al cliente"><span class="glyphicon glyphicon-wrench"></span></button>
							 	</form>
							 </td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<center><?=$paginacion?></center>
	</div> 
</div>
<div id="edi-cli" class="row">	
	<form class="form-horizontal" id="frm-cli" rule="form" action="<?=base_url()?>clientes/modiCliAjax" method="post">
  			<div class="panel-body">	
  				<div class="row">
                    <div class="col-md-6">
						<div class="form-group">
							<label for="nombre" class="control-label col-md-3">Nombre</label>
							<div class="col-md-9">
								<input class="form-control" type="text" name="nombre" id="nombre" placeholder=""/>
								<input  type="hidden" name="idCli" id="idCli" />
				
								<input type="hidden" name="ruta" id="ruta" value="<?=base_url()?>clientes/rellenarAjaxCli"/>
							</div>
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="form-group">
							<label for="direccion" class="control-label col-md-3">Dirección</label>
							<div class="col-md-9">
								<input class="form-control" type="text" name="direccion" id="direccion"/>
							</div>
						</div>
					</div>
				</div> <!--row-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="telefono" class="control-label col-md-3">Telefono</label>
							<div class="col-md-9">
								<input class="form-control" type="text" name="telefono" id="telefono"/>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="fecha" class="control-label col-md-3">Municipio</label>
							<div class="col-md-9">
								<input class="form-control" type="text" name="fecha" id="fecha"/>
							</div>
						</div>
					</div>
				</div><!--row-->
				<div class="row">
					<div class="col-md-6">
						
					</div>
					
				</div><!--row-->
				<div class="row">

					<div class="col-md-6">
						<p style="color:red;text-align:center" id="mnsModi"></p>
					</div>
			</form>
	
</div>
<div class="col-md-12 cargador">
<div class=" progress  progress-striped active">
  <div class="progress-bar progress-bar-danger"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
    <span class="sr-only">100%</span>
  </div>
</div>
</div>
<form rule="form">
	<input type="hidden" name="rutaEliCli" id="rutaEliCli" value="<?=base_url()?>clientes/eliminarCli">
	
</form>
<div id="modalCli" class="row">
	<p id="mnsCli"></p>
</div>