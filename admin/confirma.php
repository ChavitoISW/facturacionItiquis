<?php
include '../configuracion/database.php';
session_start();
if(!isset($_SESSION['_cedula_'])) {
  	header('location: error.php?error=l');
}
if (!isset($_POST))
    die('Error de parámetros 0');

$orden = '010638-01' . _RAND();

/* VERIFICA QUE NO EXISTE LA TRANSACCION */
$ROW = _QUERY("SELECT 1 FROM detalle WHERE (trans_compra = '{$orden}');");

if ($ROW) {
    header('location: error.php?error=o');
    exit();
}

$monto = 0;
$curso = "";

for ($z = 0; $z < count($_POST['ck']); $z++) {
    $Q = _QUERY("SELECT id, nombre, grupo, cuporeal, monto, descuento, estado FROM tablamontos WHERE (id = '{$_POST['ck'][$z]}');");
    if ($Q[0]['cuporeal'] < 1 || $Q[0]['estado'] != 1) {
        header('location: error.php?error=c');
        exit();
    }
    $monto += ($Q[0]['monto'] - ($Q[0]['monto'] * ($Q[0]['descuento'] / 100)));
    $curso .= $Q[0]['nombre'] . ", Grupo:" . $Q[0]['grupo'] . "|";
    $c = $Q[0]['nombre'] . ", Grupo:" . $Q[0]['grupo'];
    $v = ($Q[0]['monto'] - ($Q[0]['monto'] * ($Q[0]['descuento'] / 100)));
    _TRANS("INSERT INTO detalle VALUES('{$orden}', '{$Q[0]['id']}', '{$c}', '{$v}');");
}


/* HACE EL INSERT TEMPORAL DEL ENCABEZADO */
_TRANS("INSERT INTO tabla000 VALUES('{$orden}',
	 NOW(),
	 '{$_POST['cedula']}', 
	 '{$_POST['nombre']}',
	 '{$_POST['correo']}',
	 '{$_POST['telefono']}',
	 '{$monto}',
	 '{$_SESSION['_cedula_']}',
	 '0','')
	 ");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
        <title><?= _Titulo() ?></title>
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
        <script>
            function lolo(_ORDEN) {
                swal({
                    title: "Desea continuar?",
                    text: "Se realizara la inscripcion!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#367fa9",
                    confirmButtonText: "Si, continuar!",
                    cancelButtonText: "No, deseo regresar!",
                    closeOnConfirm: true,
                    closeOnCancel: false
                },
                        function (isConfirm) {
                            if (isConfirm) {
                                window.location.href = 'comprobante.php?ORDER=' + _ORDEN;
                            } else {
                                swal("Cancelado", "No se realizara ninguna accion", "error");
                            }
                        });
            }
        </script>		
    </head>
    <body>
        <div class="wrapper">
            <section class="content-header">
                <br>
                <ol class="breadcrumb">
                    <li><a href="#"><img src="../imagenes/miniescudo.png"> <?= _Titulo() ?></a></li>
                    <li class="active"><?= _Evento() ?></li>
                </ol>
            </section> 
            <hr>			
            <br>
            <section class="content">  
                <form name="formulario" id="formulario" method="post" action="pago.php">
                    <center>
                        <div class="row">  
                            <img src="../imagenes/logo.png" class="img-rounded" alt="logo">	
                            <div class="box box-info"> 												
                                <div class="box-header with-border"><h3 class="box-title">Paso 2. Confirmar Información</h3></div>
                                <div class="box-body" align="center">               
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="cedula">Identificación / Pasaporte:</label>
                                        <div class="col-sm-6"><?= $_POST['cedula'] ?></div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="nombre">Nombre Completo:</label>
                                        <div class="col-sm-6"><?= $_POST['nombre'] ?></div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="correo">Correo:</label>
                                        <div class="col-sm-6"><?= $_POST['correo'] ?></div>
                                    </div>
                                    <br>					
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="telefono">Teléfono:</label>
                                        <div class="col-sm-6"><?= $_POST['telefono'] ?></div>
                                    </div>
                                    <br>
                                    <hr>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="monto">Detalle de Cursos:</label>
                                    </div> 
                                    <br><br>
                                    <div class="form-group">
                                        <ul>
                                            <?php
                                            $curso = explode('|', $curso);
                                            for ($x = 0; $x < count($curso); $x++) {
                                                if ($curso[$x] != '') {
                                                    echo "<li>{$curso[$x]}</li>";
                                                }
                                            }
                                            ?>                                                        
                                        </ul>
                                    </div> 
                                    <hr>
                                    <br>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="monto">Monto:</label>
                                        <div class="col-sm-6">&cent;<?= _FORMATO($monto) ?> CRC</div>
                                    </div> 
                                </div>                              
                                <div class="box-footer">                               
                                    <div class="pull-right">
                                        <button type="button" onclick="lolo('<?=$orden?>');" class="btn btn-primary"><i class="fa fa-credit-card"></i> Pagar</button>
                                    </div>
                                    <div class="pull-left">
                                        <button type="button" onclick="location.href = 'inscripcion.php';" class="btn btn-default"><i class="fa fa-arrow-circle-o-left"></i> Regresar</button>									
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