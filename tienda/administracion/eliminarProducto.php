<?php
session_start();
	if (($_SESSION['tipoUsuario']) != 'Administrador') {
		header("Location: ../index.php");
		exit();
	}
	if (!array_key_exists('ID', $_GET)) {
		header("Location: ../index.php");
		exit();
	} else {
		include ("../funciones/funcionesConectarBD.php");
		$conexion = conectarBD();
		$borrar = "delete from productos where id_producto={$_GET['ID']}";
		$borrarImg = "delete from imagenes where idProducto={$_GET['ID']}";
		mysqli_query($conexion, $borrar);
		mysqli_query($conexion, $borrar);
		echo mysqli_error($conexion);
		//header('Location: ' . $_SERVER['HTTP_REFERER']);

	}
?>