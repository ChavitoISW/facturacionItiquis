<?php
include 'configuracion/database.php';
$X = _QUERY("SELECT id, nombre FROM tablaprogramaciones WHERE estado = '1';");
$espacios = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;';
$consecutivo = _RAND();

$ROWOrden = _QUERY("SELECT SUM(totalLinea) as total FROM pedido where consecutivo = '$consecutivo';");
$detalle = _QUERY("select tm.nombre, tm.monto, p.cantidad, p.totalLinea from pedido p inner join tablamontos tm on p.idProducto = tm.id where p.consecutivo = '$consecutivo';");
$fecha = date('d-M-Y');

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
    <script src="js/alertify.js"></script>
    <script src="js/estilo.js"></script>
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

    <section class="content">
        <form name="formulario" id="formulario" method="post" action="generar.php">


            <?php for ($x = 0; $x < count($X); $x++) { ?>
                <div class="row">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <i class="ion ion-clipboard"></i> <?= $X[$x]['nombre'] ?>
                            </h3>
                            <div class="form-group" hidden>
                                <div class="col-sm-6"><input type="text" class="form-control" name="consecutivo"
                                                             id="consecutivo" value="<?= $consecutivo ?>"></div>
                            </div>
                            <a href="info.php" target="_blank">(ver información de todos los productos)</a>
                            <hr>
                            <?php
                            $Z = _QUERY("SELECT id, nombre, descripcion, monto FROM tablamontos WHERE estado = '1' AND programacion = '{$X[$x]['id']}';");

                            for ($z = 0; $z < count($Z); $z++) {
                                ?>
                                <br>

                                <div class="col-md-6" style="cursor:pointer;">
                                    <ul class="todo-list">
                                        <li>
                                            <input type="checkbox" id="ck<?= $Z[$z]['id'] ?>" name="ck[]"
                                                   value="<?= $Z[$z]['id'] ?>"
                                                   onclick="Selecciona('<?= $Z[$z]['id'] ?>', '<?= $Z[$z]['nombre'] ?>', '<?= $consecutivo ?>', this);">
                                            <span onclick="Agrega('<?= $Z[$z]['id'] ?>', '<?= $Z[$z]['nombre'] ?>', '<?= $Z[$z]['monto'] ?>');"><strong><i
                                                            class="fa fa-book margin-r-5"></i> Producto: </strong><?= $Z[$z]['nombre'] ?></span><br>
                                            <?= $espacios ?><strong><i class="fa fa-file-text-o margin-r-5"></i> Precio:
                                            </strong>&cent;<?= _FORMATO($Z[$z]['monto']) ?> CRC<small
                                                    class="label label-primary"
                                                    onclick="Agrega('<?= $Z[$z]['id'] ?>', '<?= $Z[$z]['nombre'] ?>', '<?= $Z[$z]['monto'] ?>');"></small>
                                            <a onclick="Info('<?= $Z[$z]['nombre'] ?>', '<?= $Z[$z]['descripcion'] ?>',  '<?= _FORMATO($Z[$z]['monto']) ?>');">(ver
                                                información)</a>
                                        </li>
                                    </ul>
                                    <br>
                                </div>
                                <?php
                                if (($z + 1) < count($Z)) {
                                    $z++;
                                    ?>
                                    <div class="col-md-6" style="cursor:pointer;">
                                        <ul class="todo-list">
                                            <li>
                                                <input type="checkbox" id="ck<?= $Z[$z]['id'] ?>" name="ck[]"
                                                       value="<?= $Z[$z]['id'] ?>"
                                                       onclick="Selecciona('<?= $Z[$z]['id'] ?>', '<?= $Z[$z]['nombre'] ?>', '<?= $consecutivo ?>', this);">
                                                <span onclick="Agrega('<?= $Z[$z]['id'] ?>', '<?= $Z[$z]['nombre'] ?>',  '<?= $Z[$z]['monto'] ?>');"><strong><i
                                                                class="fa fa-book margin-r-5"></i> Producto: </strong><?= $Z[$z]['nombre'] ?></span><br>
                                                <?= $espacios ?><strong><i class="fa fa-file-text-o margin-r-5"></i>
                                                    Precio: </strong>&cent;<?= _FORMATO($Z[$z]['monto']) ?> CRC<small
                                                        class="label label-primary"
                                                        onclick="Agrega('<?= $Z[$z]['id'] ?>', '<?= $Z[$z]['nombre'] ?>','<?= $Z[$z]['monto'] ?>');"></small>
                                                <a onclick="Info('<?= $Z[$z]['nombre'] ?>', '<?= $Z[$z]['descripcion'] ?>', '<?= _FORMATO($Z[$z]['monto']) ?>');">(ver
                                                    información)</a>
                                            </li>
                                        </ul>
                                        <br>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <br>
            <?php } ?>
            <br>
            <div class="callout callout-info"><h4>Total a pagar:</h4>
                <p id="total">&cent;0.00</p></div>
            <div class="box-footer">
                <div class="pull-right">
                        <button type="button" onclick="muestraOrden('<?= $consecutivo ?>')" data-toggle="modal" data-target="#myModal" class="btn btn-warning"> <i class="fa fa-th-list"></i> Detalle Orden </button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Generar</button>
                </div>
                <div class="pull-left">
                    <button type="button" onclick="location.href = 'index.php';" class="btn btn-danger"><i class="fa fa-backward"></i> Limpiar Pedio
                    </button>
                    <!-- <button type="button" onclick="location.href = 'reimprime.php';" class="btn btn-default"><i class="fa fa-print"></i> Reimprimir</button>-->
                </div>
            </div>
        </form>
    </section>
    <hr>
    <footer class="Pfooter">
        <strong>BRAJOS-SOFT&copy; <?= date('Y') ?></strong>
    </footer>
</div>


<div class="container">
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Detalle de orden</h4>
                </div>
                <div class="modal-body">
                    <div id="resumen"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-danger"><i class="fa fa-times"> </i> Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
