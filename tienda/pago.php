<?php
	
	include_once ('funciones/comprobarUsuario.php');
	include 'claseCarrito.php';
	$carrito = new Carrito();
	if (!$carrito->getAll()) {
		header('location: ../carrito.php');
	}
	include ('navegacion.php');
	include_once ('funciones/comprobarUsuario.php');
	$conexion = conectarBD();
	global $conexion;
	include 'funciones/faltanDatos.php';
	include 'funciones/funcionesSelect.php';
	
	if (usuariosRegistrados() == false) {
		header('location: ../carrito.php');
	}
	if (isset($_SESSION['tipoUsuario'])) {
		if (!$_SESSION['tipoUsuario'] == 'Usuario') {
			header('location: ../carrito.php');
		}
	}
	
		

	
	if (datos(2)){
		if (!isset($_SESSION['faltanDatos'])) {
			$_SESSION['faltanDatos'] = 'true';
		}
	};

	/* consultas al carritp */
	$precio = $carrito->precio();
	/*consultas al carrito */
	function imprimirFilaProducto($id,$nombre,$precio, $cantidad,$imagen,$subtotal){
	echo "
		<tr>
<td class='columnaTablaProductos columnaNombre bordeColumna'>$nombre</td>
<td class='columnaPrincipal columnaTablaProductos bordeColumna'><center>$precio €</center></td>
<td class='columnaPrincipal columnaTablaProductos bordeColumna'><center>$cantidad</center></td>
<td class='columnaPrincipal columnaTablaProductos bordeColumna'><center>$subtotal €</center></td>
<td class='columnaBorrarItem columnaTablaProductos'> <a href='eliminarItem.php?id=$id' data-toggle='tooltip' data-placement='right' title='¡Eliminar de la cesta'> <span class='glyphicon glyphicon-remove'></span></a></td>
		</tr>
	";
	}
	/*consultas */
	$conexion = conectarBD();
	$datosPrincipales 	= "select * from usuarios where id_user={$_SESSION['id']}";
	$arrayDatos 		= mysqli_fetch_array(mysqli_query($conexion, $datosPrincipales));
	$queryPais 			= "select * from paises";
	$resultadoPais 		= mysqli_query($conexion, $queryPais);
	$queryDatosPais 	= "select * from paises where id_pais = (select pais from usuarios where id_user={$_SESSION['id']});";
	$queryDatosPais2 	= "select * from paises where id_pais = (select pais_envio from usuarios where id_user={$_SESSION['id']});";
	$arrayDatosPais = mysqli_fetch_array(mysqli_query($conexion, $queryDatosPais));
	$arrayDatosPais2 = mysqli_fetch_array(mysqli_query($conexion, $queryDatosPais2));
	/*fin consultas */
	
?>
<style>
	@media (min-width: 1000px) {
		.container {
			width: 100%;
		}
		.container-apm{
			width: 100%;
		}
	}
	.container-apm {
		padding-top: 30px;
	}
	.divAlerta{
		padding-right: 90px;
		padding-left: 105px;
	}
	.columnaPrincipal{
		text-align: center;
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
	
	
	.contenedorInterior {
		background-color: #FDFDFD;
		padding: 10px;
		margin-bottom: 15px;
	}
	
	#bloqueIzquierda {
		padding-left: 50px;
		padding-right: 15px;
		padding-top: 10px;
		padding-bottom: 30px;
	}
	#bloqueDerecha {
		padding-left: 15px;
		padding-right: 50px;
		padding-top: 10px;
	}
	.TuCarrito{
		float: left;
	}
	
	.divInline {
		display: inline-block;
	}
	
	.btn-finalizar {
		width: 100%;
	}
	.btn-finalizar > h3 {
		margin-top: 5px;
		margin-bottom: 5px;
	}
	.alinearDerecha {
		float: right;
	}
	div.divInline > .TuCarrito {
		vertical-align: middle;
	}
	.titulo {
		
	}
	h4.datos {
		margin: 5px;
		padding-bottom: 0px;
		font-family: 'Montserrat', sans-serif;
		
	}
	.contenido {
		padding-left:10px;
		padding-right: 10px;
		color: #7F7F7F;
		margin-top: 5px;
	}
	.tituloEncabezado {
		padding-left:10px;
		padding-left: 10px;
		border-bottom: 1px solid #7F7F7F;
	}
	.editar {
		float: right;
		font-size: 12px;
		margin-bottom: 0;
	}
	.columnaDatos {
		padding-top: 5px;
	}
	.finalizar {
		width: 100%;
		max-width: 100%;
		border-radius: 0;
		height: 55px;
	}
	.finalizar > h3 {
		margin: 0;
		padding: 0;
		vertical-align: middle;
	}
</style>
<div class="container">
	<div class="container-apm">
		<div class="row divAlerta">
			<!--ADVERTENCIA: NOS FALTAN DATOS-->
			<?php if (datos(2) and $_SESSION['faltanDatos'] == 'true') {?>
			<div class="row ">
				<div class="alert alert-warning alert-dismissible fade in " role="alert" id='errorDatos'>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4>¡Nos faltan algunos datos!</h4>
					<p>Para poder realizar compras en nuestra tienda necesitamos que rellenes los
						<strong>
						<?php
						if (datos(0) and datos(1)){
							echo "datos de facturación y/o envío";
						}
						elseif (datos(0)) {
							echo "datos de facturación";
						}
						elseif (datos(1)) {
							echo "datos de envío";
						}
						?>
						
						</strong>
					</p>
					<p class="text-right">
					<?php if (datos(0)): ?>
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#datosFacturacion">Rellenar datos de facturación</button>
					<?php endif ?>
					<?php if (datos(1)): ?>
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#datosEnvio">Rellenar datos de envío</button>
					<?php endif ?>
					</p>
				</div>
			</div>
			<?php } ?>
			<!--ADVERTENCIA: NOS FALTAN DATOS-->
		</div>
		<div class="row">
			<div class="col-md-7" id="bloqueIzquierda">
				<div class="contenedorInterior panel panel-default">
					<div class="tituloEncabezado">
						<div class="divInline">
							<h4 class="datos"><span class="glyphicon glyphicon-user"> </span> DATOS DE FACTURACIÓN</h4>
						</div>
						<div class="divInline alinearDerecha">
							<a class="editar" href="" data-toggle="modal" data-target="#datosFacturacion">Editar</a>
						</div>
					</div>
					<div class="contenido">
					<?php if (datos(0)):?>
						<div href="" data-toggle="modal" data-target="#datosFacturacion"><h3><small>Nos faltan algunos datos sobre la dirección de facturación y los necesitamos para que puedas comprar en esta tienda.</small></h3></div>
					<?php endif ?>
					<?php if (!datos(0)): ?>
						<div><?php echo $arrayDatos['nombre'] . " ". $arrayDatos['apellidos']; ?></div>
						<div><?php echo $arrayDatosPais['pais'] . " ". $arrayDatos['provincia']; ?></div>
						<div><?php echo $arrayDatos['ciudad'] . " ". $arrayDatos['codigopostal']; ?></div>
						<div><?php echo $arrayDatos['direccion']?></div>
					<?php endif ?>
						
					</div>
					<!-- contenido modal datos de facturacion -->
					<div class="modal fade" id="datosFacturacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Introduce tus datos de facturación</h4>
								</div>
								<div class="modal-body">
									<form action="../perfil/modificarPerfil.php" method="POST" id="formFacturacion">
										<div class='form-group'>
											<div class="row">
												<div class="col-md-4">
													<label for="nombreUsuario">Nombre *</label>
													<input type="text" value="<?php echo $arrayDatos['nombre'];?>" class="form-control" name="nombreUsuario" id="nombreUsuario" required>
												</div>
												<div class="col-md-4">
													<label for="apellidosUsuario">Apellidos *</label>
													<input type="text" value="<?php echo $arrayDatos['apellidos'];?>" class="form-control" name="apellidosUsuario" id="apellidosUsuario" required>
												</div>
												<div class="col-md-4">
													<label for="documentacionUsuario">DNI/NIE *</label>
													<input type="text" value="<?php echo $arrayDatos['ndocumento'];?>" class="form-control" name="documentacionUsuario" id="documentacionUsuario" required>
												</div>
											</div>
											<label for="paisUsuario">País *</label>
											<select class="form-control" value="<?php echo $arrayDatos['pais'];?>" name= "paisUsuario" id="paisUsuario" required>
												<option value= '0'>Selecciona un país</option>
												<?php
												
												while ($valor = mysqli_fetch_array($resultadoPais)) {
													echo "<option value='{$valor['id_pais']}'";
																				if ($arrayDatos['pais'] == $valor['id_pais']) {
																					echo "selected";
																				}
													echo ">{$valor['pais']}</option>";
												}
												?>
											</select>
											<label for="provinciaUsuario">Provincia *</label>
											<input type="text" value="<?php echo $arrayDatos['provincia'];?>" class="form-control" name="provinciaUsuario" id="provinciaUsuario" required>
											<label for="ciudadUsuario">Ciudad *</label>
											<input type="text" value="<?php echo $arrayDatos['ciudad'];?>" class="form-control" name="ciudadUsuario" id="ciudadUsuario" required>
											<label for="codpostalUsuario">Código Postal *</label>
											<input type="number" value="<?php echo $arrayDatos['codigopostal'];?>" class="form-control" name="codpostalUsuario" id="codpostalUsuario" required>
											<label for="direccionUsuario">Dirección *</label>
											<input type="text" value="<?php echo $arrayDatos['direccion'];?>" class="form-control" name="direccionUsuario" id="direccionUsuario" required>
											<label for="copiardatos">¿Desea usar esta configuración para la dirección de envío?</label>
											<select class="form-control" name="copiardatos" id="copiardatosUsuario">
												<option value="No">No, quiero usar una dirección de envío diferente</option>
												<option value="Si">Sí, quiero usar la misma dirección para el envío</option>
											</select>
										</div>
									</form>
									<!-- INFO SOBRE CAMPOS OBLIGATORIOS -->
									<?php
									if (datos()) {
									echo "
										<div class='alert alert-warning fade in alert-dismissable' style='margin:0;'>
											<a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>&times;</a>
											<p>
												<span class='glyphicon glyphicon-info-sign'></span> Es necesario rellenar todos campos con (*) para poder realizar compras.
											</p>
										</div>
										";
									} else {
									echo "
										<div class='alert panel-default fade in alert-dismissable' style='margin:0;'>
															<a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>&times;</a>
															<p>
																				<span class='glyphicon glyphicon-info-sign'></span> Es necesario rellenar todos campos con (*) para poder realizar compras.
															</p>
										</div>
									";
									}
									?>
									<!-- INFO SOBRE CAMPOS OBLIGATORIOS -->
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
									<button type="submit" name="datosFacturacion" class="btn btn-primary" form="formFacturacion">Guardar cambios</button>
								</div>
							</div>
						</div>
					</div>
					<!-- FIN contenido modal datos de facturacion -->
				</div>
				<div class="contenedorInterior panel panel-default">
					<div class="tituloEncabezado">
						<div class="divInline">
							<h4 class="datos"><span class="glyphicon glyphicon-home"> </span> DIRECCIÓN DE ENVÍO</h4>
						</div>
						<div class="divInline alinearDerecha">
							<a class="editar" href="" data-toggle="modal" data-target="#datosEnvio">Editar</a>
						</div>
					</div>
					<div class="contenido">
					<?php if (datos(1)): ?>
						<div data-toggle="modal" data-target="#datosEnvio"><h3><small>Nos faltan algunos datos sobre la dirección de envío y los necesitamos para que puedas comprar en esta tienda.</small></h3></div>
					<?php endif ?>
					<?php if (!datos(1)): ?>
						<div><?php echo $arrayDatos['nombre_envio'] . " ". $arrayDatos['apellidos_envio']; ?></div>
						<div><?php echo $arrayDatosPais2['pais'] . " ". $arrayDatos['provincia_envio']; ?></div>
						<div><?php echo $arrayDatos['ciudad_envio'] . " ". $arrayDatos['codigopostal_envio']; ?></div>
						<div><?php echo $arrayDatos['direccion_envio']?></div>
					<?php endif ?>
					</div>
					<!-- contenido modal datos de envio -->
					<div class="modal fade" id="datosEnvio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Introduce tus datos de envío</h4>
								</div>
								<div class="modal-body">
									<form action="../perfil/modificarPerfil.php" method="POST" id="formEnvio">
										<div class='form-group'>
											<div class="row">
												<div class="col-md-4">
													<label for="nombreEnvio">Nombre *</label>
													<input type="text" value="<?php echo $arrayDatos['nombre'];?>" class="form-control" name="nombreEnvio" id="nombreEnvio" required>
												</div>
												<div class="col-md-4">
													<label for="apellidosEnvio">Apellidos *</label>
													<input type="text" value="<?php echo $arrayDatos['apellidos'];?>" class="form-control" name="apellidosEnvio" id="apellidosEnvio" required>
												</div>
												<div class="col-md-4">
													<label for="documentacionEnvio">DNI/NIE *</label>
													<input type="text" value="<?php echo $arrayDatos['ndocumento'];?>" class="form-control" name="documentacionEnvio" id="documentacionEnvio" required>
												</div>
											</div>
											<label for="paisEnvio">País *</label>
											<select class="form-control" value="<?php echo $arrayDatos['pais'];?>" name= "paisEnvio" id="paisEnvio" required>
												<option value= '0'>Selecciona un país</option>
												<?php
												$queryPais = "select * from paises";
												$resultadoPais = mysqli_query($conexion, $queryPais);
												while ($valor = mysqli_fetch_array($resultadoPais)) {
													echo "<option value='{$valor['id_pais']}'";
																			if ($arrayDatos['pais'] == $valor['id_pais']) {
																				echo "selected";
																			}
													echo ">{$valor['pais']}</option>";
												}
												?>
											</select>
											<label for="provinciaEnvio">Provincia *</label>
											<input type="text" value="<?php echo $arrayDatos['provincia'];?>" class="form-control" name="provinciaEnvio" id="provinciaEnvio" required>
											<label for="ciudadEnvio">Ciudad *</label>
											<input type="text" value="<?php echo $arrayDatos['ciudad'];?>" class="form-control" name="ciudadEnvio" id="ciudadEnvio" required>
											<label for="codpostalEnvio">Código Postal *</label>
											<input type="number" value="<?php echo $arrayDatos['codigopostal'];?>" class="form-control" name="codpostalEnvio" id="codpostalEnvio" required>
											<label for="direccionEnvio">Dirección *</label>
											<input type="text" value="<?php echo $arrayDatos['direccion'];?>" class="form-control" name="direccionEnvio" id="direccionEnvio" required>
										</div>
									</form>
									<!-- INFO SOBRE CAMPOS OBLIGATORIOS -->
									<?php
									if (datos()) {
									echo "
										<div class='alert alert-warning fade in alert-dismissable' style='margin:0;'>
											<a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>&times;</a>
											<p>
												<span class='glyphicon glyphicon-info-sign'></span> Es necesario rellenar todos campos con (*) para poder realizar compras.
											</p>
										</div>
										";
									} else {
									echo "
										<div class='alert panel-default fade in alert-dismissable' style='margin:0;'>
											<a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>&times;</a>
											<p>
												<span class='glyphicon glyphicon-info-sign'></span> Es necesario rellenar todos campos con (*) para poder realizar compras.
											</p>
										</div>
									";
									}
									?>
									<!-- INFO SOBRE CAMPOS OBLIGATORIOS -->
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
									<button type="submit" name="datosEnvio" class="btn btn-primary" form="formEnvio">Guardar cambios</button>
								</div>
							</div>
						</div>
					</div>
					<!-- FIN contenido modal datos de envio -->
				</div>
				<div class="contenedorInterior panel panel-default">
					<div class="tituloEncabezado">
						<div class="divInline">
							<h4 class="datos"><span class="glyphicon glyphicon-credit-card"> </span> MÉTODO DE PAGO</h4>
						</div>
					</div>
					<div class="contenido">
						<div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
							<ul class="nav nav-tabs" id="myTabs" role="tablist">
								<li role="presentation" class="dropdown">
									<a href="#" class="dropdown-toggle" id="myTabDrop1" data-toggle="dropdown" aria-controls="myTabDrop1-contents" aria-expanded="false">Selecciona un metodo de pago <span class="caret"></span></a>
									<ul class="dropdown-menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
										<li>
											<a href="#tarjeta" onclick="hab()" role="tab" id="dropdown1-tab" data-toggle="tab" aria-controls="dropdown1">Tarjeta de crédito</a>
										</li>
										<li>
											<a href="#transferencia" onclick="deshab()" role="tab" id="dropdown2-tab" data-toggle="tab" aria-controls="dropdown2">Transferencia bancaria</a>
										</li>
									</ul>
								</li>
							</ul>
							<div class="tab-content" id="myTabContent">
								
								<div class="tab-pane fade in active" role="tabpanel" id="tarjeta" aria-labelledby="home-tab">
									<div class="row">
										<form method='POST' id="prueba" name="prueba">
											<div class="col-md-6 columnaDatos" >
												<label for="nombreUsuario">Nombre *</label>
												<input type="text" class="form-control" name="nombreUsuario" id="nombreUsuario" required>
												<label for="nombreUsuario">Número de tarjeta *</label>
												<input type="text" class="form-control" name="nombreUsuario" id="nombreUsuario" required>
												<div class="row">
													<div class="col-md-6">
														<label for="nombreUsuario">Fecha de vencimiento *</label>
														<select name="" id="" class="form-control">
															<option value="1">Enero</option>
															<option value="2">Febrero</option>
															<option value="3">Marzo</option>
															<option value="4">Abril</option>
															<option value="5">Mayo</option>
															<option value="6">Junio</option>
															<option value="7">Julio</option>
															<option value="8">Agosto</option>
															<option value="9">Septiembre</option>
															<option value="10">Octubre</option>
															<option value="11">Noviembre</option>
															<option value="12">Diciembre</option>
														</select>
													</div>
													<div class="col-md-6">
														<label for=""></label>
														<input type="number" class="form-control" placeholder="Año" min="2017" max="2100">
													</div>
												</div>
											</div>
											<div class="col-md-6 columnaDatos">
												<label for="nombreUsuario">Apellidos *</label>
												<input type="text" class="form-control" name="nombreUsuario" id="nombreUsuario" required>
											</div>
										</form>
									</div>
									<div class="row">
										
										<div class='alert fade in alert-dismissable columnaDatos' style='margin:0;'>
											<a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>&times;</a>
											<p>
												<span class='glyphicon glyphicon-info-sign'></span> Es necesario rellenar todos campos con (*) para poder realizar compras.
											</p>
											<p>
												<span class='glyphicon glyphicon-info-sign'></span> El nombre y los apellidos deben coincidir con los datos del titular de la tarjeta
											</p>
											
										</div>
									</div>
								</div>
								<div class="tab-pane fade" role="tabpanel" id="transferencia" aria-labelledby="home-tab">
									<p>La compra se relizará y se pondrá en marcha en cuanto recibamos tu pago. Para ello,debes realizar una transferencia bancaria con los siguientes datos:
										<ul style="padding-left: 20px;">
											<li>Banco: Un Banco</li>
											<li>Número de cuenta: 2020 1234 4321 1346793164</li>
											<li>Importe total: <?php echo $precio ."€";?></li>
											<li>Concepto: 909090</li>
											<li>Beneficiario: Tienda Online S.A</li>
										</ul>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-5" id="bloqueDerecha">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-6">
								<h4 style="margin-bottom: 0px;"><a href="carrito.php">(<?php echo $carrito->count(); ?>) <small style="color:#337ab7;">artículos en total</small></a></h4>
							</div>
							<div class="col-md-6 text-right">
								<a class="btn btn-default" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
									Ver carrito
								</a>
							</div>
						</div>
						
						
						
						
					</div>
					<div class="panel-body">
						<div class="collapse" id="collapseExample">
							<div class="container">
								<table class='table table-responsive'>
									<thead>
										<tr>
											
											<th class="columnaPrincipal">Nombre</th>
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
									</tbody>
								</table>
								
							</div>
						</div>
						<div class="row">
							<b>
							<div class="col-md-6 text-left">TOTAL A PAGAR:</div>
							<div class="col-md-6 text-right"><?php echo $precio ."€";?></div>
							</b>
						</div>
					</div>
					
				</div>
				<?php if (datos(2)): ?>
				<button type="submit" class="btn btn-default finalizar" id='realizarCompra' disabled="disabled">
					<h3><small>PAGAR Y FINALIZAR COMPRA</small></h3>
				</button>
				<?php endif ?>
				<?php if (!datos(2)): ?>
				<form action="comprafinalizada.php" id='formularioCompra' method="POST">
					<input type="hidden" value="<?php echo $_SESSION["id"]; ?>" name="id_user">
					<input type="hidden" value="<?php echo $precio; ?>" name="importeTotal">
					<input type="hidden" value="<?php echo $arrayDatos['nombre_envio'] ?>" name="nombre_envio">
					<input type="hidden" value="<?php echo $arrayDatos['apellidos_envio'] ?>" name="apellidos_envio">
					<input type="hidden" value="<?php echo $arrayDatos['ndocumento_envio'] ?>" name="ndocumento_envio">
					<input type="hidden" value="<?php echo $arrayDatos['pais_envio'] ?>" name="pais_envio">
					<input type="hidden" value="<?php echo $arrayDatos['provincia_envio'] ?>" name="provincia_envio">
					<input type="hidden" value="<?php echo $arrayDatos['ciudad_envio'] ?>" name="ciudad_envio">
					<input type="hidden" value="<?php echo $arrayDatos['codigopostal_envio'] ?>" name="codigopostal_envio">
					<input type="hidden" value="<?php echo $arrayDatos['direccion_envio'] ?>" name="direccion_envio">
					<button type="submit" class="btn btn-default finalizar" form='formularioCompra' name="botonComprar">
						<h3><small>PAGAR Y FINALIZAR COMPRA</small></h3>
					</button>
				</form>
				<?php endif ?>
				
			</div>
		</div>
	</div>
</div>
</div>

<html> 
<head> 

<!--
<script type="text/javascript"> 
function deshab() { 
  frm = document.forms['prueba']; 
  for(i=0; ele=frm.elements[i]; i++) 
    ele.disabled=true;
}

function deshab2() {
	if (document.getElementById("pruebaboton").disabled == true) {
		document.getElementById("pruebaboton").disabled = false;
	}
}

function hab() { 
  frm = document.forms['prueba']; 
  for(i=0; ele=frm.elements[i]; i++) 
    ele.disabled=false;
}
</script>
-->