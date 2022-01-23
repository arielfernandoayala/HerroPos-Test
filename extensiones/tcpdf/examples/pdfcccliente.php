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

require_once "../../../controladores/cccliente.controlador.php";
require_once "../../../modelos/cccliente.modelo.php";

//Creamos la clase
class imprimirCCCliente{
//Creamos una propiedad de la clase
public $idClienteCC;
public $docCliente;
//Creamos la funcion a llamar para crear el pdf
public function traerImpresionCCClinete(){


$itemCCCliente = "ccc_id_cliente";
$valorItem = $this->idClienteCC;

$respuestaCCCliente = ControladorCCCliente::ctrMostrarCCCliente($itemCCCliente, $valorItem);

$itemCliente = "id";

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorItem);

$razonSocCliente = $respuestaCliente["nombre"];
$docuCliente = $respuestaCliente["documento"];
$emailCliente = $respuestaCliente["email"];
$telCel = $respuestaCliente["telefono"];
$cantCompras = $respuestaCliente["compras"];

$fecha = date('d-m-Y');


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


        <br>
        $fecha 

        <br>
               

      </td>

    </tr>

  </table>

  <hr>

EOD;

$pdf->writeHTMLCell(0, 0, '', '', $bloque1, 0, 1, 0, true, '', true);

// ---------------------------------------------------------


$bloque2 = <<<EOD
  


  <table style="font-size:10px; padding:5px 10px;">

    <tr>
    
    <td style="border: 1px solid #666; background-color:white; width:150px; text-align:center">Razón social
    </td>
    <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">CUIT/CUIL/DNI
    </td>
    <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Tel/Cel
    </td>
    <td style="border: 1px solid #666; background-color:white; width:150px; text-align:center">E-mail
    </td>
    <td style="border: 1px solid #666; background-color:white; width:40px; text-align:center">N°
    </td>

    </tr>

  </table>
    <table style="font-size:10px; padding:5px 9px;">

    <tr>
    
    <td style="border: 1px solid #666; background-color:white; width:150px; text-align:center">$razonSocCliente
    </td>
    <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">$docuCliente
    </td>
    <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">$telCel
    </td>
    <td style="border: 1px solid #666; background-color:white; width:150px; text-align:center">$emailCliente
    </td>
    <td style="border: 1px solid #666; background-color:white; width:40px; text-align:center">$cantCompras
    </td>

    </tr>

  </table>

  <br>

  <hr>


EOD;

$pdf->writeHTMLCell(0, 0, '', '', $bloque2, 0, 1, 0, true, '', true);

// ---------------------------------------------------------


$bloque3 = <<<EOD
  
  <table style="font-size:10px; padding:5px 10px;">
    <tr>
      <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Fecha</td>
      <td style="border: 1px solid #666; background-color:white; width:140px; text-align:center">Detalle</td>
      <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Crédito</td>
      <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Débito</td>
      <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Saldo</td>
    </tr>
  </table>


EOD;

$pdf->writeHTMLCell(0, 0, '', '', $bloque3, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

foreach ($respuestaCCCliente as $key => $item) {
  $newDate = date("d-m-Y", strtotime($item["ccc_fecha_mov"]));

  $fechaMov = $newDate;
  $detalleMov = $item["ccc_detalle"];
  $creditoMov = number_format($item["ccc_debe"],2);
  $debitoMov = number_format($item["ccc_haber"],2);
  $SaldoMov = number_format($item["ccc_saldo"],2);

  $bloque4 = <<<EOD

    <table style="font-size:10px; padding:0px ;">
      <tr>
        <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$fechaMov</td>
        <td style="border: 1px solid #666; color:#333; background-color:white; width:140px; text-align:center">$detalleMov</td>
        <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$creditoMov</td>
        <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$debitoMov</td>
        <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$SaldoMov</td>
      </tr>
  </table>


EOD;

$pdf->writeHTMLCell(0, 0, '', '', $bloque4, 0, 1, 0, true, '', true);

}

// ---------------------------------------------------------




//SALIDA DEL ARCHIVO 
$pdfName = "CtaCte-".$_GET["idClienteCC"].".pdf";
//Close and output PDF document
$pdf->Output($pdfName, 'D');

//============================================================+
// END OF FILE
//============================================================+
} // End "class imprimirRecibo"

} // End "function traerImpresionRecibo"


$CtaCtePdf = new imprimirCCCliente();
$CtaCtePdf -> idClienteCC = $_GET["idClienteCC"];
$CtaCtePdf -> traerImpresionCCClinete();

?>