<?php
include 'configuracion/database.php';
if (!isset($_POST['_AJAX'])) {
    echo -1;
}

$consecutivo = $_POST['consecutivo'];
    $totaliza = _QUERY("SELECT SUM(totalLinea) as total FROM pedido where consecutivo = '$consecutivo';");
   echo number_format($totaliza[0]['total'], 2, '.', ',');
?>