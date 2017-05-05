<?php
session_start();
if($_SESSION['VALIDO'] != "SI"){
header ("Location: usada.htm");
}
?>
<html>
<head>
<title>Sistema de invitacion</title>
</head>

<body bgcolor="#333333">

<div align="center">
&nbsp;<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>
</p>
	</div>		
<div align="center">
	<table border="0" width="15%">
		<tr>
			<td><b><font face="Verdana" size="1" color="#FFFFFF">Usuario:</font></b></td>
			<td>
  <label>
  <form name="form1" method="post" action="insertar.php">
  <input name="username" type="text" id="username0"></label></td>
		</tr>
		<tr>
			<td><b><font face="Verdana" size="1" color="#FFFFFF">Contraseña:</font></b></td>
			<td>
    <label>
      <input name="password" type="password" id="password"></label></td>
		</tr>
		<tr>
			<td><b><font face="Verdana" size="1" color="#FFFFFF">Repetir contraseña:</font></b></td>
			<td>
    <label>
      <input name="password2" type="password" id="password"></label></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
    <label>
    <input type="submit" name="Submit" value="Registrarse"></label></td>
    </form>
		</tr>
	</table>
</div>
</body>
</html>