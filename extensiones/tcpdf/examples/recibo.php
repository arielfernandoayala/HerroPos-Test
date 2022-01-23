<?php

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/cobranzaclientes.controlador.php";
require_once "../../../modelos/cobranzaclientes.modelo.php";

require_once "../../../controladores/imprecibo.controlador.php";
require_once "../../../modelos/imprecibo.modelo.php";

//Creamos la clase
class imprimirRecibo{
//Creamos una propiedad de la clase
public $nroRecibo;
//Creamos la funcion a llamar para crear el pdf
public function traerImpresionRecibo(){


$itemRecibo = "id";
$valorItem = $this->nroRecibo;

$respuestaRecibo = ControladorImpRecibos::ctrMostrarRecibosPdf($itemRecibo, $valorItem);

$idRecibo = $respuestaRecibo["id"];
$idVenta = $respuestaRecibo["id_venta"];
$importe = number_format($respuestaRecibo["importe"],2);
$fecha = $respuestaRecibo["fecha"];
$medio_de_pago = $respuestaRecibo["medio_de_pago"];
$identificacionPago = $respuestaRecibo["identificacion_pago"];
$entidad =  $respuestaRecibo["entidad"];
$cuotas = $respuestaRecibo["cant_cuotas"];
$razSocEmi = $respuestaRecibo["razon_soc_emisor"];
$cuitEmisor = $respuestaRecibo["cuit_emisor"];
$banco = $respuestaRecibo["banco"];
$nroChq = $respuestaRecibo["nro_chq"];
$fechaVencChq = $respuestaRecibo["fecha_chq"];


$itemCliente = "documento";
$docCliente = $respuestaRecibo["doc_cliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $docCliente);

//TRAEMOS LA INFORMACIÓN DE LA VENTA
$itemVenta = "id";

$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $idVenta);


//Creamos la variables que van a tomar los valores de la respuesta


//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();



$bloque1 = <<<EOD

  <table>
    
    <tr>
      
      <td style="width:145px">

        <img src="images/logo-negro-bloque.png">

      </td>

      <td style="background-color:white; width:300px; font-size:10px; text-align:center;">
          
          wwww.encasade-herrero.com - info@encasade-herrero.com

          <br>
          fb.com/herreroaberturas - Instagram.com/herreroaberturas

          <br>
          Tel: (0341) 4565906 | WhatsApp: 3416233209

          <br>
           Av. R. Rivarola 8001 - Esq. Manuel Gonzalez (2000) Rosario

      </td>


      <td style="background-color:white; border: 1px solid #666; width:90px; text-align:center">
        
        <br>
        Recibo

        <br>
        Nro.

        <br>
        $idRecibo        

      </td>

    </tr>

  </table>

  <hr>

EOD;

$pdf->writeHTMLCell(0, 0, '', '', $bloque1, 0, 1, 0, true, '', true);

// ---------------------------------------------------------


$bloque2 = <<<EOD
  
  <h2 style="text-align:right">
    Rosario, $fecha
  </h2>


  <h3>
  Recibo por parte de $respuestaCliente[nombre], DNI/CUIT/CUIL: $docCliente la suma total de: $ $importe en concepto de pago asociado a ALB Nro $respuestaVenta[codigo].
  <br>
  Medio de pago: $medio_de_pago .
  <br>
  Identificador: $identificacionPago -
  <br>
  Detalle de cheque:
  <br>
  </h3>

  <table style="font-size:10px; padding:5px 10px;">

    <tr>
    
    <td style="border: 1px solid #666; background-color:white; width:150px; text-align:center">Razón social
    </td>
    <td style="border: 1px solid #666; background-color:white; width:90px; text-align:center">Cuit emisor
    </td>
    <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Banco
    </td>
    <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Número
    </td>
    <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Fecha venc.
    </td>

    </tr>

  </table>
    <table style="font-size:10px; padding:5px 9px;">

    <tr>
    
    <td style="border: 1px solid #666; background-color:white; width:150px; text-align:center">$razSocEmi
    </td>
    <td style="border: 1px solid #666; background-color:white; width:90px; text-align:center">$cuitEmisor
    </td>
    <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">$banco
    </td>
    <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">$nroChq
    </td>
    <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">$fechaVencChq
    </td>

    </tr>

  </table>

  <table>
    
    <tr>
      
      <td style="width:540px"><img src="images/backFact1.jpg"><p style="text-align:right">Firma: ________________________</p></td>
    
    </tr>

  </table>

  <br>

  <hr>


EOD;

$pdf->writeHTMLCell(0, 0, '', '', $bloque2, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// -----------------------------------------------------------------------------
$bloque3 = <<<EOD

  <table>
    
    <tr>
      
      <td style="width:145px">

        <img src="images/logo-negro-bloque.png">

      </td>

      <td style="background-color:white; width:300px; font-size:10px; text-align:center;">
          
          wwww.encasade-herrero.com - info@encasade-herrero.com

          <br>
          fb.com/herreroaberturas - Instagram.com/herreroaberturas

          <br>
          Tel: (0341) 4565906 | WhatsApp: 3416233209

          <br>
           Av. R. Rivarola 8001 - Esq. Manuel Gonzalez (2000) Rosario

      </td>


      <td style="background-color:white; border: 1px solid #666; width:90px; text-align:center">
        
        <br>
        Recibo

        <br>
        Nro.

        <br>
        $idRecibo        

      </td>

    </tr>

  </table>

  <hr>


EOD;

$pdf->writeHTMLCell(0, 0, '', '', $bloque3, 0, 1, 0, true, '', true);

// ---------------------------------------------------------


$bloque4 = <<<EOD
  
  <h2 style="text-align:right">
    Rosario, $fecha
  </h2>


  <h3>
  Recibo por parte de $respuestaCliente[nombre], DNI/CUIT/CUIL: $docCliente la suma total de: $ $importe en concepto de pago asociado a ALB Nro $respuestaVenta[codigo].
  <br>
  Medio de pago: $medio_de_pago .
  <br>
  Identificador: $identificacionPago -
  <br>
  Detalle de cheque:
  <br>
  </h3>

  <table style="font-size:10px; padding:5px 10px;">

    <tr>
    
    <td style="border: 1px solid #666; background-color:white; width:150px; text-align:center">Razón social
    </td>
    <td style="border: 1px solid #666; background-color:white; width:90px; text-align:center">Cuit emisor
    </td>
    <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Banco
    </td>
    <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Número
    </td>
    <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Fecha venc.
    </td>

    </tr>

  </table>
    <table style="font-size:10px; padding:5px 9px;">

    <tr>
    
    <td style="border: 1px solid #666; background-color:white; width:150px; text-align:center">$razSocEmi
    </td>
    <td style="border: 1px solid #666; background-color:white; width:90px; text-align:center">$cuitEmisor
    </td>
    <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">$banco
    </td>
    <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">$nroChq
    </td>
    <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">$fechaVencChq
    </td>

    </tr>

  </table>

  <br>



EOD;

$pdf->writeHTMLCell(0, 0, '', '', $bloque4, 0, 1, 0, true, '', true);

// ---------------------------------------------------------




//SALIDA DEL ARCHIVO 
$pdfName = "Rec-".$valorItem.".pdf";
//Close and output PDF document
$pdf->Output($pdfName, 'D');

//============================================================+
// END OF FILE
//============================================================+
} // End "class imprimirRecibo"

} // End "function traerImpresionRecibo"


$reciboPdf = new imprimirRecibo();
$reciboPdf -> nroRecibo = $_GET["nroRecibo"];
$reciboPdf -> traerImpresionRecibo();

?>