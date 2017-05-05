<?php 
	include ("../funciones/comprobarSession.php");
	include ("../funciones/comprobarUsuario.php");
	include ("../funciones/funcionesConectarBD.php");
	$conexion = conectarBD();

	
	
	if (isset($_POST['categoriaNueva'])) {
		$insertCategoria = "insert into categorias values (default, '{$_POST['nombreCategoria']}', default)";
		mysqli_query($conexion, $insertCategoria);
	}
	if (isset($_POST['productoNuevo'])) {

		$uploadsDir = "../imagenes/";
		/* Insertar producto*/
		$principal = $uploadsDir.$_FILES["fotos"]["name"][0];
		$insertProducto = "insert into productos values (default, '{$_POST['nombreProducto']}', '{$_POST['marca']}', '{$_POST['categoria']}', {$_POST['precio']}, '{$_POST['descripcion']}', default, default, '$principal', default)";
		echo $principal . "<br>" . "$insertProducto";
		mysqli_query($conexion, $insertProducto);
echo mysqli_error($conexion);
		/*Insertar fotos productos */
		$IdProducto = "select id_producto from productos order by id_producto desc limit 1";
		$result = mysqli_fetch_array(mysqli_query($conexion, $IdProducto));
		$id = $result['id_producto'];
		$Imagenes = count($_FILES['fotos']['tmp_name']);
		for ($i=0; $i < $Imagenes ; $i++) {
			$nombreFoto = $uploadsDir.$_FILES["fotos"]["name"][$i];
			move_uploaded_file($_FILES["fotos"]["tmp_name"][$i], $nombreFoto);
			$pdo=new PDO("mysql:dbname=proyecto;host=127.0.0.1","root","123456");
			$statement = $pdo->prepare("INSERT INTO  imagenes(idImagen, IdProducto, url) VALUES(NULL,{$id},:url)");
			$statement->execute(array("url" => $nombreFoto));
		}
	}
	
	echo mysqli_error($conexion);
	header ("Location: ../administracion/categorias.php")
?>