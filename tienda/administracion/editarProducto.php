<?php 
	include '../navegacion.php';
	$conexion = conectarBD();
	if (!isset($_GET['ID']))  {
		header('location: ../administracion/categorias.php');
		exit();
	}
	$id = $_GET['ID'];
	$sql = "select * from productos where id_producto='{$id}';";
	$result = mysqli_query($conexion, $sql);
	$datos = mysqli_fetch_array($result);

?>

<style>
	.container{
		padding-top: 10px;
		width: 70%;
	}
	.row{
		padding-right: 100px;
		padding-left: 100px;
	}
	.col-md-12 {
		padding-right: 170px;
		padding-left: 170px;
	}
	.contenedorForm{
		padding: 10px;
		border: 1px solid #bbb;
		border-radius: 5px;
	}
	#resultadoAccion {
		max-width: 500px;
		margin: 15px auto;
	}
	.foto {
		width: 90px;
		height: 88px;
	}

	/*Estilo input file*/
	.contenedorFoto {
		display: inline-block;
	}
	.image-preview-input {
    position: relative;
	overflow: hidden;
	margin: 0px;    
    color: #333;
    background-color: #fff;
    border-color: #ccc;    
}
.image-preview-input input[type=file] {
	position: absolute;
	top: 0;
	right: 0;
	margin: 0;
	padding: 0;
	font-size: 20px;
	cursor: pointer;
	opacity: 0;
	filter: alpha(opacity=0);
}
.image-preview-input-title {
    margin-left:2px;
}
	/*Fin de estilo input file*/
</style>

<script>
	function capturar()
    { 
    	var foto=document.getElementById("fotoProducto").value;
    	document.getElementById("resultadoFoto").innerHTML=foto;

    	var categoria=document.getElementById("categoriaProducto").value;
    	document.getElementById("resultadoCategoria").innerHTML=categoria;

    	var nombre=document.getElementById("nombreProducto").value;
    	document.getElementById("resultadoNombre").innerHTML=nombre;
    	
    	var marca=document.getElementById("marcaProducto").value;
    	document.getElementById("resultadoMarca").innerHTML=marca;

    	var precio=document.getElementById("precioProducto").value;
    	document.getElementById("resultadoPrecio").innerHTML=precio;

    	var descripcion=document.getElementById("descripcionProducto").value;
    	document.getElementById("resultadoDescripcion").innerHTML=descripcion;
    }

    /*Contador cuenta atrás*/
	var cuentaInicial = "4";
	function fin() {
	window.location="../administracion/categorias.php";
	}
	 
	function unoMenos() {
	with (
	document.forms["cuenta"]["regresiva"]) value = 'Será redireccionado a la página principal en '+cuentaInicial+' segundos.';
	if (
	cuentaInicial-- > 0
	)
	setTimeout("unoMenos()", 1000);
	else fin();
	}
	function ini() {
	with (
	document.forms["cuenta"]["regresiva"]) value = 'Será redireccionado a la página principal en '+cuentaInicial--+' segundos.';
	setTimeout("unoMenos()", 1000);
	}
	/* Fin del contador cuenta atrás*/

	/*codigo input file */
	$(document).on('click', '#close-preview', function(){ 
    $('.image-preview').popover('hide');
    // Hover befor close the preview
    $('.image-preview').hover(
        function () {
           $('.image-preview').popover('show');
        }, 
         function () {
           $('.image-preview').popover('hide');
        }
    );    
});

$(function() {
    // Create the close button
    var closebtn = $('<button/>', {
        type:"button",
        text: 'x',
        id: 'close-preview',
        style: 'font-size: initial;',
    });
    closebtn.attr("class","close pull-right");
    // Set the popover default content
    $('.image-preview').popover({
        trigger:'manual',
        html:true,
        title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
        content: "There's no image",
        placement:'bottom'
    });
    // Clear event
    $('.image-preview-clear').click(function(){
        $('.image-preview').attr("data-content","").popover('hide');
        $('.image-preview-filename').val("");
        $('.image-preview-clear').hide();
        $('.image-preview-input input:file').val("");
        $(".image-preview-input-title").text("Browse"); 
    }); 
    // Create the preview image
    $(".image-preview-input input:file").change(function (){   

        var img = $('<img/>', {
            id: 'dynamic',
            width:250,
            height:200
        });      
        var file = this.files[0];
        var reader = new FileReader();
        // Set preview image into the popover data-content
        reader.onload = function (e) {
            $(".image-preview-input-title").text("Change");
            $(".image-preview-clear").show();
            $(".image-preview-filename").val(file.name);            
            img.attr('src', e.target.result);
            $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
        }        
        reader.readAsDataURL(file);
    });  
});
	/*fin codigo input file*/

	/*tootlip*/
	$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
	/*fin tootlio*/
</script>

<?php

if (isset($_SESSION['resultadoAccion'])) {
	if ($_SESSION['resultadoAccion'] == 'error') {
		
		echo "
		<style>
			p#titulo {
				margin-bottom: 1xp;
			}
		</style>
		<div id='resultadoAccion'>
			<div class='alert alert-danger fade in alert-dismissable' style='margin-top:18px;'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>&times;</a>
			    <center><strong>¡Alerta!</strong>Ha ocurrido un error</center>
			    
			</div>
		</div>";
		
	}
	if ($_SESSION['resultadoAccion'] == 'correcto') {
		
		echo "
		<style>
			p#titulo {
				margin-bottom: 1xp;
			}
		</style>
		<div id='resultadoAccion'>
			<div class='alert alert-success fade in alert-dismissable' style='margin-top:18px;'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>&times;</a>
			    <center>¡Se han guardado los cambios correctamente!</center>
			    
					<div class='container-fluid' id='volver'>
						<form name='cuenta'>
							<input name='regresiva' type='text' size='55' readonly>
						</form>
						<script>
							ini('volver');
						</script>
					</div>
				
			</div>
		</div>";
		
	}
		
}
unset($_SESSION['resultadoAccion']);
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="contenedorForm">
				<form action="confirmareditarProducto.php" method="POST" enctype="multipart/form-data" class="form-vert" id='confirmar'>
				<div class="form-group">
					<label for='fotoProducto'>Foto principal del producto</label>
					<input type="hidden" value="<?php echo $datos['id_producto'] ?>" name='idProducto'>
					<div class="contenedorFoto">
						<!--Foto-->
						<div class="input-group image-preview">
			                <input type="text" class="form-control image-preview-filename" name='fotoProducto' value="<?php echo $datos['url'] ?>" id='fotoProducto' disabled="disabled"> <!-- No devolver un nombre === no se puede enviar a traves de POST o GET -->
			                <span class="input-group-btn">
			                    <!-- image-preview-clear button -->
			                    <button type="button" class="btn btn-default image-preview-clear" >
			                        <span class="glyphicon glyphicon-remove"></span> Borrar
			                    </button>
			                    <!-- image-preview-input -->
			                    <div class="btn btn-default image-preview-input">
			                        <span class="glyphicon glyphicon-folder-open"></span>
			                        <span class="image-preview-input-title">Buscar imagen</span>
			                        <input type="file" accept="image/png, image/jpeg, image/gif" name="fotoProducto"/> <!-- renombrar -->
			                    </div>
			                </span>

	           			 </div>
						<!--Foto-->
						
					</div>
				</div>
					

				
				<div class='form-group'>
					<label for="categoria">Seleccione una categoría</label>
					<select name="categoria" id="categoriaProducto" class="form-control">
			<?php 
			$sqlNombreCat = "select * from categorias";
			$resultadoCat = mysqli_query($conexion, $sqlNombreCat);
			$sql2 = "select categoria from productos where id_producto = {$id}";
			$result2 = mysqli_query($conexion, $sql2);
			$campo = mysqli_fetch_array($result2);
			while ($valorCategoria = mysqli_fetch_array($resultadoCat)){
						echo "<option value='{$valorCategoria['nombre']}'";
						if ($valorCategoria['nombre'] == $campo['categoria']) {
							echo " selected";
						} 
						
						echo ">{$valorCategoria['nombre']}</option>";
			}
			?>

					</select>
				</div>
				<div class='form-group'>
					<label for='nombreProducto'>Nombre del producto</label>
					<input type="text" name="nombre" class="form-control" id="nombreProducto" value="<?php echo $datos['nombre'] ?>" required>
				</div>
				<div class='form-group'>
					<label for="marcaProducto">Marca</label>
					<input type="text" name="marca" class="form-control"  id='marcaProducto' value="<?php echo $datos['marca'] ?>" required>
				</div>
				<div class='form-group'>
					<label for="precioProducto">Precio</label>
					<div class="input-group" id="precio">
					    <input type="number" name='precio' class="form-control" id='precioProducto' value="<?php echo $datos['precio'] ?>" required>
					    <div class="input-group-addon">€</div>
				    </div>
				</div>
				<div class='form-group'>
					<label for="descripcionProducto">Descripción del producto</label>
					<input type="text" name="descripcion" class="form-control" id='descripcionProducto' value="<?php echo $datos['descripcion'] ?>">
				</div>
				
				<div class="modal-footer">
					<a href="../administracion/categorias.php" type="button" class="btn btn-default" data-dismiss="modal">Volver sin guardar cambios</a>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirmarModal" onclick="capturar();">Guardar cambios</button>
				</div>

				</form>
			</div>
		</div>
	</div>
</div>


<style>
	.bloqueM{
		margin:0;
		padding-top: 20px;
		padding-bottom: 20px;

	}
	.mensaje {
		display: inline;
	}
</style>

  <div class="modal fade" id="confirmarModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        
		<!-- ventana alerta-->
        <div class='alert alert-danger fade in alert-dismissable bloqueM'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>&times;</a>
			<div class="modal-header">
        		<h4 class="modal-title" id="myModalLabel">MENSAJE DE CONFIRMACIÓN</h4>
      		</div>
      		<div class="modal-body">
      			<span class="glyphicon glyphicon-info-sign"></span>
      			<p class="mensaje">
					Los campos se guadarán con el siguiente contenido:
				</p>
				<ul style="padding-left: 18px;">
					<!-- foto producto -->
					<div><p class="mensaje">Foto </p>
										<p class="mensaje" style="padding-left: 5px; padding-right:10px;font-size: 11px;">
											<span class="glyphicon glyphicon-chevron-right"></span>
										</p>
										<p class="mensaje" id='resultadoFoto'></p></div>
					
					<!-- categoria producto -->
					<div><p class="mensaje">Categoría </p>
										<p class="mensaje" style="padding-left: 5px; padding-right:10px;font-size: 11px;">
											<span class="glyphicon glyphicon-chevron-right"></span>
										</p>
										<p class="mensaje" id='resultadoCategoria'></p></div>
					
					<!-- nombre producto -->
					<div><p class="mensaje">Nombre </p>
										<p class="mensaje" style="padding-left: 5px; padding-right:10px;font-size: 11px;">
											<span class="glyphicon glyphicon-chevron-right"></span>
										</p>
										<p class="mensaje" id='resultadoNombre'></p></div>
					
					<!-- marca producto --><div>
										<p class="mensaje">Marca </p>
										<p class="mensaje" style="padding-left: 5px; padding-right:10px;font-size: 11px;">
											<span class="glyphicon glyphicon-chevron-right"></span>
										</p>
										<p class="mensaje" id='resultadoMarca'></p></div>
					
					<!-- precio producto -->
<div>					<p class="mensaje">Precio </p>
					<p class="mensaje" style="padding-left: 5px; padding-right:10px;font-size: 11px;">
						<span class="glyphicon glyphicon-chevron-right"></span>
					</p>
					<p class="mensaje" id='resultadoPrecio'></p></div>

					<!-- descripcion producto -->
					<div>
						<p class="mensaje">Descripcion </p>
						<p class="mensaje" style="padding-left: 5px; padding-right:10px;font-size: 11px;">
							<span class="glyphicon glyphicon-chevron-right"></span>
						</p>
						<p class="mensaje" id='resultadoDescripcion'></p>
					</div>
				</ul>
      		</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<input type="submit" class="btn btn-danger" form='confirmar' value="Confirmar" name="confirmar">
			</div>
		</div>
        <!-- ventana alerta -->        

      </div>
    </div>
  </div>

