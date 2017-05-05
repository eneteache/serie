<?php
  include('../navegacion.php');
  include ("../funciones/comprobarUsuario.php");
  comprobarUsuario();
  denegarInvitados();
  for ($i=0; $i <= 31 ; $i++) { 
    $cantidad[$i] =0;
  }

  $mes = date('n');
  
  $sql = "SELECT COUNT(*) AS cantidad, MONTH(fechaPedido) AS mes, DAY(fechaPedido) as dia
          FROM pedidos
          WHERE LEFT(fechaPedido, 7) = LEFT(now(),7)
          GROUP BY MONTH(fechaPedido), DAY(fechaPedido)
          ORDER BY MONTH(fechaPedido), DAY(fechaPedido) ASC";
  $result = mysqli_query($conexion, $sql);

  $visitas = "select * from visitas where url like '%producto.php%' order by fecha asc limit 30;";
  $rvisitas = mysqli_query($conexion, $visitas);
  $contador=0;
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  /* Ventas del mes actual */
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
          ['Día', 'Cantidad', { role: 'style' }],
      <?php
        while ($row = mysqli_fetch_array($result)) {
          if ($row['mes'] === $mes) {
        
      ?>
      
          ['<?php echo $row['dia'] ?>', <?php echo $row['cantidad'] ?> , '#607D8B'],            // RGB value
      <?php }} ?>
      ]);
    var options = {
      
    };
    var chart = new google.visualization.ColumnChart(document.getElementById('ventas-mes'));
    chart.draw(data, options);
  }

  /*Historico visitas*/
  google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(drawBasic);

function drawBasic() {

      var data = new google.visualization.DataTable();
      data.addColumn('number', 'X');
      data.addColumn('number', 'Visitas');

      data.addRows([
        

      <?php
        while ($row = mysqli_fetch_array($rvisitas)) {
      ?>
        
        [<?php echo substr($row['fecha'], 8,10) ?>, <?php echo $row['visitas'] ?>],

      <?php
        }
      ?>
      ]);

      var options = {
        
        hAxis: {
          title: 'Día del mes (últimos 30 días)'
        },
        vAxis: {
          title: 'Nº de visitas'
        }
      };

      var chart = new google.visualization.LineChart(document.getElementById('historico-visitas'));

      chart.draw(data, options);
    }
</script>
<style>
  .panel {
    margin: 50px;
    margin-bottom: 0;
    margin-top: 25px;
  }
  .panel:hover{
    border-color: #A9A9A9;
  }
  .panel-body{
    padding-right: 1px;
    padding-right: 30px;
  }
  .row{
    margin-bottom: 40px;
  }
</style>
<div class="container-fluid">
  <div class="row">
    
      <div class="panel panel-default">
        <div class="panel-body">
          <h3 class="text-center"><small>Número de ventas del mes actual</small></h3>
          <div id="ventas-mes"></div>
        </div>
      
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <h3 class="text-center"><small>Visitas de los productos (producto.php)</small></h3>
          <div id="historico-visitas" style="height:400px; "></div>
        </div>
      </div>
    </div>
  </div>
</div>



