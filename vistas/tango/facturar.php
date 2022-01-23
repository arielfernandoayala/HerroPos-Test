<html>
	<head>
	</head>
	<body>
		<link href="style.css" rel="stylesheet" />
		<h2 id="title">API Tango factura - Demo de Integraci&oacute;n</h2>
		<div class="action">
			<h3>Creación de cliente</h3>
			<div class="description">
				Record&aacute; editar el archivo <strong>doFacturar.php</strong> incluyendo los datos de tu aplicaci&oacute;n y el User Identifier que obtuviste durante la autorizaci&oacute;n
			</div>
			<div class="description">
				Ingresá los datos del comprobante a crear:
				<form action="doFacturar.php" method="POST">
					<div class="input">
						Tipo de comprobante <br />
						<select id="TipoComprobante" name="TipoComprobante">
							<option value="1">Factura</option>
							<option value="2">Cr&eacute;dito</option>
							<option value="3">D&eacute;bito</option>
						</select>
					</div>
					<div class="input">
						Letra: <br />
						<select id="Letra" name="Letra">
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="C">C</option>
						</select>
					</div>
					<div class="input">
						Código cliente: <br /><input id="ClienteCodigo" name="ClienteCodigo" />
					</div>
					<div class="input">
						Razón social cliente: <br /><input id="ClienteRazonSocial" name="ClienteRazonSocial" />
					</div>
					<div class="input">
						Tipo documento: <br />
						<select id="ClienteTipoDocumento" name="ClienteTipoDocumento">
							<option value="1">D.N.I.</option>
							<option value="2">C.U.I.T.</option>
							<option value="3">C.I.</option>
							<option value="4">L.E.</option>
							<option value="5">L.C.</option>
							<option value="6">C.U.I.L.</option>
						</select>
					</div>
					<div class="input">
						Número documento: <br /><input id="ClienteNumeroDocumento" name="ClienteNumeroDocumento" />
					</div>
					<div class="input">
						Perfil impositivo: <br />
						<select id="ClientePerfilImpositivo" name="ClientePerfilImpositivo">
							<option value="RI">Responsable inscripto</option>
							<option value="MT">Responsable monotributo</option>
							<option value="CF">Consumidor final</option>
							<option value="EX">Exento</option>
						</select>
					</div>
					<div class="input">
						C&oacute;digo producto/servicio a facturar: <br /><input id="ConceptoCodigo" name="ConceptoCodigo" />
					</div>
					<div class="input">
						Nombre producto/servicio a facturar: <br /><input id="ConceptoNombre" name="ConceptoNombre" />
					</div>
					<div class="input">
						Cantidad: <br /><input id="ConceptoCantidad" name="ConceptoCantidad" />
					</div>
					<div class="input">
						Precio: <br /><input id="ConceptoImporte" name="ConceptoImporte" />
					</div>
				</form>
				<a class="button" href="#" onclick="createSingle(); return false;">Crear comprobante</a>
				<a class="button" href="#" onclick="createBatch(); return false;">Crear 10 facturas (Creación por comprobante)</a>
			</div>
			
		</div>
		<script src="https://code.jquery.com/jquery-3.0.0.min.js" integrity="sha256-JmvOoLtYsmqlsWxa7mDSLMwa6dZ9rrIdtrrVYRnDRH0=" crossorigin="anonymous"></script>
		<script type="text/javascript">
			function submit(){
				$("form").submit();
			}
			
			function createSingle(){
				$("form").attr("action","doFacturar.php");
				submit();
			}
			
			function createBatch(){
				$("form").attr("action","doFacturarBatch.php");
				submit();
			}
		</script>
	</body>
</html>