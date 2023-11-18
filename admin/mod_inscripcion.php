<?php
include '../configuracion/database.php';
include '_menu.php';
session_start();
if (!isset($_SESSION['_cedula_'])) {
    header('location: error.php?error=l');
}
if (!isset($_POST['cedula'])) {
    $_POST['cedula'] = '';
    $_POST['nombre'] = '';
} else {
    if ($_POST['cedula'] != '') {
        $Q = _QUERY("SELECT trans_compra, DATE_FORMAT(fecha, '%d/%m/%Y %T') AS fecha, nombre FROM tabla000 WHERE cedula = '{$_POST['cedula']}' AND estado = '1';");
    } else {
        $Q = _QUERY("SELECT trans_compra, DATE_FORMAT(fecha, '%d/%m/%Y %T') AS fecha, nombre FROM tabla000 WHERE nombre like '%{$_POST['nombre']}%' AND estado = '1';");
    }
}
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
            <?= menu($_SESSION['_tipo_'], _Titulo()) ?>
            <section class="content-header">
                <br>
                <ol class="breadcrumb">
                    <li><a href="#"><img src="../imagenes/miniescudo.png"> <?= _Titulo() ?></a></li>
                    <li class="active">Registro</li>
                    <li class="active">Modificar Inscripción</li>	
                </ol>
            </section> 
            <hr>			
            <br>					
            <section class="content">  
                <form name="formulario" id="formulario" method="post" action="mod_inscripcion.php">
                    <center>
                        <div class="row">  
                            <div class="box box-info"> 												
                                <div class="box-header with-border"><h3 class="box-title">Filtro de búsqueda</h3></div>
                                <div class="box-body">                                    
                                    <table style="width:100%" cellpadding="2" cellspacing ="2">
                                        <tr>
                                            <td align="center"><label for="cedula" >Identificación / Pasaporte:</label></td>
                                            <td><input type="text" class="form-control" placeholder="Identificación / Pasaporte" name="cedula" id="cedula" value="<?= $_POST['cedula'] ?>"></td>
                                        </tr>                                        
                                        <tr>
                                            <td align="center"><label for="nombre" >Nombre:</label></td>
                                            <td> <input class="form-control" placeholder="Nombre"  type="text" name="nombre" id="nombre" value="<?= $_POST['nombre'] ?>"/></td>
                                        </tr>										
                                    </table>  
                                </div>                              
                                <div class="box-footer">                               
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                    </div>									
                                </div>                                 
                            </div>						
                        </div>
                        <?php if ($_POST['cedula'] != '' || $_POST['nombre'] != '') { ?>
                            <div class="row">  
                                <div class="box box-info"> 												
                                    <div class="box-header with-border"><h3 class="box-title">Datos encontrados</h3></div>
                                    <div class="box-body">                                    
                                        <table style="width:100%" cellpadding="2" cellspacing ="2">
                                            <tr>
                                                <th align="center">Comprobante de pago</th>
                                                <th align="center">Nombre</th>
                                                <th align="center">Fecha</th>
                                            </tr>
                                            <?php for ($z = 0; $z < count($Q); $z++) { ?>                                        
                                                <tr>
                                                    <td><a href="mod_inscripcion_detalle.php?ORDER=<?= $Q[$z]['trans_compra'] ?>"><?= $Q[$z]['trans_compra'] ?></a></td>
                                                    <td><?= $Q[$z]['nombre'] ?></td>
                                                    <td><?= $Q[$z]['fecha'] ?></td>
                                                </tr>	
                                            <?php } ?>										
                                        </table>  
                                    </div>                                 
                                </div>						
                            </div>	
                        <?php } ?>						
                    </center> 	
                </form>	
            </section>	
            <hr>			
            <footer class="Pfooter">
                <strong>&copy; <?=date('Y')?></strong>            </footer>
        </div>
    </body>
</html>