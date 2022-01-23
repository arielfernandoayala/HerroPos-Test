<?php
	require("/SDK/TangoFacturaServicioFacturacion.php");
	$ApplicationPublicKey = "X6w2OekGgVlNE3NJEgroCSginwBLvQ5i7cG5a0+syfM=";
	$Username = "/tmXkf6+LnCPpG2iN64dIs1nhPcP4IhQgJs3vqUnNzc=";
	$Password = "2pV5+HbpayeKwqL2JHvMhxBwWtPNSf6+APPHecHGzcA=";
	$UserIdentifier = "VFY3bGMrUGRSdXNzVEFHb1ZSdUxlZz09";
	if ($ApplicationPublicKey != "YOUR_APPLICATION_PUBLIC_KEY") { 
		$tfs = new TangoFacturaServicioFacturacion($ApplicationPublicKey, $Username, $Password, $UserIdentifier);
		
		//Creo la factura
		$movimiento = new FacturarModel();
		$movimiento->ClienteCodigo = $_POST["ClienteCodigo"];
		$movimiento->ClienteNombre = $_POST["ClienteRazonSocial"];
		$movimiento->CategoriaImpositivaCodigo = $_POST["ClientePerfilImpositivo"];
		$movimiento->ClienteTipoDocumento = $_POST["ClienteTipoDocumento"];
		$movimiento->ClienteNumeroDocumento = $_POST["ClienteNumeroDocumento"];
		$movimiento->Letra = $_POST["Letra"];
		$movimiento->DetallesMovimiento = array();
		$detalleMovimiento = new DetalleFacturarModel();
		$detalleMovimiento->Cantidad = $_POST["ConceptoCantidad"];
		$detalleMovimiento->Precio = $_POST["ConceptoImporte"];
		$detalleMovimiento->ProductoCodigo = $_POST["ConceptoCodigo"];
		$detalleMovimiento->ProductoNombre = $_POST["ConceptoNombre"];
		$movimiento->DetallesMovimiento[] = $detalleMovimiento;
		
		$tipoComprobante = $_POST["TipoComprobante"];
		
		if ($tipoComprobante == 1){
			$facturarResult = $tfs->CrearFactura($movimiento);
		} else if ($tipoComprobante == 2){
			$facturarResult = $tfs->CrearCreditoACuenta($movimiento);
		} else if ( $tipoComprobante == 3){
			$facturarResult = $tfs->CrearDebito($movimiento);
		}
		
		
	}
	
?>

<html>
	<head>
	</head>
	<body>
		<link href="style.css" rel="stylesheet" />
		<h2 id="title">API Tango factura - Demo de Integraci&oacute;n</h2>
		<?php if ($ApplicationPublicKey == "YOUR_APPLICATION_PUBLIC_KEY") { ?>
			<div class="action">
				<h3>No configuraste tu aplicaci&oacute;n</h3>
				<div class="description">
					Para poder crear la factura, es necesario que modifiques el archivo <strong>doFacturar.php</strong> incluyendo los datos de tu aplicaci&oacute;n y el User Identifier que obtuviste mediante el proceso de autorizaci&oacute;n.
				</div>
			</div>				
		<?php } else { ?>
			<div class="action">
				<h3>Factura creado</h3>
				<div class="description">
					La factura fue creado exitosamente. Hac&eacute; clic en el siguiente link para ver el comprobante<br />
					<span id="uid">
						<a target="_blank" href="<?php echo $facturarResult->UrlPDF ?>">
							Ver factura
						</a>
					</span>
					<br />
					<strong>Detalle de factura (objecto FacturarResultModel): </strong> 
					<br />
					<?php var_dump($facturarResult); ?>
				</div>
				
			</div>
		<?php } ?>
	</body>
</html>