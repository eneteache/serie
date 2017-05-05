<?php
include 'claseCarrito.php';

$carrito = new Carrito();



echo "<br>";
$carrito->add($_POST['id'], $_POST['nombre'], $_POST['precioU'],$_POST['cantidad'],$_POST['rutaImagen']);

print_r($carrito->get('1'));

header("location: carrito.php")
?>