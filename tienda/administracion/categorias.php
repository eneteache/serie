
<?php
include ("../navegacion.php"); // Panel de navegacion y se inician las sesiones

include ("../funciones/comprobarUsuario.php"); // Denegar el acceso a usuarios normales
comprobarUsuario();
denegarInvitados();

include ("../funciones/funcionesSelect.php");
$conexion = conectarBD();

$resultado = mysqli_query($conexion, selectallCategorias());
$resultado2 = mysqli_query($conexion, selectallProductos());

?>

<p id="titulo">GESTIÓN DE CATEGORÍAS Y PRODUCTOS</p>
<!--No existe la factura. Error -->
		<?php if (isset($_SESSION['error'])): ?>
			<div class="container">
				<div class="row">
					<div class="alert alert-warning alert-dismissible fade in alerta" role="alert" id='errorDatos'>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4>Parece que ha ocurrido un error en MySQL: </h4>
					<p><?php echo $_SESSION['error']; unset($_SESSION['error']);?>
					</p>
					<p class="text-right">
						<a id="ejemplo" onclick="setTimeout(myfunction,200);" class="btn btn-link" data-dismiss="alert" aria-label="Close">Cerrar</a>
					</p>
					</div>
				</div>
			</div>
		<?php endif ?>
<!--<link rel="stylesheet" href="../css/ventanaModal.css">-->
<link rel="stylesheet" href="../css/categorias.css">

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
<div class="modal fade" id="categoriaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Introduce los datos de la nueva categoría</h4>
      </div>
      <div class="modal-body">
		<form action="crearCategoria.php" method="POST" id="crearCategoria">
			<div class='form-group'>
				<label for="nombreCategoria">Nombre de la categoría</label>
				<input type="text" class="form-control" name="nombreCategoria" id="nombreCategoria">
			</div>
		</form>
		</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" name="categoriaNueva" class="btn btn-primary" form="crearCategoria">Crear categoría</button>
      </div>
    </div>
  </div>
</div>


<!-- Crear productos -->
<div class="modal fade" id="productoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Introduce los datos del nuevo producto</h4>
      </div>
      <div class="modal-body">
		<form action="crearCategoria.php" method="POST" enctype="multipart/form-data" class="form-vert" id="crearProducto">
				<div class='form-group'>
					<label for="foto">Inserte una foto para el producto</label>
					<input id="foto" name="fotos[]" type="file" multiple required="true">
				</div>
				<div class='form-group'>
					<label for="categoria">Seleccione una categoría</label>
					<select name="categoria" id="marca" class="form-control">
			<?php 
			while ($valorCategoria = mysqli_fetch_array($resultado)){
						echo "<option value='{$valorCategoria['nombre']}'>{$valorCategoria['nombre']}</option>";
			}
			?>
					</select>
				</div>
				<div class='form-group'>
					<label for='nombreProducto'>Nombre del producto</label>
					<input type="text" name="nombreProducto" class="form-control" id="nombreProducto">
				</div>
				<div class='form-group'>
					<label for="marca">Marca</label>
					<input type="text" class="form-control" name="marca">
				</div>
				<div class='form-group'>
					<label for="precio">Precio</label>
					<input type="text" class="form-control" name="precio">
				</div>
				<div class='form-group'>
					<label for="descripcion">Descripción del producto</label>
					<input type="text" class="form-control" name="descripcion">
				</div>
				
		</form>
		</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" name="productoNuevo" class="btn btn-primary" form="crearProducto">Crear producto</button>
      </div>
    </div>
  </div>
 </div>

<!-- Listado de categorias -->
<div class="listado">
	<div class="encabezado">
		<p>CATEGORÍAS</p>
		<button type="button" class="abrir" data-toggle="modal" data-target="#categoriaModal">
  			Añadir categoría
		</button>
	</div>
	<div class="cuerpo">
		<table class="tabla">
			<tr class="titulos">
				<td>Nombre</td>
				<td>Total productos</td>
				<td class="opciones"><center>Opciones</center></td>


			</tr>
				<?php
				mysqli_data_seek($resultado, 0); 
				while ($linea = mysqli_fetch_array($resultado)) {
					echo "
			<tr>
				
				<td>{$linea['nombre']}</td>
				<td>{$linea['cantidad']}</td>
				<td>
					<center>
						<a title='Modificar categoría' href='editarCategoria.php?ID={$linea['id_categoria']}'>
						<span class='glyphicon glyphicon-edit'></span>
						</a>
						<a title='Eliminar categoría' href='eliminarCategoria.php?ID={$linea['id_categoria']}'>
							<span class='glyphicon glyphicon-trash'></span>
						</a>
					</center>
				</td>
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
		<button type="submit" class="abrir" data-toggle="modal" data-target="#productoModal">
  			Añadir producto
		</button>
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
				<td class="opciones"><center>Opciones</center></td>
			</tr>
			

			<?php
				while ($valorTabla  = mysqli_fetch_array($resultado2)) {
					echo "
				<tr>

					<td><img src='{$valorTabla['url']}' width='65px' height='62px'></td>
					<td>{$valorTabla['nombre']}</td>
					<td>{$valorTabla['marca']}</td>
					<td>{$valorTabla['categoria']}</td>
					<td>{$valorTabla['precio']} €</td>
					<td>{$valorTabla['descripcion']}</td>
					<td>{$valorTabla['f_creacion']}</td>
					<td>{$valorTabla['f_modificacion']}</td>
					<td>
  							<center>
								<a title='Modificar producto' href='editarProducto.php?ID={$valorTabla['id_producto']}'>
								<span class='glyphicon glyphicon-edit'></span>
								</a>
								<a title='Eliminar producto' href='eliminarProducto.php?ID={$valorTabla['id_producto']}'>
									<span class='glyphicon glyphicon-trash'></span>
								</a>
  							</center>
					</td>
				</tr>
					";
				}
			?>
			
		</table>
	</div>
</div>
</body>

