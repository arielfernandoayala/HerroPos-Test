<?php
	//Este proceso recibe los datos para crear un comprobante, y crea 10 comprobantes iguales utilizando el proceso de creación por lotes
	require("SDK/TangoFacturaServicioFacturacion.php");
	$ApplicationPublicKey = "4ZqVXbzRYdX1EWp3uWu4TUjqWdgC+JB4TCpL1XuEE00=";
	$Username = "pKuSpP0cXEEQCrhonL+/PGXXQ9rNa5D+cGfRbjL83d4=";
	$Password = "oZi8kFAD+Iyk3y75Nzvy/Q3W5DRmDWAcvsk4qrtS5SA=";
	$UserIdentifier = "MjNxTUlEMjFhbjloaHE3M1pQZGJVUT09";
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
		
		//Setear TipoMovimiento solo sirve para la creación por lotes.
		//La funcionalidad de creación de débitos por lotes aún no está implementada.
		$movimiento->TipoMovimiento = $_POST["TipoComprobante"];
		$movimientos = array();
		
		for ($i = 0; $i<10; $i++){
			$movimientos[] = $movimiento;
		}
		
		$facturarResult = $tfs->CrearLoteMovimientos($movimientos);
		
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
				<h3>Se crearon <?php echo sizeof($facturarResult->FacturarResultModel);?> comprobantes </h3>
				<div class="description">
					<strong>Detalle de comprobantes creados (objeto CrearLoteMovimientosResult): </strong> 
					<br />
					<?php var_dump($facturarResult); ?>
				</div>
				
			</div>
		<?php } ?>
	</body>
</html>
