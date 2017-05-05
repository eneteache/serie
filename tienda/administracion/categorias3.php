
<?php
include ("../navegacion.php"); // Panel de navegacion y se inician las sesiones
include ("../funciones/comprobarUsuario.php"); // Denegar el acceso a usuarios normales
comprobarUsuario();
denegarInvitados();
include ("../funciones/funcionesConectarBD.php");
include ("../funciones/funcionesSelect.php");
$conexion = conectarBD();

$resultado = mysqli_query($conexion, selectallCategorias());
$resultado2 = mysqli_query($conexion, selectallProductos());

?>

<p id="titulo">GESTIÓN DE CATEGORÍAS Y PRODUCTOS</p>
<link rel="stylesheet" href="../css/ventanaModal.css">
<link rel="stylesheet" href="../css/categorias.css">
<style>
	form {
		position: relative;
		display: block;
	}
	input[type='label'] {
		position: relative;
		display: block;
	}
</style>
<body>
<script>
	function desplegar(elemento){
		if (document.getElementsByClassName('bgventana')[elemento].style.display != 'block')  {
			document.getElementsByClassName('bgventana')[elemento].style.display='block';
		} else
		{
			document.getElementsByClassName('bgventana')[elemento].style.display='none';
		}

	}
</script>
<!-- Crear categoria -->

<div class="bgventana">
	<div class="ventana">
		<div class="contenedorCerrar">
		<a href="javascript:desplegar( 0);"  class="cerrar"> X </a>
		</div>
		<form action="crearCategoria.php" method="POST">
				<label for="nombreCategoria">Nombre de la categoría</label>
				<input type="text" name="nombreCategoria" id="nombreCategoria">
				<input type="submit" name="categoriaNueva">
		</form>
	</div>
</div>


<!-- Crear productos -->
<div class="bgventana">
	<div class="ventana">
	<div class="contenedorCerrar">
		<a href="javascript:desplegar(1);" class="cerrar"> X </a>
	</div>
	<form action="crearCategoria.php" method="POST" enctype="multipart/form-data">
			<input type="file" name="fotoProducto" id="foto">
			<label for="foto">Inserte una foto</label>
			
			<select name="categoria" id="marca">
	<?php 
	while ($valorCategoria = mysqli_fetch_array($resultado)){
				echo "<option value='{$valorCategoria['nombre']}'>{$valorCategoria['nombre']}</option>";
	}
	?>
			</select>
			<label for="categoria">Seleccione una categoría: </label>
			<input type="text" name="nombreProducto" id="nombreProducto">
			<label for='nombreProducto'>Nombre del producto: </label>
			<input type="text" name="marca">
			<label for="marca">Marca: </label>
			<input type="text" name="precio">
			<label for="precio">Precio: </label>
			<input type="text" name="descripcion">
			<label for="descripcion">Descripción del producto: </label>
			<input class="mui-btn mui-btn--raised" type="submit" name="productoNuevo">
	</form>
	</div>
</div>


<!-- Listado de categorias -->
<div class="listado">
	<div class="encabezado">
		<p>CATEGORÍAS</p>
		<a href="javascript:desplegar(0);" class="abrir">Crear categoría</a>
	</div>
	<div class="cuerpo">
		<table class="tabla">
			<tr class="titulos">
				<td class="marcar"><input type='checkbox'"></td>
				<td>Nombre</td>
				<td>Total productos</td>
				<td>Opciones</td>


			</tr>
				<?php
				mysqli_data_seek($resultado, 0); 
				while ($linea = mysqli_fetch_array($resultado)) {
					echo "
			<tr>
				<td>
					<input type='checkbox' value='{$linea['id_categoria']}'>
				</td>
				<td>{$linea['nombre']}</td>
				<td>{$linea['cantidad']}</td>
				<td></td>
			</tr>
						";
					}
				?>

		</table>
	</div>
</div>

<!-- Listado de productos -->
<div class="listado">
	<div class="encabezado">
		<p>PRODUCTOS</p>
		<a href="javascript:desplegar(1);" class="abrir">Añadir producto</a>
	</div>
	<div class="cuerpo">
		<table class="tabla">
			<tr class="titulos">
				<td>Imagen</td>
				<td>Nombre</td>
				<td>Marca</td>
				<td>Categoría</td>
				<td>Precio</td>
				<td>Descripcion</td>
				<td>Fecha creación</td>
				<td>Fecha modificación</td>
				<td>Opciones</td>
			</tr>
			<?php 
				while ($valorTabla  = mysqli_fetch_array($resultado2)) {
					echo "
					<tr>

						<td><img src='{$valorTabla['rutaImagen']}' width='65px' height='62px'></td>
						<td>{$valorTabla['nombre']}</td>
						<td>{$valorTabla['marca']}</td>
						<td>{$valorTabla['categoria']}</td>
						<td>{$valorTabla['precio']} €</td>
						<td>{$valorTabla['descripcion']}</td>
						<td>{$valorTabla['f_creacion']}</td>
						<td>{$valorTabla['f_modificacion']}</td>
						<td></td>
					</tr>
					";
				}
			?>
		</table>
	</div>
</div>
</body>



<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...ghg
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...vgg
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...hgvghgv
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>