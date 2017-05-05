<?php
session_start();
include('config.php');
		if($_SESSION["logeado"] != "SI"){
		header ("Location: nologueado.htm");
		}
		$id_user = $_SESSION["s_username"];
        $link = mysql_connect ($dbhost, $dbusername, $dbuserpass);
        mysql_select_db($dbname,$link);
		$queEmp = "SELECT * FROM invitacion WHERE de='$id_user'";
		$resEmp = mysql_query($queEmp, $link) or die(mysql_error());
		$totEmp = mysql_num_rows($resEmp);
		$arree = $cantidad-$totEmp;
?>
<html>
<head>
<title>Enviar invitacion</title>
</head>

<body bgcolor="#333333">
<div align="center">
<table border="0" width="34%">
		<tr>
			<td>
			<p align="center"><font face="Impact" size="5" color="#FF6600">ENVÍA 
			UNA INVITACIÓN</font><form id="form1" name="form1" method="post" action="enviar.php">
<p align="center"><u><b><font face="Verdana" size="1" color="#FFFFFF">IMPORTANTE 
LEER:</font></b></u></p>
<p align="center"><b><font face="Verdana" size="1" color="#FFFFFF">Recuerda que 
el duplicado de cuentas es motivo de baneo permanente e inmediato de la web.</font></b></p>
<p align="center"><font face="Verdana" size="1" color="#FFFFFF">Te quedan 
<strong style="font-weight: 400"><?=$arree?> </strong>
<br>
<br>
Email:</font><br />
<input name="email" type="text" id="email" />
<br>
<br />
<label>
<input type="submit" name="Submit" value="Enviar" />
</label>
</p>
</form></td>
		</tr>
	</table>
</div>
</body>
</html>