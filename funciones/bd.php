<?php

function conectarBD() {

  $dbhost   = "localhost";
  $dbusuario  = "root";
  $dbpassword = "123456";
  $port   = "3306";
  $db     = "series";
  
  $conexion = mysqli_connect($dbhost . ":" . $port, $dbusuario, $dbpassword);
  if (!$conexion) die("Error al conectar al servidor:" . mysqli_error($conexion));
  if (!mysqli_select_db($conexion, $db)) die("No se pueda usar la BD: " . mysqli_error($conexion, $db));
  return $conexion;
  mysqli_close($conexion);
  
}
  
?>
  