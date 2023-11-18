<?php
include 'configuracion/database.php';
if (!isset($_POST['_AJAX'])) {
    echo -1;
}

$consecutivo = $_POST['consecutivo'];
$accion = $_POST['accion'];
$fecha = date('Y/m/d');
$respuesta= '';

    if($accion == 'Anular'){
        $busca = _QUERY("SELECT consecutivo, DATE_FORMAT(fecha, '%Y/%m/%d') AS fecha, monto, tipoPago, estado from encabezadopedido where consecutivo = '$consecutivo';");

        if($busca[0]['estado'] == 0){
            $respuesta = '-1';
           // echo ('-1');// ya esta nulo
        }else if($busca[0]['consecutivo'] == ''){
           // echo ('-2');//no existe conseucutio
            $respuesta = '-2';
        }else if($busca[0]['fecha'] != $fecha){
           // echo ('-3');//no anular de dias anteriores
            $respuesta = '-3';
        } else {
            _TRANS("UPDATE encabezadopedido SET estado = 0 WHERE consecutivo = '$consecutivo';");
            //echo ('0');//funciono
            $respuesta = '0';
        }
         echo($respuesta);
    }
?>