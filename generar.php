<?php
if (!isset($_POST))
    die('Error de parámetros 0');
include 'configuracion/database.php';

$orden = $_POST['consecutivo'];

$ROWOrden = _QUERY("SELECT SUM(totalLinea) as total FROM pedido where consecutivo = '$orden';");

$monto = $ROWOrden[0]['total'];

_TRANS("INSERT INTO encabezadopedido VALUES('$orden', NOW(), '$monto', '0-0000-0000', 1 , 0);");

$detalle = _QUERY("select tm.nombre, tm.monto, p.cantidad, p.totalLinea from pedido p inner join tablamontos tm on p.idProducto = tm.id where p.consecutivo = '$orden';");
$fecha = date('Y/m/d');

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
            <section class="content-header">
                <br>
                <ol class="breadcrumb">
                    <li><a href="#"><img src="imagenes/miniescudo.png"> <?= _Titulo() ?></a></li>
                    <li class="active"><?= _Evento() ?></li>
                </ol>
            </section> 
            <hr>			
            <br>
            <section class="content">
                <form id= "tipoPago" name="tipoPago" action="procesar.php" method="post">

                    <input type="hidden" name="consecutivo" id="consecutivo" value="<?= $orden ?>" />

                    <center>
                        <div class="row">
                                <div class="box-body" align="center">
                                    <hr>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="monto">Detalle de Compra:</label>
                                    </div> 
                                    <br><br>
                                    <table id="example" class="table table-bordered table-striped" border="2">
                                        <thead>
                                        <tr>
                                            <th style="text-align: center">Cant.</th>
                                            <th style="text-align: center">Producto</th>
                                            <th style="text-align: center">Precio Unitario</th>
                                            <th style="text-align: center">Total Linea</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php for ($x = 0; $x < count($detalle); $x++) {
                                            if ($detalle[$x] != '') {  ?>
                                            <tr class="gradeA" align="center">
                                                <td align="center"><h4><?= $detalle[$x]['cantidad'] ?></h4></a></td>
                                                <td><h4><?= $detalle[$x]['nombre'] ?></h4></td>
                                                <td><h5>&cent;<?= _FORMATO($detalle[$x]['monto']) ?></h5> </td>
                                                <td><h5>&cent;<?= _FORMATO($detalle[$x]['totalLinea']) ?></h5> </td>
                                            </tr>
                                        <?php } } ?>
                                        </tbody>
                                    </table>
                                    <hr>

                                    <div class="form-group">
                                        <div class="col-sm-12"> <h4>Monto total de compra:&nbsp; <strong>&cent;&nbsp;<?= _FORMATO($monto) ?></strong></h4> </div>
                                         <select class="pull-right nover btn btn-default" name="tipoPago" id="tipoPago" required="true">
                                            <option value="" disabled = "true" selected >Seleccione metodo de pago</option>
                                            <option value=1>Efectivo</option>
                                            <option value=2>Sinpe</option>
                                         </select>
                                    </div>
                                    <hr>
                                </div>
                                <div class="box-footer">
                                    <hr>
                                    <div class="pull-right nover">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Procesar Venta</button>
                                    </div>
                                    <div class="pull-left nover">
                                        <button type="button" onclick="location.href = 'index.php';" class="btn btn-danger"><i class="fa fa-arrow-circle-o-left"></i> Cancelar</button>
                                    </div>									
                                </div>                                 
                            </div>						
                        </div>     
                    </center> 	
                </form>	
            </section>
            <hr>			
            <footer class="Pfooter nover">
                <strong>BRAJOS-SOFT&copy; <?=date('Y')?></strong>
            </footer>
        </div>		
    </body>
</html>