<?php 
include 'claseCarrito.php';
$carrito = new Carrito();
$id = $_GET['id'];
$carrito->delAll($id);

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>