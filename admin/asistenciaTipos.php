<?php
include '../configuracion/database.php';
include '_menu.php';
session_start();
if (!isset($_SESSION['_cedula_'])) {
    header('location: error.php?error=l');
}

if (isset($_GET['export'])) {
    header('Content-type: application/x-msdownload');
    header('Content-Disposition: attachment; filename=reporte.xls');
    header('Pragma: no-cache');
    header('Expires: 0');
}
$ROW = _QUERY("SELECT tabla000.trans_compra, DATE_FORMAT(tabla000.fecha, '%d/%m/%Y %T') AS fecha, tabla000.cedula, tabla000.nombre, tabla000.correo, tabla000.telefono, tabla000.monto, tabla000.usuario, detalle.curso FROM detalle INNER JOIN tabla000 ON detalle.trans_compra = tabla000.trans_compra WHERE tabla000.estado = '1' AND detalle.idcurso = '{$_GET['id']}';");
if(!$ROW){
    $Q = _QUERY("SELECT nombre, grupo FROM tablamontos WHERE id = '{$_GET['id']}';");
    $ROW[0]['curso'] = $Q[0]['nombre'].', Grupo: '.$Q[0]['grupo'];
}
$total = 0;
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
                    <li class="active">Reportes</li>
                    <li class="active">Reporte General de Inscripciones</li>
                </ol>
            </section> 
            <hr>			
            <br>					
            <section class="content" style="width:90%">  
                <form name="formulario" id="formulario" method="post" action="_mod_inscripcion_detalle.php" onsubmit="return validacion();">
                    <input type="hidden" id="trans_compra" name="trans_compra" value="<?= $ROW[0]['trans_compra'] ?>">
                    <center>
                        <div class="row">  
                            <img src="../imagenes/logo.png" class="img-rounded" alt="logo">	
                            <div class="box box-info"> 												
                                <div class="box-header with-border"><h3 class="box-title">Reporte de Inscripciones de "<?=$ROW[0]['curso']?>"</h3></div>
                                <div class="box-body">                                    
                                    <table style="width:100%" cellpadding="4" cellspacing ="4">
                                        <tr>
                                            <td><b>No. Comprobante:</b></td>
                                            <td><b>Fecha:</b></td>
                                            <td><b>Cedula:</b></td>
                                            <td><b>Nombre:</b></td>
                                            <td><b>Teléfono:</b></td> 
                                            <td><b>Correo:</b></td>	
                                        </tr>
                                        <?php
                                            for ($x = 0; $x < count($ROW); $x++) {
                                                $total += $ROW[$x]['monto'];
                                            ?>
                                            <tr onMouseOut='mOut(this)' onMouseOver='mOver(this)'>
                                                <td><?= $ROW[$x]['trans_compra'] ?></td>
                                                <td><?= $ROW[$x]['fecha'] ?></td>
                                                <td><?= $ROW[$x]['cedula'] ?></td>
                                                <td><?= $ROW[$x]['nombre'] ?></td>
                                                <td><?= $ROW[$x]['telefono'] ?></td>
                                                <td><?= $ROW[$x]['correo'] ?></td>				
                                            </tr>
                                        <?php } ?>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr><td colspan="7" align="right"><b>Total de inscripciones:</b>&nbsp;</td><td><?= count($ROW) ?> Personas</td></tr>
                                    </table>  
                                </div>                              
                                <div class="box-footer">                               
                                    <div class="pull-right">
                                        <button type="button" onclick="window.print();" class="btn btn-primary"><i class="fa fa-print"></i> Imprimir</button>
                                    </div>
                                    <div class="pull-left">
                                        <button type="button" onclick="location.href = 'asistenciaTipos.php?id=<?=$_GET['id']?>&export=1';" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Exportar</button>
                                    </div>									
                                </div>                                 
                            </div>						
                        </div>     
                    </center> 	
                </form>	
            </section>	
            <hr>			
            <footer class="Pfooter">
                <strong>&copy; <?=date('Y')?></strong>            </footer>
        </div>
    </body>
</html>