<?php
session_start();
	if (($_SESSION['tipoUsuario']) != 'Administrador') {
		header("Location: ../index.php");
		exit();
	}
include ("../funciones/funcionesConectarBD.php");
$conexion = conectarBD();
if (isset($_POST['editarusuario'])) {
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$ciudad = $_POST['ciudad'];
$pais = $_POST['valorpais'];
$tipoUsuario = $_POST['valorTipoUsuario'];
$id = $_POST['usuarioeditar'];

$update = "update usuarios set nombre='$nombre', apellidos= '$apellidos', ciudad= '$ciudad', pais=$pais, tipoUsuario= '$tipoUsuario' where id_user = $id";
mysqli_query($conexion, $update);
header('Location: ' . $_SERVER['HTTP_REFERER']);
}




?>