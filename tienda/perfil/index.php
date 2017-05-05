<?php
	include('../navegacion.php');;
	include('../funciones/comprobarUsuario.php');
	include("../funciones/funcionesSelect.php");
	include '../funciones/faltanDatos.php';
	
	if  (!usuariosRegistrados()) {
		header('location: ../iniciosesion.php');
	}
	$conexion = conectarBD();
	$datosPrincipales 	= "select * from usuarios where id_user={$_SESSION['id']}";
	$arrayDatos 		= mysqli_fetch_array(mysqli_query($conexion, $datosPrincipales));
	$queryPais 			= "select * from paises";
	$resultadoPais 		= mysqli_query($conexion, $queryPais);
	$queryDatosPais 	= "select * from paises where id_pais = (select pais from usuarios where id_user={$_SESSION['id']});";
	$queryDatosPais2 	= "select * from paises where id_pais = (select pais_envio from usuarios where id_user={$_SESSION['id']});";
	$arrayDatosPais 	= mysqli_fetch_array(mysqli_query($conexion, $queryDatosPais));
	$arrayDatosPais2 	= mysqli_fetch_array(mysqli_query($conexion, $queryDatosPais2));
	$sqlPedidos 		= "select * from pedidos p, detallespedidos d where p.idPedido = d.idPedido and p.id_user={$_SESSION['id']};";
	$nPedidos			= mysqli_num_rows(mysqli_query($conexion,$sqlPedidos));
	$datosPedidos		= mysqli_fetch_array(mysqli_query($conexion, $sqlPedidos));
	if (datos(2)){
		if (!isset($_SESSION['faltanDatos'])) {
			$_SESSION['faltanDatos'] = 'true';
		}
	};
?>
<style>
	
	.container-apm {
		padding-top: 30px;
	}
	
	.foto {
		max-width: 120px;
		max-height: 110px;
		align-content: center;
		margin: auto;
		vertical-align: middle;
	}
	.datosPerfil {
		padding-top: 16px;
	}
	
	.divInline {
		display: inline-block;
	}
	.tituloInline {
		display: inline;
	}
	.alinearDerecha {
			float: right;
	}
	h4.datos {
			margin: 0px;
			padding-bottom: 0px;
			font-family: 'Montserrat', sans-serif;
			
		}
	h5.datos {
			margin: 0px;
			padding-bottom: 0px;
			font-family: 'Montserrat', sans-serif;
			
		}
	.editar {
		vertical-align: middle;
			font-size: 10.5px;
			margin-bottom: 0;
		}
	.info {
		padding: 8px;
		margin: 0;
	}
	.alerta {
		padding-bottom: 15px;
	}
	a.alert{
		display: block;
		margin:0;
	}
	.divAlerta{
		padding-right: 15px;
		padding-left: 15px;
	}
	.col3 {
		padding-right: 7px;
		padding-left: 7px;
		text-align: center;
	}
	.alerta {
		padding-bottom: 5px;

	}
	.alerta h4, p{
		margin-bottom: 5px;
		margin-top: 0;

	}
</style>
<div class="container">
	<div class="container-apm">
		<!--No existe la factura. Error -->
		<?php if (isset($_SESSION['error'])): ?>
			<div class="row">
				<div class="alert alert-warning alert-dismissible fade in alerta" role="alert" id='errorDatos'>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4> <?php echo $_SESSION['error']; unset($_SESSION['error']);?></h4>
				<p>Puede que la factura no se haya emitido aún. Si crees que es un error, contacta con nosotros.
				</p>
				<p class="text-right">
					<a id="ejemplo" onclick="setTimeout(myfunction,200);" class="btn btn-link" data-dismiss="alert" aria-label="Close">Cerrar</a>
				</p>
				</div>
			</div>
		<?php endif ?>
		<!--ADVERTENCIA: NOS FALTAN DATOS-->
		<?php if (datos(2) and $_SESSION['faltanDatos'] == 'true') { ?>
		<div class="row divAlerta">
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
					<button type="button" class="btn btn-default">Rellenar datos</button> <a id="ejemplo" onclick="setTimeout(myfunction,200);" class="btn btn-link" data-dismiss="alert" aria-label="Close">No mostrar</a>
				</p>
			</div>
		</div>
		<?php } ?>
		<!--ADVERTENCIA: NOS FALTAN DATOS-->
		<div class="row">
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading hover">
						<div class="divInline">
							<h4 class="panel-little datos"><span class="glyphicon glyphicon-user"> </span> Perfil</h4>
						</div>
						<div class="divInline alinearDerecha">
							<a class="editar" href="../perfil/editar.php">Editar</a>
						</div>
					</div>
					<div class="panel-body">
						<div class="foto">
							<img src="<?php echo $arrayDatos['fotoUsuario'];?>" alt="..." class="img-thumbnail">
						</div>
						<div class="container-fluid datosPerfil">
							<div><?php echo $arrayDatos['nombre'];?></div>
							<div><?php echo $arrayDatos['apellidos'];?></div>
							<div><?php echo $arrayDatos['email'];?></div>
							
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title datos"><span class="glyphicon glyphicon-list-alt"> </span> Datos de facturación y envío</h4>
					</div>
					<div class="panel-body">
						<div class="panel panel-default">
							<div class="panel-heading">
								<div class="divInline">
									<h5 class="panel-title datos">Dirección de facturación</h5>
								</div>
								<div class="divInline alinearDerecha">
									<a class="link" role="button" data-toggle="collapse" href="#facturacion" aria-expanded="false" aria-controls="facturacion">
										<span class="glyphicon glyphicon-zoom-in"></span>
									</a>
									<a href="" data-toggle="modal" data-target="#datosFacturacion"> <span class="glyphicon glyphicon-cog"></span></a>
								</div>
							</div>
							<div class="panel-body">
								<div><?php echo $arrayDatos['nombre'];?></div>
								<div><?php echo $arrayDatos['apellidos'];?></div>
								<div class="tituloInline"><?php echo $arrayDatos['ndocumento'];?></div>
								<div class="collapse" id="facturacion">
									<?php if (datos(0)) {
									echo "
									<p style='color: #b94a48;''>
										Faltan datos por completar
									</p>
									";} 
									else {
									echo "
									<div>{$arrayDatosPais['pais']}</div>
									<div>{$arrayDatos['provincia']}</div>
									<div>{$arrayDatos['ciudad']}</div>
									<div>{$arrayDatos['codigopostal']}</div>
									<div>{$arrayDatos['direccion']}</div>
									";
									}
									
									?>
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
						</div>
						
						<div class="panel panel-default">
							<div class="panel-heading">
								<div class="divInline">
									<h5 class="panel-title datos">Dirección de envio</h5>
								</div>
								<div class="divInline alinearDerecha">
									<a class=" link " role="button" data-toggle="collapse" href="#envio" aria-expanded="false" aria-controls="envio">
										<span class="glyphicon glyphicon-zoom-in"></span>
									</a>
									<a href="" data-toggle="modal" data-target="#datosEnvio"> <span class="glyphicon glyphicon-cog"></span></a>
								</div>
							</div>
							<div class="panel-body">
								<div><?php echo $arrayDatos['nombre_envio'];?></div>
								<div><?php echo $arrayDatos['apellidos_envio'];?></div>
								<div class="tituloInline"><?php echo $arrayDatos['ndocumento_envio'];?></div>
								<div class="collapse" id="envio">
									<?php if (datos(1)) {
									echo "
									<p style='color: #b94a48;''>
										Faltan datos por completar
									</p>
									";} 
									else {
									echo "
									<div>{$arrayDatosPais2['pais']}</div>
									<div>{$arrayDatos['provincia_envio']}</div>
									<div>{$arrayDatos['ciudad_envio']}</div>
									<div>{$arrayDatos['codigopostal_envio']}</div>
									<div>{$arrayDatos['direccion_envio']}</div>
									";
									}
									
									?>
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
						</div>
						
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title datos"> <span class="glyphicon glyphicon-equalizer"> </span> Pedidos</h4>
					</div>
					<div class="panel-body">
						<?php
						if ($nPedidos == 0){
							echo "No has comprado nada aún";

						}
						else {
							//$sql = "select * from pedidos p, detallespedidos d where p.idPedido = d.idPedido and p.id_user={$_SESSION['id']};";
							$sql = "select * from pedidos where id_user={$_SESSION['id']};";
							$consulta = mysqli_query($conexion, $sql);
							echo "
						<div class='row'>
							<div class='col-md-3 col3'>Nº Pedido</div>
							<div class='col-md-3 col3'>Fecha</div>
							<div class='col-md-3 col3'>Estado</div>
							<div class='col-md-3 col3'>Opciones</div>
						</div>
							";
							while ($pedido = mysqli_fetch_array($consulta)) {
								$fecha = date("d-m-Y", strtotime($pedido['fechaPedido']) );
								echo "
						<div class='row'>
							<div class='col-md-3 col3'>{$pedido['idPedido']}</div>
							<div class='col-md-3 col3'>{$fecha}</div>
							<div class='col-md-3 col3'>{$pedido['estado']}</div>
							<div class='col-md-3 col3'>
								<a style='padding:0 3px 0 3px;' href='generarfactura.php?pedido={$pedido['idPedido']}'> 
									<span class='glyphicon glyphicon-eye-open'> </span> 
								</a>
								<a style='padding:0 3px 0 3px;' href='generarfactura.php?pedido={$pedido['idPedido']}' download> 
									<span class='glyphicon glyphicon-cloud-download'> </span> 
								</a>
							</div>
						</div>
								";
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
