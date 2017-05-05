<?php

function datos($columna = 0) {
		$conexion = conectarBD();
		if ($columna == 0) {
			$columnas = "(nombre is null or apellidos is null or ndocumento is null or pais is null or provincia is null or ciudad is null or codigopostal is null or direccion is null)";
			$resultado = 'facturacion';

		}
		elseif ($columna == 1){
			$columnas = "(nombre_envio is null or apellidos_envio is null or ndocumento_envio is null or pais_envio is null or provincia_envio is null or ciudad_envio is null or codigopostal_envio is null or direccion_envio is null)";
			$resultado = 'envio';
		}
		elseif ($columna == 2){
			$columnas = "((nombre is null or apellidos is null or ndocumento is null or pais is null or provincia is null or ciudad is null or codigopostal is null or direccion is null) or (nombre_envio is null or apellidos_envio is null or 
			ndocumento_envio is null or pais_envio is null or provincia_envio is null or ciudad_envio is null or codigopostal_envio is null or direccion_envio is null))";
			$resultado = 'alguna';
		}

		$datosPrincipales = "select count(*) as nulo from usuarios where id_user={$_SESSION['id']} and $columnas";
		$arrayDatos = mysqli_fetch_array(mysqli_query($conexion, $datosPrincipales));
		return $arrayDatos['nulo'];
	}

?>
<script>
	 function myfunction() {
	 	location.href='ocultarAlerta.php'
 }
</script>