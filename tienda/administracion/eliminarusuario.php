<?php 
	session_start();
	if (($_SESSION['tipoUsuario']) != 'Administrador') {
		header("Location: ../index.php");
		exit();
	}
	include ("../funciones/funcionesConectarBD.php");
	$conexion = conectarBD();
	$sql = "select * from usuarios where id_user={$_GET['ID']}";
	$resultado = mysqli_fetch_array(mysqli_query($conexion, $sql));

	if ($_GET['ID'] != $_SESSION["id"]) {
		if ($_SESSION['superadmin'] == 1) {
			$borrar = "delete from usuarios where id_user = {$_GET['ID']}";
			mysqli_query ($conexion, $borrar);
			$_SESSION['resultadoAccion'] = 'correcto';
			header("location: ../administracion/listarUsuarios.php");
			exi();
		}
		if (($_SESSION['superadmin'] == 0) and ($resultado['tipoUsuario'] != 'Administrador')) {
			$borrar = "delete from usuarios where id_user = {$_GET['ID']}";
			mysqli_query ($conexion, $borrar);
			$_SESSION['resultadoAccion'] = 'correcto';
			header("location: ../administracion/listarUsuarios.php");
			exit();
		} else {
			$_SESSION['resultadoAccion'] = 'NoBorrarOtroAdmin';
			header("location: ../administracion/listarUsuarios.php");
			exit();
		}
	} else {
		$_SESSION['resultadoAccion'] = 'MismoUsuario';
		header("location: ../administracion/listarUsuarios.php");
		exit();
	}
			/*$borrar = "delete from usuarios where id_user = {$_GET['ID']}";
			mysqli_query ($conexion, $borrar);
			header("location: ../administracion/listarUsuarios.php");
			$_SESSION['resultadoAccion'] = 'NoBorrarAdmin';
			//header("location: ../administracion/listarUsuarios.php");*/
		
	
	


?>