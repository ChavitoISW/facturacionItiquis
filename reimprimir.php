<?php
include 'configuracion/database.php';

if (isset($_GET['ORDER'])) {
    $ROW = _QUERY("SELECT trans_compra, DATE_FORMAT(fecha, '%d/%m/%Y %T') AS fecha, cedula, nombre, correo, telefono, monto FROM tabla000 WHERE trans_compra = '{$_GET['ORDER']}';");
    $Q = _QUERY("SELECT trans_compra, idcurso, curso, monto FROM detalle WHERE trans_compra = '{$_GET['ORDER']}';");
}?>
    <!DOCTYPE html>
    <html>
      <head>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
        <title><?= _Titulo() ?></title>
        <link rel="icon" type="image/gif" href="imagenes/logo.png">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link rel="stylesheet" href="css/bridge.css">
        <link rel="stylesheet" href="css/print.css?1">
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
            <form name="formulario" id="formulario" method="post" action="imprimeAgain.php">
                <center>
                    <div class="box box-info">
                        <h2>Reimprimir Ordenes</h2>
                        <div class="box-header with-border"><h3 class="box-title">Dato Requerido</h3></div>
                        <div class="box-body">
                            <table style="width:100%" cellpadding="2" cellspacing ="2">
                                <tr>
                                    <td align="center"><label for="cedula" >N&uacute;mero de tiquete:</label></td>
                                    <td><input type="text" class="form-control" placeholder="N&uacute;mero de tiquete" name="tiquete" id="tiquete" required></td>
                                </tr>
                            </table>
                        </div>
                        <div class="box-footer">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                            <div class="pull-left">
                                <button type="button" onclick="location.href = '../facturacionItiquis/admin/menu.php';" class="btn btn-default"><i class="fa fa-arrow-circle-o-left"></i> Regresar</button>
                            </div>
                        </div>
                    </div>
                </center>
            </form>
        </section>

        <footer class="Pfooter">
        <strong>BRAJOS-SOFT &copy; <?= date('Y') ?></strong>
        </footer>
      </div>
    </body>
</html>
