<?php
	include ("navegacion.php");
    $conexion = conectarBD();
    $query = "select id_pais, pais from paises order by pais asc";
	$resultado = mysqli_query ($conexion, $query);
	
?>
<html>
<title>Formulario de registro</title>
<head>
</head>
<script type="text/javascript" src="js/validaciones.js"></script>
<link href= "css/formulario.css" rel= "stylesheet" type= "text/css">
    <div class="formulario">
		<form onSubmit="return validarForm();" action= "registro.php" method= "post">
			<h3>FORMULARIO DE REGISTRO</h3>
			<input type="text" name= "nombre" placeholder= "Nombre" maxlength="30" required="" >
			<input type="text" name= "apellidos" placeholder= "Apellidos" maxlength= "80">
			<input type="email" name= "email" placeholder= "Correo electronico" maxlength= "80" required="">
			<!-- valores nulos
			<input type="text" name= "ciudad" placeholder= "Ciudad" maxlength= "50" required="">
			<select name= "valorpais" id="codigo">
				<option value= '0'>Selecciona un país</option>
				<?php
				//while ($valor = mysqli_fetch_array($resultado)) {
					//echo "<option value='{$valor['id_pais']}'>{$valor['pais']}</option>";
				 // }
				?>
			</select>
			valores nulos-->
			<input type="password" name= "clave" id= "clave" placeholder= "Contraseña" minlength="6" maxlength= "100" required >
			<input type="password" name= "confirmarClave" id= "clave2" placeholder= "Confirmar contraseña" minlength="6" maxlength="100" required>
			<div id="error"></div>
			<div id="idcorrecto"></div>
			<input type="submit" value= "Registrar">
			<div class="opciones">
				<a href="iniciosesion.php">Ya tengo cuenta</a>
			</div>

		</form>
	</div>	


<html>