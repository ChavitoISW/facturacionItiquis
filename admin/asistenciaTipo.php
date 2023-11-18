<?php
include '../configuracion/database.php';
include '_menu.php';
session_start();
if (!isset($_SESSION['_cedula_'])) {
    header('location: error.php?error=l');
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
        <script src="../js/estilo.js"></script>
    </head>	
    <body class="hold-transition skin-blue layout-top-nav">
        <div class="wrapper">
            <?= menu($_SESSION['_tipo_'], _Titulo()) ?>
            <section class="content-header">
                <br>
                <ol class="breadcrumb">
                    <li><a href="#"><img src="../imagenes/miniescudo.png"> <?= _Titulo() ?></a></li>
                    <li class="active">Reportes</li>
                    <li class="active">Reporte de Inscripciones por Tipo</li>
                </ol>
            </section> 
            <hr>			
            <br>					
            <section class="content">  
                <form action="asistenciaTipos.php" name="formulario" id="formulario" method="post">
                    <center>
                        <div class="row">  
                            <img src="../imagenes/logo.png" class="img-rounded" alt="logo">	
                            <div class="box box-info"> 												
                                <div class="box-header with-border"><h3 class="box-title">Seleccione un curso</h3></div>
                                <div class="box-body">                                    
                                    <table style="width:100%" cellpadding="4" cellspacing ="4">
                                        <tr>
                                            <td><b>Curso:</b></td>
                                            <td><b>Programación:</b></td>
                                            <td><b>Opciones:</b></td>	
                                        </tr>
                                        <?php
                                        $ROW = _QUERY("SELECT id, nombre, programacion FROM tablamontos;");
                                        for ($x = 0; $x < count($ROW); $x++) {
                                        ?>
                                        <tr onMouseOut='mOut(this)' onMouseOver='mOver(this)' style="cursor:pointer;">
                                                <td><?= $ROW[$x]['nombre'] ?></td>
                                                <td><?= _PROGRAMACION($ROW[$x]['programacion']) ?></td>
                                                <td><i class="fa fa-search" title="Mostrar inscripciones" onclick="window.open('asistenciaTipos.php?id=<?= $ROW[$x]['id'] ?>')"></i></td>			
                                            </tr>
                                        <?php } ?>
                                    </table>   
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