<?php 

	session_start();
	if (($_SESSION['tipoUsuario']) != 'Administrador') {
		header("Location: ../index.php");
		exit();
	}
	if (!array_key_exists('ID', $_GET)) {
		header("Location: ../index.php");
		exit();
	}

	include ("../funciones/funcionesConectarBD.php");
	$conexion = conectarBD();
	$productos  ="select * from productos where categoria= (select nombre from categorias where id_categoria={$_GET['ID']})";
	$rProductos = mysqli_query($conexion, $productos);
	if (mysqli_num_rows($rProductos) > 0) {
		
		$_SESSION['error'] = 'Ha habido problemas con la foreign key de esta tabla. No se puede borrar esta categoría debido a que existen productos relacionados con esta categoría.';
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		
	}else {
		$borrar = "delete from categorias where id_categoria={$_GET['ID']}";
		$result = mysqli_query($conexion, $borrar);
		if (mysqli_error($conexion)) {
			
			$_SESSION['error'] = mysqli_error($conexion, $result);

		}
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
	
	
?>