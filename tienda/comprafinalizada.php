<?php
include 'funciones/comprobarSession.php';
include 'funciones/comprobarUsuario.php';
include 'claseCarrito.php';
$carrito = new Carrito();
/*if (!(isset($_POST)) or !(usuariosRegistrados()) or !($_POST['botonComprar']) or !($carrito->getAll())) {
	header('location:index.php');
	exit();
}*/
include_once('funciones/funcionesConectarBD.php');
$conexion = conectarBD();
global $conexion;

$id 		= $_POST['id_user'];
$importe	= $_POST['importeTotal'];
$nombre     = $_POST['nombre_envio'];
$apellidos  = $_POST['apellidos_envio'];
$ndocumento = $_POST['ndocumento_envio'];
$pais       = $_POST['pais_envio'];
$provincia 	= $_POST['provincia_envio'];
$ciudad     = $_POST['ciudad_envio'];
$codigopostal= $_POST['codigopostal_envio'];
$direccion   = $_POST['direccion_envio'];

$sqlPedidos = "insert into pedidos (id_user, importeTotal, nombre_envio, apellidos_envio, ndocumento_envio, pais_envio, provincia_envio, ciudad_envio, codigopostal_envio, direccion_envio) values ($id, $importe, '$nombre', '$apellidos', '$ndocumento', '$pais', '$provincia', '$ciudad', '$codigopostal', '$direccion');";

mysqli_query($conexion, $sqlPedidos);

function filaCarrito ($id, $nombre, $precio, $unidades) {
	include_once('funciones/funcionesConectarBD.php');
	$conexion = conectarBD();
	$sqlUltimoPedido = "select idPedido from pedidos where id_user = {$_SESSION['id']} order by fechaPedido desc limit 1;";
	$idPedido = mysqli_fetch_array(mysqli_query($conexion, $sqlUltimoPedido));
	$sqlDetallesPedidos = "insert into detallespedidos (idPedido, idProducto, nUnidades, precioUnitario) values ({$idPedido['idPedido']},$id,$unidades,$precio )";
	echo "<br/>" . $sqlDetallesPedidos;
	mysqli_query($conexion, $sqlDetallesPedidos);
}

$carrito->getAll('filaCarrito');
unset($_SESSION['carrito']);
header('location: ../perfil/index.php');

?>