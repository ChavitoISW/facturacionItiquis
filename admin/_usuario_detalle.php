<?php
include '../configuracion/database.php';
session_start();
if(!isset($_SESSION['_cedula_'])) {
  	header('location: error.php?error=l');
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
	<body>
		<?php
		if(!isset($_POST['id'])){?>
			<script>
				swal({
                        title: "Error!!!",
                        text: "Error al recibir parametros!",
                        type: "error",
                        timer: 6000,
                        showConfirmButton: false
                    });
					opener.location.reload();
                    window.close();
			</script>
		<?php
		}
		if($_POST['id'] == ''){
			_TRANS("INSERT INTO tabla002 VALUES ('{$_POST['cedula']}', '{$_POST['nombre']}', '{$_POST['usuario']}', '{$_POST['clave']}', '{$_POST['tipo']}', '{$_POST['estado']}');");
		?>
			<script>
				swal({
                        title: "Exito!!!",
                        text: "Se actualizo la informacion con exito!",
                        type: "success",
                        timer: 6000,
                        showConfirmButton: false
                    });
					opener.location.reload();
                    window.close();
			</script>
		<?php
		}else{ 
			_TRANS("UPDATE tabla002 SET nombre = '{$_POST['nombre']}', usuario = '{$_POST['usuario']}', clave = '{$_POST['clave']}', tipo = '{$_POST['tipo']}', estado = '{$_POST['estado']}' WHERE cedula = '{$_POST['id']}';");
		?>
			<script>
				swal({
                        title: "Alerta!!!",
                        text: "No fue posible actualizar la informacion!",
                        type: "warning",
                        timer: 6000,
                        showConfirmButton: false
                    });
					opener.location.reload();
                    window.close();
			</script>
		<?php
		}		
		?>
	</body>
</html>