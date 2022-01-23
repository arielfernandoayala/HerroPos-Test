<html>
	<head>
	</head>
	<body>
		<link href="style.css" rel="stylesheet" />
		<h2 id="title">API Tango factura - Demo de Integraci&oacute;n</h2>
		<div class="action">
			<h3>Consulta de comprobante</h3>
			<div class="description">
				Record&aacute; editar el archivo <strong>doObtenerInfoMovimiento.php</strong> incluyendo los datos de tu aplicaci&oacute;n y el User Identifier que obtuviste durante la autorizaci&oacute;n
			</div>
			<div class="description">
				Ingresá los datos del comprobante que quer&eacute;s consultar:
				<form action="doObtenerInfoMovimiento.php" method="POST">
					<div class="input">
						MovimientoID: <br /><input id="MovimientoID" name="MovimientoID" />
					</div>
					<div class="input">
						C&oacute;digo de autorizaci&oacute;n electr&oacute;nico: <br /><input id="CAE" name="CAE" />
					</div>
				</form>
				<a class="button" href="#" onclick="submit(); return false;">Consultar</a>
			</div>
			
		</div>
		<script src="https://code.jquery.com/jquery-3.0.0.min.js" integrity="sha256-JmvOoLtYsmqlsWxa7mDSLMwa6dZ9rrIdtrrVYRnDRH0=" crossorigin="anonymous"></script>
		<script type="text/javascript">
			function submit(){
				$("form").submit();
			}
		</script>
	</body>
</html>