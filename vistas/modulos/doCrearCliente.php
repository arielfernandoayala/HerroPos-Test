<?php
	require("SDK/TangoFacturaServicioFacturacion.php");
	$ApplicationPublicKey = "4ZqVXbzRYdX1EWp3uWu4TUjqWdgC+JB4TCpL1XuEE00=";
	$Username = "pKuSpP0cXEEQCrhonL+/PGXXQ9rNa5D+cGfRbjL83d4=";
	$Password = "oZi8kFAD+Iyk3y75Nzvy/Q3W5DRmDWAcvsk4qrtS5SA=";
	$UserIdentifier = "MjNxTUlEMjFhbjloaHE3M1pQZGJVUT09";
	if ($ApplicationPublicKey != "YOUR_APPLICATION_PUBLIC_KEY") { 
		$tfs = new TangoFacturaServicioFacturacion($ApplicationPublicKey, $Username, $Password, $UserIdentifier);
		
		//Creo el cliente model para enviar a Tango factura
		$cliente = new Cliente();
		$cliente->ClienteCodigo = $_POST["ClienteCodigo"];
		$cliente->ClienteNombre = $_POST["ClienteNombre"];
		$cliente->ClienteDireccion = new ClienteDireccionExtendida();
		$cliente->ClienteDireccion->Calle = $_POST["ClienteDireccion"];
		$cliente->ClientePerfilImpositivoCodigo = $_POST["ClientePerfilImpositivo"];
		$cliente->ClienteEmail = array();
		$email = new Email();
		$email->TipoEmail = "Particular";
		$email->Email = $_POST["ClienteEmail"];
		$cliente->ClienteEmail[] = $email;
		$cliente->CrearAunRepetido = false;
		$cliente->ClienteTipoDocumento = $_POST["ClienteTipoDocumento"];
		$cliente->ClienteNumeroDocumento = $_POST["ClienteNumeroDocumento"];
		
		$clienteResult = $tfs->CrearCliente($cliente);
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
					Para poder crear el cliente, es necesario que modifiques el archivo <strong>doCrearCliente.php</strong> incluyendo los datos de tu aplicaci&oacute;n y el User Identifier que obtuviste mediante el proceso de autorizaci&oacute;n.
				</div>
			</div>				
		<?php } else { ?>
			<div class="action">
				<h3>Cliente creado</h3>
				<div class="description">
					El cliente fue creado exitosamente. Hac&eacute; clic en el siguiente link para ir visualizar sus datos en Tango factura<br />
					<span id="uid">
						<a target="_blank" href="<?php echo TangoFacturaServicioFacturacion::GetBaseURL()."/ERP/Clientes/Details/".$clienteResult->ClienteID;?>">
							Ver cliente
						</a>
					</span>
				</div>
				
			</div>
		<?php } ?>
	</body>
</html>