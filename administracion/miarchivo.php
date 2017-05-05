<?php
# Esta página recibe por post el id del formulario.
#
# Para nuestro ejemplo, devolvemos un valor para el id 10, pero aqui se tendria
# que realizar la busqueda en la base de datos en busca del registro.
#
if (!isset($_POST['id'])) {
	header('location: index.php');
}
		$id		= $_POST['id'];
		$url	= "https://api.themoviedb.org/3/movie/".$id."?api_key=9e51a426706d7dc458f162e67740c39f&language=es";
		$json1	= file_get_contents($url);
		$humano	= json_decode($json1,true);
		$yt		= "http://api.themoviedb.org/3/movie/$id/videos?api_key=9e51a426706d7dc458f162e67740c39f&language=es";
		$videos	= json_decode(file_get_contents($yt), true);

$json =json_encode(array("title"=>"juan", "apellidos"=>"martinez exposito"));

if (!isset($_POST)) {
	header('location: index.php');
}

if($id == $humano['id'] or $id == $humano['imdb_id'])
{
	echo $json1;
}else {
	echo json_encode(array("nombre"=>"", "apellidos"=>""));
}
?>
