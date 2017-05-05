<?php
# Esta página recibe por post el id del formulario.
#
# Para nuestro ejemplo, devolvemos un valor para el id 10, pero aqui se tendria
# que realizar la busqueda en la base de datos en busca del registro.
#

if($_POST["id"]=="10")
{
	echo json_encode(array("nombre"=>"juan", "apellidos"=>"martinez exposito"));
}else{
	echo json_encode(array("nombre"=>"", "apellidos"=>""));
}
?>
