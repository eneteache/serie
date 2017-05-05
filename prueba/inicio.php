<?php
session_start();
if($_SESSION["logeado"] != "SI"){
header ("Location: index.php");
exit;
}
?>
<html>

<head>
<meta http-equiv="Content-Language" content="es">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Sistema de invitaciones</title>
<base target="_top">
<style type="text/css">
body,td,th {
	font-family: Verdana, Geneva, sans-serif;
	color: #FFF;
}
a:link {
	color: #FFF;
	text-decoration: none;
}
a:visited {
	color: #FFF;
	text-decoration: none;
}
a:hover {
	color: #FFF;
	text-decoration: none;
}
a:active {
	color: #FFF;
	text-decoration: none;
}
</style>
</head>

<body bgcolor="#333333">

<div align="center" style="font-size:10px;">
						<a href="cerrar.php">Cerrar sesión</a> / <a href="invitar.php">Enviar invitación</a></b>
</div>

Contenido solo para usuarios registrados

</body>

</html>
