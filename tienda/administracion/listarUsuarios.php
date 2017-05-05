<?php 
	
	include ("../navegacion.php");
	include ("../funciones/comprobarUsuario.php");
	comprobarUsuario();
	denegarInvitados();
	$conexion = conectarBD();
	include ("../funciones/funcionesSelect.php");
	$selectall = selectall();
?>

<link rel="stylesheet" type="text/css" href="../css/categorias.css">

<style>
	#resultadoAccion {
		max-width: 475px;
		margin: 15px auto;
	}
	
</style>


<p id="titulo">GESTIÓN DE USUARIOS</p>

<?php
	if (isset($_SESSION['resultadoAccion'])) {
		if ($_SESSION['resultadoAccion'] == 'NoBorrarOtroAdmin') {
			echo "
			<style>
				p#titulo {
					margin-bottom: 1xp;
				}
			</style>
			<div id='resultadoAccion'>
				<div class='alert alert-danger fade in alert-dismissable' style='margin-top:18px;'>
				    <a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>&times;</a>
				    <center><strong>¡Alerta!</strong> No puedes borrar un usuario de tipo administrador.</center>
				</div>
			</div>";
			
		}
		

		if ($_SESSION['resultadoAccion'] == 'MismoUsuario') {
			echo "
			<style>
				p#titulo {
					margin-bottom: 1xp;
				}
			</style>
			<div id='resultadoAccion'>
				<div class='alert alert-danger fade in alert-dismissable' style='margin-top:18px;'>
				    <a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>&times;</a>
				    <center><strong>¡Alerta!</strong> No puedes borrarte</center>
				</div>
			</div>";
		}
		if ($_SESSION['resultadoAccion'] == 'correcto') {
			echo "
			<style>
				p#titulo {
					margin-bottom: 1xp;
				}
			</style>
			<div id='resultadoAccion'>
				<div class='alert alert-success fade in alert-dismissable' style='margin-top:18px;'>
				    <a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>&times;</a>
				    <center>¡El usuario se borro correctamente!</center>
				</div>
			</div>";
		}
		unset($_SESSION['resultadoAccion']);
	}

?>
<div class="listado">
	<div class="encabezado">
		<p>Usuarios</p>
	</div>
	<div class="cuerpo">
		<table class="tabla">
			<tr class="titulos">
				<td>ID</td>
				<td>Nombre</td>
				<td>Apellidos</td>
				<td>Email</td>
				<td>Ciudad</td>
				<td>País</td>
				<td>Tipo de usuario</td>
				<td>Nº de entradas</td>
				<td>Intentos erroneos</td>
				<td>Ultima entrada</td>
				<td class='opciones-l'><center>Opciones</center></td>
			</<tr>
			<?php
				$resultado = mysqli_query($conexion, $selectall);
				while ($row = mysqli_fetch_array($resultado)) {
					echo 
					"<tr>
						<td>{$row['id_user']}</td>
						<td>{$row['nombre']}</td>
						<td>{$row['apellidos']}</td>
						<td>{$row['email']}</td>
						<td>{$row['ciudad']}</td>
						<td>{$row['pais']}</td>
						<td>{$row['tipoUsuario']}</td>
						<td>{$row['nEntradas']}</td>
						<td>{$row['nErrores']}</td>
						<td>{$row['ultimaVisita']}</td>
						<td class='opciones-l'>
							<center>
								<a title='Modificar datos' href='editarusuario.php?ID={$row['id_user']}'>
									<span style='color:#CAD227;' class='icon-pencil'></span>
								</a>
								<a title='Modificar contraseña' href='setpass.php?ID={$row['id_user']}'>
									<span class='icon-key'></span>
								</a>";
							if ($row['bloqueado'] == 1) {
								echo "
								</a>
								<a title='Click para desbloquear' href='lockstatus.php?ID={$row['id_user']}'>
									<span style='color:red;' class='icon-lock'></span>
								</a>";
							}
							else {
								echo "
								<a title='Click para bloquear' href='lockstatus.php?ID={$row['id_user']}'>
									<span style='color:green;' class='icon-unlocked'></span>
								</a>
								";
							}
							echo "
								<a title='Eliminar usuario' href='eliminarusuario.php?ID={$row['id_user']}'>
									<span style='color:red;' class='glyphicon glyphicon-trash'></span>
								</a>
							</center>
						</td>
					</tr>";
				}
			?>
		</table>
	</div>
</div>
