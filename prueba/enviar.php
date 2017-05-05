<?php
session_start();
include('config.php');
		if($_SESSION["logeado"] != "SI"){
		header ("Location: nologueado.htm");
		exit;
		}
		
		$id_user = $_SESSION["s_username"];
        $link = mysql_connect ($dbhost, $dbusername, $dbuserpass);
        mysql_select_db($dbname,$link);
		$queEmp = "SELECT * FROM invitacion WHERE de='$id_user'";
		$resEmp = mysql_query($queEmp, $link) or die(mysql_error());
		$totEmp = mysql_num_rows($resEmp);
		if($totEmp == $cantidad){
		header ("Location: noinivitaciones.htm");
		exit;
		}
		$mail = htmlentities($_POST['email']);
		$queEmp = "SELECT email FROM usuarios WHERE email='$mail'";
		$resEmp = mysql_query($queEmp, $link) or die(mysql_error());
		$totEmp = mysql_num_rows($resEmp);
		if($totEmp > 0){
		header ("Location: userreg.htm");
		exit();
		}
		$ale = rand(1,1000000);
		$hash = md5($ale);
		
// Para que ande este código php tienen que tener el hosting activado la funcion mail() activada
$nombre = htmlentities($_POST['nombre']);
$web = htmlentities($_POST['web']);
$mensaje = htmlentities($_POST['mensaje']);
$headers .= "From:Invitaciones Webs <info@webmaster.com>\r\n";  
# Esto es lo que va a aparecer en el mail cuando te llega
$message = "".$id_user." te ha invitado a formar parte de TUWEB
A partir de ahora serás miembro de nuestra web, y tendrás DOS invitaciones.

Sin más disfruta de tu estancia en nuestra web, y recuerda que cualquier intento de copia de la página, conllevará a un baneo por tiempo indefinido.

Ahora ya puedes registrarte, para ello pulsa el link que aparece aquí debajo.

*Recuerda que el duplicado de cuenta es motivo de baneo permanente y definitivo de la web*

¡Gracias!

http://".$tuweb."/validar.php?hash=".$hash."&mail=".$mail;

mysql_query("INSERT INTO invitacion (de,para,hash,valido)
        VALUES ('".$id_user."','".$mail."','".$hash."','true')",$link) or die('No se pudo conectar a la base de datos');
# Cambiar Formulario de Consulta por el asunto del mail, ejemplo: contacto desde mi web
if (mail($mail,"Invitación",$message,$headers))
header('Location: gracias.html');

?>