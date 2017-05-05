<?php
function camposForm() {
	$contenido = array('usuario' => "", 'codigo' => "", 'correo' => "", 'clave' => "", 'clave2' => "");
	$contador = 0;
	foreach ($contenido as $key => $value) {
		if(array_key_exists($key,$_POST) ) {
			if (empty($_POST[$key])) {
				$contador = $contador + 1;
			} 
		}
	}

	if ($contador >= 1) {
		return true;
	}
}
?>