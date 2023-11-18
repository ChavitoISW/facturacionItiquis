<?php
include '../configuracion/database.php';
session_start();
if (!isset($_SESSION['_cedula_'])) {
    header('location: error.php?error=l');
}

if ($_GET['id'] != '') {
    $ROW = _QUERY("SELECT id, nombre, descripcion, grupo, cupo, cuporeal, monto, descuento, modalidad, duracion, instructor, DATE_FORMAT(fechaInicio, '%d/%m/%Y') AS fechaInicio, DATE_FORMAT(fechaFinal, '%d/%m/%Y') AS fechaFinal, horario, lugar, programacion, estado FROM tablamontos WHERE id = '{$_GET['id']}';");
} else {
    $ROW[0]['id'] = $ROW[0]['nombre'] = $ROW[0]['descripcion'] = $ROW[0]['grupo'] = $ROW[0]['cupo'] = $ROW[0]['cuporeal'] = $ROW[0]['monto'] = $ROW[0]['descuento'] = $ROW[0]['modalidad'] = $ROW[0]['duracion'] = $ROW[0]['instructor'] = $ROW[0]['fechaInicio'] = $ROW[0]['fechaFinal'] = $ROW[0]['horario'] = $ROW[0]['lugar'] = $ROW[0]['programacion'] = $ROW[0]['estado'] = '';
}
$Q = _QUERY("SELECT id, nombre FROM tablaprogramaciones WHERE estado = '1';");
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
    </head>	
    <body class="hold-transition skin-blue layout-top-nav">
        <div class="wrapper">
            <section class="content-header">
                <br>
                <ol class="breadcrumb">
                    <li><a href="#"><img src="../imagenes/miniescudo.png"> <?= _Titulo() ?></a></li>
                    <li class="active">Mantenimiento</li>
                    <li class="active">Gestionar Montos Detalle</li>
                </ol>
            </section> 
            <hr>			
            <br>					
            <section class="content">  
                <form name="formulario" id="formulario" method="post" action="_monto_detalle.php">
                    <input type="hidden" id="id" name="id" value="<?= $_GET['id'] ?>">
                    <center>
                        <div class="row">  
                            <div class="box box-info"> 												
                                <div class="box-header with-border"><h3 class="box-title">Datos del monto</h3></div>
                                <div class="box-body">                                    
                                    <table style="width:100%" cellpadding="2" cellspacing ="2">
                                        <tr><td><strong>Id:</strong></td><td><input type="text" class="form-control" value="<?= $ROW[0]['id'] ?>" readonly/></td></tr>
                                        <tr><td><strong>Nombre:</strong></td><td><input type="text" class="form-control" id="nombre" name="nombre" value="<?= $ROW[0]['nombre'] ?>" /></td></tr>
                                        <tr><td><strong>Descripción:</strong></td><td><textarea class="form-control" id="descripcion" name="descripcion"><?= $ROW[0]['descripcion'] ?></textarea></td></tr>
                                        <tr><td><strong>Grupo:</strong></td><td><input type="number" class="form-control" id="grupo" name="grupo" value="<?= $ROW[0]['grupo'] ?>"/></td></tr>
                                        <tr><td><strong>Cupo:</strong></td><td><input type="number" class="form-control" id="cupo" name="cupo" value="<?= $ROW[0]['cupo'] ?>"/></td></tr>
                                        <tr><td><strong>Espacios Disponibles:</strong></td><td><input type="number" class="form-control" id="cuporeal" name="cuporeal" value="<?= $ROW[0]['cuporeal'] ?>"/></td></tr>
                                        <tr><td><strong>Monto:</strong></td><td><input type="number" class="form-control" id="monto" name="monto" value="<?= $ROW[0]['monto'] ?>" /></td></tr>
                                        <tr><td><strong>Porcentaje de descuento:</strong></td><td><input type="number" class="form-control" id="descuento" name="descuento" value="<?= $ROW[0]['descuento'] ?>"/></td></tr>
                                        <tr><td><strong>Modalidad:</strong></td><td><input type="text" class="form-control" id="modalidad" name="modalidad" value="<?= $ROW[0]['modalidad'] ?>"/></td></tr>
                                        <tr><td><strong>Duración:</strong></td><td><input type="text" class="form-control" id="duracion" name="duracion" value="<?= $ROW[0]['duracion'] ?>"/></td></tr>
                                        <tr><td><strong>Instructor:</strong></td><td><input type="text" class="form-control" id="instructor" name="instructor" value="<?= $ROW[0]['instructor'] ?>"/></td></tr>
                                        <tr><td><strong>Fecha Inicio:</strong></td><td><input type="text" class="form-control" id="fechaInicio" name="fechaInicio" value="<?= $ROW[0]['fechaInicio'] ?>"/></td></tr>
                                        <tr><td><strong>Fecha Final:</strong></td><td><input type="text" class="form-control" id="fechaFinal" name="fechaFinal" value="<?= $ROW[0]['fechaFinal'] ?>"/></td></tr>
                                        <tr><td><strong>Horario:</strong></td><td><input type="text" class="form-control" id="horario" name="horario" value="<?= $ROW[0]['horario'] ?>"/></td></tr>
                                        <tr><td><strong>Lugar:</strong></td><td><input type="text" class="form-control" id="lugar" name="lugar" value="<?= $ROW[0]['lugar'] ?>"/></td></tr>
                                        <tr>
                                            <td><strong>Programación:</strong></td>
                                            <td>
                                                <select id="programacion" name="programacion" class="form-control" required>
                                                    <option>...</option>
                                                    <?php for($z=0;$z<count($Q);$z++){?>
                                                        <option <?= $ROW[0]['programacion'] == $Q[$z]['id'] ? 'selected' : '' ?> value="<?=$Q[$z]['id']?>"><?=$Q[$z]['nombre']?></option>
                                                    <?php }?>                                                    
                                                <select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Estado:</strong></td>
                                            <td>
                                                <select id="estado" name="estado" class="form-control" required>
                                                    <option>...</option>
                                                    <option <?= $ROW[0]['estado'] == '1' ? 'selected' : '' ?> value="1">Activo</option>
                                                    <option <?= $ROW[0]['estado'] == '0' ? 'selected' : '' ?> value="0">Inactivo</option>
                                                <select>
                                            </td>
                                        </tr>									
                                    </table>  
                                </div>                              
                                <div class="box-footer">                               
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
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
        <script>
        $('#fechaInicio').daterangepicker({singleDatePicker: true, timePicker: false, timePicker24Hour: true, timePickerIncrement: 30, locale: {format: 'DD/MM/YYYY'}});
        $('#fechaFinal').daterangepicker({singleDatePicker: true, timePicker: false, timePicker24Hour: true, timePickerIncrement: 30, locale: {format: 'DD/MM/YYYY'}});
        </script>
    </body>
</html>