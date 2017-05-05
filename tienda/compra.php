<?php
		if (!isset($_POST['carrito'])) {
			header('location: carrito.php');
		}
		
		include('claseCarrito.php');
		$carrito = new Carrito();

		if (isset($_POST['carrito']) and $carrito->getAll() and (!isset($_SESSION['estado']))) {
			$_SESSION['posibleCompra'] = "false";
			header('location: iniciosesion.php');
		}

		if (isset($_POST['carrito']) and $carrito->getAll() and (isset($_SESSION['estado']))) {
			header('location: pago.php');
		}

		if (!isset($_POST['carrito']) and $carrito->getAll() and (!isset($_SESSION['estado']))) {
			header('location: carrito.php');
		}

		

		exit();
		

?>