<?php
include '../configuracion/database.php';
include '_menu.php';
session_start();
if (!isset($_SESSION['_cedula_'])) {
    header('location: error.php?error=l');
}
$fecha = date('Y/m/d');

$totalGeneralEfectivo = 0;
$totalGeneralSimpe = 0;
$totalGeneralNulos = 0;
$grantotalGeneral = 0;

if (isset($_GET['export'])) {
    header('Content-type: application/x-msdownload');
    header('Content-Disposition: attachment; filename=reporte.xls');
    header('Pragma: no-cache');
    header('Expires: 0');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
        <title><?= _Titulo() ?></title>
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
            <?= menu($_SESSION['_tipo_'], _Titulo()) ?>
            <section class="content-header">
                <br>
                <ol class="breadcrumb">
                    <li><a href="#"><img src="../imagenes/miniescudo.png"> <?= _Titulo() ?></a></li>
                    <li class="active">Cierre de Caja</li>
                </ol>
            </section> 
            <hr>			
            <br>					
            <section class="content" style="width:90%">  


                <center>
                    <div class="row">  
                        <img src="../imagenes/logo.png" class="img-rounded" alt="logo">	
                        <div class="box box-info"> 												
                            <div class="box-header with-border"><h3 class="box-title">Cierre de Caja del <?= date('d/m/Y') ?></h3></div>
                            <div class="box-body">

                                <?php
                                $ro = _QUERY("SELECT DISTINCT tp.nombre as nombre FROM encabezadopedido ep 
                                    inner join pedido p on ep.consecutivo = p.consecutivo inner join tablamontos tm on p.idProducto = tm.id
                                    inner join tablaprogramaciones tp on tm.programacion = tp.id
                                    WHERE usuario = '0-0000-0000' AND (fecha BETWEEN '2023-11-14' AND '2023-11-15 23:59:00') AND ep.estado = '1';");


                                for ($y = 0; $y < count($ro); $y++) {
                                    $progra = $ro[$y]['nombre'];

                                $total = 0;
                                $totalEfectivo = 0;
                                $totalSimpe = 0;
                                $totalNulos = 0;

                                ?>
                                    <div class="dynamic" id="dynamic">
                                    <h2>Caja de <?= $progra ?></h2>
                                <h3>EFECTIVO</h3>
                                <table style="width:100%" cellpadding="2" cellspacing ="2" >
                                    <tr>
                                        <th><b>No. Comprobante</b></th>
                                        <th><b>Fecha</b></th>
                                        <th><b>Nombre</b></th>
                                        <th><b>Monto</b></th>
                                    </tr>
                                    <?php
                                   $ROW = _QUERY(" SELECT (ep.consecutivo), DATE_FORMAT(ep.fecha, '%d/%m/%Y %T') AS fecha, p.totalLinea as monto, tp.nombre as programacion, tm.nombre as nombre FROM encabezadopedido ep inner join pedido p on ep.consecutivo = p.consecutivo inner join tablamontos tm on p.idProducto = tm.id inner join tablaprogramaciones tp on tm.programacion = tp.id
                                     WHERE usuario = '0-0000-0000' AND (fecha BETWEEN '{$fecha}' AND '{$fecha} 23:59:00') AND ep.estado = '1' AND tipoPago = 1 and tp.nombre like '%$progra%';");
                                   
                                    for ($x = 0; $x < count($ROW); $x++) {
                                        $totalEfectivo += $ROW[$x]['monto'];

                                        ?>
                                        <tr onMouseOut='mOut(this)' onMouseOver='mOver(this)'>
                                            <td><?= $ROW[$x]['consecutivo'] ?></td>
                                            <td><?= $ROW[$x]['fecha'] ?></td>
                                            <td><?= $ROW[$x]['nombre'] ?></td>
                                            <td>&cent;<?= _FORMATO($ROW[$x]['monto']) ?> </td>
                                        </tr>
                                    <?php }  $totalGeneralEfectivo += $totalEfectivo ?>
                                    <tr><td colspan="8"><hr></td></tr>
                                    <tr><td colspan="7" align="right"><b>Total Efectivo <?= $progra ?>:</b>&nbsp;</td><td>&cent;<?= _FORMATO($totalEfectivo) ?> </td></tr>
                                </table>
                                    <hr/>
                                    <table style="width:100%" cellpadding="2" cellspacing ="2">
                                        <br/>

                                        <h3>SINPE</h3>
                                        <tr>
                                            <th><b>No. Comprobante</b></th>
                                            <th><b>Fecha</b></th>
                                            <th><b>Nombre</b></th>
                                            <th><b>Monto</b></th>
                                        </tr>
                                        <?php
                                        $ROWE = _QUERY(" SELECT (ep.consecutivo), DATE_FORMAT(ep.fecha, '%d/%m/%Y %T') AS fecha, p.totalLinea as monto, tp.nombre as programacion, tm.nombre as nombre FROM encabezadopedido ep inner join pedido p on ep.consecutivo = p.consecutivo inner join tablamontos tm on p.idProducto = tm.id inner join tablaprogramaciones tp on tm.programacion = tp.id 
                                        WHERE usuario = '0-0000-0000' AND (fecha BETWEEN '{$fecha}' AND '{$fecha} 23:59:00') AND ep.estado = '1' AND tipoPago = 2 and tp.nombre like '%$progra%';");


                                        for ($x = 0; $x < count($ROWE); $x++) {
                                            $totalSimpe += $ROWE[$x]['monto'];
                                            ?>
                                            <tr onMouseOut='mOut(this)' onMouseOver='mOver(this)'>
                                                <td><?= $ROWE[$x]['consecutivo'] ?></td>
                                                <td><?= $ROWE[$x]['fecha'] ?></td>
                                                <td><?= $ROWE[$x]['nombre'] ?></td>
                                                <td>&cent;<?= _FORMATO($ROWE[$x]['monto']) ?></td>
                                            </tr>
                                        <?php } $totalGeneralSimpe += $totalSimpe;?>
                                    <tr><td colspan="8"><hr></td></tr>
                                    <tr><td colspan="7" align="right"><b>Total Sinpe <?= $progra ?>:</b>&nbsp;</td><td>&cent;<?= _FORMATO($totalSimpe) ?></td></tr>
                                </table>
                                <br/>
                                <table style="width:100%" cellpadding="2" cellspacing ="2">
                                    <br/>

                                    <h3>Tiqutes Anulados</h3>
                                    <tr>
                                        <th><b>No. Comprobante</b></th>
                                        <th><b>Fecha</b></th>
                                        <th><b>Nombre</b></th>
                                        <th><b>Monto</b></th>
                                    </tr>
                                    <?php
                                    $ROWN = _QUERY(" SELECT (ep.consecutivo), DATE_FORMAT(ep.fecha, '%d/%m/%Y %T') AS fecha, p.totalLinea as monto, tp.nombre as programacion, tm.nombre as nombre FROM encabezadopedido ep inner join pedido p on ep.consecutivo = p.consecutivo inner join tablamontos tm on p.idProducto = tm.id inner join tablaprogramaciones tp on tm.programacion = tp.id WHERE usuario = '0-0000-0000' AND (fecha BETWEEN '{$fecha}' AND '{$fecha} 23:59:00') AND ep.estado = '0'  and tp.nombre like '%$progra%';");

                                    for ($x = 0; $x < count($ROWN); $x++) {
                                        $totalNulos += $ROWN[$x]['monto'];

                                        ?>
                                        <tr onMouseOut='mOut(this)' onMouseOver='mOver(this)'>
                                            <td><?= $ROWN[$x]['consecutivo'] ?></td>
                                            <td><?= $ROWN[$x]['fecha'] ?></td>
                                            <td><?= $ROWN[$x]['nombre'] ?></td>
                                            <td>&cent;<?= _FORMATO($ROWN[$x]['monto']) ?></td>
                                        </tr>
                                    <?php }  $totalGeneralNulos += $totalNulos;?>
                                    <tr><td colspan="8"><hr></td></tr>
                                    <tr style="color: red"><td colspan="7" align="right"><b>Total Anulados <?= $progra ?>:</b>&nbsp;</td><td>&cent;<?= _FORMATO($totalNulos) ?></td></tr>
                                </table>
                                <br/>
                                <h3>TOTAL GENERAL <?= strtoupper($progra) ?>: <strong>&cent; <?= _FORMATO($totalSimpe + $totalEfectivo) ?></strong></h3>
                                <h6>*No incluye los tiquetes anulados</h6>
                                        <hr/>
                            </div>
                            <?php }?>

                                <div>
                                    <h2>Total General Efectivo:&nbsp;&cent;<?=  _FORMATO($totalGeneralEfectivo)?></h2>
                                    <h2>Total General Sinpe:&nbsp;&cent;<?= _FORMATO($totalGeneralSimpe)?></h2>
                                    <h2 style="color: red">Total General Nulos:&nbsp;&cent;<?= _FORMATO($totalGeneralNulos)?></h2>
                                    <h2><strong>Gran Total General: &nbsp;&cent; <?= _FORMATO($totalGeneralEfectivo+$totalGeneralSimpe)?></strong></h2>
                                </div>
                            <div class="box-footer">                               
                                <div class="pull-right">
                                    <button type="button" onclick="window.print();" class="btn btn-primary"><i class="fa fa-print"></i> Imprimir</button>
                                </div>
                                <div class="pull-left">
                                    <button type="button" onclick="location.href = 'cierre2.php?export=1';" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Exportar</button>
                                </div>									
                            </div>                                 
                        </div>						
                        </div>
                    </div>
                </center> 	
            </section>	
            <hr>			
            <footer class="Pfooter">
                <strong>BRAJOS-SOFT&copy; <?=date('Y')?></strong>            </footer>
        </div>
    </body>
</html>