 <?php

session_start();
include("funciones/funcionesConectarBD.php");
$conexion = conectarBD();

$correo = $_POST['email'];
$clave = $_POST['clave'];

$sql = "select * from usuarios where email= '$correo';";
$result = mysqli_query($conexion, $sql);
//INICIO - COMPROBAR SI SE HAN INGRESADO DATOS DE LOGEO Y SI ES VÁLIDO EL CORREO.
if ($correo == null || $clave == null) {
	echo "Por favor, rellena todo los campos";
	exit();	
}

if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    echo "Por favor, escribe una dirección de correo válida.";
    exit();
	}
//FIN - COMPROBAR SI HAN INGRESADO DATOS DE LOGEO Y SI ES VÁLIDO EL CORREO.


if (mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_array($result);
	if ((password_verify($clave, $row['clave'])) and ($row['bloqueado']) == 0) {
		date_default_timezone_set('Europe/Madrid'); 
		$fechaHora = date("Y-m-d H:i:s");
		
		//Variables de sesion
		$_SESSION['invitado'] = false;
		$_SESSION["estado"] = ""; 
		$_SESSION["id"] = $row['id_user'];
		$_SESSION['nombre'] = $row['nombre'];
		$_SESSION['apellidos'] = $row['apellidos'];
		$_SESSION["email"] = $correo;
		$_SESSION['fecha_hora_entrada'] = $fechaHora;
		$_SESSION['tipoUsuario'] = $row['tipoUsuario'];
		$_SESSION['superadmin'] = $row['superadmin'];

		if (isset($_SESSION['posibleCompra']) and $_SESSION['posibleCompra'] == "false") {
			$_SESSION['posibleCompra'] = "true";
		}

		//Variables de sesion

		$nEntradas = "update usuarios set nEntradas = nEntradas + 1 where email = \"" . $row['email'] . "\"";
		mysqli_query($conexion, $nEntradas);
		$ultimaVisita = "update usuarios set ultimaVisita = '$fechaHora' where email = \"" . $row['email'] . "\"";
		mysqli_query($conexion, $ultimaVisita);
        echo '<script>location.href = "login.php"</script>';
	}
	else {
		$updatenErrores = "update usuarios set nErrores = nErrores + 1 where id_user = {$row['id_user']}";
		mysqli_query($conexion, $updatenErrores);
		if ($row['nErrores']  >= 5  ){
			//Bloquear cuenta si tiene mas de 5 errores
			$setblock = "update usuarios set bloqueado = 1 where id_user = {$row['id_user']}";
			mysqli_query($conexion, $setblock);
			echo "Por motivos de seguridad tu cuenta ha sido bloqueada.";
			exit();
		}
		else {
		
		echo 'El usuario y/o clave son incorrectas, vuelva a intentarlo.';
		
		}
	}

}
else {
	echo 'No existe esta cuenta en nuestro sistema.';
}
?>