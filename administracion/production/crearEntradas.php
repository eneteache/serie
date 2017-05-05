<?php
	include ('../../funciones/bd.php');
	$conexion = conectarBD();
	global $conexion;

	if (isset($_POST['tipoEntrada'])) {


		$youtube = "";
		if (isset($_POST['tipoEntrada']) and $_POST['tipoEntrada'] == "serie") {

			// Campos recibidos
			$tipo			= $_POST['tipoEntrada'];
			$titulo			= $_POST['name'];
			$genero			= $_POST['genero'];
			$poster			= $_POST['backdrop_path'];
			$background		= $_POST['poster_path'];
			$lanzamiento	= $_POST['first_air_date'];
			$temporadas		= $_POST['number_of_seasons'];
			$sinopsis		= addslashes($_POST['overview']);
			if (isset($_POST['yt'])) {
				$youtube		= $_POST['yt'];
			}
			

			// SQL para insertar
			$insert 		= "insert into entradas (tipo, titulo, genero, poster, background, lanzamiento, temporadas, sinopsis,youtube) values ('$tipo', '$titulo', '$genero', '$poster', '$background', '$lanzamiento', $temporadas, '$sinopsis', '$youtube')";
		}
		if (isset($_POST['tipoEntrada']) and $_POST['tipoEntrada'] == "pelicula") {

			// Campos recibidos
			$tipo			= $_POST['tipoEntrada'];
			$titulo			= $_POST['titulo'];
			$genero			= $_POST['genero'];
			$poster			= $_POST['backdrop_path'];
			$background		= $_POST['poster_path'];
			$lanzamiento	= $_POST['anio'];
			$duracion		= $_POST['runtime'];
			$sinopsis		= addslashes($_POST['overview']);
			if (isset($_POST['yt'])) {
				$youtube		= $_POST['yt'];
			}

			// SQL para insertar
			$insert = "insert into entradas (tipo, titulo, genero, poster, background, lanzamiento, duracion, sinopsis, youtube) values ('$tipo','$titulo', '$genero', '$poster','$background', '$lanzamiento', $duracion,'$sinopsis','$youtube')";
		}

		$sql 		= "select titulo from entradas where titulo='$titulo'";
		$resultado 	= mysqli_query($conexion, $sql);

		if (mysqli_error($conexion)) {
			echo "Parece ser que ha ocurrido un error";
			exit();
		} else {
			if (mysqli_num_rows($resultado) >= 1) {
				echo "Parece ser que esta serie o película ya existe";
				exit();
			}
		}
		mysqli_query($conexion, $insert);
		if (mysqli_error($conexion)) {
			echo "Ha ocurrido un error";
			exit();
		} else {
			echo "La nueva entrada se ha creado correctamente";
		}
	} else {
		if (isset($_SERVER['HTTP_REFERER'])) {
			header('Location: ' . isset($_SERVER['HTTP_REFERER']));
		} else {
			header('location: index.php');
		}
		
	}
?>