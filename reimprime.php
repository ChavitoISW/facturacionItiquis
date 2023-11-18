<?php
include 'configuracion/database.php';

if (isset($_GET['ORDER'])) {
    $ROW = _QUERY("SELECT trans_compra, DATE_FORMAT(fecha, '%d/%m/%Y %T') AS fecha, cedula, nombre, correo, telefono, monto FROM tabla000 WHERE trans_compra = '{$_GET['ORDER']}';");
    $Q = _QUERY("SELECT trans_compra, idcurso, curso, monto FROM detalle WHERE trans_compra = '{$_GET['ORDER']}';");
    $curso = "<ul>";
    for ($z = 0; $z < count($Q); $z++) {
        $curso .= "<li>" . $Q[$z]['curso'] . " (&cent;" . _FORMATO($Q[$z]['monto']) . " CRC)</li>";
    }
    $curso .= "</ul>";
    ?>
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
                    <form name="formulario" id="formulario" method="post" action="pago.php">
                        <center>
                            <div class="row">  
                                <img src="imagenes/logo.png" class="img-rounded" alt="logo">	
                                <div class="box box-info"> 												
                                    <div class="box-header with-border"><h3 class="box-title">Comprobante de Pago</h3></div>
                                    <div class="box-body">                                    
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
                                    </div>                              
                                    <div class="box-footer">                               
                                        <div class="pull-right">
                                            <button type="button" onclick="window.print();" class="btn btn-primary"><i class="fa fa-print"></i> Imprimir</button>
                                        </div>
                                        <div class="pull-left">
                                            <button type="button" onclick="location.href = 'index.php';" class="btn btn-default"><i class="fa fa-arrow-circle-o-left"></i> Volver al inicio</button>									
                                        </div>									
                                    </div>                                 
                                </div>						
                            </div>     
                        </center> 	
                    </form>	
                </section>	
                <hr>			
                <footer class="Pfooter">
                    <strong>&copy; 2020 <img src="imagenes/miniescudo.png"> <a href="http://www.fundauna.org" target="_blank">FUNDAUNA</a></strong>
                </footer>  
            </div>		
        </body>
    </html>
<?php } else { ?>
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
                    <form action="reimprime.php" name="formulario" id="formulario" method="post">
                        <center>
                            <div class="row">  
                                <img src="imagenes/logo.png" class="img-rounded" alt="logo">	
                                <div class="box box-info"> 												
                                    <div class="box-header with-border"><h3 class="box-title">Dato Requerido</h3></div>
                                    <div class="box-body">
                                        <table style="width:100%" cellpadding="2" cellspacing ="2">
                                            <tr>
                                                <td align="center"><label for="cedula" >Identificación / Pasaporte:</label></td>
                                                <td><input type="text" class="form-control" placeholder="Identificación / Pasaporte" name="cedula" id="cedula" required></td>
                                            </tr>
                                        </table>  
                                    </div>                              
                                    <div class="box-footer">                               
                                        <div class="pull-right">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                        </div>
                                        <div class="pull-left">
                                            <button type="button" onclick="location.href = 'index.php';" class="btn btn-default"><i class="fa fa-arrow-circle-o-left"></i> Regresar</button>										
                                        </div>									
                                    </div>                                 
                                </div>
                                <?php if (isset($_POST['cedula'])) { ?>
                                    <br>
                                    <div class="box box-info"> 												
                                        <div class="box-header with-border"><h3 class="box-title">Datos Encontrados</h3></div>
                                        <div class="box-body">                                    
                                            <table style="width:100%" cellpadding="2" cellspacing ="2">
                                                <tr><td><strong>N&uacute;mero de Comprobante:</strong></td><td><strong>Fecha:</strong></td><td><strong>Monto:</strong></td></tr>
                                                <?php
                                                $ROW = _QUERY("SELECT trans_compra, DATE_FORMAT(fecha, '%d/%m/%Y %T') AS fecha, monto FROM tabla000 WHERE cedula = '{$_POST['cedula']}' AND estado = '1'");
                                                for ($i = 0; $i < count($ROW); $i++) {
                                                    ?>
                                                    <tr><td><a href="reimprime.php?ORDER=<?= $ROW[$i]['trans_compra'] ?>"><?= $ROW[$i]['trans_compra'] ?></a></td><td><?= $ROW[$i]['fecha'] ?></td><td>&cent;<?= _FORMATO($ROW[$i]['monto']) ?> CRC</td></tr>
                                                <?php } ?>
                                            </table>  
                                        </div>                                   
                                    </div>								
                                <?php } ?>							
                            </div>     
                        </center> 	
                    </form>	
                </section>	
                <hr>			
                <footer class="Pfooter">
                    <strong>&copy; <?=date('Y')?></strong>                </footer>
            </div>
        </body>
    </html>
<?php
}?>