<?php
include '../configuracion/database.php';
include '_menu.php';
session_start();
if (!isset($_SESSION['_cedula_'])) {
    header('location: error.php?error=l');
}
$ROW = _QUERY("SELECT trans_compra, DATE_FORMAT(fecha, '%d/%m/%Y %T') AS fecha, cedula, nombre, correo, telefono, monto FROM tabla000 WHERE trans_compra = '{$_GET['ORDER']}';");
$Q = _QUERY("SELECT trans_compra, idcurso, curso, monto FROM detalle WHERE trans_compra = '{$_GET['ORDER']}';");
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
        <script>
            function valida() {
                swal({
                    title: "Atencion!!!",
                    text: "Debe indicar el metodo de pago de la diferencia!",
                    type: "warning",
                    timer: 2000,
                    showConfirmButton: false
                });
                document.getElementById("fpago").style.visibility = 'visible';
            }
            function validacion() {
                if (document.getElementById("fpago").style.visibility == 'visible') {
                    if (document.getElementById("formapago").value == '') {
                        swal('Alerta!', 'Debe indicar la forma de pago', 'warning');
                        return false;
                    }
                    if (document.getElementById("compago").value == '') {
                        swal('Alerta!', 'Debe indicar el comprobante de pago', 'warning');
                        return false;
                    }
                }
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
                    <li class="active">Registro</li>
                    <li class="active">Modificar Inscripción</li>
                    <li class="active">Modificar Detalle Inscripción</li>					
                </ol>
            </section> 
            <hr>			
            <br>					
            <section class="content">  
                <form name="formulario" id="formulario" method="post" action="_mod_inscripcion_detalle.php" onsubmit="return validacion();">
                    <input type="hidden" id="trans_compra" name="trans_compra" value="<?= $ROW[0]['trans_compra'] ?>">
                    <center>
                        <div class="row">  
                            <img src="../imagenes/logo.png" class="img-rounded" alt="logo">	
                            <div class="box box-info"> 												
                                <div class="box-header with-border"><h3 class="box-title">Información de Inscripción</h3></div>
                                <div class="box-body">                                    
                                    <table style="width:100%" cellpadding="2" cellspacing ="2">
                                        <tr>
                                            <td align="center"><label for="cedula" >Número de Comprobante:</label></td>
                                            <td><?= $ROW[0]['trans_compra'] ?></td>
                                        </tr>
                                        <tr>
                                            <td align="center"><label for="cedula" >Fecha:</label></td>
                                            <td><?= $ROW[0]['fecha'] ?></td>
                                        </tr>
                                        <tr>
                                            <td align="center"><label for="cedula" >Identificación / Pasaporte:</label></td>
                                            <td><input type="text" class="form-control" placeholder="Identificación / Pasaporte" name="cedula" id="cedula" required value="<?= $ROW[0]['cedula'] ?>"></td>
                                        </tr>                                        
                                        <tr>
                                            <td align="center"><label for="nombre" >Nombre Completo:</label></td>
                                            <td> <input class="form-control" placeholder="Nombre Completo"  type="text" name="nombre" id="nombre" required value="<?= $ROW[0]['nombre'] ?>"/></td>
                                        </tr>
                                        <tr>
                                            <td align="center"><label for="correo" >Correo:</label></td>
                                            <td> <input class="form-control" placeholder="Correo electrónico"  type="email" name="correo" id="correo" required value="<?= $ROW[0]['correo'] ?>"/></td>
                                        </tr>
                                        <tr>
                                            <td align="center"><label for="telefono" >Teléfono:</label></td>
                                            <td> <input class="form-control" placeholder="Teléfono"  type="text" name="telefono" id="telefono" required value="<?= $ROW[0]['telefono'] ?>"/></td>
                                        </tr>  							
                                        <tbody id="fpago" style="visibility:hidden;">
                                            <tr><td colspan="2"><hr></td></tr>
                                            <tr>
                                                <td align="center"><label for="formapago" >Forma de Pago:</label></td>
                                                <td>
                                                    <select class="form-control" name="formapago" id="formapago">
                                                        <option value="">...</option>
                                                        <option value="1">Efectivo</option>
                                                        <option value="2">Tarjeta</option>
                                                        <option value="3">Transferencia</option>
                                                        <option value="4">Devolución</option>
                                                    </select>													
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center"><label for="compago" >Comprobante de Pago:</label></td>
                                                <td><input class="form-control" placeholder="Comprobante de Pago"  type="text" name="compago" id="compago"/></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    <?php for ($x = 0; $x < count($X); $x++) { ?>  
                                        <div class="row">  	
                                            <div class="box box-info"> 	
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">
                                                        <i class="ion ion-clipboard"></i> <?= $X[$x]['nombre'] ?>
                                                    </h3> 
                                                    <hr>
                                                    <?php
                                                    $Z = _QUERY("SELECT id, nombre, descripcion, grupo, cupo, cuporeal, monto, descuento, modalidad, duracion, instructor, DATE_FORMAT(fechaInicio, '%d/%m/%Y') AS fechaInicio, DATE_FORMAT(fechaFinal, '%d/%m/%Y') AS fechaFinal, horario, lugar FROM tablamontos WHERE estado = '1' AND programacion = '{$X[$x]['id']}';");
                                                    for ($z = 0; $z < count($Z); $z++) {
                                                        $lolo = false;
                                                        for($q=0;$q<count($Q);$q++){
                                                            if($Z[$z]['id'] == $Q[$q]['idcurso']){
                                                                $lolo = true;
                                                                break;
                                                            }
                                                        }
                                                        ?>
                                                        <div class="col-md-6" style="cursor:pointer;">
                                                            <ul class="todo-list">                                                    
                                                                <li>                                                
                                                                    <input type="checkbox" id="ck<?= $Z[$z]['id'] ?>" name="ck[]" value="<?= $Z[$z]['id'] ?>" onclick="valida();" <?=$lolo == true ? 'checked' : ''?>>
                                                                    <span><strong><i class="fa fa-book margin-r-5"></i> Curso: </strong><?= $Z[$z]['nombre'] ?>, Grupo: <?= $Z[$z]['grupo'] ?></span>                                                                    
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <?php
                                                        if (($z + 1) < count($Z)) {
                                                            $z++;
                                                            $lolo = false;
                                                            for($q=0;$q<count($Q);$q++){
                                                                if($Z[$z]['id'] == $Q[$q]['idcurso']){
                                                                    $lolo = true;
                                                                    break;
                                                                }
                                                            }
                                                            ?>
                                                            <div class="col-md-6" style="cursor:pointer;">
                                                                 <ul class="todo-list">                                                    
                                                                    <li>                                                
                                                                        <input type="checkbox" id="ck<?= $Z[$z]['id'] ?>" name="ck[]" value="<?= $Z[$z]['id'] ?>" onclick="valida();" <?=$lolo == true ? 'checked' : ''?>>
                                                                        <span><strong><i class="fa fa-book margin-r-5"></i> Curso: </strong><?= $Z[$z]['nombre'] ?>, Grupo: <?= $Z[$z]['grupo'] ?></span>                                                                      
                                                                    </li>
                                                                </ul>
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
                                </div>                              
                                <div class="box-footer">                               
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-lock"></i> Actualizar</button>
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