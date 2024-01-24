<?php
if (!isset($_POST))
    die('Error de parámetros 0');
include 'configuracion/database.php';

$orden = $_POST['consecutivo'];
$tipoPago = $_POST['tipoPago'];

$ROW = _QUERY("SELECT MAX(cocina) as cons FROM consecutivo;");
$ROWOrden = _QUERY("SELECT SUM(totalLinea) as total FROM pedido where consecutivo = '$orden';");
$consecutivo = $ROW[0]['cons'];
$monto = $ROWOrden[0]['total'];

_TRANS("INSERT INTO encabezadopedido VALUES('$consecutivo', NOW(), '$monto', '0-0000-0000', 1) ;");

_TRANS("UPDATE encabezadopedido SET consecutivo = '$consecutivo', tipoPago = '$tipoPago', monto = '$monto' WHERE consecutivo = '$orden';");

_TRANS("UPDATE pedido SET consecutivo = '$consecutivo' WHERE consecutivo = '$orden';");
_TRANS("UPDATE consecutivo SET cocina = (SELECT MAX(cocina) FROM consecutivo)+1;");

$detalle = _QUERY("select tm.nombre, tm.monto, p.cantidad, p.totalLinea from pedido p inner join tablamontos tm on p.idProducto = tm.id where p.consecutivo = '$consecutivo';");
$fecha = date('Y/m/d');

$comoPago = $tipoPago == 2 ? "Sinpe": "Efectivo";

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
        <title><?= _Titulo() ?></title>
        <link rel="icon" type="image/gif" href="imagenes/logo.png">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>		 		
        <link rel="stylesheet" href="css/bridge.css">
        <script src="js/jquery-2.2.3.min.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/moment.min.js"></script>
        <script src="js/daterangepicker.js"></script>
        <script src="js/bootstrap-datepicker.js"></script>
        <script src="js/bootstrap-timepicker.min.js"></script>
        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/dataTables.bootstrap.min.js"></script>
        <script src="js/jquery.knob.js"></script>
        <script src="js/moment.min.js"></script>
        <script src="js/jquery.slimscroll.min.js"></script>
        <script src="js/fastclick.js"></script>
        <script src="js/app.min.js"></script>
        <script src="js/jquery.inputmask.bundle.js"></script>
        <script src="js/inputmask.phone.extensions.js"></script>
        <script src="js/sweetalert.min.js"></script>
        <style type="text/css" media="print">
            .nover {display:none}
        </style>
    </head>
    <body>

        <div class="wrapper">
            <section class="content-header nover">
                <ol class="breadcrumb nover">
                    <li><a href="#"><img src="imagenes/miniescudo.png"> <?= _Titulo() ?></a></li>
                    <li class="active nover"><?= _Evento() ?></li>
                </ol>
            </section> 
            <hr>

            <section class="content">  
                <form name="formulario" id="formulario" method="post" action="pago.php">
                    <center>
                        <div class="row">
                            <div class="box box-info">
                                <div class="box-header with-border"><h5 >Parroquia Sagrado Coraz&oacute;n de Jesus <br/>Diaconia Nuestra señora de Lourdes </h5></div>
                                <div class="form-group">
                               <!-- <div ><h5><strong>Direcci&oacute;n:</strong> Del puente de Itiquis, 700 metros este </h5></div>-->
                                <!--<div ><h5><strong>Correo electr&oacute;nico:</strong> ticda.digital@gmail.com </h5></div>-->
                                <div ><h5><strong>Fecha:</strong> <?= $fecha?></h5></div>
                                    <div><h5 ><strong>Sinpe Movil: </strong>8353-9062</h5></div>
                                    <hr/>
                                    <div><h5><strong>Consecutivo: </strong></h5><h3><?= $consecutivo?></h3></div>
                                    <hr/>
                               <!-- <div><h5 ><strong>Cliente: </strong>Estimado Cliente</h5></div>-->

                            </div>
                                <hr/>
                                <div class="table1" id="table1" >
                                    <table id="table" class="table table-bordered table-striped" border="2">
                                        <thead>
                                        <tr align="center">
                                            <th style="text-align: center">Cant.</th>
                                            <th style="text-align: center">Producto</th>
                                           <!-- <th>Precio <br/> Unitario</th>-->
                                            <th style="text-align: center">Total Linea</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php for ($x = 0; $x < count($detalle); $x++) {
                                            if ($detalle[$x] != '') {  ?>
                                            <tr class="gradeA" align="center">
                                                <td><h4><?= $detalle[$x]['cantidad'] ?></h4></a></td>
                                                <td><h4><?= $detalle[$x]['nombre'] ?></h4></td>
                                                <!--<td><h5>&cent;<?= _FORMATO($detalle[$x]['monto']) ?></h5> </td>-->
                                                <td><h5>&cent;<?= _FORMATO($detalle[$x]['totalLinea']) ?></h5> </td>
                                            </tr>
                                        <?php } } ?>
                                        </tbody>
                                    </table>
                                    <hr>

                                    <div class="form-group">
                                        <div class="col-sm-12"> <h4>Monto total de compra:&nbsp; <strong>&cent;&nbsp;<?= _FORMATO($monto) ?></strong></h4> </div>
                                            <h4>Medio de Pago: <strong><?= $tipoPago == 1 ? "Efectivo": "Sinpe"?></strong> </h4>
                                    </div>
                                    <hr/>
                                </div>

                                <div class="box-footer">
                                    <div class="pull-right nover">
                                        <button type="button" onclick="window.print()" class="btn btn-primary"><i class="fa fa-print"></i> Imprimir</button>
                                    </div>
                                    <div class="pull-left nover">
                                        <button type="button" onclick="location.href = 'index.php';" class="btn btn-default"><i class="fa fa-arrow-circle-o-left"></i> Regresar</button>									
                                    </div>									
                                </div>                                 
                            </div>						
                        </div>     
                    </center> 	
                </form>	
            </section>
            <hr>			
            <footer class="Pfooter nover">
                <strong>BRAJOS-SOFT &copy; <?=date('Y')?></strong>            </footer>
        </div>		
    </body>
</html>