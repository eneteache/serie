<?php 
	include ('../navegacion.php');

	$conexion = conectarBD();
  	if (isset($_POST['confirmar'])) {
  		$nombreCategoria = $_POST['nombre'];
  		$idCategoria = $_POST['idCategoria'];
  		$sqlUpdate = "update categorias set nombre='{$nombreCategoria}' where id_categoria={$idCategoria}";
  		mysqli_query($conexion, $sqlUpdate);
  		$_SESSION['resultadoAccion'] = "correcto"; 
  		header('location: ../administracion/editarCategoria.php?ID='.$idCategoria);		
 }
  ?>