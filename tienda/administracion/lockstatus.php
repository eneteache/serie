<?php
session_start();
	if (($_SESSION['tipoUsuario']) != 'Administrador') {
		header("Location: ../navegacion.php");
		exit();
	}
include ("../funciones/funcionesConectarBD.php");
include ("../funciones/funcionesSelect.php");
$conexion = conectarBD();
$selectallbyID = selectallbyID($_GET['ID']);
$rselectallbyID = mysqli_query($conexion, $selectallbyID);
$campo = mysqli_fetch_array($rselectallbyID);

$lock = "update usuarios set bloqueado=1 where id_user= {$_GET['ID']}";
$unlock = "update usuarios set bloqueado=0 where id_user= {$_GET['ID']}";
$resetnErrores = "update usuarios set nErrores = 0 where id_user= {$_GET['ID']}";
echo $campo['bloqueado'];
echo $selectallbyID;

if ($campo['bloqueado'] == 0 ) {
	mysqli_query($conexion, $lock);
}

if ($campo['bloqueado'] == 1) {
	mysqli_query($conexion, $unlock);
	mysqli_query($conexion, $resetnErrores);
}

header("location: /administracion/listarUsuarios.php");
?>