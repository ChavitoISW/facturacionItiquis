<?php
include 'configuracion/database.php';
if (!isset($_POST['_AJAX'])) {
    echo -1;
}
$ids = explode(',', $_POST['ids']);
$total = 0;
for ($q = 0; $q < count($ids); $q++) {
    if ($ids[$q] != '') {
        $Z = _QUERY("SELECT cuporeal, monto, descuento FROM tablamontos WHERE id = '{$ids[$q]}';");
        if ($Z[0]['cuporeal'] < 1) {
            _TRANS("UPDATE tablamontos SET estado = '0' WHERE id = '{$ids[$q]}';");
            echo '-99';
            exit();
        }
        $total += ($Z[0]['monto'] - ($Z[0]['monto'] * ($Z[0]['descuento'] / 100)));
        _TRANS("UPDATE tablamontos SET cuporeal = cupo - ((SELECT COUNT(detalle.trans_compra) AS total FROM detalle INNER JOIN tabla000 ON detalle.trans_compra = tabla000.trans_compra WHERE   tabla000.estado = '1' AND detalle.idcurso = '{$ids[$q]}') + 1) WHERE id = '{$ids[$q]}';");
    }
}
echo number_format($total, 2, '.', ',');
?>