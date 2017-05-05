<?php
session_start();
include('config.php');
$hash = htmlentities($_GET['hash']);
$mail = htmlentities($_GET['mail']);
$link = mysql_connect ($dbhost, $dbusername, $dbuserpass);
        mysql_select_db($dbname,$link);
		
		$queEmp = "SELECT * FROM invitacion WHERE hash='$hash' and para='$mail' and valido='true'";
		$resEmp = mysql_query($queEmp, $link) or die(mysql_error());
		$totEmp = mysql_num_rows($resEmp);
		if($totEmp == 0){
		header ("Location: usada.htm");
		exit;
		}
		
		$_SESSION['VALIDO'] = "SI";
		$_SESSION['MAIL'] = $mail;
		
		mysql_query("UPDATE invitacion SET valido='false' WHERE hash='$hash'",$link);
		 
		header ("Location: registro.php");
		exit;
	
		
		
?>