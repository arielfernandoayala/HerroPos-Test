<?php

require_once "../../../controladores/presupuestoRapido.controlador.php";
require_once "../../../modelos/presupuestoRapido.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

class imprimirPresupuestoRapido{

public $codigo;

public function traerImpresionPresupuestoRapido(){

//TRAEMOS LA INFORMACIÓN DEL PRESUPUESTO

$itemPresupuestoRapido = "codigo";
$nroDePresupuestoRapido = $this->codigo;

$respuestaVenta = ControladorPresupuestosRapidos::ctrMostrarPresupuestosRapidos($itemPresupuestoRapido, $nroDePresupuestoRapido);

$fecha = substr($respuestaVenta["fecha"],0,-8);
$newDate = date("d-m-Y", strtotime($fecha));
$productos = json_decode($respuestaVenta["productos"], true);
$neto = number_format($respuestaVenta["neto"],2);
$modificacion = number_format($respuestaVenta["modificacion"],2);
$total = number_format($respuestaVenta["total"],2);

//TRAEMOS LA INFORMACIÓN DEL CLIENTE

$itemCliente = "id";
$valorCliente = $respuestaVenta["id_cliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

//TRAEMOS LA INFORMACIÓN DEL VENDEDOR

$itemVendedor = "id";
$valorVendedor = $respuestaVenta["id_vendedor"];

$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

// ---------------------------------------------------------

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
		Presup

        <br>
        Nro

        <br>
         $nroDePresupuestoRapido      

      </td>

    </tr>

  </table>

  <hr>

EOD;

$pdf->writeHTMLCell(0, 0, '', '', $bloque1, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

$bloque2 = <<<EOD

	<table>
		
		<tr>
			
			<td style="width:540px"><img src="images/back.jpg"></td>
		
		</tr>

	</table>

	<table style="font-size:10px; padding:5px 10px;">
	
		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:390px">

				Cliente: $respuestaCliente[nombre]

			</td>

			<td style="border: 1px solid #666; background-color:white; width:150px; text-align:right">
			
				Fecha: $newDate

			</td>

		</tr>

		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:540px">Vendedor: $respuestaVendedor[nombre]</td>

		</tr>

		<tr>
		
		<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

		</tr>

	</table>

EOD;

$pdf->writeHTMLCell(0, 0, '', '', $bloque2, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

$bloque3 = <<<EOD

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
		<td style="border: 1px solid #666; background-color:white; width:60px; text-align:center">Cod</td>
		<td style="border: 1px solid #666; background-color:white; width:260px; text-align:center">Producto</td>
		<td style="border: 1px solid #666; background-color:white; width:60px; text-align:center">Cant</td>
		<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Valor Unit.</td>
		<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Valor Total</td>

		</tr>

	</table>

EOD;

$pdf->writeHTMLCell(0, 0, '', '', $bloque3, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

foreach ($productos as $key => $item) {

$itemProducto = "descripcion";
$valorProducto = $item["descripcion"];
$orden = null;

$respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto, $valorProducto, $orden);

$valorUnitario = number_format($item["precio"], 2);
$valorBonificado = number_format($item["precio_contado"], 2);
/*APLICO BONIFICACION -15% PARA IMPRIMIR EN PRESUPUESTO*/



$precioTotal = number_format($item["total"], 2);

$bloque4 = <<<EOD

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:60px; text-align:center">
				$item[id]
			</td>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
				$item[descripcion]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:60px; text-align:center">
				$item[cantidad]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">$ 
				$valorUnitario<br>$ $valorBonificado
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">$ 
				$precioTotal
			</td>


		</tr>

	</table>


EOD;

$pdf->writeHTMLCell(0, 0, '', '', $bloque4, 0, 1, 0, true, '', true);

}

// ---------------------------------------------------------

$bloque5 = <<<EOD

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>

		</tr>
		
		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666;  background-color:white; width:100px; text-align:center">
				Sub-Total:
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $neto
			</td>

		</tr>

		<tr>

			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Modificación:
			</td>
		
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $modificacion
			</td>

		</tr>

		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Total:
			</td>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $total
			</td>

		</tr>


	</table>

EOD;

$pdf->writeHTMLCell(0, 0, '', '', $bloque5, 0, 1, 0, true, '', true);



// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 
$pdfName = "Presup".$nroDePresupuestoRapido.".pdf";

$pdf->Output($pdfName, 'D');

}

}

$presupuestoRapido = new imprimirPresupuestoRapido();
$presupuestoRapido -> codigo = $_GET["codigo"];
$presupuestoRapido -> traerImpresionPresupuestoRapido();

?>