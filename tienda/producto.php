<?php
include 'navegacion.php';
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Productos</title>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
<script src="//code.jquery.com/jquery-3.1.1.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
<script src="visitas.php"></script>
<link href="http://cdnjs.com/libraries/fancybox">
<style>
body {
overflow-x: hidden; }
img {
max-width: 100%; }
.preview {
display: -webkit-box;
display: -webkit-flex;
display: -ms-flexbox;
display: flex;
-webkit-box-orient: vertical;
-webkit-box-direction: normal;
-webkit-flex-direction: column;
-ms-flex-direction: column;
flex-direction: column; }
@media screen and (max-width: 996px) {
.preview {
margin-bottom: 20px; } }
.preview-pic {
-webkit-box-flex: 1;
-webkit-flex-grow: 1;
-ms-flex-positive: 1;
flex-grow: 1; }
.preview-thumbnail.nav-tabs {
border: none;
margin-top: 15px; }
.preview-thumbnail.nav-tabs li {
width: 18%;
margin-right: 2.5%; }
.preview-thumbnail.nav-tabs li img {
max-width: 100%;
display: block; }
.preview-thumbnail.nav-tabs li a {
padding: 0;
margin: 0; }
.preview-thumbnail.nav-tabs li:last-of-type {
margin-right: 0; }
.tab-content {
overflow: hidden; }
.tab-content img {
width: 100%;
-webkit-animation-name: opacity;
animation-name: opacity;
-webkit-animation-duration: .3s;
animation-duration: .3s; }
.card {
padding-top: 25px;
background: #eee;
padding: 3em;
line-height: 1.5em; }
@media screen and (min-width: 997px) {
.wrapper {
display: -webkit-box;
display: -webkit-flex;
display: -ms-flexbox;
display: flex; } }
.details {
display: -webkit-box;
display: -webkit-flex;
display: -ms-flexbox;
display: flex;
-webkit-box-orient: vertical;
-webkit-box-direction: normal;
-webkit-flex-direction: column;
-ms-flex-direction: column;
flex-direction: column; }
.colors {
-webkit-box-flex: 1;
-webkit-flex-grow: 1;
-ms-flex-positive: 1;
flex-grow: 1; }
.price, .sizes, .colors {
text-transform: UPPERCASE;
font-weight: bold; }
.no-check{
  color: #E0E0E0;
}
.checked, .price span {
color: #607D8B; }
.product-title, .rating, .product-description, .price, .vote, .sizes {
margin-bottom: 15px; }
.product-title {
margin-top: 0; }
.size {
margin-right: 10px; }
.size:first-of-type {
margin-left: 40px; }
.color {
display: inline-block;
vertical-align: middle;
margin-right: 10px;
height: 2em;
width: 2em;
border-radius: 2px; }
.color:first-of-type {
margin-left: 20px; }
.add-to-cart, .like {
background: #607D8B;
padding: 1.2em 1.5em;
border: none;
text-transform: UPPERCASE;
font-weight: bold;
color: #fff;
letter-spacing: 1px;
}
.add-to-cart:hover, .like:hover {
background: #576166;
color: #fff; }
.not-available {
text-align: center;
line-height: 2em; }
.not-available:before {
font-family: fontawesome;
content: "\f00d";
color: #fff; }
.orange {
background: #ff9f1a; }
.green {
background: #85ad00; }
.blue {
background: #0076ad; }
.tooltip-inner {
padding: 1.3em; }
@-webkit-keyframes opacity {
0% {
opacity: 0;
-webkit-transform: scale(3);
transform: scale(3); }
100% {
opacity: 1;
-webkit-transform: scale(1);
transform: scale(1); } }
@keyframes opacity {
0% {
opacity: 0;
-webkit-transform: scale(3);
transform: scale(3); }
100% {
opacity: 1;
-webkit-transform: scale(1);
transform: scale(1); } }
a.thumbnail:hover, a.thumbnail:focus, a.thumbnail.active {
  border-color: white;
}
.list-group {
  box-shadow: none;
  margin-bottom: 0;
}
.divImg {
  height: 340px;
  display: flex;
  /* alineacion vertical */
  align-items: center;
  /* alineacion horizontal */
  justify-content: center;
}
.img {
  max-width: 335px;
    max-height: 328px;
}
.container {
  margin-top: 50px;
  margin-bottom: 25px;
}
.panel-body {
  background-color: white;
}

</style>

<?php
  if (empty($_GET)) {
    header ("location: index.php");
  }
  if (!empty($_GET) and !array_key_exists('id', $_GET)) {
  echo '
  <div class="container">
      <div class="row">
          <div class="span12">
              <div class="hero-unit center">
                  <h2>Página no encontrada<small><font face="Tahoma" color="red"> Error 404</font></small></h2>
                  <br />
                  <p>La página a la que estás intentando acceder no existe. Si crees que se trata de un error, <a href=""><b>ponte en contacto con nosotros</b></a> o prueba de nuevo en unos minnutos.</p>
                  <p><b>Puedes pulsar el boton para salir de aquí:</b></p>
                  <a href="index.php" class="btn btn-large btn-info"><i class="icon-home icon-white"></i>Llevame al Inicio.</a>
              </div>    
          </div>
      </div>
  </div>
  ';}

  
?>

<?php if (!empty($_GET) and array_key_exists('id', $_GET)) { ?>
  <?php
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      
      $sqlProducto = "select * from productos where id_producto='{$id}'";
      
      $r = mysqli_query($conexion, $sqlProducto);
      
      if (mysqli_num_rows($r) == 0) {
        echo '
  <div class="container">
      <div class="row">
          <div class="span12">
              <div class="hero-unit center">
                  <h2>Página no encontrada<small><font face="Tahoma" color="red"> Error 404</font></small></h2>
                  <br />
                  <p>La página a la que estás intentando acceder no existe. Si crees que se trata de un error, <a href=""><b>ponte en contacto con nosotros</b></a> o prueba de nuevo en unos minnutos.</p>
                  <p><b>Puedes pulsar el boton para salir de aquí:</b></p>
                  <a href="index.php" class="btn btn-large btn-info"><i class="icon-home icon-white"></i>Llevame al Inicio.</a>
              </div>    
          </div>
      </div>
  </div>
  ';
      } else {
      $producto = mysqli_fetch_array($r);
      $sqlImg = "select * from imagenes where idProducto = {$id}";
      $result = mysqli_query($conexion, $sqlImg);
      ?>
  
<div class="container">
  <div class="panel panel-default">
  
  <div class="card panel-body">
    <div class="container-fliud">
      <div class="wrapper row">
        <div class="preview col-md-6">
          <div class='list-group gallery'>
            <div class="preview-pic tab-content">

            <?php
                $sqlImg = "select * from imagenes where idProducto={$id}";
                $result = mysqli_query($conexion, $sqlImg);
                $sqlPrimera = "select * from imagenes where idProducto={$id} order by idImagen asc";
                $primera = mysqli_fetch_array(mysqli_query($conexion, $sqlPrimera));
                while ( $imagenes = mysqli_fetch_array($result)) {
                
                 
            ?>
              <div class="tab-pane <?php if ($imagenes['url'] == $primera['url']) echo 'active'?>" id="pic-<?php echo $imagenes['idImagen'] ?>">
                <a class="thumbnail fancybox" rel="ligthbox" href="<?php echo $imagenes['url'] ?>">
                  <div class="divImg">
                    <img class="img"  src="<?php echo $imagenes['url']?>">
                  </div>
                </a>
              </div>
            <?php
              
            }
            ?>
            <ul class="preview-thumbnail nav nav-tabs">
            <?php
            $sqlImg2 = "select * from imagenes where idProducto={$id}";
            $result2 = mysqli_query($conexion, $sqlImg2);
            $sqlPrimera2 = "select * from imagenes where idProducto={$id} order by idImagen asc";
            $primera2 = mysqli_fetch_array(mysqli_query($conexion, $sqlPrimera2));
            
              while ( $imagenes2 = mysqli_fetch_array($result2)) {
            ?>
              <li class="<?php if ($imagenes2['url'] == $primera2['url']) echo 'active'?>">
                <a data-target="#pic-<?php echo $imagenes2['idImagen'] ?>" data-toggle="tab">
                  <img src="<?php echo $imagenes2['url']?>" />
                </a>
              </li>
            <?php
              
            }
            ?>
            </ul>
          </div>
          </div>
        </div>
        <div class="details col-md-6">
          <h3 class="product-title"><?php echo $producto['nombre'] ?></h3>
          <div class="rating">
            <div class="stars">
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star no-check"></span>
              <span class="fa fa-star no-check"></span>
            </div>
            <span class="review-no">41 reviews</span>
          </div>
          <p class="product-description"><?php echo $producto['descripcion'] ?></p>
          <h4 class="price">Precio actual: <span><?php echo $producto['precio'] ?> €</span></h4>
          
          <h5 class="sizes">Disponibilidad:
          <span class="size" data-toggle="tooltip" title="small">En stock</span>
          </h5>
          <h5 class="colors">
          </h5>
          <div class="action">
            
            <?php
          echo "
          <form action='addCarrito.php' method='POST'>
                  <input type='hidden' name='id' value='{$producto['id_producto']}'>
                  <input type='hidden' name='cantidad' value='1'>
                  <input type='hidden' name='rutaImagen' value='{$producto['url']}'>
                  <input type='hidden' name='nombre' value='{$producto['nombre']}'>
                  <input type='hidden' name='precioU' value='{$producto['precio']}'>
                  <button type='submit' class='btn btn-default add-to-cart btn btn-default' data-toggle='modal' data-target='#productoModal'>
              <h4>Añadir al carrito <span class='glyphicon glyphicon-shopping-cart'></span></h4>
              </button>
          </form>
          ";
          ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</div>
<!-- References: https://github.com/fancyapps/fancyBox -->
<script>
$(document).ready(function(){
//FANCYBOX
//https://github.com/fancyapps/fancyBox
$(".fancybox").fancybox({
openEffect: "none",
closeEffect: "none"
});
});
</script>

<?php
      }
    } 
  }
?>
