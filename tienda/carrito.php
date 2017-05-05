<?php
include ('navegacion.php');
?>
<style type="text/css">
	.table > tbody > tr.bordeColumna {
		border-bottom: 1px solid black;
	}
	tr.columnaTablaProductos {
		padding: 50px;
	}
	.container {
		padding-top: 50px;
		padding-left: 250px;
		padding-right: 250px;
	}
	.columnaPrincipal{
		text-align: center;
		max-width: 30px;
	}
	.table > thead > tr > th.columnaBorrarItem {
		border-bottom: 0px;
		max-width: 20px;
	}
	.table > tbody > tr > td.columnaBorrarItem {
		border-top: 0px;
		max-width: 20px;
		border-bottom: 0;
		text-align: right;
	}
	.table > tbody > tr > td.columnaTablaProductos {
		vertical-align: middle;
		font-size: 12px;
	}
	.table > tbody > tr > td.bordeColumna {
		border-bottom: 1px solid #ddd;
	}
	.table > tbody > tr > td.foto {
		width: 100px;
		padding: 5px;
	}
	.table > tbody > tr > td.columnaNombre {
		width: 270px;
		max-width: 270px;
	}
	div.contenedorFoto {
		width: 90px;
		height: 90px;
	}
	.total {
		font-size: 18px;
		font-weight: bold;
	}
	.precio {
		font-size: 15px;
		font-weight: bold;
	}
	.btn-finalizar {
		width: 100%;
	}
	.btn-finalizar > h3 {
		margin-top: 5px;
		margin-bottom: 5px;
	}
	.contenedorInterior {
		padding: 10px 5px 0px 5px;
	}
</style>

<?php
	
	function imprimirFilaProducto($id,$nombre,$precio, $cantidad,$imagen,$subtotal){
		echo "
			<tr>
					<td class='foto columnaTablaProductos bordeColumna'>
							<div class='contenedorFoto'>
									<img src='$imagen' alt='Error' class='img-thumbnail'>
							</div>
					</td>
					<td class='columnaTablaProductos columnaNombre bordeColumna'>$nombre</td>
					<td class='columnaPrincipal columnaTablaProductos bordeColumna'>$precio €</td>
					<td class='columnaPrincipal columnaTablaProductos bordeColumna'>$cantidad</td>
					<td class='columnaPrincipal columnaTablaProductos bordeColumna'>$subtotal €</td>
					<td class='columnaBorrarItem columnaTablaProductos'> <a href='eliminarItem.php?id=$id' data-toggle='tooltip' data-placement='right' title='¡Eliminar de la cesta'> <span class='glyphicon glyphicon-remove'></span></a></td>
			</tr>
		";
	}
include 'claseCarrito.php';
		$carrito = new Carrito();
?>
<?php
	
	if ( $carrito->getAll()) {
		
		
?>
<div class="container">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-body">
				<table class='table table-responsive'>
					<thead>
						<tr>
							<th class="foto" colspan="2"></th>
							<th class="columnaPrincipal">Precio</th>
							<th class="columnaPrincipal">Cantidad</th>
							<th class="columnaPrincipal">Subtotal</th>
							<th class="columnaBorrarItem" colspan="1"></th>
						</tr>
					</thead>
					<tbody>
						<?php
						
							$carrito->getAll('imprimirFilaProducto');
							
						?>
						<tr>
							<td colspan='2' style="position: relative;">
								
								<a href="../index.php" name="carrito" class='btn btn-default btn-finalizar' style="width: 68%; position: absolute; bottom: 8px;">
									<h3>
										<small>Seguir comprando</small>
									</h3>
								</a>
							</td>
							<td colspan='3'>
								<div class='container-fluid'>
									<div class='row contenedorInterior'>
										<div class='col-md-6 text-left total'>
											TOTAL:
										</div>
										<div class='col-md-6 text-right precio'>
											<?php
												echo $carrito->precio();
											?> €
										</div>
									</div>
									<div class='row contenedorInterior'>
										<form action="compra.php" method="POST" >
											<button type="submit" name="carrito" class='btn btn-default btn-finalizar'><h3><small>FINALIZAR COMPRA</small></h3></button>
										</form>
									</div>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
</div>
<?php
	} else {
?>
<div class="container">
	<center><h3>CARRITO DE LA COMPRA</h3>
	<h5><small>No hay articulos en la cesta</small></h5>
	<div style="width: 200px;">
		<a class="btn btn-default btn-finalizar" href="../index.php"><h3><small>Seguir comprando</small></h3></a>
	</div>
	</center>
</div>
<?php
	}
?>