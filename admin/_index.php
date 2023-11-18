<?php
include '../configuracion/database.php';

if(!isset($_POST['usuario'])){
	header('location: ../error.php?error=l');
	exit(); 
}
$ROW = _QUERY("SELECT cedula, nombre, tipo FROM tabla002 WHERE usuario = '{$_POST['usuario']}' AND clave = '{$_POST['clave']}' AND estado = '1';");
if($ROW) {
	session_start();
	$_SESSION['_cedula_'] = $ROW[0]['cedula'];
	$_SESSION['_nombre_'] = $ROW[0]['nombre'];
	$_SESSION['_tipo_'] = $ROW[0]['tipo'];
	echo "<script>location.href = 'menu.php'; </script>";
}else{
	header('location: error.php?error=u');
}
exit();

?>