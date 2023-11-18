<?php
if (!isset($_POST))
    die('Error de parámetros 0');
include 'configuracion/database.php';

$tiquete = $_POST['tiquete'];

$detalle = _QUERY("select consecutivo, fecha, monto, tipoPago from encabezadopedido where consecutivo = '$tiquete';");

if(!$detalle[0]['consecutivo']){
    die('No existe el consecutivo buscado, favor revisar');
}


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
        <script src="js/estilo.js"></script>
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
                    <center>
                        <div class="row">
                            <div class="box box-info">
                                <div ><h5><strong>Fecha:</strong> <?= $detalle[0]['fecha']?></h5></div>
                                <div><h5 ><strong>Consecutivo: </strong><?= $detalle[0]['consecutivo']?></h5></div>
                                <div><h5 ><strong>Monto Venta: </strong><?= $detalle[0]['monto']?></h5></div>
                            </div>
                                <div class="box-footer">
                                    <div class="pull-right nover">
                                        <button onclick="anular('<?= $detalle[0]['consecutivo'] ?>', 'Anular')" class="btn btn-primary"><i class="fa fa-trash"></i> Anular</button>
                                    </div>
                                    <div class="pull-left nover">
                                        <button type="button" onclick="location.href = 'anular.php';" class="btn btn-default"><i class="fa fa-arrow-circle-o-left"></i> Regresar</button>
                                    </div>									
                                </div>                                 
                            </div>						
                        </div>     
                    </center> 	

            </section>
            <hr>			
            <footer class="Pfooter nover">
                <strong>BRAJOS-SOFT &copy; <?=date('Y')?></strong>            </footer>
        </div>		
    </body>
</html>