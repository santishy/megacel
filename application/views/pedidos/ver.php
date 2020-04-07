<!DOCTYPE html>
<html lang="es">


<head>	
  <meta contentType="application/json"charset=utf-8>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  
	<title>
    <?php 
        if(isset($title))
          echo $nomSuc.' '.$title;
        else
          echo $nomSuc.'Servicio';
    ?>    
  </title>

 
  <link href="<?=base_url()?>css/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css">
  <link href="<?=base_url()?>css/bootstrap.min.css" rel="stylesheet" type="text/css">	
  <link href="<?=base_url()?>css/styles.less" rel="stylesheet/less" type="text/css">
  <link href="<?=base_url()?>css/dataTables.css" rel="stylesheet/less" type="text/css">
  <link href="<?=base_url()?>css/font-awesome.min.css" rel="stylesheet/less" type="text/css">

  <script src="<?=base_url()?>js/less.js" type="text/javascript"></script>
  <script src="<?=base_url()?>js/JQuery.js" type="text/javaScript"></script> 
  <script src="<?=base_url()?>js/jquery-ui-1.10.3.custom.min.js"></script>
  <script src="<?=base_url()?>js/jquery.dataTables.min.js"></script>
  
  <script src="<?=base_url()?>js/bootstrap.js"></script>
  <script src="<?=base_url()?>js/spin.js"></script>
  <script src="<?=base_url()?>js/ZeroClipboard.js" type="text/javascript"></script>
  <script src="<?=base_url()?>js/dataTables.tableTools.min.js" type="text/javaScript"></script>
  <script src="<?=base_url()?>js/<?=$ruta?>" type="text/javaScript"></script>
  <script src="<?=base_url()?>js/hola.js" type="text/javaScript"></script>
   
 
</head>
<body>
	<div class="row">
		<div class="col-xs-3">
		</div>
		<div class="col-xs-9">
			<div class="table-responsive">
				<table class="table table-bordered">
					
				</table>
			</div>
		</div>
	</div>
</body>