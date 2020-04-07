<div id="panelFolio"class="row">
<div class="paneles panel panel-primary">
  <div class="panel-heading">Folio</div>
  <div class="panel-body">
  	<form name="rutas" id="rutas">
  		<input type="hidden" name="rutaEquipo" id="rutaEquipo" value="<?=base_url()?>equipos/getEquipoAjax">
  		<input type="hidden" name="rutaPDF" id="rutaPDF" value="<?=base_url()?>serviciofolio/folioPDF">
  	</form>
	<form class="form-horizontal" name="frmFolio" id="frmFolio" role="form" method="post" action="<?=base_url()?>serviciofolio/addFolio">
<div class="row">
	<div class="col-md-4">
	 	<div class="form-group">
			<label for="fecha" class="col-md-3 control-label">Fecha</label>
			<div class="col-md-9">
				<input type="text" class="form-control" name="fecha" id="fecha" value=<?php echo date("Y-m-d")?> >
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label for="fecha" class="col-md-3 control-label">Estado</label>
			<div class="col-md-9">
				<select name="estado" id="estado" class="form-control">
					<option value="pendiente">Pendiente</option>
					<option value="urgente">Urgente</option>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label for="folio" class="col-md-3 control-label">Folio</label>
			<div class="col-md-9">
				<input type="number" name="folio"  id="folio" class="form-control"  value="<?=$folio?>" disabled>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label for="folio" class="col-md-2 control-label">Cliente</label>
			<div class="col-md-10">
				<input type="text" name="cliente" id="cliente" class="form-control" value="<?=$nombre?>" disabled>
				<input type="hidden" name="idCli" id="idCli" value="<?=$idcli?>">
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="col-md-5">
				<button type="button" id="btn_folio" class="btn btn-primary">Siguiente</button>

			</div>
			<div id="spFolio"  style="height:30px"class="col-md-3 "></div>
		</div>
	</div>
	</form>
</div>
</div>
</div>
</div>
<div id="panelEquipo" class="row">
	<div class="paneles panel panel-primary">
  		<div class="panel-heading">Equipo del Cliente</div>
 			<div class="panel-body">
				<form class="form-horizontal" id="frmEquipo" name="frmEquipo" role="form" action="<?=base_url()?>equipos/addEquipo" method="post">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="comboId" class="col-md-3 control-label">Equipos Existentes</label>
								<div class="col-md-9">
									<select name="comboId" id="comboId" class="form-control">
										<option value="" selected disabled>Seleccione el equipo si ya existe</option>
										<?php foreach($query->result() as $row){
											?>
										<option  value="<?=$row->idEq?>">Categoría: <?=$row->nomEquipo?> - Marca: <?=$row->marca?>- Modelo: <?=$row->modelo?></option>
										<?php }?>
									</select>
								</div>
							</div>
						</div><!--col-md-6-->
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="nomEquipo" class="col-md-3 control-label">Dispositivo</label>
								<div class="col-md-9">
									<input name="nomEquipo" type="text" id="nomEquipo" class="form-control" value="Cel"/>
								</div>
							</div>
						</div><!--col-md-6-->
						<div class="col-md-6">
							<div class="form-group">
								<label for="marca" class="col-md-4 control-label">Marca</label>
								<div class="col-md-8">
									<input type="text" name="marca" id="marca" class="form-control"/>
								</div>
							</div>
						</div><!--col-md-6-->
					</div><!--row-->
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="modelo" class="col-md-3 control-label">Modelo</label>
								<div class="col-md-9">
									<input name="modelo" type="text" id="modelo" class="form-control"/>
								</div>
							</div>
						</div><!--col-md-6-->
						<div class="col-md-6">
							<div class="form-group">
								<label for="numSerie" class="col-md-4 control-label">IMEI</label>
								<div class="col-md-8">
									<input type="text" name="numSerie" id="numSerie" class="form-control"/>
								</div>
							</div>
						</div><!--col-md-6-->
					</div><!--row-->
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="color" class="col-md-3 control-label">Color</label>
								<div class="col-md-5">
									<input type="text" name="color" id="color" class="form-control">
									<input type="hidden" name="idEq" id="idEq">
								</div>
							</div>
						</div><!--row-->
							<div class="col-md-6">
								<div class="form-group has-warning">
									<label for="color" class="col-md-4 control-label">Contraseña</label>
									<div class="col-md-8">
										<input type="text" name="con" id="con" class="form-control">
										<!--input type="hidden" name="numfolio" id="numfolio"-->
									</div>
								</div>
							</div>
					</div><!--col-md-6-->
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="descripcion" class="col-md-3 control-label">Edo. Estetico</label>
								<div class="col-md-9">
									<textarea name="descripcion" rows="3"id="descripcion"class="form-control"></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 ">
							<div class="form-group">
								<div class="col-md-8 ">
									<button type="button" id="btn_equipo" class="btn btn-primary">Siguiente</button>
								<div class="col-md-6" id="rutaModiEquipo" data-ruta="<?=base_url()?>equipos/modiIdFolio">	<button type="button" id="btn_sig" class="btn btn-info">Siguiente</button></div>
									<div class="col-md-6"><button type="button" id="btn_cancel" class="btn btn-danger">Cancelar</button></div>
								</div>
								<div id="spEquipo"  style="height:30px"class="col-md-3 "></div>
							</div>
						</div>
					</div><!--row-->
				</form>
			</div><!--panel body-->
		</div><!--Panel Titulo-->
</div><!--row PRINCIPAL DEL FORMULARIO EQUIPO-->
<div id="panelServicio" class="row">
	<div class="paneles panel panel-primary">
  		<div class="panel-heading">Servicio</div>
 			<div class="panel-body">
				<form class="form-horizontal" id="frmServicio" name="frmServicio" role="form" action="<?=base_url()?>serviciofolio/addServicio" method="post">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="" class="col-md-3 control-label">Falla</label>
								<div class="col-md-9">
									<textarea class="form-control" name="falla" id="falla" rows="3"></textarea>
								</div>
							</div>
						</div><!--col-md-6-->
						<div class="col-md-6">
							<div class="form-group">
								<label for="tipo" class="col-md-2 control-label">Tipo</label>
								<div class="col-md-10">
									<input type="text" name="tipo" id="tipo" class="form-control">
									<input type="hidden" name="sfolio" id="sfolio">
									<input type="hidden" name="sidEq" id="sidEq">
								</div>
							</div>
						</div><!--col-md-6-->
					</div><!--row-->
					<div class="row">
						<div class="alert alert-info ">Descripción del Equipo </div>
					</div><!--row Caracteristicas-->
					<div class="row">
						<div class="form-group">
							<label for="numSerie" class="col-md-4 control-label">Cotizacion</label>
							<div class="col-md-2">
								<input type="text" name="cotizacion" id="cotizacion" class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label for="accesorios" class="col-md-2 control-label ">Carcasa</label>
							<div class="col-md-2">
								<div class="radio">
								  <label>
								    <input type="radio" name="accesorios" id="blankRadio1" value="BUENA" aria-label="...">
								    Buena
								  </label>
								</div>
							</div>
							<div class="col-md-2">
								<div class="radio">
								  <label>
								    <input type="radio" name="accesorios" id="blankRadio1" value="DESPINTADA" aria-label="...">
								    Despintada
								  </label>
								</div>
							</div>
              <div class="col-md-2">
								<div class="radio">
								  <label>
								    <input type="radio" name="accesorios" id="blankRadio1" value="DOBLADA" aria-label="...">
								    DOBLADA
								  </label>
								</div>
							</div>
							<div class="col-md-2">
								<div class="radio">
								  <label>
								    <input type="radio" name="accesorios" id="blankRadio1" value="MALTRATADA" aria-label="...">
								    Maltratada
								  </label>
								</div>
							</div>
						</div>
					</div><!--row-->
					<div class="row">
						<div class="form-group">
							<label for="cables" class="col-md-4 control-label ">Touch en buen estado?</label>
							<div class="col-md-1">
								<div class="radio">
								  <label>
								    <input type="radio" name="cables" id="blankRadio1" value="SI" aria-label="...">
								    Si
								  </label>
								</div>
							</div>
							<div class="col-md-1">
								<div class="radio">
								  <label>
								    <input type="radio" name="cables" id="blankRadio1" value="NO" aria-label="...">
								    No
								  </label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="radio">
								  <label>
								    <input type="radio" name="cables" id="blankRadio1" value="NO SE PUEDE VERIFICAR" aria-label="...">
								    No se puede verificar
								  </label>
								</div>
							</div>
						</div>
            <div class="row">
  						<div class="form-group">
  							<label for="calcas" class="col-md-4 control-label ">Batería en buen estado?</label>
  							<div class="col-md-1">
  								<div class="radio">
  								  <label>
  								    <input type="radio" name="calcas" id="blankRadio1" value="SI" aria-label="...">
  								    Si
  								  </label>
  								</div>
  							</div>
  							<div class="col-md-1">
  								<div class="radio">
  								  <label>
  								    <input type="radio" name="bateria" id="blankRadio1" value="NO" aria-label="...">
  								    No
  								  </label>
  								</div>
  							</div>
  							<div class="col-md-2">
  								<div class="radio">
  								  <label>
  								    <input type="radio" name="bateria" id="blankRadio1" value="NO CONTIENE" aria-label="...">
  								    No contiene
  								  </label>
  								</div>
  							</div>
  							<div class="col-md-3">
  								<div class="radio">
  								  <label>
  								    <input type="radio" name="bateria" id="blankRadio1" value="NO SE PUEDE VERIFICAR" aria-label="...">
  								    No se puede verificar
  								  </label>
  								</div>
  							</div>
  						</div>
  					</div><!--row-->
					<div class="row">
						<div class="form-group">
							<label for="calcas" class="col-md-4 control-label ">Batería en buen estado?</label>
							<div class="col-md-1">
								<div class="radio">
								  <label>
								    <input type="radio" name="calcas" id="blankRadio1" value="SI" aria-label="...">
								    Si
								  </label>
								</div>
							</div>
							<div class="col-md-1">
								<div class="radio">
								  <label>
								    <input type="radio" name="calcas" id="blankRadio1" value="NO" aria-label="...">
								    No
								  </label>
								</div>
							</div>
							<div class="col-md-2">
								<div class="radio">
								  <label>
								    <input type="radio" name="calcas" id="blankRadio1" value="NO CONTIENE" aria-label="...">
								    No contiene
								  </label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="radio">
								  <label>
								    <input type="radio" name="calcas" id="blankRadio1" value="NO SE PUEDE VERIFICAR" aria-label="...">
								    No se puede verificar
								  </label>
								</div>
							</div>
						</div>
					</div><!--row-->
					<!-- <div class="row">
						<div class="form-group">
							<label for="botones" class="col-md-4 control-label ">Estado botones</label>
							<div class="col-md-7">
								<textarea class="form-control" name="botones"></textarea>
							</div>
						</div>
					</div> -->
					<!-- <div class="row">
						<div class="form-group">
							<label for="golpes" class="col-md-4 control-label ">El dispositivo enciende?</label>
							<div class="col-md-1">
								<div class="radio">
								  <label>
								    <input type="radio" name="golpes" id="blankRadio1" value="SI" aria-label="...">
								    Si
								  </label>
								</div>
							</div>
							<div class="col-md-1">
								<div class="radio">
								  <label>
								    <input type="radio" name="golpes" id="blankRadio1" value="NO" aria-label="...">
								    No
								  </label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="radio">
								  <label>
								    <input type="radio" name="golpes" id="blankRadio1" value="NO SE PUEDO VERIFICAR" aria-label="...">
								    No se puedo verificar
								  </label>
								</div>
							</div>
						</div> -->
						<div class="form-group">
							<label for="chip" class="col-md-4 control-label ">Contiene chip?</label>
							<div class="col-md-1">
								<div class="radio">
								  <label>
								    <input type="radio" name="chip" id="blankRadio1" value="SI" aria-label="...">
								    Si
								  </label>
								</div>
							</div>
							<div class="col-md-1">
								<div class="radio">
								  <label>
								    <input type="radio" name="chip" id="blankRadio1" value="NO" aria-label="...">
								    No
								  </label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="radio">
								  <label>
								    <input type="radio" name="chip" id="blankRadio1" value="NO SE PUEDE VERIFICAR" aria-label="...">
								    No se puede verificar
								  </label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="memoria" class="col-md-4 control-label ">Contiene memoria?</label>
							<div class="col-md-1">
								<div class="radio">
								  <label>
								    <input type="radio" name="memoria" id="blankRadio1" value="SI" aria-label="...">
								    Si
								  </label>
								</div>
							</div>
							<div class="col-md-1">
								<div class="radio">
								  <label>
								    <input type="radio" name="memoria" id="blankRadio1" value="NO" aria-label="...">
								    No
								  </label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="radio">
								  <label>
								    <input type="radio" name="memoria" id="blankRadio1" value="NO SE PUEDE VERIFICAR" aria-label="...">
								    No se puede verificar
								  </label>
								</div>
							</div>
						</div>
						<div class="form-group" id="rutaPass" data-ruta="<?=base_url()?>serviciofolio/comprobarPass">
							<label for="pass" class="col-md-3 control-label ">Contraseña</label>
							<div class="col-md-8">
								<input type="password" name="pass" id="pass" class="form-control" value="">
								<input type="hidden" name="usuario" id="usuario">
							</div>
						</div>
						<!--div class="form-group">
							<label for="golpes" class="col-md-2 control-label ">Golpes</label>
							<div class="col-md-9">
								<input type="text" name="golpes" id="golpes" class="form-control" value="No tiene">
							</div>
						</div-->
					</div><!--row-->
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<div class="col-md-7">
									<button type="button" id="btn_servicio" class="btn btn-primary">Guardar Servicio</button>
								</div><div id="spServicio"  style="height:30px"class="col-md-3 "></div>
							</div>
						</div>
					</div><!--row-->
				</form>
			</div><!--panel-body Cuerpo-->
	</div><!--panel-->
</div><!--row PRINCIPAL DEL FORMULARIO SERVICIO-->
<div id="confirServicio"class="row">
	<div class="col-md-12"><p>¿Desea agregar otro equipo a este servicio?</p></div>
</div>
<div id="confirEquipo"class="row">
	<div class="col-md-12"><p>Revise sus datos y si son correctos, de aceptar. De lo contrario elija nuevamente</p></div>
</div>
<div id="mns"class="row" style="opacity:0">
	<div class="col-md-12"><p id="mnsBan" style="color:red;"></p></div>
</div>
<form method="post" id="frm_clave" action="<?=base_url()?>serviciofolio/buscar">
	<input type="hidden" name="clave" id="clave">
</form>
