<?php
function comprobarSession() {
	if (!isset($_SESSION)) session_start();

}
return comprobarSession();
?>