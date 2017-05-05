 <?php

include('../funciones/comprobarSession.php');
include("../funciones/bd.php");
$conexion = conectarBD();

$usuario = $_POST['usuario'];
$clave = addslashes($_POST['clave']);

$sql = "select * from usuarios where usuario= '$usuario';";
$result = mysqli_query($conexion, $sql);
//INICIO - COMPROBAR SI SE HAN INGRESADO DATOS DE LOGEO Y SI ES VÁLIDO EL usuario.
if ($usuario == null || $clave == null) {
	echo "Por favor, rellena todo los campos";
	exit();	
}

//FIN - COMPROBAR SI HAN INGRESADO DATOS DE LOGEO Y SI ES VÁLIDO EL usuario.


if (mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_array($result);
	if ((password_verify($clave, $row['clave'])) and ($row['bloqueado']) == 0) {
		date_default_timezone_set('Europe/Madrid'); 
		$fechaHora = date("Y-m-d H:i:s");
		
		//Variables de sesion
		$_SESSION['invitado'] = false;
		$_SESSION["estado"] = "";
		$_SESSION['nombre'] = $row['nombre'];
		$_SESSION['apellidos'] = $row['apellidos'];
		$_SESSION["usuario"] = $usuario;
		$_SESSION['fecha_hora_entrada'] = $fechaHora;
		$_SESSION['tipoUsuario'] = $row['tipoUsuario'];
		$_SESSION['superadmin'] = $row['superadmin'];

		if (isset($_SESSION['posibleCompra']) and $_SESSION['posibleCompra'] == "false") {
			$_SESSION['posibleCompra'] = "true";
		}

		//Variables de sesion

		$nEntradas = "update usuarios set nEntradas = nEntradas + 1 where usuario = \"" . $row['usuario'] . "\"";
		mysqli_query($conexion, $nEntradas);
		$ultimaVisita = "update usuarios set ultimaVisita = '$fechaHora' where usuario = \"" . $row['usuario'] . "\"";
		mysqli_query($conexion, $ultimaVisita);
        echo '<script>location.href = "../index.php"</script>';
	}
	else {
		$updatenErrores = "update usuarios set nErrores = nErrores + 1 where usuario = '{$row['usuario']}'";
		
		if ($row['nErrores']  >= 4  ){

			//Bloquear cuenta si tiene 4 errores
			$setblock = "update usuarios set bloqueado = 1 where usuario = '{$row['usuario']}'";
			mysqli_query($conexion, $setblock);
			echo "Por motivos de seguridad esta cuenta ha sido bloqueada.";
			exit();
		}
		else {

			$intentos = 4-$row['nErrores'];
			if ($row['nErrores'] == 0) {
				echo 'Los datos introducidos son incorrectos.';
				mysqli_query($conexion, $updatenErrores);
				exit();
			}

			if ($intentos > 1) {
				echo 'Los datos introducidos son incorrectos. Te quedan '. $intentos. ' intentos erroneos  para que esta cuenta sea bloqueada';
			}

			if ($intentos < 2) {
				echo 'Los datos introducidos son incorrectos. Te queda '. $intentos. ' intento erroneo  para que esta cuenta sea bloqueada';
			}			
		}
		mysqli_query($conexion, $updatenErrores);

	}

}
else {
	echo 'No existe esta cuenta en nuestro sistema.';
}
?>