<?php 
  
  ob_start();
  include_once ("funciones/comprobarSession.php");
  include_once('funciones/bd.php');

  $conexion = conectarBD();
  global $conexion;
?>
<head>
  <link rel="stylesheet" href="/css/bootstrap-completo.css">
  <script src='/js/jquery.min.js'></script>
  <script src="/js/bootstrap.js"></script>
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=0.65, maximum-scale=0.65, minimum-scale=0.65">
</head>

<style>
  
  .navbar{
    padding-left: 30px;
    padding-right: 30px;
  }

</style>

<nav class="navbar navbar-default navbar-static-top">
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
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Series 
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
        <li><a href="/index.php">Peliculas</a></li>
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          
            <input type="text" class="form-control" name="nombre"  placeholder="Buscar en toda la web">
          
        </div>
        <button type="submit" class="btn btn-default">Buscar</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        
          <li class="dropdown">
            <?php if (!isset($_SESSION['estado'])): ?>
            <a href="../iniciosesion.php" role="button"
              aria-expanded="false">Iniciar sesión
            </a>
            <?php endif ?>
            <?php if (isset($_SESSION['estado'])): ?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
              aria-expanded="false" style="margin-left: 5px;"><?php echo $_SESSION['usuario'] . " "; ?><span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
              <?php if ($_SESSION['tipoUsuario'] == 'Administrador'): ?>
              <li><a href="../administracion/production/index.php">Panel de administración</a></li>
              <?php endif ?>
              <li><a href="../perfil/index.php">Mi perfil</a></li>
              <li><a href="#">Ayuda y soporte</a></li>
              <li class="divider"></li>
              <li><a href="/logout.php">Cerrar sesion</a></li>
              <?php endif ?>
            </ul>
          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

