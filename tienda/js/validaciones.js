

function validarForm(){ 

var valuepais = document.getElementById("codigo");
var resultado = valuepais.selectedIndex;

var clave1 = document.getElementById("clave").value;
var clave2 = document.getElementById("clave2").value;

if ( resultado == 0){
	document.getElementById('error').innerHTML = 'Error: Debes seleecionar un pais';
	return false;
}
if (clave1 != clave2) {
	//alert("Las contraseñas introducidas no coiciden");
	document.getElementById('error').innerHTML = 'Error: La contraseña no coicide.';
	return false;
}
}


//var nombre = document.getElementById("nombre").value;
//var miDiv = document.getElementById("miDiv");

//if (nombre == "") {
		//miDiv.innerHTML = "";
		//html = "Debe introducir el nombre";
		//miDiv.innerHTML = html;

		//return false;
	//}

