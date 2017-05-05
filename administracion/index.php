<!--<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>

	<script>
		$(document).ready(function(){
		
			// generamos un evento cada vez que se pulse una tecla
			$("input[name=boton]").click(function(){
			//$("#id").keyup(function(){
			
				// enviamos una petición al servidor mediante AJAX enviando el id
				// introducido por el usuario mediante POST
				$.post("miarchivo.php", {"id":$("#id").val()}, function(data){
				
					// Si devuelve un nombre lo mostramos, si no, vaciamos la casilla
					if(data.title)
						$("#titulo").val(data.title);
					else
						$("#titulo").val("");
						
					// Si devuelve un apellido lo mostramos, si no, vaciamos la casilla
					//if(data.apellidos)
					//	$("#apellidos").val(data.apellidos);
					//else
					//	$("#apellidos").val("");

				},"json");
			});
		});
	</script>
	
	<style>
	#miFormulario span {width:100px;display:inline-block;}
	</style>
</head>

<body>

<form id="miFormulario" name="miFormulario">
	<div><span>ID:</span><input type="text" name="id" id="id" value=""> (introduce el id 10)</div>
	<div><span>Nombre:</span><input type="text" name="title" id="titulo" value=""></div>
	<div><span>Apellidos:</span><input type="text" name="apellidos" id="apellidos" value=""></div>
	<div><input type="button" name="boton" value="Buscar"></div>
</form>

</body>
</html>


<progress id="progress" value="0"></progress>
<button id="button">Start uploading</button>
<span id="display"></span>

<script type="text/javascript">
var progressBar = document.getElementById("progress"),
  loadBtn = document.getElementById("button"),
  display = document.getElementById("display");

function upload(data) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "https://api.themoviedb.org/3/movie/123?api_key=9e51a426706d7dc458f162e67740c39f&language=es", true);
  if (xhr.upload) {
    xhr.upload.onprogress = function(e) {
      if (e.lengthComputable) {
        progressBar.max = e.total;
        progressBar.value = e.loaded;
        display.innerText = Math.floor((e.loaded / e.total) * 100) + '%';
      }
    }
    xhr.upload.onloadstart = function(e) {
      progressBar.value = 0;
      display.innerText = '0%';
    }
    xhr.upload.onloadend = function(e) {
      progressBar.value = e.loaded;
      loadBtn.disabled = false;
      loadBtn.innerHTML = 'Start uploading';
    }
  }
  xhr.send(data);
}

function buildFormData() {
  var fd = new FormData();

  for (var i = 0; i < 3000; i += 1) {
    fd.append('data[]', Math.floor(Math.random() * 999999));
  }

  return fd;
}

loadBtn.addEventListener("click", function(e) {
  this.disabled = true;
  this.innerHTML = "Uploading...";
  upload(buildFormData());
});
</script>
-->
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Leer recursivamente un json bidimensional</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
 
	<script>
	var miJSON={
		"A1":{"valor":"100", "color":"azul", "caracteristica":{"tipo":"S1","ref":"MMM"}},
		"A2":{"valor":"110", "color":"rojo", "caracteristica":{"tipo":"S2","ref":"NNN"}},
		"A3":{"valor":"120", "color":"negro", "caracteristica":{"tipo":"S3","ref":"OOO"}},
		"A4":{"valor":"90", "color":"verde", "caracteristica":{"tipo":"S4","ref":"PPP"}},
	}
 
	$(document).ready(function(){
		$.each(miJSON, function(i,item){
			document.write("<br>"+i+" - "+miJSON[i].valor+" - "+miJSON[i].color+" - "+miJSON[i].caracteristica.tipo+" - "+miJSON[i].caracteristica.ref);
		})
	})
	</script>
</head>
<body>
 
</body>
</html>