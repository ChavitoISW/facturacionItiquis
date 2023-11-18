<?php
include 'configuracion/database.php';
if (!isset($_POST['_AJAX'])) {
    echo -1;
}

$consecutivo = $_POST['consecutivo'];
$detalle = _QUERY("select tm.nombre, tm.monto, p.cantidad, p.totalLinea from pedido p inner join tablamontos tm on p.idProducto = tm.id where p.consecutivo = '$consecutivo';");

?>

<div>
    <table id="example" class="table table-bordered table-striped" border="2">
        <thead>
        <tr>
            <th>Cant.</th>
            <th>Producto</th>
            <th>Precio Unitario</th>
            <th>Total <br/> Linea</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($x = 0; $x < count($detalle); $x++) {
            if ($detalle[$x] != '') { ?>
                <tr class="gradeA" align="center">
                    <td align="center"><h4><?= $detalle[$x]['cantidad'] ?></h4></a></td>
                    <td><h4><?= $detalle[$x]['nombre'] ?></h4></td>
                    <td><h5>&cent;<?= _FORMATO($detalle[$x]['monto']) ?></h5></td>
                    <td><h5>&cent;<?= _FORMATO($detalle[$x]['totalLinea']) ?></h5></td>
                </tr>
            <?php }
        } ?>
        </tbody>
    </table>
</div>