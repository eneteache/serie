<!-- Style body -->
<style>
  .contenedor-body {
    padding-top: 20px;
  }
  .panel-body {
    padding: 13px;
  }
  .titulos > h3{
    margin-top: 5px;
    margin-bottom: 5px;
  }
  .titulos > hr {
    margin-top: 10px;
    margin-bottom: 10px;
  }
</style>
<?php

  //Obtener datos para mostrar en la portada
  function getNovedades($tipo){

    global $conexion;

    //Consulta
    $sql = "select titulo, poster, background, sinopsis from entradas where tipo='$tipo' limit 4";
    $resultado  = mysqli_query($conexion, $sql);

    while ($row = mysqli_fetch_assoc($resultado)) {
      $datos[] = $row;  
    }
    
    return $datos;

  }

  getNovedades('pelicula')



?>
<div class="container contenedor-body">
  <div class="row">
    <div class="col-md-8 div-col-xs-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12 titulos">
              
              <h3><small>Novedades</small></h3>
              <hr/>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-5">asd</div>
            <div class="col-md-3 col-sm-6 col-xs-5">asd</div>
            <div class="col-md-3 col-sm-6 col-xs-5">asd</div>
            <div class="col-md-3 col-sm-6 col-xs-5">asd</div>
          </div>
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12 titulos">
              
              <h3><small>Series más vistas</small></h3>
              <hr/>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-5">asd</div>
            <div class="col-md-3 col-sm-6 col-xs-5">asd</div>
            <div class="col-md-3 col-sm-6 col-xs-5">asd</div>
            <div class="col-md-3 col-sm-6 col-xs-5">asd</div>
          </div>
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12 titulos">
              
              <h3><small>Series más valoradas</small></h3>
              <hr/>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-5">asd</div>
            <div class="col-md-3 col-sm-6 col-xs-5">asd</div>
            <div class="col-md-3 col-sm-6 col-xs-5">asd</div>
            <div class="col-md-3 col-sm-6 col-xs-5">asd</div>
          </div>
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12 titulos">
              
              <h3><small>Peliculas más vistas</small></h3>
              <hr/>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-5">asd</div>
            <div class="col-md-3 col-sm-6 col-xs-5">asd</div>
            <div class="col-md-3 col-sm-6 col-xs-5">asd</div>
            <div class="col-md-3 col-sm-6 col-xs-5">asd</div>
          </div>
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12 titulos">
              
              <h3><small>Peliculas mejor valoradas</small></h3>
              <hr/>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-5">asd</div>
            <div class="col-md-3 col-sm-6 col-xs-5">asd</div>
            <div class="col-md-3 col-sm-6 col-xs-5">asd</div>
            <div class="col-md-3 col-sm-6 col-xs-5">asd</div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4 div-col-xs-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12 titulos">
              <h3><small>Estadísticas</small></h3>
              <hr>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>