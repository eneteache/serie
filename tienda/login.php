<?php

	session_start();

	if (($_SESSION['tipoUsuario']) == 'Administrador') {
		header("Location: administracion/paneladmin.php");
	}
	if (isset($_SESSION['posibleCompra']) == true) {
			header("Location: pago.php");
	}
	elseif (($_SESSION['tipoUsuario']) == 'Usuario') {
		header("Location: index.php");
	}

?>

