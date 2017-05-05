<?php 
if (!session_start()){
		session_start();
	}

$_SESSION['faltanDatos'] = 'false';
echo $_SESSION['faltanDatos'];
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
