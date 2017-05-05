<?php


function comprobarUsuario () {
	
	if (isset($_SESSION['estado'])) {
		if (($_SESSION['tipoUsuario']) != 'Administrador') {
			header("Location: ../index.php");
		}
		
	} 
	else { 
		$_SESSION['invitado'] = true;
	}
}

function denegarInvitados ()  {
	
	if ($_SESSION['invitado']){
		header("Location: ../index.php");
	}
}

function usuariosRegistrados() {
	if (isset($_SESSION['estado']) and $_SESSION['estado']=="") {
		return true;
	}else {
		return false;
	}	
}
?>