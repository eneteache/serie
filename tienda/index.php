<?php
include 'navegacion.php';
?>

<link rel="stylesheet" href="../css/categorias.css">
<style>
	.container-apm{
		margin-top: 5px;
	}
	.columna {
		padding-left: 25px;
		padding-right: 25px;
		margin-bottom: 18px;
		height: 350px;
	}
	.producto {
		padding: 15px;
		background-color: white;
	}
	.imagenProducto {
		max-width: 195px;
		max-height: 180px;
	}
	.btn-carrito {
		padding-bottom: 1px;
		width: 100%;
	}
	.filaEncabezado {
		margin: 0;
		padding: 0;
		background-color: ;
		border-bottom: 1px solid grey;
	}
	.filaProducto {
		padding-top: 5px;
	}
	h2,h4 {
		margin-top: 9px;
		margin-bottom: 8px;
	}
	.divImg {
		height: 190px;
		display: flex;
	/* alineacion vertical */
	align-items: center;
	/* alineacion horizontal */
	justify-content: center;
	}
	.namePrice {
		height: 80px;
		color: #666565;

	}
	
	.namePrice > p{
		font-size: 13px;
		margin:0;

	}
	.namePrice > .name {
		height: 50px;
		justify-content: center;
	}
	.namePrice > .price {
		height: 30px;
		font-size: 20px;
		justify-content: center;
		font-weight: bold;
	}
	.namePrice > .price:hover {
		color:#303030;
	}
	.namePrice > .name {
		
		display: flex;
    /* flex-direction: column;*/
    align-items: center; 
    /* justify-content: center;*/
	}
	.namePrice > .name:hover{
		color: #454545;
	}
</style>
<?php
if (isset($_GET['categoria'])) {
	$cat = $_GET['categoria'];
	$sqlCategorias = "select nombre from categorias where nombre='{$cat}'";
	$r = mysqli_query($conexion, $sqlCategorias);
}
if (empty($_GET)) { ?>
<div class="container container-apm">
	<div class="contenedorInterno">
		<div class="row filaEncabezado">
			<div class="col-md-12">
				<h2>Todos los productos</h2>
			</div>
		</div>
		<div class="row filaProducto">
			<?php
			$consulta = "select * from productos";
			$resultado = mysqli_query($conexion, $consulta);
			while ($productos = mysqli_fetch_array($resultado)) {
			?>
			<div class="col-xs-6 col-sm-4 col-md-3 col-lg-3 columna">
				<div class="producto">
					<div class="container-fluid divImg img-thumbnail">
						<a href="producto.php?id=<?php echo $productos['id_producto']?>">
							<img  src="<?php echo $productos['url'] ?>"  class=" imagenProducto">
						</a>
					</div>
					<div class="namePrice">
						<p class="name text-center"><?php echo $productos['nombre'] ?></p>
						<p class="price text-center"><small><?php echo $productos['precio'] ?> €</small></p>
					</div>
					<?php
					echo "
					<form action='addCarrito.php' method='POST'>
									<input type='hidden' name='id' value='{$productos['id_producto']}'>
									<input type='hidden' name='cantidad' value='1'>
									<input type='hidden' name='rutaImagen' value='{$productos['url']}'>
									<input type='hidden' name='nombre' value='{$productos['nombre']}'>
									<input type='hidden' name='precioU' value='{$productos['precio']}'>
									<button type='submit' class='btn btn-default btn-carrito' data-toggle='modal' data-target='#productoModal'>
							<h4>Añadir al carrito <span class='glyphicon glyphicon-shopping-cart'></span></h4>
							</button>
					</form>
					";
					?>
					
				</div>
			</div>
			<?php
				}
			?>
		</div>
	</div>
</div>
<?php } ?>

<?php


if (!empty($_GET) and !array_key_exists('categoria', $_GET)) {
echo '
<div class="container">
		<div class="row">
				<div class="span12">
						<div class="hero-unit center">
								<h2>Página no encontrada<small><font face="Tahoma" color="red"> Error 404</font></small></h2>
								<br />
								<p>La categoría a la que estás intentando acceder no existe. Si crees que se trata de un error, <a href=""><b>ponte en contacto con nosotros</b></a> o prueba de nuevo en unos minnutos.</p>
								<p><b>Puedes pulsar el boton para salir de aquí:</b></p>
								<a href="index.php" class="btn btn-large btn-info"><i class="icon-home icon-white"></i>Llevame al Inicio.</a>
						</div>
				</div>
		</div>
</div>
';}
elseif (array_key_exists('categoria', $_GET) and mysqli_num_rows($r) == 0){
echo '
<div class="container">
	<div class="row">
		<div class="span12">
			<div class="hero-unit center">
				<h2>Página no encontrada<small><font face="Tahoma" color="red"> Error 404</font></small></h2>
				<br />
				<p>La categoría a la que estás intentando acceder no existe. Si crees que se trata de un error, <a href=""><b>ponte en contacto con nosotros</b></a> o prueba de nuevo en unos minnutos.</p>
				<p><b>Puedes pulsar el boton para salir de aquí:</b></p>
				<a href="index.php" class="btn btn-large btn-info"><i class="icon-home icon-white"></i>Llevame al Inicio.</a>
			</div>
		</div>
	</div>
</div>
	';


} elseif (array_key_exists('categoria', $_GET) and mysqli_num_rows($r) > 0) {?>
<div class="container container-apm">
	<div class="contenedorInterno">
		<div class="row filaEncabezado">
			<div class="col-md-12">
				<h2>Categoría: <?php echo $cat ?></h2>
			</div>
		</div>
		<div class="row filaProducto">
			<?php
			$consulta = "select * from productos where categoria='$cat'";
			$resultado = mysqli_query($conexion, $consulta);
			while ($productos = mysqli_fetch_array($resultado)) {
			?>
			<div class="col-xs-6 col-sm-4 col-md-3 col-lg-3 columna">
				<div class="producto">
					<div class="container-fluid divImg img-thumbnail">
						<a href="producto.php?id=<?php echo $productos['id_producto']?>">
							<img src="<?php echo $productos['url'] ?>"  class=" imagenProducto">
						</a>
					</div>
					<div class="namePrice">
						<p class="name text-center"><?php echo $productos['nombre'] ?></p>
						<p class="price text-center"><small><?php echo $productos['precio'] ?> €</small></hp>
					</div>
					<?php
					echo "
					<form action='addCarrito.php' method='POST'>
									<input type='hidden' name='id' value='{$productos['id_producto']}'>
									<input type='hidden' name='cantidad' value='1'>
									<input type='hidden' name='rutaImagen' value='{$productos['url']}'>
									<input type='hidden' name='nombre' value='{$productos['nombre']}'>
									<input type='hidden' name='precioU' value='{$productos['precio']}'>
									<button type='submit' class='btn btn-default btn-carrito' data-toggle='modal' data-target='#productoModal'>
							<h4>Añadir al carrito <span class='glyphicon glyphicon-shopping-cart'></span></h4>
							</button>
					</form>
					";
					?>
					
				</div>
			</div>
			<?php
				}
			?>
		</div>
	</div>
</div>
<?php } ?>