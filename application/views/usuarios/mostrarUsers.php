<div class="row">
	<div class="col-md-11 col-sm-11 col-lg-11 col-md-offset-1 col-sm-offset-1 col-lg-offset-1">
		<span class="titleSection">CONSULTA DE USUARIOS DEL SISTEMA</span>
		<div class="table-responsive">
			<table class="table table-bordered table-hover" id="tlbUsuarios">
				<thead>
					<th>Usuario</th>
					<th>E-mail</th>
					<th>Sucursal</th>
					<th>Editar</th>
					<th>Eliminar</th>
				</thead>
				<tbody>
					<input type="hidden" id="rutaUs" value="<?=base_url()?>usuarios/getUsuarioAjax">
					<?php
						if($query->num_rows()>0)
						   foreach($query->result() as $row)
							{?>
						<tr>
							<form action="<?=base_url()?>usuarios/eliminarUsers" method="post" id="frmMuestraU" name="frmMuestraU">
								<input type="hidden" id="idUser" value="<?=$row->iduser?>">
								<td><div id="usernameUsr"><?=$row->nick?></div><div><button type="button" class="btn btn-info btn-xs btnVerInfo">más datos</button></div>
									<p class="pApellidos" style="margin-top:3px;"><label>Nombre : </label><span id="nomUsr"><?=$row->nombre?></span><br>
										<label>Apellido P : </label><span id="apUsr"><?=$row->ap?></span><br>
										<label>Apellido M : </label><span id="amUsr"><?=$row->am?></span>
									</p>
								</td>
								<td><span id="correoUsr"><?=$row->correo?></span></td>
								<td><?=$row->nombresuc?></td>
								<td><button type="button" id="btnModiUser"  class="btn btn-info btn-xs btn-edi btnModiUser" data-toggle="tooltip" data-placement="left" title="Edita los datos del usuario"><span class="glyphicon glyphicon-pencil"></span></botton>
								</td>
								<td><button type="button" id="btnModalDelete" class="btn btn-danger btn-xs btn-eli btnModalDelete" data-toggle="tooltip"  title="Elimina al usuario de manera permanente" ><span class="glyphicon glyphicon-trash"></span></botton></td>
							</form>
						</tr>
						<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- Modal de eliminar -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Eliminación de usuarios</h4>
      </div>
      <div class="modal-body">
        Deseas realmente eliminar este registro?
      </div>
      <div class="modal-footer">        
        <button type="button" id="btnDeleteUser" class="btn btn-danger">Eliminar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button><div id="divEu"></div>
      </div>
    </div>
  </div>
</div>
<!-- modal de modificar -->
<div class="modal fade" id="divModalEdit" tabindex="-1" role="dialog" aria-labelledby="idModalEditLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="idModalEditLabel">Modificación de usuarios</h4>
			</div>
			<div class="modal-body">
					<form rule="form" action="<?=base_url()?>usuarios/modiUser"  method="post" id="frmUsers" name="frmUsers">
						<div class="form-group">
							<label for="nombre">Nombre: </label>
							<input type="text" class="form-control" name="txtnombre" id="nombre" placeholder="Nombre" required>
							<input type="hidden" id="iduser" name="iduser" value="">
						</div>

						<div class="form-group">
							<label for="apellidop">Apellido Paterno:</label>
							<input type="text" class="form-control" name="txtap" id="apellidop" placeholder="Apellido paterno" required>
						</div>
						<div class="form-group">
							<label for="apellidom">Apellido Materno:</label>
							<input type="text" class="form-control" name="txtam" id="apellidom" placeholder="Apellido materno" required>
						</div>
						<div class="form-group">							
								<label for="nickname">Usuario:</label>
								<input type="text" class="form-control" name="txtname" id="nickname" placeholder="Nombre de acceso" required>							
						</div>
						<div class="form-group">
							<small><a href="<?=base_url()?>usuarios/ValidaUser/1" id="lnkValidaU" style="color:green;"></a></small>
							<div id="divcomp"></div>
						</div>	
						<div class="form-group">
							<label for="email">E-mail:</label>
							<input type="email" class="form-control" name="txtemail" id="txtemail" placeholder="Correo eléctronico" required>
						</div>
						<div class="form-group">
							<small><a href="<?=base_url()?>usuarios/ValidaUser/2" id="lnkValidaC" style="color:green;"></a></small>
							<div id="divEmail"></div>
						</div>
						<div class="form-group">
							<label for="pass">Contraseña:</label>
							<input type="password" class="form-control" name="txtpass" id="pass" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="El password debe tener minimo 8 caracteres una letra mayúscula y una minúscula como mínimo al menos un numero o carácter especial" placeholder="Contraseña" required>
							<input type="hidden" id="tempass" name="tempass" value="">
						</div>
						<div class="form-group">
							<label for="tipo">Tipo:</label>
							<select name="tipo" id="tipo" class="form-control">
								<option value="1">Administrador</option>
								<option value="2">Empleado</option>
								<option value="3">Tecnico</option>
							</select>
						</div>
					</form><br><?php 
								echo validation_errors();
							?>		
			</div>
			
			<div class="modal-footer">
				<div class="divSpin"></div>
				<button type="button" class="btn btn-info btnmodi">Modificar</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>

<!-- fin -->
</div>
</body>
</html>