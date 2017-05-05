<?php

	if (!isset($_POST['id'])) {

		//Expulsar si no viene de un formulario con POST.
		//header('location: index.php');

	} else {
		//Recogida de variables.
		
		$id		= $_POST['id'];

		//Formar URL con el ID recogido
		$url	= "https://api.themoviedb.org/3/movie/$id?api_key=9e51a426706d7dc458f162e67740c39f&language=es";
		$urlYT	= "https://api.themoviedb.org/3/movie/$id/videos?api_key=9e51a426706d7dc458f162e67740c39f&language=es";

		// Comprobar si se puede acceder a la URL y obtener su contenido.
		if (file_get_contents($url) === true) {
			// Mostrar error
			
		} else {
			$contenido =	json_encode(array_merge(json_decode(file_get_contents($url), true),json_decode(file_get_contents($urlYT), true)));
			

			// Comprobar si el resultado de la URL coincide con el ID introducido
			// Si coincide se devuelven los datos al formulario.
			$array	= json_decode($contenido,true); 
			
			if ($id == $array['id'] or $id == $array['imdb_id']) {
				//Devolver resultados
				echo $contenido;
				
			}
			else {
				//Mostrar error.
				echo "ha";
			}

			

		}
	}
	/*if (!isset($_POST['id'])) {
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	} else {


		// Definicion de variables
		$id		= 321612;
		$url	= "https://api.themoviedb.org/3/movie/".$id."?api_key=9e51a426706d7dc458f162e67740c39f&language=es";
		$json	= json_decode(file_get_contents($url), true);
		$yt		= "http://api.themoviedb.org/3/movie/$id/videos?api_key=9e51a426706d7dc458f162e67740c39f&language=es";
		$videos	= json_decode(file_get_contents($yt), true);
		print_r($json) ;
		echo $json['title'];
		echo $json['release_date'];
		echo "<br>";
		for ($i=0; $i < count($json['genres']) ; $i++) { 
			echo $json['genres'][$i]['name'] . ", ";
		}
		echo $json['overview'];
		echo "<img src='https://image.tmdb.org/t/p/w500".$json['backdrop_path']."'/>";
		echo "<img src='https://image.tmdb.org/t/p/w500".$json['poster_path']."'/>";
		
		function conversorSegundosHoras($tiempo_en_minutos) {
	$horas = floor($tiempo_en_minutos / 60);
	$minutos = floor(($tiempo_en_minutos - ($horas * 60)) );
	$segundos = ($tiempo_en_minutos * 60) - (($minutos * 60) + ($horas * 3600));
 	
	$hora_texto = "";
	if ($horas > 0 ) {
		$hora_texto .= $horas . "h ";
	}
 
	if ($minutos > 0 ) {
		$hora_texto .= $minutos . "m ";
	}
 
	if ($segundos > 0 ) {
		$hora_texto .= $segundos . "s";
	}
 
	return $hora_texto;
}
	}

	echo conversorSegundosHoras($json['runtime']);

for ($i=0; $i < count($videos['results']) ; $i++) { 
			echo $videos['results'][$i]['key'] . ", ";
			$i = count($videos['results']);
		}*/
?>
