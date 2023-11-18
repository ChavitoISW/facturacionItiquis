<?php
include 'configuracion/database.php';
$X = _QUERY("SELECT id, nombre FROM tablaprogramaciones WHERE estado = '1';");
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
            <br>					
            <section class="content">                 
                <?php for ($x = 0; $x < count($X); $x++) { ?>  
                    <div class="row">  	
                        <div class="box box-info"> 	
                            <div class="box-header with-border">
                                <h3 class="box-title">
                                    <i class="ion ion-clipboard"></i> <?= $X[$x]['nombre'] ?>
                                </h3>
                                <hr>
                                <?php
                                $Z = _QUERY("SELECT id, nombre, descripcion, monto FROM tablamontos WHERE estado = '1' AND programacion = '{$X[$x]['id']}';");
                                for ($z = 0; $z < count($Z); $z++) {
                                    ?>                                
                                    <div class="col-md-6" style="cursor:pointer;">
                                        <ul class="todo-list">                                                    
                                            <li>
                                                <i class="ion ion-clipboard"></i> <b>Producto:</b> <?= $Z[$z]['nombre'] ?><br>
                                                <i class="fa fa-book margin-r-5"></i> <b>Descripción:</b> <?= $Z[$z]['descripcion'] ?><br>
                                                <i class="fa fa-credit-card margin-r-5"></i> <b>Precio:</b> &cent;<?= _FORMATO($Z[$z]['monto']) ?> CRC<br>
                                            </li>
                                        </ul>
                                    </div>
                                    <?php
                                    if (($z + 1) < count($Z)) {
                                        $z++;
                                        ?>
                                        <div class="col-md-6" style="cursor:pointer;">
                                        <ul class="todo-list">                                                    
                                            <li>
                                                <i class="ion ion-clipboard"></i> <b>Producto:</b> <?= $Z[$z]['nombre'] ?><br>
                                                <i class="fa fa-book margin-r-5"></i> <b>Descripción:</b> <?= $Z[$z]['descripcion'] ?><br>
                                                <i class="fa fa-credit-card margin-r-5"></i> <b>Precio:</b> &cent;<?= _FORMATO($Z[$z]['monto']) ?> CRC<br>
                                            </li>
                                        </ul>
                                    </div>
                                    <?php }
                                }
                                ?>
                            </div>
                        </div>    
                    </div>
                    <br>
                <?php } ?>                
                <div class="box-footer">  
                    <center>
                        <button type="button" onclick="window.close();" class="btn btn-default"><i class="fa fa-arrow-circle-o-left"></i> Regresar</button>
                    </center>									
                </div>
            </section>		
            <footer class="Pfooter">
                <strong>&copy; <?=date('Y')?></strong>            </footer>
        </div>
    </body>
</html>