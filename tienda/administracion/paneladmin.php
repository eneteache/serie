<?php
	include "../navegacion.php";
	include("../funciones/funcionesSelect.php");
	if (($_SESSION['tipoUsuario']) != 'Administrador') {
		header("Location: ../index.php");
		exit();
	}
?>
<title>Panel de administración</title>
<link rel="stylesheet" type="text/css" href="../../css/paneladmin.css">
<link rel="stylesheet" type="text/css" href="../css/fonts.css">
<style type="text/css">
	* {
		font-family: calibri;
	}
	.contenedor{
		padding-right: 175px;
		padding-left: 175px;
		margin-top: 22px;
		padding-top: 22px;
	}
	.columna {
		font-size: 20px;
		padding: 0 52px;
	}
	.columna a span{
		width: 98%;
		color:#4D4D4D;
			display: flex;
	/* alineacion vertical */
	align-items: center;
	/* alineacion horizontal */
	justify-content: center;
	
	}
	.columna a span:hover{
		width: 98%;
		color:#000;
	}
	.panel-body {
		padding-left: 100px;
		padding-right: 100px;
	}
	.panel-heading:hover{
		color:black;
	}
</style>

<div class="container contenedor">
	<?php if (isset($_SESSION['log'])): ?>
			<div class="row">
				<div class="alert alert-success alert-dismissible fade in alerta" role="alert" id='errorDatos'>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				
				<p><?php echo $_SESSION['log']; unset($_SESSION['log']);?>
				</p>
				<p class="text-right">
					<a id="ejemplo" onclick="setTimeout(myfunction,200);" class="btn btn-link" data-dismiss="alert" aria-label="Close">Cerrar</a>
				</p>
				</div>
			</div>
		<?php endif ?>
	<div class="panel panel-default">
		<div class="panel-heading"><h4><center>Panel de administración</center></h4></div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-3 columna">
					<a href="../administracion/categorias.php" data-toggle='tooltip' data-placement='bottom' title='Inventario de categorias y productos'><span class="glyphicon glyphicon-folder-open"></span></a>
				</div>
				<div class="col-md-3 columna">
					<a href="../administracion/listarUsuarios.php" data-toggle='tooltip' data-placement='bottom' title='Gestión de usuarios'><span class="glyphicon glyphicon-user"></span></a>
				</div>
				<div class="col-md-3 columna">
					<a href="../administracion/estadisticas.php" data-toggle='tooltip' data-placement='bottom' title='Ver estadisticas'><span class="glyphicon glyphicon-stats"></span></a>
				</div>
				<div class="col-md-3 columna">
					<a href="../administracion/backup.php" data-toggle='tooltip' data-placement='bottom' title='Crear copia de seguridad'><span class="icon-database"></span></a>
				</div>
			</div>
		</div>
	</div>
</div>