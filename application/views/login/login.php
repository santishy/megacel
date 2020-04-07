<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>..Ingreso al sistema..</title>
	<script src="<?=base_url()?>js/JQuery.js" type="text/javaScript"></script>
	<link href="<?=base_url()?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>css/styles.less" rel="stylesheet/less" type="text/css">
  	<link href="<?=base_url()?>css/font-awesome.min.css" rel="stylesheet/less" type="text/css">
  	<link href="<?=base_url()?>css/jquery_notification.css" rel="stylesheet/less" type="text/css">
  	<script src="<?=base_url()?>js/bootstrap.js"></script>
  	<script src="<?=base_url()?>js/jquery_notification_v.1.js" type="text/javascript"></script>
  	<script src="<?=base_url()?>js/less.js" type="text/javascript"></script>




</head>
<body>
<div class="container" id="divLogin">
	<div class="row">
			<div class="col-md-6 col-md-offset-4 col-sm-9 col-sm-offset-3 col-xs-12 col-lg-12" style="margin-top:10%;" id="contenedor">
				<form action="<?=base_url()?>login/Login" method="post" class="form-horizontal " id="frmIngreso" role="form">
					<div style="font-size:1.5em;text-align:center;border-bottom:1px solid #fff;">Login</div><br>
					<div class="form-group">
						 <div class="col-md-10 col-md-offset-1">
						   <input type="text" class="form-control txtlogin" id="txtUser" name="txtUser" placeholder="nombre de usuario" pattern=".{3,}" required title="el campo debe tener 3 caracteres minimo" autofocus>
						 </div>
					</div>
					<div class="form-group">
						<div class="col-md-10  col-md-offset-1">
							<input type="password"  class="form-control txtlogin" id="txtPass" name="txtPass"  required title="el campo debe tener 8 caracteres minimo" placeholder="Contraseña" required>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-10 col-md-offset-1" >
							<select id="lstSuc" name="lstSuc" class="form-control txtlogin">
								<?php foreach($query->result() as $row){?>
									<option value="<?=$row->idsuc?>"><?=$row->nombre?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="form-group col-md-12">
						<button class="btn btn-warning col-md-5 col-md-offset-1" id="btnLogin" type="submit" style="background-color:#FF4500;"><i class="fa fa-sign-in fa-lg"></i> Ingresar</button>
						<div class="col-md-1" id="divAvisoIngreso"></div>
					</div>

				</form>
			</div>
	</div>
</div>
<script src="<?=base_url()?>js/ings.js" type="text/javascript"></script>
</body>
</html>
