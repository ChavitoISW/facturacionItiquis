<?php
include '../configuracion/database.php';
session_start();
if(!isset($_SESSION['_cedula_'])) {
  	header('location: error.php?error=l');
}
$fi = explode('/', $_POST['fechaInicio']);
$ff = explode('/', $_POST['fechaFinal']);
$_POST['fechaInicio'] = $fi[2].'/'.$fi[1].'/'.$fi[0];
$_POST['fechaFinal'] = $ff[2].'/'.$ff[1].'/'.$ff[0];
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
			$W = _QUERY("SELECT MAX(id)+1 AS id FROM tablamontos");
			if($W[0]['id'] == 0){
				$W[0]['id'] = 1;
			}
			_TRANS("INSERT INTO tablamontos VALUES ('{$W[0]['id']}', '{$_POST['nombre']}', '{$_POST['descripcion']}', '{$_POST['grupo']}', '{$_POST['cupo']}', '{$_POST['cupo']}', '{$_POST['monto']}', '{$_POST['descuento']}', '{$_POST['modalidad']}', '{$_POST['duracion']}', '{$_POST['instructor']}', '{$_POST['fechaInicio']}', '{$_POST['fechaFinal']}', '{$_POST['horario']}', '{$_POST['lugar']}', '{$_POST['programacion']}', '{$_POST['estado']}');");
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
			_TRANS("UPDATE tablamontos SET nombre = '{$_POST['nombre']}', descripcion = '{$_POST['descripcion']}', grupo = '{$_POST['grupo']}', cupo = '{$_POST['cupo']}', cuporeal = '{$_POST['cuporeal']}', monto = '{$_POST['monto']}', descuento = '{$_POST['descuento']}', modalidad = '{$_POST['modalidad']}', duracion = '{$_POST['duracion']}', instructor = '{$_POST['instructor']}', fechaInicio = '{$_POST['fechaInicio']}', fechaFinal = '{$_POST['fechaFinal']}', horario = '{$_POST['horario']}', lugar = '{$_POST['lugar']}', programacion = '{$_POST['programacion']}', estado = '{$_POST['estado']}' WHERE id = '{$_POST['id']}';");
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