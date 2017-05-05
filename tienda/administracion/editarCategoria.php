<?php 
	include '../navegacion.php';
	$conexion = conectarBD();
	if (!isset($_GET['ID']))  {
		header('location: ../administracion/categorias.php');
		exit();
	}
	$id = $_GET['ID'];
	$sql = "select * from categorias where id_categoria='{$id}';";
	$result = mysqli_query($conexion, $sql);
	$datos = mysqli_fetch_array($result);

?>

<style>
	.container{
		padding-top: 10px;
		width: 65%;
	}
	.row{
		padding-right: 100px;
		padding-left: 100px;
	}
	.col-md-12 {
		padding-right: 200px;
		padding-left: 200px;
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
</style>
<script>
	function capturar()
    {
    	var porId=document.getElementById("nombreCategoria").value;
    	document.getElementById("resultadoNombre").innerHTML=porId;
    }


	var cuentaInicial = "6";
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
				<form action="confirmareditarCategoria.php" method="POST" enctype="multipart/form-data" class="form-vert" id='confirmar'>
					<div class='form-group'>
						<input type="hidden" name="idCategoria" value="<?php echo $datos['id_categoria'] ?>">
						<label for='idCategoria'>Identificador de categoría</label>
						<input type="text" class="form-control" id="idCategoria" value="<?php echo $datos['id_categoria'] ?>" readonly disabled>
					</div>
					<div class='form-group'>
						<label for="nombre">Nombre de la categoría</label>
						<input type="text" class="form-control" name="nombre" value="<?php echo $datos['nombre']; ?>" id='nombreCategoria'>
					</div>

					<div class="modal-footer">
						<a href="../administracion/categorias.php" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
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
					La categoría <?php echo " '{$datos['nombre']}' " ?> será modificada por
				</p>
				'<p class="mensaje" id='resultadoNombre'></p>'
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





