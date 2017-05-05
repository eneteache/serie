<?php
session_start();
	if (($_SESSION['tipoUsuario']) != 'Administrador') {
		header("Location: ../index.php.php");
		exit();
	}
	include ("../funciones/funcionesConectarBD.php");
	$conexion = conectarBD();
	$email = $_POST['email'];
	$clavecifrada = password_hash ($_POST['clave'], PASSWORD_BCRYPT, array("salt" => "123456789salypimienta159753*"));
	
	$updatepass = "update usuarios set clave='$clavecifrada' where email='$email'";
	mysqli_query ($conexion, $updatepass);
	header ("Location: ../administracion/listarUsuarios.php")
?>