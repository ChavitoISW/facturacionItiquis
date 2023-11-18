<?php
include '../configuracion/database.php';
include '_menu.php';
session_start();
if (!isset($_SESSION['_cedula_'])) {
    header('location: error.php?error=l');
}
$Q = _QUERY("SELECT id, nombre, monto, estado FROM tablamontos;");
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
            $(function () {
                $('#example').DataTable();
            });

            function url(_id) {
                window.open('monto_detalle.php?id=' + _id, '', 'width=900,height=600,scrollbars=yes,status=no');
            }
        </script>	
    </head>	
    <body class="hold-transition skin-blue layout-top-nav">
        <div class="wrapper">
            <?= menu($_SESSION['_tipo_'], _Titulo()) ?>
            <section class="content-header">
                <br>
                <ol class="breadcrumb">
                    <li><a href="#"><img src="../imagenes/miniescudo.png"> <?= _Titulo() ?></a></li>
                    <li class="active">Mantenimiento</li>
                    <li class="active">Gestionar Montos</li>
                </ol>
            </section> 
            <hr>			
            <br>					
            <section class="content cajaBusqueda">
                <center>
                    <div class="row">
                        <div class="box box-info" style="width:50%;">
                            <div class="box-header with-border"><h3 class="box-title">Opciones</h3></div>
                            <div class="box-body">
                                <div class="form-group"> 
                                    <input type="button" value="Agregar Monto" class="btn btn-primary" onClick="url('');">
                                </div>                                        
                            </div>
                        </div>
                    </div>  
                </center>                
            </section>
            <section class="content">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Montos</h3>
                    </div>
                    <div class="box-body">
                        <table id="example" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Descripción</th>
                                    <th>Monto</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($x = 0; $x < count($Q); $x++) { ?>
                                    <tr class="gradeA" align="center">
                                        <td><a href="#" title="Editar usuario" onclick="url('<?= $Q[$x]['id'] ?>');"><?= $Q[$x]['id'] ?></a></td>
                                        <td><?= $Q[$x]['nombre'] ?></td>
                                        <td>&cent;<?= _FORMATO($Q[$x]['monto']) ?> CRC</td>
                                        <td><?= $Q[$x]['estado'] == '1' ? 'Activo' : 'Inactivo' ?></td>
                                        <td>
                                            <a href="#"><span class="fa fa-pencil-square-o" style="color:#666666" title="Editar monto" onClick="url('<?= $Q[$x]['id'] ?>');"></span></a>	 
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <hr>			
            <footer class="Pfooter">
                <strong>&copy; <?=date('Y')?></strong>            </footer>
        </div>
    </body>
</html>