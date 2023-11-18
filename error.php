<?php
include 'configuracion/database.php';
if ($_GET['error'] == 'o') {
    $error = 'F01';
} elseif ($_GET['error'] == 'c') {
    $error = 'F03';
} elseif ($_GET['error'] == 'e') {
    $error = 'F06';
} elseif ($_GET['error'] == 'r') {
    $error = 'F08';
} elseif ($_GET['error'] == 'l') {
    $error = 'F10';
} elseif ($_GET['error'] == 'u') {
    $error = 'F18';
} else {
    $error = 'F???';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="ISO-8859-1">
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
                <div class="error-page">
                    <h2 class="headline text-red"><?= $error ?></h2>
                    <div class="error-content">
                        <h3><i class="fa fa-warning text-red"></i> Oops! Algo salió mal.</h3>
                        <?php if ($_GET['error'] == 'o') { ?>
                            <p>
                                No fue posible asignar un número de comprobante.<br>
                                Puede intentarlo nuevamente!.
                            </p>
                        <?php } elseif ($_GET['error'] == 'c') { ?>
                            <p>
                                Uno de los cursos llego a su cupo máximo.<br>
                                Puede intentarlo nuevamente!.
                            </p>
                        <?php } elseif ($_GET['error'] == 'e') { ?>
                            <p>
                                No fue posible recuperar sus datos, su saldo será reversado en los próximos minutos.<br>
                                Puede intentarlo nuevamente!.
                            </p>
                        <?php } elseif ($_GET['error'] == 'r') { ?>
                            <p>
                                Esta intentando recargar la página<br>
                                Si desea reimprimir el comprobante vaya al menu principal y seleccione la opción correspondiente.
                            </p>
                        <?php } elseif ($_GET['error'] == 'l') { ?>
                            <p>
                                Acceso Denegado<br>
                                Esta intentado ingresar a un sitio que requiere identificación.
                            </p>
                        <?php } elseif ($_GET['error'] == 'u') { ?>
                            <p>
                                Credenciales de acceso incorrectos<br>
                                Verifique que haya digitado los datos correctamente.
                            </p>
                        <?php } else { ?>
                            <p>
                                Trabajaremos en reparar el inconveniente.
                                Puede comunicarse con el encargado, <a href="mailto:braulio.alvarez.gonzalez@una.cr">braulio.alvarez.gonzalez@una.cr</a> o intentarlo más tarde.
                            </p>
                        <?php } ?>
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button type="buttton" onclick="location.href = 'index.php';" class="btn btn-danger btn-flat"><i class="fa fa-arrow-circle-o-left"></i> Regresar</button>
                            </div>
                        </div>						
                    </div>
                </div>
            </section>
            <hr>			
            <footer class="Pfooter">
                <strong>&copy; <?=date('Y')?></strong>            </footer>
        </div>
    </body>
</html>