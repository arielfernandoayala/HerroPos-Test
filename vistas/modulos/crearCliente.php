<html>
	<head>
	</head>
	<body>
		<link href="style.css" rel="stylesheet" />
		<h2 id="title">API Tango factura - Demo de Integraci&oacute;n</h2>
		<div class="action">
			<h3>Creación de cliente</h3>
			<div class="description">
				Record&aacute; editar el archivo <strong>doCrearCliente.php</strong> incluyendo los datos de tu aplicaci&oacute;n y el User Identifier que obtuviste durante la autorizaci&oacute;n
			</div>
			<div class="description">
				Ingresá los datos del cliente a crear:
				<form action="doCrearCliente.php" method="POST">
					<input type="hidden" value="1" name="ClientePerfil" />
					<div class="input">
						Código: <br /><input id="ClienteCodigo" name="ClienteCodigo" />
					</div>
					<div class="input">
						Nombre: <br /><input id="ClienteNombre" name="ClienteNombre" />
					</div>
					<div class="input">
						Tipo documento: <br />
						<select id="ClienteTipoDocumentoSelect">
							<option value="1">D.N.I.</option>
							<option value="2">C.U.I.T.</option>
							<option value="3">C.I.</option>
							<option value="4">L.E.</option>
							<option value="5">L.C.</option>
							<option value="6">C.U.I.L.</option>
						</select>
						<input type="hidden" name="ClienteTipoDocumento" id="ClienteTipoDocumento" value="1"/>
					</div>
					<div class="input">
						Número documento: <br /><input id="ClienteNumeroDocumento" name="ClienteNumeroDocumento" />
					</div>
					<div class="input">
						Perfil impositivo: <br />
						<select id="ClientePerfilImpositivoSelect">
							<option value="RI">Responsable inscripto</option>
							<option value="MT">Responsable monotributo</option>
							<option value="CF">Consumidor final</option>
							<option value="EX">Exento</option>
						</select>
						<input type="hidden" name="ClientePerfilImpositivo" id="ClientePerfilImpositivo" value="RI"/>
					</div>
					<div class="input">
						Direccion: <br /><input id="ClienteDireccion" name="ClienteDireccion" />
					</div>
					<div class="input">
						Correo electrónico: <br /><input id="ClienteEmail" name="ClienteEmail" />
					</div>
				</form>
				<a class="button" href="#" onclick="submit(); return false;">Crear cliente</a>
			</div>
			
		</div>
		<script src="https://code.jquery.com/jquery-3.0.0.min.js" integrity="sha256-JmvOoLtYsmqlsWxa7mDSLMwa6dZ9rrIdtrrVYRnDRH0=" crossorigin="anonymous"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#ClientePerfilImpositivoSelect").on("change", function(){
					$("#ClientePerfilImpositivo").val($("#ClientePerfilImpositivoSelect").val());	
				});
				$("#ClienteTipoDocumentoSelect").on("change", function(){
					$("#ClienteTipoDocumento").val($("#ClienteTipoDocumentoSelect").val());	
				});
			});
			function submit(){
				$("form").submit();
			}
		</script>
	</body>
</html>