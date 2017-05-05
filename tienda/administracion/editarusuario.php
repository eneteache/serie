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

	$selectallPaises = selectallPaises();
	$rselectallPaises = mysqli_query($conexion, $selectallPaises);

	$selectall = selectallbyID($identificador);
	$rselectall = mysqli_query($conexion, $selectall);
	$campo = mysqli_fetch_array($rselectall);

?>


<script type="text/javascript" src="js/validaciones.js"></script>
<link href= "../css/formulario.css" rel= "stylesheet" type= "text/css">
    <div class="formulario">
		<form onSubmit="return validarPasswd()" action= "editarusuario1.php" method= "post">
			<h3>MODIFICAR USUARIO</h3>
			<input type= "hidden" name="usuarioeditar" value= "<?php echo $campo['id_user']?>">
			<input type="text" name= "nombre" placeholder= "Nombre" value="<?php echo $campo['nombre']?>" maxlength="30" required>
			<input type="text" name= "apellidos" placeholder= "Apellidos" value="<?php echo $campo['apellidos']?>" maxlength= "80">
			<input type="email" name= "email" value="<?php echo $campo['email']?>" maxlength= "80" disabled>
			<input type="text" name= "ciudad" placeholder= "Ciudad" value="<?php echo $campo['ciudad']?>" maxlength= "50">
			<select name= "valorpais" id="codigo">
				<option value= '0'>Selecciona un país</option>
				<?php
				while ($valor = mysqli_fetch_array($rselectallPaises)) {
					echo "<option value='{$valor['id_pais']}'";
						if ($valor['id_pais'] == $campo['pais']){
						echo "selected";
						} 
					echo ">{$valor['pais']}</option>";
				  }
				
				?>

			</select>
			<select name="valorTipoUsuario">
				<?php
					if ($campo['tipoUsuario'] == 'Administrador') {

						echo "<option value='Administrador'selected>Administrador</option>";
						echo "<option value='Usuario' >Usuario</option>";
					}
					else{
						echo "<option value='Administrador'>Administrador</option>";
						echo "<option value='Usuario' selected>Usuario</option>";
					}
				?>
			</select>
			<div id="error"></div>
			<div id="idcorrecto"></div>
			<input type="submit" name='editarusuario' value= "Guardar cambios">
		</form>
	</div>