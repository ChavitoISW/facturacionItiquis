<?php
/* ----------------NO TOCAR---------------- */
include '../configuracion/database.php';
require '../configuracion/PHPMailerAutoload.php';
if (!isset($_GET['ORDER']))
    die('Error: Param. Respuesta');
/* ----------------NO TOCAR---------------- */

$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'fundauna@una.cr';
$mail->Password = 'Sugerencias2013';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->From = 'fundauna@una.cr';
$mail->FromName = 'FUNDAUNA';
$mail->isHTML(true);
$mail->Subject = 'Procame - Comprobante de Pago';

$ROW = _QUERY("SELECT estado FROM tabla000 WHERE trans_compra = '{$_GET['ORDER']}';");

if (!$ROW && $ROW[0]['estado'] != '0' && $ROW[0]['estado'] != '1') {
    $mail->addAddress('braulio.alvarez.gonzalez@una.cr');
    $mail->Body = "Orden: {$_GET['ORDER']}";
    $mail->send();
    header('location: error.php?error=e');
    exit();
}

//VERIFICAMOS QUE NO SE HAYA RECARGADO LA PAGINA
if ($ROW[0]['estado'] == '1') {
    header('location: error.php?error=r');
    exit();
}

/* PONE LA COMPRA COMO CORRECTA */
_TRANS("UPDATE tabla000 SET estado = '1' WHERE (trans_compra = '{$_GET['ORDER']}');");

/* OBTIENE LA INFORMACION DE LA BASE DE DATOS */
$ROW = _QUERY("SELECT trans_compra, DATE_FORMAT(fecha, '%d/%m/%Y %T') AS fecha, cedula, nombre, correo, telefono, monto FROM tabla000 WHERE trans_compra = '{$_GET['ORDER']}';");
$Q = _QUERY("SELECT trans_compra, idcurso, curso, monto FROM detalle WHERE trans_compra = '{$_GET['ORDER']}';");
$curso = "<ul>";
for ($z = 0; $z < count($Q); $z++) {
    $curso .= "<li>" . $Q[$z]['curso'] . " (&cent;" . _FORMATO($Q[$z]['monto']) . " CRC)</li>";
}
$curso .= "</ul>";
/* ENVIO DE COMPROBANTE AL CORREO DEL BENEFICIARIO */
$cuerpo = "<table align='center' style='padding:20px; border:solid; border-color:#009cde; border-bottom-left-radius:50px; border-top-right-radius:50px' width='650px'>
        	<tr><td align='center' colspan='2'><strong>Comprobante de Pago</strong></td></tr>
		<tr><td align='center' colspan='2'><hr></td></tr>
                <tr><td align='center'><strong>N&uacute;mero de Comprobante:</strong></td><td>" . $ROW[0]['trans_compra'] . "</td></tr>
                <tr><td align='center'><strong>Fecha de Transacci&oacute;n:</strong></td><td>" . $ROW[0]['fecha'] . "</td></tr>
                <tr><td align='center'><strong>Identificaci&oacute;n / Pasaporte:</strong></td><td>" . $ROW[0]['cedula'] . "</td></tr>
                <tr><td align='center'><strong>Nombre Completo:</strong></td><td>" . $ROW[0]['nombre'] . "</td></tr>
                <tr><td align='center'><strong>Correo Electr&oacute;nico:</strong></td><td>" . $ROW[0]['correo'] . "</td></tr>
		<tr><td align='center'><strong>Tel&eacute;fono:</strong></td><td>" . $ROW[0]['telefono'] . "</td></tr>
                <tr><td align='center'><strong>Detalle de Cursos:</strong></td><td>" . $curso . "</td></tr>
                <tr><td align='center'><strong>Costo:</strong></td><td>&cent;" . _FORMATO($ROW[0]['monto']) . " CRC</td></tr>
                <tr><td align='right' colspan='2'><img src='http://fundauna.org/imagenes/fundauna.png' title='FUNDAUNA' width='200'/></td></tr>
            </table>";
$mail->addAddress($ROW[0]['correo']);
$mail->Body = $cuerpo;
$mail->send();
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
                                <div class="box-header with-border"><h3 class="box-title">Comprobante de Pago</h3></div>
                                <div class="box-body" align="center">    
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="cedula">Número de Comprobante:</label>
                                        <div class="col-sm-6"><?= $ROW[0]['trans_compra'] ?></div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="cedula">Fecha:</label>
                                        <div class="col-sm-6"><?= $ROW[0]['fecha'] ?></div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="cedula">Identificación / Pasaporte:</label>
                                        <div class="col-sm-6"><?= $ROW[0]['cedula'] ?></div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="nombre">Nombre Completo:</label>
                                        <div class="col-sm-6"><?= $ROW[0]['nombre'] ?></div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="correo">Correo:</label>
                                        <div class="col-sm-6"><?= $ROW[0]['correo'] ?></div>
                                    </div>
                                    <br>					
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="telefono">Teléfono:</label>
                                        <div class="col-sm-6"><?= $ROW[0]['telefono'] ?></div>
                                    </div>
                                    <br>
                                    <hr>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="monto">Detalle de Cursos:</label>
                                    </div> 
                                    <br><br>
                                    <div class="form-group">
                                        <?=$curso?>
                                    </div> 
                                    <hr>
                                    <br>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="monto">Monto:</label>
                                        <div class="col-sm-6">&cent;<?= _FORMATO($ROW[0]['monto']) ?> CRC</div>
                                    </div> 
                                </div>                              
                                <div class="box-footer">                               
                                    <div class="pull-right">
                                        <button type="button" onclick="window.print()();" class="btn btn-primary"><i class="fa fa-print"></i> Imprimir</button>
                                    </div>
                                    <div class="pull-left">
                                        <button type="button" onclick="window.close();" class="btn btn-default"><i class="fa fa-arrow-circle-o-left"></i> Regresar</button>									
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