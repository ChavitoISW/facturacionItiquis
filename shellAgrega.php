<?php
include 'configuracion/database.php';
if (!isset($_POST['_AJAX'])) {
    echo -1;
}
$total = 0;
$accion =  $_POST['accion'];
$id =  $_POST['id'];
$unidades = $_POST['unidades'];
$consecutivo = $_POST['consecutivo'];
$numeric = is_numeric($unidades);
$res = "";

$Z = _QUERY("SELECT  monto FROM tablamontos WHERE id = $id;");

if($numeric == false and $accion == "agregar"){
    //echo(-1); //unidades en 0
    $res = '-2';
} else if($unidades <=0 and $accion == "agregar"){
    //echo(-2); //no numerico
    $res = '-1';
} else if ($accion == "agregar") {
        $total += ($Z[0]['monto'] * $unidades);
        _TRANS("INSERT INTO pedido VALUES('$consecutivo', $id, $unidades, $total) ;");
        $res = 1;
    } else {
        _TRANS("DELETE FROM pedido WHERE consecutivo = '$consecutivo' and idProducto = $id;");
    $res = 1;
    }

    // $totaliza = _QUERY("SELECT SUM(totalLinea) FROM pedido where consecutivo = $consecutivo ;");
    // echo number_format($totaliza, 2, '.', ',');
    echo($res);

?>