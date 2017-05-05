<?
// Configura los datos de tu cuenta
include('config.php');

session_start();

// Conectar a la base de datos
mysql_connect ($dbhost, $dbusername, $dbuserpass);
mysql_select_db($dbname) or die('No se puede seleccionar la base de datos');

if ($_POST['username']) {
//Comprobacion del envio del nombre de usuario y password
$username=htmlentities($_POST['username']);
$password=md5($_POST['password']);
if ($password==NULL) {
header ("Location: error_password.htm");
}else{
$query = mysql_query("SELECT username,password FROM usuarios WHERE username = '$username'") or die(mysql_error());
$data = mysql_fetch_array($query);
if($data['password'] != $password) {
echo "Contraseña incorrecta";
}else{
$query = mysql_query("SELECT username,password FROM usuarios WHERE username = '$username'") or die(mysql_error());
$row = mysql_fetch_array($query);
$_SESSION["s_username"] = $row['username'];
$_SESSION["logeado"] = "SI";
header ("Location: inicio.php");
}
}
}
?> 