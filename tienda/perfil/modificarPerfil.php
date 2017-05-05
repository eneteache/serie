<?php 
session_start();
include('../funciones/funcionesConectarBD.php');
$conexion = conectarBD();
if (!isset($_POST['datosFacturacion'])) {
	//header('location:index.php');
}
if (isset($_POST['datosFacturacion'])) {
$nombre  	= $_POST['nombreUsuario'];
$apellidos  = $_POST['apellidosUsuario'];
$ndocumento  = $_POST['documentacionUsuario'];
$pais  = $_POST['paisUsuario'];
$provincia  = $_POST['provinciaUsuario'];
$ciudad  = $_POST['ciudadUsuario'];
$codigopostal  = $_POST['codpostalUsuario'];
$direccion  = $_POST['direccionUsuario'];

	if ($_POST['copiardatos'] == 'No') {
		$update = "update usuarios set nombre='$nombre', apellidos='$apellidos',  ndocumento='$ndocumento', pais=$pais, provincia='$provincia', ciudad='$ciudad', codigopostal=$codigopostal, direccion='$direccion' where id_user={$_SESSION['id']}";
			
	}
	if ($_POST['copiardatos'] == 'Si'){
		$update = "update usuarios set nombre='$nombre', apellidos='$apellidos',  ndocumento='$ndocumento', pais=$pais, provincia='$provincia', ciudad='$ciudad', codigopostal=$codigopostal, direccion='$direccion', nombre_envio='$nombre', apellidos_envio='$apellidos',  ndocumento_envio='$ndocumento', pais_envio=$pais, provincia_envio='$provincia', ciudad_envio='$ciudad', codigopostal_envio=$codigopostal, direccion_envio='$direccion' where id_user={$_SESSION['id']}";
	}

	mysqli_query($conexion, $update);
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if (isset($_POST['datosEnvio'])) {
$nombre  	= $_POST['nombreEnvio'];
$apellidos  = $_POST['apellidosEnvio'];
$ndocumento  = $_POST['documentacionEnvio'];
$pais  = $_POST['paisEnvio'];
$provincia  = $_POST['provinciaEnvio'];
$ciudad  = $_POST['ciudadEnvio'];
$codigopostal  = $_POST['codpostalEnvio'];
$direccion  = $_POST['direccionEnvio'];

$update = "update usuarios set nombre_envio='$nombre', apellidos_envio='$apellidos',  ndocumento_envio='$ndocumento', pais_envio=$pais, provincia_envio='$provincia', ciudad_envio='$ciudad', codigopostal_envio=$codigopostal, direccion_envio='$direccion' where id_user={$_SESSION['id']}";


}
mysqli_query($conexion, $update);
//echo $update;
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>