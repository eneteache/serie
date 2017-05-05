<?php 
$id 		= $_GET['id'];
$url 		= "https://api.themoviedb.org/3/movie/$id?api_key=9e51a426706d7dc458f162e67740c39f&language=es";

$videos		= "http://api.themoviedb.org/3/movie/$id/videos?api_key=9e51a426706d7dc458f162e67740c39f&language=es";

$feed		= json_decode(file_get_contents($url), true);
$feedVideo	= json_decode(file_get_contents($videos),true);




foreach ($feedVideo as $value) {
	foreach ($value as $valor) {
		echo "https://www.youtube.com/watch?v=" .$valor['key']. "<br>";
	}
}
echo "<br>";
$video = "";
echo "<br>";

echo "https://www.youtube.com/watch?v=" .$video;
$imagenes	= $feed['poster_path'];
echo $feed['overview'];
?>

<img src="https://image.tmdb.org/t/p/w500/<?php echo $imagenes ?>" alt="">
