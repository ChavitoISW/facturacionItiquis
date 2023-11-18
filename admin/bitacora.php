<?php
include '../configuracion/database.php';
include '_menu.php';
session_start();
if(!isset($_SESSION['_cedula_'])) {
  	header('location: error.php?error=l');
}
$Q = _QUERY("SELECT cedula, nombre FROM tabla002 WHERE cedula != '0-0000-0000' AND cedula != '9-9999-9999' AND cedula != '1-0507-0839';");
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
			<?=menu($_SESSION['_tipo_'], _Titulo())?>
			<section class="content-header">
                <br>
                <ol class="breadcrumb">
                    <li><a href="#"><img src="../imagenes/miniescudo.png"> <?=_Titulo()?></a></li>
                    <li class="active">Reportes</li>
					<li class="active">Reporte de Bitácora</li>
                </ol>
            </section> 
            <hr>			
			<br>					
            <section class="content">  
				<form name="formulario" id="formulario" method="post" action="bitacora_detalle.php">
					<center>
						<div class="row">  
							<div class="box box-info"> 												
							<div class="box-header with-border"><h3 class="box-title">Filtro de búsqueda</h3></div>
								<div class="box-body">                                    
									<table style="width:100%" cellpadding="2" cellspacing ="2">
                                        <!--<tr>
                                            	<td align="center"><label for="cedula" >Usuario:</label></td>
											<td>
												<select id="usuario" name="usuario" class="form-control" required>
													<option value ="">...</option>
													<?php for($z=0;$z<count($Q);$z++){?>
														<option value ="<?=$Q[$z]['cedula']?>"><?=$Q[$z]['cedula']?> | <?=$Q[$z]['nombre']?></option>
													<?php }?>
											</td>
										</tr>    -->
										<tr>
											<td align="center"><label for="nombre" >Rango de Fechas:</label></td>
											<td> <input class="form-control" placeholder="Rango de fechas" type="text" name="fecha" id="fecha"/></td>
										</tr>										
									</table>  
								</div>                              
								<div class="box-footer">                               
									<div class="pull-right">
										<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
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
		<script>$('#fecha').daterangepicker();</script>
	</body>
</html>