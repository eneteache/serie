<?php 
function comprobar($titulo) {
	include ('../../funciones/bd.php');
	$conexion = conectarBD();
	$sql 		= "select titulo from entradas where titulo='$titulo'";
	$resultado 	= mysqli_query($conexion, $sql);

	if (mysqli_error($conexion)) {
		return false;
	} else {
		if (mysqli_num_rows($resultado) >= 1) {
			return true;
		}
	}

}
?>