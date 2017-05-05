<?php
include('funciones/funcionesConectarBD.php');
$conexion = conectarBD();

$createTableUsuarios = "CREATE TABLE IF NOT EXISTS usuarios(

id_user INT NOT NULL AUTO_INCREMENT,
nombre CHAR(30) NOT NULL,
apellidos CHAR(80) NULL,
ndocumento CHAR(9) NULL,
email CHAR(80) NOT NULL,
fotoUsuario CHAR(100) NOT NULL DEFAULT '../imagenes/sinfoto.jpg',
pais INT NULL,
provincia CHAR(50) NULL,
ciudad CHAR(50) NULL,
codigopostal INT(5) NULL,
direccion CHAR(200) NULL,
clave CHAR(100) NOT NULL,
nombre_envio CHAR(30) NULL,
apellidos_envio CHAR(80) NULL,
ndocumento_envio CHAR(9) NULL,
pais_envio INT NULL,
provincia_envio CHAR(50) NULL,
ciudad_envio CHAR(50) NULL,
codigopostal_envio INT(5) NULL,
direccion_envio CHAR(200) NULL,
tipoUsuario ENUM('Usuario', 'Administrador', 'Superadministrador') NOT NULL,
fechaAlta DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
nEntradas INT NOT NULL DEFAULT 0,
nErrores INT NOT NULL DEFAULT 0,
ultimaVisita DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
bloqueado BOOLEAN NOT NULL DEFAULT 0,
superadmin BOOLEAN NOT NULL DEFAULT 0,
PRIMARY KEY (id_user),
FOREIGN KEY(pais) REFERENCES paises(id_pais)
ON UPDATE CASCADE
ON DELETE CASCADE,
FOREIGN KEY(pais_envio) REFERENCES paises (id_pais)
ON UPDATE CASCADE
ON DELETE CASCADE)
ENGINE= InnoDB;";



mysqli_query ($conexion, $createTableUsuarios);
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