<?php
include '../configuracion/database.php';
include '_menu.php';
session_start();
if(!isset($_SESSION['_cedula_'])) {
  	header('location: error.php?error=l');
}

if( isset($_GET['export']) ){
	header('Content-type: application/x-msdownload'); 
	header('Content-Disposition: attachment; filename=reporte.xls'); 
	header('Pragma: no-cache'); 
	header('Expires: 0');
}
$fechas = $_POST['fecha'];
//$fechas = str_replace('-',"' and '" , $fechas);
error_log($fechas);

$inicio = strpos($fechas, ' -');

$inicio = substr($fechas, 0, $inicio);
$final =  substr($fechas, -10);


$inicio = date_create_from_format('d/m/Y', $inicio);
$inicio=  date_format($inicio, 'Y-m-d');

$final = date_create_from_format('d/m/Y', $final);
$final = date_format($final, 'Y-m-d');



$total = 0;
$totalEfectivo = 0;
$totalSimpe = 0;

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
		<title><?=_Titulo()?></title>
		<link rel="icon" type="image/gif" href="../imagenes/logo.png">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>		 		
		<link rel="stylesheet" href="../css/bridge.css">
		<link rel="stylesheet" href="../css/print.css?1">
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
					<li class="active">Reporte Detalle de Bitácora</li>
                </ol>
            </section> 
            <hr>			
			<br>
            <section class="content" style="width:90%">


                <center>
                    <div class="row">
                        <img src="../imagenes/logo.png" class="img-rounded" alt="logo">
                        <div class="box box-info">
                            <div class="box-header with-border"><h3 class="box-title">Reporte de ingresos del <?= $_POST['fecha'] ?></h3></div>
                            <div class="box-body">
                                <h3>EFECTIVO</h3>
                                <table style="width:100%" cellpadding="2" cellspacing ="2">
                                    <tr>
                                        <th><b>No. Comprobante</b></th>
                                        <th><b>Fecha</b></th>
                                        <th><b>Monto</b></th>
                                    </tr>
                                    <?php
                                    $ROW = _QUERY("SELECT consecutivo, DATE_FORMAT(fecha, '%d/%m/%Y %T') AS fecha,  monto FROM encabezadopedido WHERE (fecha > '{$inicio}' and  fecha <= '{$final} 23:59:00') AND estado = '1' AND tipoPago = 1;");
                                    for ($x = 0; $x < count($ROW); $x++) {
                                        $totalEfectivo += $ROW[$x]['monto']
                                        ?>
                                        <tr onMouseOut='mOut(this)' onMouseOver='mOver(this)'>
                                            <td><?= $ROW[$x]['consecutivo'] ?></td>
                                            <td><?= $ROW[$x]['fecha'] ?></td>
                                            <td>&cent;<?= _FORMATO($ROW[$x]['monto']) ?> CRC</td>
                                        </tr>
                                    <?php } ?>
                                    <tr><td colspan="8"><hr></td></tr>
                                    <tr><td colspan="7" align="right"><b>Total Efectivo:</b>&nbsp;</td><td>&cent;<?= _FORMATO($totalEfectivo) ?> CRC</td></tr>
                                </table>
                                <hr/>
                                <table style="width:100%" cellpadding="2" cellspacing ="2">
                                    <br/>

                                    <h3>SINPE</h3>
                                    <tr>
                                        <th><b>No. Comprobante</b></th>
                                        <th><b>Fecha</b></th>
                                        <th><b>Monto</b></th>
                                    </tr>
                                    <?php
                                    $ROWE = _QUERY("SELECT consecutivo, DATE_FORMAT(fecha, '%d/%m/%Y %T') AS fecha,  monto FROM encabezadopedido WHERE (fecha > '{$inicio}' and  fecha <= '{$final} 23:59:00') AND estado = '1' AND tipoPago = 2;");

                                    for ($x = 0; $x < count($ROWE); $x++) {
                                        $totalSimpe += $ROWE[$x]['monto']
                                        ?>
                                        <tr onMouseOut='mOut(this)' onMouseOver='mOver(this)'>
                                            <td><?= $ROWE[$x]['consecutivo'] ?></td>
                                            <td><?= $ROWE[$x]['fecha'] ?></td>
                                            <td>&cent;<?= _FORMATO($ROWE[$x]['monto']) ?> CRC</td>
                                        </tr>
                                    <?php } ?>
                                    <tr><td colspan="8"><hr></td></tr>
                                    <tr><td colspan="7" align="right"><b>Total Sinpe:</b>&nbsp;</td><td>&cent;<?= _FORMATO($totalSimpe) ?> CRC</td></tr>
                                </table>
                                <br/>
                                <br/>
                                <h3>TOTAL GENERAL: <strong>&cent; <?= _FORMATO($totalSimpe + $totalEfectivo) ?></strong></h3>

                            </div>
                            <div class="box-footer">
                                <div class="pull-right">
                                    <button type="button" onclick="window.print();" class="btn btn-primary"><i class="fa fa-print"></i> Imprimir</button>
                                </div>
                                <div class="pull-left">
                                    <button type="button" onclick="location.href = 'cierre.php?export=1';" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Exportar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </center>
            </section>
			<hr>			
			<footer class="Pfooter">
                <strong>&copy; <?=date('Y')?></strong>			</footer>
		</div>
	</body>
</html>