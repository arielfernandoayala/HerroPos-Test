<?php


// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->AddPage();


// Set some content to print
$bloque1 = <<<EOD
	<table>
		<tr>
			<td style="width:150px"><img src="images/logo-negro-bloque.png"></td>
			<td style="background-color:white; width:140px">
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					<br>
					CUIT 27-20167608-3
					<br>
					RIVAROLA 8001-ROSARIO
				</div>
			</td>

			<td style="background-color:white; width:140px">
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					<br>
					Whatsapp: 3416233209
					<br>
					www.encasade-herrero.com
				</div>
			</td>

			<td style="background-color:white; width:110px">
				<div style="font-size:8.5px; text-align:center; color:red; line-height:15px;">
					<br>
					COMP NRO:
				</div>
			</td>
		</tr>
	</table>

EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque1, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');


