<?php 
session_start();
//unset($_SESSION["cualquiera variable"]);  

unset($_SESSION['invitado']);
unset($_SESSION["estado"]);
unset($_SESSION["id"]);
unset($_SESSION['nombre']);
unset($_SESSION['apellidos']);
unset($_SESSION["email"]);
unset($_SESSION['fecha_hora_entrada']);
unset($_SESSION['tipoUsuario']);
unset($_SESSION['superadmin']);
unset($_SESSION['faltanDatos']);

if (isset($_SESSION['posibleCompra'])) {
	if ($_SESSION['posibleCompra'] == true) {
		unset($_SESSION['posibleCompra']);
	}
}



header("Location: index.php");
?>