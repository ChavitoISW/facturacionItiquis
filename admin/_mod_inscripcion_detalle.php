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
		if(!isset($_POST['trans_compra'])){?>
			<script>
				swal({
                        title: "Error!!!",
                        text: "Error al recibir parametros!",
                        type: "error",
                        timer: 6000,
                        showConfirmButton: false
                    });
                    window.close();
			</script>
		<?php
		}
		
		$split = explode('|', $_POST['monto']);
		
		if(_TRANS("UPDATE tabla000 SET cedula = '{$_POST['cedula']}', nombre = '{$_POST['nombre']}', correo = '{$_POST['correo']}', telefono = '{$_POST['telefono']}' WHERE trans_compra = '{$_POST['trans_compra']}';")){
			_TRANS("INSERT INTO tablaBIT VALUES('{$_SESSION['_cedula_']}', 'M', NOW(), 'Modifica inscripcion de cliente {$_POST['cedula']}', '{$_POST['formapago']}', '{$_POST['compago']}');");	
                        _TRANS("DELETE FROM detalle WHERE trans_compra = '{$_POST['trans_compra']}';");
                        $monto = 0;
                        for ($z = 0; $z < count($_POST['ck']); $z++) {
                            $Q = _QUERY("SELECT id, nombre, grupo, cuporeal, monto, descuento, estado FROM tablamontos WHERE (id = '{$_POST['ck'][$z]}');");
                            $c = $Q[0]['nombre'] . ", Grupo:" . $Q[0]['grupo'];
                            $v = ($Q[0]['monto'] - ($Q[0]['monto'] * ($Q[0]['descuento'] / 100)));
                            $monto += ($Q[0]['monto'] - ($Q[0]['monto'] * ($Q[0]['descuento'] / 100)));
                            _TRANS("INSERT INTO detalle VALUES('{$_POST['trans_compra']}', '{$Q[0]['id']}', '{$c}', '{$v}');");
                            _TRANS("UPDATE tabla000 SET monto = '{$monto}' WHERE trans_compra = '{$_POST['trans_compra']}';");
                        }
                ?>
			<script>
				swal({
                        title: "Exito!!!",
                        text: "Se actualizo la informacion con exito!",
                        type: "success",
                        timer: 6000,
                        showConfirmButton: false
                    });
                    location.href = 'mod_inscripcion_detalle.php?ORDER=<?=$_POST['trans_compra']?>';
			</script>
		<?php
		}else{?>
			<script>
				swal({
                        title: "Alerta!!!",
                        text: "No fue posible actualizar la informacion!",
                        type: "warning",
                        timer: 6000,
                        showConfirmButton: false
                    });
                    location.href = 'mod_inscripcion_detalle.php?ORDER=<?=$_POST['trans_compra']?>';
			</script>
		<?php
		}		
		?>
	</body>
</html>