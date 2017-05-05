<?php 
	include ('../navegacion.php');

	$conexion = conectarBD();
  	if (isset($_POST['confirmar'])) {

      $idProducto = $_POST['idProducto'];
      $categoria = $_POST['categoria'];
  		$nombre = $_POST['nombre'];
      $marca = $_POST['marca'];
      $precio = $_POST['precio'];
      $descripcion = $_POST['descripcion'];

      
      $nombreFoto = basename($_FILES["fotoProducto"]["name"]);
      $tmp_name = $_FILES["fotoProducto"]["tmp_name"];
      $uploadsDir = "../imagenes";
      $rutaAlmacenamiento = "$uploadsDir/$nombreFoto";

      /*foto movida al servidor*/
      move_uploaded_file($tmp_name, "$uploadsDir/$nombreFoto");
      /*foto movida al servidor*/

      if (!$nombreFoto) {
        $sqlUpdate = "update productos set nombre='{$nombre}', marca='{$marca}', categoria='{$categoria}', precio='{$precio}', descripcion='$descripcion', f_modificacion=now() where id_producto={$idProducto}";
        mysqli_query($conexion, $sqlUpdate);
         echo $sqlUpdate;
      }
      else {
        $sqlUpdate = "update productos set nombre='{$nombre}', marca='{$marca}', categoria='{$categoria}', precio='{$precio}', descripcion='$descripcion', f_modificacion=now(), rutaImagen='{$rutaAlmacenamiento}' where id_producto={$idProducto}";
        mysqli_query($conexion, $sqlUpdate);
        echo $sqlUpdate;
      }
  		
  		$_SESSION['resultadoAccion'] = "correcto"; 
  		header('location: ../administracion/editarProducto.php?ID='.$idProducto);		
 }
  ?>