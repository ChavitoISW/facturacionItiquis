<?php
include '../configuracion/database.php';
session_start();
if(!isset($_SESSION['_cedula_'])) {
  	header('location: error.php?error=l');
}

if($_GET['id'] != ''){
	$ROW = _QUERY("SELECT cedula, nombre, usuario, clave, tipo, estado FROM tabla002 WHERE cedula = '{$_GET['id']}';");
}else{
	$ROW[0]['cedula'] = $ROW[0]['nombre'] = $ROW[0]['usuario'] = $ROW[0]['clave'] = $ROW[0]['tipo'] = $ROW[0]['estado'] = '';
}	
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
		<title><?=_Titulo()?></title>
		<link rel="icon" type="image/gif" href="../imagenes/logo.png">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>		 		
		<link rel="stylesheet" href="../css/bridge.css">
		<script src="../js/jquery-2.2.3.min.js"></script>
		<script src="../js/jquery-ui.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/moment.min.js"></script>
		<script src="../js/daterangepicker.js"></script>
		<script src="../js/bootstrap-datepicker.js"></script>
		<script src="../js/bootstrap-timepicker.min.js"></script>
		<script src="../js/jquery.dataTables.min.js"></script>
		<script src="../js/dataTables.bootstrap.min.js"></script>
		<script src="../js/jquery.knob.js"></script>
		<script src="../js/moment.min.js"></script>
		<script src="../js/jquery.slimscroll.min.js"></script>
		<script src="../js/fastclick.js"></script>
		<script src="../js/app.min.js"></script>
		<script src="../js/jquery.inputmask.bundle.js"></script>
		<script src="../js/inputmask.phone.extensions.js"></script>
		<script src="../js/sweetalert.min.js"></script>
	</head>	
    <body class="hold-transition skin-blue layout-top-nav">
		<div class="wrapper">
			<section class="content-header">
                <br>
                <ol class="breadcrumb">
                    <li><a href="#"><img src="../imagenes/miniescudo.png"> <?=_Titulo()?></a></li>
                    <li class="active">Mantenimiento</li>
					<li class="active">Gestionar Usuarios Detalle</li>
                </ol>
            </section> 
            <hr>			
			<br>					
            <section class="content">  
				<form name="formulario" id="formulario" method="post" action="_usuario_detalle.php">
					<input type="hidden" id="id" name="id" value="<?=$_GET['id']?>">
					<center>
						<div class="row">  
							<div class="box box-info"> 												
							<div class="box-header with-border"><h3 class="box-title">Datos del usuario</h3></div>
								<div class="box-body">                                    
									<table style="width:100%" cellpadding="2" cellspacing ="2">
										<tr><td><strong>Identificación:</strong></td><td><input type="text" class="form-control" id="cedula" name="cedula" value="<?=$ROW[0]['cedula']?>" <?=$_GET['id'] != '' ? 'readonly' : ''?>/></td></tr>
										<tr><td><strong>Nombre:</strong></td><td><input type="text" class="form-control" id="nombre" name="nombre" value="<?=$ROW[0]['nombre']?>" /></td></tr>
										<tr><td><strong>Usuario:</strong></td><td><input type="text" class="form-control" id="usuario" name="usuario" value="<?=$ROW[0]['usuario']?>" /></td></tr>
										<tr><td><strong>Contrase&ntilde;a:</strong></td><td><input type="text" class="form-control" id="clave" name="clave" value="<?=$ROW[0]['clave']?>" /></td></tr>
										<tr>
											<td><strong>Tipo:</strong></td>
											<td>
												<select id="tipo" name="tipo" class="form-control" required>
													<option>...</option>
													<option <?=$ROW[0]['tipo']=='1' ? 'selected' : ''?> value="1">Operador</option>
													<option <?=$ROW[0]['tipo']=='7' ? 'selected' : ''?> value="7">Administrador</option>
												<select>
											</td>
										</tr>
										<tr>
											<td><strong>Estado:</strong></td>
											<td>
												<select id="estado" name="estado" class="form-control" required>
													<option>...</option>
													<option <?=$ROW[0]['estado']=='1' ? 'selected' : ''?> value="1">Activo</option>
													<option <?=$ROW[0]['estado']=='0' ? 'selected' : ''?> value="0">Inactivo</option>
												<select>
											</td>
										</tr>									
									</table>  
								</div>                              
								<div class="box-footer">                               
									<div class="pull-right">
										<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
									</div>									
								</div>                                 
							</div>						
						</div>					
					</center> 	
				</form>	
            </section>	
			<hr>			
			<footer class="Pfooter">
                <strong>&copy; <?=date('Y')?></strong>			</footer>
		</div>
	</body>
</html>