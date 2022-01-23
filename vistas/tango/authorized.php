<?php
	//Código recibido por parámetro. El nombre del mismo depende del que se le haya puesto en el CallbackURL
	//Este valor es permanente mientras la aplicación no sea desautorizada, por lo cual no es necesario obtenerlo por cada operación, 
    //sino que puede almacenarse y volver a utilizarse cuantas veces se necesite.
	$UserIdentifier = $_GET["code"];
	
?>
<html>
	<head>
	</head>
	<body>
		<link href="style.css" rel="stylesheet" />
		<h2 id="title">API Tango factura - Demo de Integraci&oacute;n</h2>
		<div class="action">
			<h3>Aplicaci&oacute;n autorizada</h3>
			<div class="description">
				&iexcl;Listo! Ya autorizaste la aplicaci&oacute;n. Debajo pod&eacute;s ver tu User Identifier. Guardarlo para poder interactuar con Tango factura.<br />
				<span id="uid"><?php echo $UserIdentifier; ?></span>
			</div>
			<div class="description">
				Esta demo incluye ejemplos de creaci&oacute;n de clientes y de comprobantes desde la API. Para ello, edit&aacute; los archivos <strong>doCrearCliente.php </strong> y <strong>doFacturar.php </strong>
				incluyendo los datos de tu aplicaci&oacute;n y el UserIdentifier que obtuviste mediante este proceso.
				<br />
				Una vez editados, pod&eacute;s continuar con los ejemplos de la demo.
			</div>
			<a href="crearCliente.php" class="button">Crear cliente</a>
			<a href="facturar.php" class="button">Crear comprobante</a>
		</div>
	</body>
</html>