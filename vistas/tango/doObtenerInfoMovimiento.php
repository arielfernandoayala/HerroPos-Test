<?php
	require("/SDK/TangoFacturaServicioFacturacion.php");
	$ApplicationPublicKey = "YOUR_APPLICATION_PUBLIC_KEY";
	$Username = "YOUR_APPLICATION_USERNAME";
	$Password = "YOUR_APPLICATION_PASSWORD";
	$UserIdentifier = "YOUR_USER_IDENTIFIER";
	if ($ApplicationPublicKey != "YOUR_APPLICATION_PUBLIC_KEY") { 
		$tfs = new TangoFacturaServicioFacturacion($ApplicationPublicKey, $Username, $Password, $UserIdentifier);
		if (isset($_POST["MovimientoID"]) && !empty($_POST["MovimientoID"])){
			$facturarResult = $tfs->ObtenerInfoMovimiento($_POST["MovimientoID"]);
		} else if (isset($_POST["CAE"]) && !empty($_POST["CAE"])){
			$facturarResult = $tfs->ObtenerInfoMovimientoPorCAE($_POST["CAE"]);
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
				<h3>Consulta de comprobante</h3>
				<div class="description">
					Hac&eacute; clic en el siguiente link para ver el comprobante<br />
					<span id="uid">
						<a target="_blank" href="<?php echo $facturarResult->UrlPDF ?>">
							Ver comprobante
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