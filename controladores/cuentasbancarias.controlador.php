<?php

class ControladorCuentasBancarias{

	/*=============================================
	CREAR CUENTA BANCARIA
	=============================================*/

	static public function ctrCrearCuentaBancaria(){

		if(isset($_POST["nuevoTitular"])){

			if(preg_match('/^[-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoTitular"])){


				$tabla = "cuentasbancarias";

				$datos = array("titular" => $_POST["nuevoTitular"],
					           "banco" => $_POST["nuevoBanco"],
					           "tipo" => $_POST["nuevoTipoCuenta"],
					           "numerodecuenta" => $_POST["nuevoNroCta"],
					           "cbu" => $_POST["nuevoCbu"],
					           "alias" => $_POST["nuevoAlias"]);

				
				//var_dump($datos);

				$respuesta = ModeloCuentasBancarias::mdlIngresarCuentaBancaria($tabla, $datos);


				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La cuenta se generó",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "cuentasbancarias";

									}
								})

					</script>';

				}



			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "Error, verifique los campos",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "cuentasbancarias";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	MOSTRAR CUENTAS BANCARIAS
	=============================================*/

	static public function ctrMostrarCuentasBancarias($item, $valor){

		$tabla = "cuentasbancarias";

		$respuesta = ModeloCuentasBancarias::mdlMostrarCuentasBancarias($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR CUENTAS BANCARIAS
	=============================================*/

	
	static public function ctrEditarCuentaBancaria(){

		if(isset($_POST["editarTitular"])){

			if(preg_match('/^[-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarTitular"])){

				$tabla = "cuentasbancarias";

				$datos = array("titular" => $_POST["editarTitular"],
					           "banco" => $_POST["editarBanco"],
					           "tipo" => $_POST["editarTipoDeCta"],
					           "numerodecuenta" => $_POST["editarNroCuenta"],
					           "cbu" => $_POST["editarCbu"],
					           "alias" => $_POST["editarAlias"]);
				//,"id" => $_POST["idCuentaBancaria"]

				$respuesta = ModeloCuentasBancarias::mdlEditarCuentaBancaria($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La cuenta se editó!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "cuentasbancarias";

									}
								})

					</script>';

				}


			}else if($respuesta == "error"){

				echo'<script>

					swal({
						  type: "error",
						  title: "Error al editar la cuenta",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "cuentasbancarias";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR CUENTA 
	=============================================*/

	static public function ctrBorrarCuentaBancaria(){

		if(isset($_GET["idCuentaBancaria"])){

			$tabla ="cuentasbancarias";
			$datos = $_GET["idCuentaBancaria"];

			$respuesta = ModeloCuentasBancarias::mdlBorrarCuentaBancaria($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "La cuenta se eliminó de la base de datos",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "cuentasbancarias";

									}
								})

					</script>';
			}
		}
		
	}
}
