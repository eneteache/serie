<?php
if (empty($_GET)) {
header('Location: index.php');
exit();
}
include('../funciones/funcionesConectarBD.php');
$conexion = conectarBD();
session_start();
$id = $_SESSION['id'];
$pedido = $_GET['pedido'];

$queryDatos = "select id_user, nombre, apellidos, pais, provincia, ciudad, codigopostal, direccion from usuarios where id_user = (select id_user from pedidos where idPedido=$pedido);";
$rqueryDatos = mysqli_fetch_array(mysqli_query($conexion, $queryDatos));
if ($rqueryDatos['id_user'] != $id ) {
  $_SESSION['error'] = "Aún no tenemos constancia de esta factura.";
  header('Location: index.php');
  exit();
}
$pedidos = "select * from pedidos where idPedido=$pedido;";
$rqueryPedidos = mysqli_fetch_array(mysqli_query($conexion, $pedidos));
$queryFactura = "
select pe.idPedido, fechaPedido, nombre, marca, descripcion, dp.nUnidades, dp.precioUnitario,  round(dp.nUnidades * dp.precioUnitario, 2) as subtotal
from productos p, detallespedidos dp, pedidos pe
where idProducto=id_producto and pe.idPedido=dp.idPedido and pe.idPedido=$pedido and id_user=$id;
";


$rqueryFactura = mysqli_query($conexion, $queryFactura);
$arrayFacturaFecha = mysqli_fetch_array($rqueryFactura);
$queryPais = "select pais from paises where id_pais={$rqueryDatos['pais']}";
$pais = mysqli_fetch_array(mysqli_query($conexion, $queryPais));
//Incluimos la librería


require_once '../mpdf/mpdf.php';
ob_end_clean();
$html = '<!DOCTYPE html>
<html>
<head>
  <title>Factura '. $arrayFacturaFecha["idPedido"].'</title>
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,700&subset=latin,latin-ext" rel="stylesheet" type="text/css">
  
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta http-equiv="content-type" content="text-html; charset=utf-8">
  <style type="text/css">
  :root {
      --fondoPrincipal : #607D8B;
      --fondoSecundario : #F5F5F5;
      --colorPrincipal : #607D8B;
    }
    html, body, div, span, applet, object, iframe,
    h1, h2, h3, h4, h5, h6, p, blockquote, pre,
    a, abbr, acronym, address, big, cite, code,
    del, dfn, em, img, ins, kbd, q, s, samp,
    small, strike, strong, sub, sup, tt, var,
    b, u, i, center,
    dl, dt, dd, ol, ul, li,
    fieldset, form, label, legend,
    table, caption, tbody, tfoot, thead, tr, th, td,
    article, aside, canvas, details, embed,
    figure, figcaption, footer, header, hgroup,
    menu, nav, output, ruby, section, summary,
    time, mark, audio, video {
      margin: 0;
      padding: 0;
      border: 0;
      font: inherit;
      font-size: 100%;
      vertical-align: baseline;
    }

    html {
      line-height: 1;
    }

    ol, ul {
      list-style: none;
    }

    table {
      border-collapse: collapse;
      border-spacing: 0;
    }

    caption, th, td {
      text-align: left;
      font-weight: normal;
      vertical-align: middle;
    }

    q, blockquote {
      quotes: none;
    }
    q:before, q:after, blockquote:before, blockquote:after {
      content: "";
      content: none;
    }

    a img {
      border: none;
    }

    article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary {
      display: block;
    }

    body {
      font-family: Source Sans Pro, sans-serif;
      font-weight: 300;
      font-size: 12px;
      margin: 0;
      padding: 0;
    }
    body a {
      text-decoration: none;
      color: inherit;
    }
    body a:hover {
      color: inherit;
      opacity: 0.7;
    }
    body .container {
      min-width: 500px;
      margin: 0 auto;
      padding: 0 20px;
    }
    body .clearfix:after {
      content: "";
      display: table;
      clear: both;
    }
    body .left {
      float: left;
    }
    body .right {
      float: right;
    }
    body .helper {
      display: inline-block;
      height: 100%;
      vertical-align: middle;
    }
    body .no-break {
      page-break-inside: avoid;
    }

    header {
      margin-top: 20px;
      margin-bottom: 50px;
    }
    header figure {
      float: left;
      width: 60px;
      height: 60px;
      margin-right: 10px;
      background-color: var(--fondoPrincipal);
      border-radius: 50%;
      text-align: center;
    }
    header figure img {
      margin-top: 13px;
    }
    header .company-address {
      float: left;
      max-width: 150px;
      line-height: 1.7em;
    }
    header .company-address .title {
      color: #607D8B;
      font-weight: 400;
      font-size: 1.5em;
      text-transform: uppercase;
    }
    header .company-contact {
      float: right;
      height: 60px;
      padding: 0 10px;
      background-color: #607D8B;
      color: white;
    }
    header .company-contact span {
      display: inline-block;
      vertical-align: middle;
    }
    header .company-contact .circle {
      width: 20px;
      height: 20px;
      background-color: white;
      border-radius: 50%;
      text-align: center;
    }
    header .company-contact .circle img {
      vertical-align: middle;
    }
    header .company-contact .phone {
      height: 100%;
      margin-right: 20px;
    }
    header .company-contact .email {
      height: 100%;
      min-width: 100px;
      text-align: right;
    }

    section .details {
      margin-bottom: 55px;
    }
    section .details .client {
      width: 50%;
      line-height: 20px;
    }
    section .details .client .name {
      color: #607D8B;
    }
    section .details .data {
      width: 50%;
      text-align: right;
    }
    section .details .title {
      margin-bottom: 15px;
      color: #607D8B;
      font-size: 1.8em;
      font-weight: 400;
      text-transform: uppercase;
    }
    section table {
      width: 100%;
      border-collapse: collapse;
      border-spacing: 0;
      font-size: 0.9166em;
    }
    section table .qty, section table .unit, section table .total {
      width: 15%;
    }
    section table .desc {
      width: 55%;
    }
    section table thead {
      display: table-header-group;
      vertical-align: middle;
      border-color: inherit;
    }
    section table thead th {
      padding: 5px 10px;
      background: #607D8B;
      border-bottom: 0px solid #FFFFFF;
      border-right: 0px solid #FFFFFF;
      text-align: right;
      color: white;
      font-weight: 400;
      text-transform: uppercase;
    }
    section table thead th:last-child {
      border-right: none;
    }
    section table thead .desc {
      text-align: left;
    }
    section table thead .qty {
      text-align: center;
    }
    section table tbody td {
      padding: 10px;
      background: #F5F5F5;
      color: #4D4D4D;
      text-align: right;
      border-bottom: 10px solid #FFFFFF;
      border-right: 4px solid #F5F5F5;
    }
    section table tbody td:last-child {
      border-right: none;
    }
    section table tbody h3 {
      margin-bottom: 5px;
      color: #4D4D4D;
      font-weight: 600;
    }
    section table tbody .desc {
      text-align: left;
    }
    section table tbody .qty {
      text-align: center;
    }
    section table.grand-total {
      margin-bottom: 45px;
    }
    section table.grand-total td {
      padding: 5px 10px;
      border: none;
      color: #6B6B6B;
      text-align: right;
    }
    section table.grand-total .desc {
      background-color: transparent;
    }
    section table.grand-total tr:last-child td {
      font-weight: 600;
      color: #607D8B;
      font-size: 1.18181818181818em;
    }

    footer {

      margin-bottom: 20px;
    }
    footer .thanks {
      margin-bottom: 40px;
      color: #607D8B;
      font-size: 1.16666666666667em;
      font-weight: 600;
    }
    footer .notice {
      margin-bottom: 25px;
    }
    footer .end {
      bottom: 10 px;
      padding-top: 5px;
      border-top: 2px solid #607D8B;
      text-align: center;
    }
  </style>
</head>

<body>
    <section>
      <div class="container">
        <div class="details clearfix">
          <div class="client left">
            <p style="color:var(--colorPrincipal); font-weight: bold;">Datos de facturación:</p>
            <p>'.$rqueryDatos['apellidos'] . ', ' . $rqueryDatos['nombre']. '</p>
            <p>'.$pais['pais'] .  ' - ' . $rqueryDatos['provincia'].'</p>
            <p>'.$rqueryDatos['ciudad'] . ', ' . $rqueryDatos['codigopostal'].'</p>
            <p>'.$rqueryDatos['direccion'].'</p>
          </div>
          <div class="data right">
            <div class="title">Pedido nº <small>'. $arrayFacturaFecha["idPedido"].'</small></div>
            <div class="date">
              Fecha del pedido: ';
              $fecha = date("d-m-Y", strtotime($arrayFacturaFecha['fechaPedido']));
              $html .= $fecha . '
            </div>
          </div>
        </div>
        <table cellspacing="0" cellpadding="0">
          <thead>
            <tr>
              <th class="desc">Producto</th>
              <th class="qty">Cantidad</th>
              <th class="unit">Precio</th>
              <th class="total">Total</th>
            </tr>
          </thead>
          <tbody>';
          $Factura = "
select pe.idPedido, fechaPedido, nombre, marca, descripcion, dp.nUnidades, dp.precioUnitario,  round(dp.nUnidades * dp.precioUnitario, 2) as subtotal
from productos p, detallespedidos dp, pedidos pe
where idProducto=id_producto and pe.idPedido=dp.idPedido and pe.idPedido=$pedido and id_user=$id;
";
$result = mysqli_query($conexion, $Factura);

            while($arrayFactura = mysqli_fetch_array($result)) {
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
            $html .= '
          </tbody>
        </table>
        <div class="no-break">
          <table class="grand-total" style="border-bottom: 10px solid #FFFFFF;border-top: 10px solid #FFFFFF;">
            <tbody>
              <tr>
                <td class="desc"></td>
                <td class="qty"></td>
                <td class="unit">SUBTOTAL:</td>
                <td class="total">'.$rqueryPedidos["importeTotal"] . ' €</td>
              </tr>
              <tr>
                <td class="desc"></td>
                <td class="unit" colspan="2">TOTAL: </td>
                <td class="total">'.$rqueryPedidos["importeTotal"] . ' €</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>
    <footer>
      <div class="container">
        <div class="thanks">¡Gracias por confíar en nosotros!</div>
        <div class="notice">
          <div></div>
          <div></div>
        </div>
        <div class="end">
        Factura generada automáticamente por Tienda Online S.L.</div>
      </div>
    </footer>
  </body>

</html>';
$filename = "factura-" . $arrayFacturaFecha["idPedido"]. ".pdf";
$pdf = new mPDF('c', 'A4');
$pdf->debug = true;
$pdf->writeHTML($html);
$pdf->Output($filename, 'I');
ob_start ();
ob_end_clean();
?>