<?
include('config.php');
session_start();
if($_SESSION['VALIDO'] != "SI"){
header ("Location: usada.htm");
exit;
}
    // Primero comprobamos que ningún campo esté vacío y que todos los campos existan.
    if(isset($_POST['username']) && !empty($_POST['username']) &&
    isset($_POST['password']) && !empty($_POST['password2'])) {
	if($_POST['password'] == $_POST['password2']){
        // Si entramos es que todo se ha realizado correctamente
		$password = md5($_POST['password']);
		$username = htmlentities($_POST['username']);
        $link = mysql_connect ($dbhost, $dbusername, $dbuserpass);
        mysql_select_db($dbname,$link);
		$queEmp = "SELECT username FROM usuarios WHERE username='$username'";
		$resEmp = mysql_query($queEmp, $link) or die(mysql_error());
		$totEmp = mysql_num_rows($resEmp);
		if($totEmp > 0){
		header ("Location: namereg.htm");
		exit();
		}
		$mail = $_SESSION['MAIL'];
		$queEmp = "SELECT email FROM usuarios WHERE email='$mail'";
		$resEmp = mysql_query($queEmp, $link) or die(mysql_error());
		$totEmp = mysql_num_rows($resEmp);
		if($totEmp > 0){
		header ("Location: userreg.htm");
		exit();
		}
        // Con esta sentencia SQL insertaremos los datos en la base de datos
        mysql_query("INSERT INTO usuarios (username,password,email)
        VALUES ('{$username}','{$password}','{$mail}')",$link);
		unset($_SESSION['VALIDO']);
		unset($_SESSION['MAIL']);
        // Ahora comprobaremos que todo ha ido correctamente
        $my_error = mysql_error($link);

        if(!empty($my_error)) {

		header ("Location: norellenar.htm");

        } else {

		header ("Location: felicidades.htm");

        }
	} else { header ("Location: norellenar.htm"); }
    } else {

		header ("Location: norellenar.htm");

    }

?>