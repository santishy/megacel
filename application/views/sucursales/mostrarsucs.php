<div class="row">
	<div class="col-md-11 col-sm-11 col-lg-11 col-md-offset-1 col-sm-offset-1 col-lg-offset-1">
		<span class="titleSection">CONSULTA DE SUCURSALES</span>
		<div class="table-responsive">
			<table id="tablasuc" class="table table-bordered">
				<thead>
					<tr>
					<th>Nombre</th>
					<th>Dirección</th>
					<th>Editar</th>
					<th>Eliminar</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($query->result() as $row) 
					{
					?>
					
					<tr>
						<form class="frm" method="post" action="<?=base_url()?>sucursal/eliminar_suc" >
							<input type="hidden" class="idsuc"  name="idsuc" value="<?=$row->idsuc?>">
							<td><?=$row->nombre?></td>
							<td><?=$row->domicilio?></td>
							<td><button type="button" name="editar" value="<?=$row->idsuc?>" class="btn btn-info btn-xs btn-edi" id="btnEdi" title="ver datos" ><span class="glyphicon glyphicon-pencil"></span></button></td>
							<td><button type="button" class="btnEliSuc btn btn-danger btn-xs" ><span class="glyphicon glyphicon-trash "></span></button></td>
						</form>
					</tr>
					<?php }?>
				</tbody>

			</table>
		</div>
	</div>
</div>
<div class="row" id="modi_suc">

<div class="col-md-12">
	<form name="frm_modi_suc" id="frm_modi_suc" role="form" method="" action="<?=base_url()?>sucursal/ajaxSucursal">
		<div id="spin1"></div>
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input class="form-control" type="text" name="nombre" id="nombre">
		</div>
		<div class="form-group">
			<label for="domicilio">Domicilio</label>
			<input class="form-control" type="text" name="domicilio" id="domicilio">
		</div>
		<div class="form-group">
			<label for="localidad">Localidad</label>
			<input class="form-control" type="text" name="localidad" id="localidad">
		</div>
		<div class="form-group">
			<label for="edo">Estado</label>
			<input class="form-control" name="edo" id="edo" type="text"/>
		</div>
		<div class="form-group">
			<label for="telefono">Telefono</label>
			<input class="form-control" type="text" name="telefono" id="telefono">
			<input type="hidden" name="idsuc" id="frmidsuc" value="">
		</div>
	</form>
</div>
</div>
<div class="col-md-12 cargador">
<div class=" progress  progress-striped active">
  <div class="progress-bar progress-bar-danger"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
    <span class="sr-only">100%</span>
  </div>
</div>
</div>
<form name="rutasSuc" id="rutasSuc">
	<input type="hidden" name="rutaEliSuc" id="rutaEliSuc" value="<?=base_url()?>sucursal/eliminar_suc">
	<input type="hidden" name="rutaModiSuc" id="rutaModiSuc" value="<?=base_url()?>sucursal/modiSuc">
</form>
<div id="modalSuc" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Confirmacion</h4>
      </div>
      <div class="modal-body">
        <p id="mnsSuc" style="color:red;font-size:14px;">Al eliminar una sucursal, solo se desactivara.</p>
      </div>
      <div class="modal-footer">
      	<button type="button" id="btnDesactivar" class="btn btn-danger">Desactivar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
       
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->