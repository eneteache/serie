<?php

// Includes
include ('funciones/bd.php');
include ('funciones/formRegistro.php');
$conexion = conectarBD();


if (isset($_POST)) {
	
	if (camposForm()) {
		header("location: index.php");
		echo "falta un campo (?)";
	} else {

		//Comprobar que las dos claves coinciden
		if ($_POST['clave'] != $_POST['clave2']) {
			echo "Las contraseñas introducidas no coinciden.";
			exit();
		}

		// Recogida de datos
		$usuario 	= 	$_POST['usuario'];
		$codigo 	= 	$_POST['codigo'];
		$correo 	= 	$_POST['correo'];
		$clave 		= 	$_POST['clave'];

		// Comprobar la invitación.
		$codigoHash 		= md5($codigo);
		$claveEscapada		= addslashes($clave);
		$codigoEscapado		= addslashes($codigoHash);
		$correoEscapado		= addslashes($correo);
		$usuarioEscapado	= addslashes($usuario);
		$consultaUsuario	= "select usuario from usuarios where usuario = '{$usuarioEscapado}'";
		$consultaCorreo		= "select email from usuarios where email='{$correoEscapado}'";
		$sql_usuario		= "select codigo from invitaciones_usuario where codigo = '{$codigoEscapado}' ";
		$sql_email			= "select codigo from invitaciones_email where destino = '{$correoEscapado}' and codigo = '{$codigoEscapado}' and activo=1";
		
		if (mysqli_num_rows(mysqli_query($conexion, $consultaCorreo)) >= 1) {
			echo "Ya existe una cuenta con este correo. Si eres el propietario, puedes recuperarla haciendo click aquí";
			exit();
		}
		elseif (mysqli_num_rows(mysqli_query($conexion, $consultaUsuario)) >= 1) {
			echo "Ya existe una cuenta con este usuario. Si eres el propietario, puedes recuperarla haciendo click aquí";
			exit();
		} else {

			$resultado_usuario 	= mysqli_num_rows(mysqli_query($conexion, $sql_usuario));
			$resultado_email	= mysqli_num_rows(mysqli_query($conexion, $sql_email));

			if ($resultado_usuario > 0 or $resultado_email > 0) {
				
				$clavecifrada	= password_hash ($claveEscapada, PASSWORD_BCRYPT, array("salt" => "123456789salypimienta159753*"));
				$sqlRegistrar	= "INSERT INTO usuarios (usuario, clave, email) values('$usuarioEscapado', '$clavecifrada', '$correoEscapado');";
				mysqli_query($conexion,$sqlRegistrar);
				
				if (mysqli_error($conexion)) {
					echo "Parece que ha ocurrido un error.";
				} else {
					header('location: index.php');
				}
			}
			else {

				echo "El codigo de invitación no existe, ha caducado o no te corresponde.";
				
			}		
		}
	}

} else {
	
	header("location: index.php");
}



exit();
include('funciones/bd.php');
$conexion = conectarBD();


//Creacion de administrador por defecto
$administrador = "select tipoUsuario from usuarios where superadmin=1";
$resultadoAdministrador = mysqli_query ($conexion, $administrador);
$claveAdmin = password_hash (123456, PASSWORD_BCRYPT, array("salt" => "123456789salypimienta159753*"));

$insertAdminDefault = "insert into usuarios (nombre, apellidos, email, clave, tipoUsuario, superadmin) values('Admin', 'Admin', 'admin@proyecto.com', '$claveAdmin', 'Administrador', 1)";
//echo $insertAdminDefault ."</br>";
if (mysqli_num_rows($resultadoAdministrador) == 0) {
	mysqli_query ($conexion, $insertAdminDefault);
	echo "Se ha creado un usuario de tipo Superadministrador</br>";
}
// Fin de Creacion de administrador por defecto

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];
$clave = $_POST['clave'];

$clavecifrada = password_hash ($clave, PASSWORD_BCRYPT, array("salt" => "123456789salypimienta159753*"));

$insertUser = 	"insert into usuarios (nombre, apellidos, email, clave) values ('$nombre', '$apellidos', '$email', 
			'$clavecifrada')";
//echo $insertUser ."</br>";
$consultaCorreo = "select email from usuarios where email= '$email'";
$rCorreo = mysqli_query($conexion, $consultaCorreo);


if (mysqli_num_rows($rCorreo) == 0 ) {
	$error = mysqli_query($conexion, $insertUser);
	//echo $error;
	echo "Se ha creado el usuario correctamente. <a href=\"iniciosesion.php\">Click aquí para iniciar sesión.</a>
		";
	
} 
else {
	echo "Ya existe una cuenta con este correo";
	echo "<a href=\"formulario.php\">Volver al formulario</a>";
}

?>