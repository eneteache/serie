<?php
	include ("navegacion.php");
    $conexion = conectarBD();
    $query = "select id_pais, pais from paises";
	$resultado = mysqli_query ($conexion, $query);
	include ("funciones/comprobarUsuario.php");
	comprobarUsuario();

	
?>
<html>
<title>Formulario de registro</title>

<script type="text/javascript" src="js/jquery.min.js"></script>
<link href= "css/formulario.css" rel= "stylesheet" type= "text/css">
<body>
    <div class="formulario">
		<form method= "post" onsubmit="return false" action= "return false" id="form">
			<h3>INICIAR SESIÓN</h3>
			<input type="email" name= "email" id= "email"  placeholder= "Correo electronico" maxlength= "80" required autofocus>
			<input type="password" name= "clave" id= "clave" placeholder= "Contraseña" maxlength="120" required>
			<div id= "error"></div>
			<input type= "submit" value="Iniciar sesión" onclick=" validarLogin(document.getElementById('email').value, document.getElementById('clave').value);">
			<div class="opciones">
				<a href="formulario.php">Registrarme</a>
				<a href="iniciosesion.php">He olvidado la contraseña</a>
			</div>
		</form>
	</div>
	<script>
	function formReset(){
	document.getElementById("form").reset();
	}

	function validarLogin(email, clave)
        {
            $.ajax({
                url: "validarInicio.php",
                type: "POST",
                data: "email="+email+"&clave="+clave,
                success: function(resp){
                $('#error').html(resp)
                $("input[type='password']").val('');
                }       
            });
        }  
    </script>
</body>
<html>