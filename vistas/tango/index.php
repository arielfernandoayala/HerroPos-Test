<?php
	require("/SDK/TangoFacturaServicioFacturacion.php");
?>
<html>
	<head>
	</head>
	<body>
		<link href="style.css" rel="stylesheet" />
		<h2 id="title">API Tango factura - Demo de Integración</h2>
		
		<div class="action">
			<h3>Como crear una aplicación</h3>
			<div class="description">
				Para poder interactuar con Tango factura, tenés que crear una aplicación ingresando con tu cuenta
			</div>
			<a href="<?php echo TangoFacturaServicioFacturacion::GetCreateAppUrl()?>" class="button" target="_blank">Crear aplicación</a>
		</div>
		
		<div class="action">
			<h3>Como obtener la autorización para que tu sistema pueda interactuar con tu aplicación de Tango factura </h3>
			<form action="autorizarAplicacion.php" method="POST" id="autorizarAppForm">
				<div class="description">
					Una vez creada una aplicación, tenés que autorizar a tu sistema para que pueda acceder a tus datos de Tango factura.<br />
					Para ello, ingresá la clave pública que obtuviste al crear tu aplicación en los siguientes campos. 
				</div>
				<div class="input">
					Nombre que se muestra en la pantalla de autorización: <br /><input id="appFriendlyName" name="appFriendlyName" />
				</div>
				<div class="input">
					Clave pública: <br /><input id="appPublicKey" name="appPublicKey" />
				</div>
			</form>
			<a href="#" onclick="autorizarApp(); return false;" class="button">Autorizar aplicación</a>
		</div>
		
		<div class="action">
			<h3>Si ya creaste y autorizaste tu aplicación...</h3>
			<div class="description">
				Probá los ejemplos de implementación de esta demo. Recordá completar las credenciales de tu aplicación en <strong>doCrearCliente.php</strong> y <strong>doFacturar.php</Strong>
			</div>
			<a href="crearCliente.php" class="button">Crear cliente</a>
			<a href="facturar.php" class="button">Crear comprobante</a>
		</div>
		<script src="https://code.jquery.com/jquery-3.0.0.min.js" integrity="sha256-JmvOoLtYsmqlsWxa7mDSLMwa6dZ9rrIdtrrVYRnDRH0=" crossorigin="anonymous"></script>
		<script type="text/javascript">
			function autorizarApp(){
				$("#autorizarAppForm").submit();
			}
		</script>
	</body>
	
</html>