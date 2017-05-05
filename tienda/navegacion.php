<?php
ob_start();
include_once ("funciones/comprobarSession.php");
include_once('funciones/funcionesConectarBD.php');

$conexionNavegacion = conectarBD();
$conexion = conectarBD();
global $conexion;
$sqlCategorias = "select * from categorias";
$r = mysqli_query($conexionNavegacion, $sqlCategorias);
?>
<head>
  <meta charset="UTF-8">
  <script src="../js/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/navegacion.css">
  <link rel="stylesheet" type="text/css" href="../css/fonts.css">
  <link rel="stylesheet" type="text/css" href="../css/font-mfizz-2.4.1/font-mfizz.css">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<style>
  .li-middle {
  padding-top: 10px;
  padding-bottom: 10px;
  margin-right: 5px;
  }
  .btn-circle.btn-xs{
  width: 30px;
  height: 30px;
  text-align: center;
  padding: 6px 0;
  font-size: 12px;
  line-height: 1.428571429;
  border-radius: 15px;
  }
  .navbar-default {
    background-color: #222;
  }
  .navbar-inverse .navbar-nav > li > .btn-cesta {
  color:black;
  }
  .navbar-inverse .navbar-nav > li > .btn-cesta:hover {
  color: black;
  background-color: #e6e6e6;
  }
  body {
  background-color: #eceff1;
  font-family: calibri;
  }
  /* submenus */
  .marginBottom-0 {margin-bottom:0;}
  .dropdown-submenu{position:relative;}
  .dropdown-submenu>.dropdown-menu{top:0;left:100%;margin-top:-6px;margin-left:-1px;-webkit-border-radius:0 6px 6px 6px;-moz-border-radius:0 6px 6px 6px;border-radius:0 6px 6px 6px;}
  .dropdown-submenu>a:after{display:block;content:" ";float:right;width:0;height:0;border-color:transparent;border-style:solid;border-width:5px 0 5px 5px;border-left-color:#cccccc;margin-top:5px;margin-right:-10px;}
  .dropdown-submenu:hover>a:after{border-left-color:#555;}
  .dropdown-submenu.pull-left{float:none;}.dropdown-submenu.pull-left>.dropdown-menu{left:-100%;margin-left:10px;-webkit-border-radius:6px 0 6px 6px;-moz-border-radius:6px 0 6px 6px;border-radius:6px 0 6px 6px;}
  /*submenus*/


</style>

<script>
(function($){
  $(document).ready(function(){
    $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
      event.preventDefault();
      event.stopPropagation();
      $(this).parent().siblings().removeClass('open');
      $(this).parent().toggleClass('open');
    });
  });
})
(jQuery);

$(document).ready(function(){
$('[data-toggle="tooltip"]').tooltip();
});
</script>
<nav class="navbar navbar-inverse navbar-static-top marginBottom-0" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed"
      data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
      
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="../index.php">Inicio</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Categorías 
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" role="menu">
            <?php while ($arrayCategorias = mysqli_fetch_array($r)) {
      echo "
            <li><a href='../index.php?categoria={$arrayCategorias['nombre']}'>{$arrayCategorias['nombre']}</a></li>
      ";
            } ?>
            
            <li class='divider'></li>
            <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Otra categoría</a>
              <ul class="dropdown-menu">
                
                <li><a href="#">Subcategoría 1</a></li>
                <li><a href="#">Subcategoría 2</a></li>
                <li><a href="#">Subcategoría 3</a></li>
              </ul>
            </li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          
            <input type="text" class="form-control" name="nombre"  placeholder="Búsqueda de un producto">
          
        </div>
        <button type="submit" class="btn btn-default">Buscar</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li class="li-middle"><a class="btn btn-default btn-circle btn-xs btn-cesta" href="../carrito.php">
          <span class="glyphicon glyphicon-shopping-cart"></span></a></li>
          <li class="dropdown">
            <?php if (!isset($_SESSION['estado'])): ?>
            <a href="../iniciosesion.php" role="button"
              aria-expanded="false">Iniciar sesión
            </a>
            <?php endif ?>
            <?php if (isset($_SESSION['estado'])): ?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
              aria-expanded="false" style="margin-left: 5px;"><?php echo $_SESSION['email'] . " "; ?><span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
              <?php if ($_SESSION['tipoUsuario'] == 'Administrador'): ?>
              <li><a href="../administracion/paneladmin.php">Panel de administración</a></li>
              <?php endif ?>
              <li><a href="../perfil/index.php">Mi perfil</a></li>
              <li><a href="#">Mis pedidos</a></li>
              <li class="divider"></li>
              <li><a href="../logout.php">Cerrar sesion</a></li>
              <?php endif ?>
            </ul>
          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
