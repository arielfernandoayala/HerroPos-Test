<?php
	//require("SDK/TangoFacturaServicioFacturacion.php");


	$ApplicationPublicKey = "4ZqVXbzRYdX1EWp3uWu4TUjqWdgC+JB4TCpL1XuEE00=";
	$Username = "pKuSpP0cXEEQCrhonL+/PGXXQ9rNa5D+cGfRbjL83d4=";
	$Password = "oZi8kFAD+Iyk3y75Nzvy/Q3W5DRmDWAcvsk4qrtS5SA=";
	$UserIdentifier = "MjNxTUlEMjFhbjloaHE3M1pQZGJVUT09";
	if ($ApplicationPublicKey != "YOUR_APPLICATION_PUBLIC_KEY") { 
		$tfs = new TangoFacturaServicioFacturacion($ApplicationPublicKey, $Username, $Password, $UserIdentifier);
		
		//Creo la factura
		


		$movimiento = new FacturarModel();
		$ClienteDomicilio = new ClienteDireccionExtendida();
		$movimiento->ClienteCodigo = $_POST["ClienteCodigo"];
		$movimiento->ClienteNombre = $_POST["ClienteRazonSocial"];
		$movimiento->CategoriaImpositivaCodigo = $_POST["ClientePerfilImpositivo"];
		$movimiento->ClienteTipoDocumento = $_POST["ClienteTipoDocumento"];
		$movimiento->ClienteNumeroDocumento = $_POST["ClienteNumeroDocumento"];
		$movimiento->Letra = $_POST["Letra"];
		$movimiento->ClienteEmail = $_POST["ClienteEmailFactura"];

		//$movimiento->ClienteDireccion = $_POST["ClienteDirExtCalle"];


		$ClienteDomicilio->Calle = $_POST["ClienteDirExtCalle"];
		$ClienteDomicilio->Numero = $_POST["ClienteDirExtNro"]; 
		$ClienteDomicilio->Piso = $_POST["ClienteDirExtPiso"]; 
		$ClienteDomicilio->Departamento = $_POST["ClienteDirExtDepartamento"]; 
		$ClienteDomicilio->Localidad = $_POST["ClienteDirExtLocalidad"]; 
		$ClienteDomicilio->CodigoPostal = $_POST["ClienteDirExtCP"];  
		$ClienteDomicilio->Provincia = $_POST["ClienteDirExtProvincia"];

		$movimiento->ClienteDireccionExtendida = $ClienteDomicilio;
		$movimiento->DetallesMovimiento = array(); 
/*
		$detalleMovimiento = new DetalleFacturarModel();
		
		$detalleMovimiento->Cantidad = $_POST["ConceptoCantidad"];
		$detalleMovimiento->Precio = $_POST["ConceptoImporte"];
		$detalleMovimiento->ProductoCodigo = $_POST["ConceptoCodigo"];
		$detalleMovimiento->ProductoNombre = $_POST["ConceptoNombre"];

		$movimiento->DetallesMovimiento[] = $detalleMovimiento;
	*/	


		$item = "id";
        $valor = $_POST["idVentaAFacturar"];

       
        //echo ('<input type="number" value="'.$valor.'">');

        $venta = ControladorVentas::ctrMostrarVentas($item, $valor);
        //Bonificacion guardad en la bae, recordar que tiene que ser un numero no negativo
        $bonif = $venta["venta_porcentaje"];

        $listaProducto = json_decode($venta["productos"], true);

        //print_r($listaProducto);
        
        //var_dump($listaProducto);

        $contador = 0;

		foreach ($listaProducto as $key => $value) {
			$detalleMovimiento = new DetalleFacturarModel();
			$Cantidad = $value["cantidad"];
			$Precio = number_format($value["precio"],2,",",".");
			$ProductoCodigo = $value["id"];
			$ProductoNombre = $value["descripcion"];

/*
			echo $contador;

			echo $Cantidad;
			echo $Precio;
			echo $ProductoCodigo;
			echo $ProductoNombre;
*/

			$detalleMovimiento->Cantidad = $Cantidad;
			$detalleMovimiento->Precio = $Precio;
			$detalleMovimiento->ProductoCodigo = $ProductoCodigo;
			$detalleMovimiento->ProductoNombre = $ProductoNombre;
			$detalleMovimiento->Bonificacion = $bonif;

			$movimiento->DetallesMovimiento[] = $detalleMovimiento;

			//print_r($movimiento->DetallesMovimiento[$contador]);
			$contador = $contador + 1;

		}

		//print_r($movimiento->DetallesMovimiento);


		
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
<div class="content-wrapper">
  <section class="content-header">  
    <ol class="breadcrumb">    
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>   
      <li class="active">Factura</li>  
    </ol>
  </section>
  <section class="content">

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
			<div class="description">
				<h3>Factura creada</h3>
				<div class="description">
					La factura fue creado exitosamente. Hac&eacute; clic en el siguiente link para ver el comprobante<br />
					<span id="uid">
						<a target="_blank" href="<?php echo $facturarResult->UrlPDF ?>">
							<h4>Ver factura</h4>
						</a>
					</span>
					<br />
					<strong>Detalle de factura (objecto FacturarResultModel): </strong> 
					<br />
					<?php // var_dump($facturarResult); ?>
				</div>
				
			</div>
		<?php } ?>
	</section>
</div>

<script> 
  function r() { window.location = "ventas"; } 
  setTimeout ("r()", 15000);
</script>
