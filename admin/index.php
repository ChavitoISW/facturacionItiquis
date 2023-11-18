<?php
include '../configuracion/database.php';
session_start();
session_destroy();
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
    <body>
		<div class="wrapper">
            <section class="content-header">
                <br>
                <ol class="breadcrumb">
                    <li><a href="#"><img src="../imagenes/miniescudo.png"> <?=_Titulo()?></a></li>
                    <li class="active"><?=_Evento()?></li>
                </ol>
            </section> 
            <hr>			
			<br>					
            <section class="content">  
				<form name="formulario" id="formulario" method="post" action="_index.php">
					<center>
						<div class="row">  
							<img src="../imagenes/logo.png" class="img-rounded" alt="logo">	
							<div class="box box-info"> 												
							<div class="box-header with-border"><h3 class="box-title">Iniciar Sesión</h3></div>
								<div class="box-body">                                    
									<table style="width:100%" cellpadding="2" cellspacing ="2">
										<tr>
											<td align="center"><label for="usuario" >Usuario:</label></td>
											<td><input type="text" class="form-control" placeholder="Usuario" name="usuario" id="usuario" required autofocus></td>
										</tr>                                        
										<tr>
											<td align="center"><label for="clave" >Contraseña:</label></td>
											<td> <input class="form-control" placeholder="Nombre Completo"  type="password" name="clave" id="clave" required/></td>
										</tr>										
									</table>  
								</div>                              
								<div class="box-footer">                               
									<div class="pull-right">
										<button type="submit" class="btn btn-primary"><i class="fa fa-lock"></i> Iniciar Sesión</button>
									</div>									
								</div>                                 
							</div>						
						</div>     
					</center> 	
				</form>	
            </section>	
			<hr>			
			<footer class="Pfooter">
                <strong>BRAJOS-SOFT&copy; <?=date('Y')?></strong>			</footer>
		</div>
	</body>
</html>