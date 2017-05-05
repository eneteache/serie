<?php
session_start();
if($_SESSION["logeado"] == "SI"){ 
header ("Location: inicio.php");
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
<table border="0" width="8%">
	<tr>
		<td>
  <b><font face="Verdana" size="1" color="#FFFFFF">Username:</font></b></td>
		<td>
		<form name="form1" method="post" action="entrar.php">
   <input name="username" type="text" id="username"></td>
	</tr>
	<tr>
		<td>
    <b><font face="Verdana" size="1" color="#FFFFFF">Password:</font></b></td>
		<td>
    <input name="password" type="password" id="password"></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>
		<p align="center">
     <input type="submit" name="Submit" value="Entrar"></form></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>
		<p align="center"><b><font face="Verdana" size="1" color="#FFFFFF">
		<a href="registro.php">
		<span style="text-decoration: none"><font color="#FFFFFF">Registrarse</font></span></a></font></b></td>
	</tr>
</table>
	</div>		
</body>
</html>