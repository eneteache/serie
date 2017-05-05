<?php
include('../funciones/funcionesConectarBD.php');
$conexion = conectarBD();
$queryFactura = "
select pe.idPedido, fechaPedido, nombre, marca, descripcion, dp.nUnidades, dp.precioUnitario,  round(dp.nUnidades * dp.precioUnitario, 2) as subtotal
from productos p, detallespedidos dp, pedidos pe
where idProducto=id_producto and pe.idPedido=dp.idPedido and pe.idPedido=5 and id_user=2;
";
$rqueryFactura = mysqli_query($conexion, $queryFactura);
/*$html = '<table border="1">';
	while($arrayFactura = mysqli_fetch_array($rqueryFactura)) {
	$html .= '<tr>
		<td class="desc">
			<h3>'. $arrayFactura['nombre'] . ' - '. $arrayFactura['marca'].'</h3>'.
			$arrayFactura['descripcion'] .
		'</td>
		<td class="qty">'.$arrayFactura['nUnidades']. '</td>
		<td class="unit">'.$arrayFactura['precioUnitario']. " €".'</td>
		<td class="total">'.$arrayFactura['subtotal']. " €".'</td>
	</tr>';
	
		
	}
$html .= '</table>';
echo $html;*/
$html = '
<table border="1" cellspacing="0" cellpadding="0">
          <thead>
            <tr>
              <th class="desc">Producto</th>
              <th class="qty">Cantidad</th>
              <th class="unit">Precio</th>
              <th class="total">Total</th>
            </tr>
          </thead>
          <tbody>';
            while($arrayFactura = mysqli_fetch_array($rqueryFactura)) {
            $html .= '<tr>
              <td class="desc">
                <h3>'. $arrayFactura['nombre'] . ' - '. $arrayFactura['marca'].'</h3>'.
                $arrayFactura['descripcion'] .
              '</td>
              <td class="qty">'.$arrayFactura['nUnidades']. '</td>
              <td class="unit">'.$arrayFactura['precioUnitario']. " €".'</td>
              <td class="total">'.$arrayFactura['subtotal']. " €".'</td>
            </tr>';
            echo $arrayFactura['nombre'];
            }
            $html .= '
          </tbody>
        </table>';
echo $html;
?>