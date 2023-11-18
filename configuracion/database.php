<?php

function _DECODE($_CADENA) {
    $_CADENA = base64_decode($_CADENA);
    $i = 1;
    $cadena = '';
    for ($x = 0; $x < strlen($_CADENA); $x++, $i *= -1) {
        $num_letra = ord(substr($_CADENA, $x, 1));
        $cadena .= chr($num_letra + $i);
    }
    return $cadena;
}

function _RAND() {
    $letras = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $tam = strlen($letras);
    $str = '';
    for ($i = 0; $i < 7; $i++)
        $str .= $letras[rand(0, $tam - 1)];
    return date('ym') . $str;
}

function _FREE($_VAR) {
    $v1 = array("'", '&', '´', '`', '-', '"');
    $_VAR = str_replace($v1, ' ', $_VAR);
    return $_VAR;
}

function _QUERY($_SQL) {
    $id_con = mysqli_connect('localhost', 'root', '', 'itiquis');
    $resultado = mysqli_query($id_con, $_SQL);
    $x = 0;
    $a = array();
    while ($row = mysqli_fetch_assoc($resultado)) {
        $a[$x] = $row;
        $x++;
    }
    mysqli_close($id_con);
    return $a;
}

function _TRANS($_SQL) {
    $id_con = mysqli_connect('localhost', 'root', '', 'itiquis');
    $resultado = mysqli_query($id_con, $_SQL);
    mysqli_close($id_con);
    return $resultado;
}

function _ZEN($_SQL) {
    $id_con = mysqli_connect('localhost', 'root', '', 'itiquis');
    $resultado = mysqli_query($id_con, $_SQL);
    mysqli_close($id_con);
    return $resultado;
}



/*
function _QUERY($_SQL) {
    $id_con = mysqli_connect('localhost', 'root', 'root', 'procame_colones');
    $resultado = mysqli_query($id_con, $_SQL);
    $x = 0;
    $a = array();
    while ($row = mysqli_fetch_assoc($resultado)) {
        $a[$x] = $row;
        $x++;
    }
    mysqli_close($id_con);
    return $a;
}

function _TRANS($_SQL) {
    $id_con = mysqli_connect('localhost', 'root', 'root', 'procame_colones');
    $resultado = mysqli_query($id_con, $_SQL);
    mysqli_close($id_con);
    return $resultado;
}

function _ZEN($_SQL) {
    $id_con = mysqli_connect('localhost', 'root', 'root', 'fundauna');
    $resultado = mysqli_query($id_con, $_SQL);
    mysqli_close($id_con);
    return $resultado;
}
*/




function _FORMATO($_num) {
    $_num = number_format($_num, 2, '.', ',');
    return $_num;
}

function _DETALLE($_trans_compra) {
    $Q = _QUERY("SELECT trans_compra, idcurso, curso, monto FROM detalle WHERE trans_compra = '{$_trans_compra}';");
    $curso = "<ul>";
    for ($z = 0; $z < count($Q); $z++) {
        $curso .= "<li>" . $Q[$z]['curso'] . " (&cent;" . _FORMATO($Q[$z]['monto']) . " CRC)</li>";
    }
    $curso .= "</ul>";
    return $curso;
}

function _USUARIO($_nom) {
    if ($_nom == '0-0000-0000')
        return 'Comercio Electronico';
    elseif ($_nom == '1-0507-0839' || $_nom == '4-0212-0075')
        return 'Cajas';
    elseif ($_nom == '9-9999-9999')
        return 'Admin';
    else
        return 'Usuario';
}

function _TIPO($_opc) {
    if ($_opc == '1')
        return 'Operador';
    elseif ($_opc == '7')
        return 'Administrador';
    else
        return 'No def.';
}

function _BITTIPO($_opc) {
    if ($_opc == 'I')
        return 'Ingresa';
    elseif ($_opc == 'M')
        return 'Modifica';
    else
        return 'No def.';
}

function _Titulo() {
    return 'Diaconia Itiquis';
}

function _Evento() {
    return 'Diaconia Itiquis, Alajuela, Costa Rica';
}

function _LIBERA() {
    //_TRANS("UPDATE tablamontos SET cuporeal = cuporeal - ((SELECT COUNT(detalle.trans_compra) AS total FROM tabla001 INNER JOIN tabla000 ON tabla001.trans_compra = tabla000.trans_compra WHERE   tabla000.estado = '1' AND tabla001.idcurso = '{$ids[$q]}') + 1) WHERE id = '{$ids[$q]}';");
}

function _PROGRAMACION($_id) {
    $W = _QUERY("SELECT nombre FROM tablaprogramaciones WHERE id = '{$_id}';");
    return $W[0]['nombre'];
}

?>