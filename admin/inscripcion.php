<?php
include '../configuracion/database.php';
session_start();
if(!isset($_SESSION['_cedula_'])) {
  	header('location: error.php?error=l');
}
$X = _QUERY("SELECT id, nombre FROM tablaprogramaciones WHERE estado = '1';");
$espacios = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;';
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
        <script src="../js/alertify.js"></script>
        <script src="../js/estilo.js"></script>
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
                <form name="formulario" id="formulario" method="post" action="confirma.php">
                    <center>
                        <div class="row">  
                            <img src="../imagenes/logo.png" class="img-rounded" alt="logo">	
                            <div class="box box-info"> 												
                                <div class="box-header with-border"><h3 class="box-title">Paso 1. Información Requerida</h3></div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="cedula" class="col-sm-4 control-label">Identificación / Pasaporte</label>
                                        <div class="col-sm-6"><input type="text" class="form-control" placeholder="Identificación / Pasaporte" name="cedula" id="cedula" required autofocus></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre" class="col-sm-4 control-label">Nombre Completo:</label>
                                        <div class="col-sm-6"><input class="form-control" placeholder="Nombre Completo"  type="text" name="nombre" id="nombre" required/></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="correo" class="col-sm-4 control-label">Correo Electrónico:</label>
                                        <div class="col-sm-6"><input class="form-control" placeholder="Correo Electrónico"  type="email" name="correo" id="correo" required/></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono" class="col-sm-4 control-label">Teléfono:</label>
                                        <div class="col-sm-6"><input class="form-control" placeholder="Teléfono"  type="text" name="telefono" id="telefono" required/></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </center>
                    <?php for ($x = 0; $x < count($X); $x++) { ?>  
                        <div class="row">  	
                            <div class="box box-info"> 	
                                <div class="box-header with-border">
                                    <h3 class="box-title">
                                        <i class="ion ion-clipboard"></i> <?= $X[$x]['nombre'] ?>
                                    </h3> 
                                    <a href="../info.php" target="_blank">(ver información de todos los cursos)</a>   
                                    <hr>
                                    <?php
                                    $Z = _QUERY("SELECT id, nombre, descripcion, monto FROM tablamontos WHERE estado = '1' AND programacion = '{$X[$x]['id']}';");
                                    for ($z = 0; $z < count($Z); $z++) {
                                        ?>
                                        <br>
                                        <div class="col-md-6" style="cursor:pointer;">
                                            <ul class="todo-list">                                                    
                                                <li>                                                
                                                    <input type="checkbox" id="ck<?= $Z[$z]['id'] ?>" name="ck[]" value="<?= $Z[$z]['id'] ?>" onclick="Selecciona2('<?= $Z[$z]['id'] ?>', '<?= $Z[$z]['nombre'] ?>', this);">
                                                    <span onclick="Agrega2('<?= $Z[$z]['id'] ?>', '<?= $Z[$z]['nombre'] ?>');"><strong><i class="fa fa-book margin-r-5"></i> Curso: </strong><?= $Z[$z]['nombre'] ?>] ?></span><br>
                                                    <?= $espacios ?><strong><i class="fa fa-file-text-o margin-r-5"></i> Costo: </strong>&cent;<?= _FORMATO($Z[$z]['monto']) ?> CRC<small class="label label-primary" onclick="Agrega2('<?= $Z[$z]['id'] ?>', '<?= $Z[$z]['nombre'] ?>');"></small>
                                                    <a onclick="Info('<?= $Z[$z]['nombre'] ?>', '<?= $Z[$z]['descripcion'] ?>',  '<?= _FORMATO($Z[$z]['monto']) ?>');">(ver información)</a>
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
                                                        <input type="checkbox" id="ck<?= $Z[$z]['id'] ?>" name="ck[]" value="<?= $Z[$z]['id'] ?>" onclick="Selecciona2('<?= $Z[$z]['id'] ?>', '<?= $Z[$z]['nombre'] ?>', this);">
                                                        <span onclick="Agrega2('<?= $Z[$z]['id'] ?>', '<?= $Z[$z]['nombre'] ?>');"><strong><i class="fa fa-book margin-r-5"></i> Curso: </strong><?= $Z[$z]['nombre'] ?>, Grupo: <?= $Z[$z]['grupo'] ?></span><br>
                                                        <?= $espacios ?><strong><i class="fa fa-file-text-o margin-r-5"></i> Costo: </strong>&cent;<?= _FORMATO($Z[$z]['monto']) ?> CRC<small class="label label-primary" onclick="Agrega2('<?= $Z[$z]['id'] ?>', '<?= $Z[$z]['nombre'] ?>');"><i class="fa fa-user"></i> Quedan <?= $Z[$z]['cuporeal'] ?> espacios</small>
                                                        <a onclick="Info('<?= $Z[$z]['nombre'] ?>', '<?= $Z[$z]['descripcion'] ?>', '<?= $Z[$z]['grupo'] ?>', '<?= $Z[$z]['cupo'] ?>', '<?= $Z[$z]['cuporeal'] ?>', '<?= _FORMATO($Z[$z]['monto']) ?>', '<?= $Z[$z]['descuento'] ?>', '<?= $Z[$z]['modalidad'] ?>', '<?= $Z[$z]['duracion'] ?>', '<?= $Z[$z]['instructor'] ?>', '<?= $Z[$z]['fechaInicio'] ?>', '<?= $Z[$z]['fechaFinal'] ?>', '<?= $Z[$z]['horario'] ?>', '<?= $Z[$z]['lugar'] ?>');">(ver información)</a>
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
                    <div class="callout callout-info"><h4>Total a pagar:</h4><p id="total">&cent;0.00</p></div>                  
                    <div class="box-footer">  
                        <div class="pull-right">                            
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Continuar</button>
                        </div>
                        <div class="pull-left">
                            <button type="button" onclick="window.close();" class="btn btn-default"><i class="fa fa-arrow-circle-o-left"></i> Regresar</button>								
                        </div>									
                    </div>
                </form>	
            </section>	
            <hr>			
            <footer class="Pfooter">
                <strong>&copy; <?=date('Y')?></strong>            </footer>
        </div>
    </body>
</html>