<?php 
session_start();
//unset($_SESSION["cualquiera variable"]);  

unset($_SESSION['invitado']);
unset($_SESSION["estado"]);
unset($_SESSION["usuario"]);
unset($_SESSION['nombre']);
unset($_SESSION['apellidos']);
unset($_SESSION["email"]);
unset($_SESSION['fecha_hora_entrada']);
unset($_SESSION['tipoUsuario']);
unset($_SESSION['superadmin']);
unset($_SESSION['faltanDatos']);

header("Location: index.php");
?>