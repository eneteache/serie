<?php
session_start();
	if (($_SESSION['tipoUsuario']) != 'Administrador') {
		header("Location: ../index.php");
		exit();
	}
	$identificador = $_GET['ID'];
	include("../funciones/funcionesConectarBD.php");
	include("../funciones/funcionesSelect.php");
	$conexion = conectarBD();

	$selectall = selectallbyID($identificador);
	$rselectall = mysqli_query($conexion, $selectall);
	$campo = mysqli_fetch_array($rselectall);


?>

<script>
function validarPasswd(){ 
var clave1 = document.getElementById("clave").value;
var clave2 = document.getElementById("clave2").value;

if (clave1 != clave2) {
	//alert("Las contraseñas introducidas no coiciden");
	document.getElementById('error').innerHTML = 'Error: La contraseña no coicide.';
	return false;
}
}
</script>

<link href= "../css/formulario.css" rel= "stylesheet" type= "text/css">

<div class="formulario">
	<form onSubmit="return validarPasswd()" action= "setpass1.php" method= "post">
		<h3>Modificar contraseña</h3>
		<input type="hidden" name= "email" value="<?php echo $campo['email'] ?>" >
		<input type="email" value="<?php echo $campo['email'] ?>" disabled>
		<input type="password" name= "clave" id= "clave" placeholder= "Nueva contraseña" minlength="6" maxlength= "100" required >
		<input type="password" name= "confirmarClave" id= "clave2" placeholder= "Confirmar nueva contraseña" minlength="6" maxlength="100" required>
		<div id="error"></div>
		<input type="submit" value= "Guardar cambios">
		<div class="opciones">
			<a href="../administracion/listarUsuarios.php">Volver</a>
		</div>

	</form>
</div>
