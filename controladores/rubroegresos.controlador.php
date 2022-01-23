<?php

class ControladorRubroEgresos{

	/*=============================================
	CREAR RUBRO DE EGRESO
	=============================================*/

	static public function ctrCrearRubroEgresos(){

		if(isset($_POST["nuevoRubroEgresos"])){

			if(preg_match('/^[-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoRubroEgresos"])){

				$tabla = "rubroEgresos";

				$datos = $_POST["nuevoRubroEgresos"];

				$respuesta = ModeloRubroEgresos::mdlIngresarRubroEgresos($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "rubroegresos";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "rubroegresos";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	MOSTRAR RUBROS DE EGRESOS
	=============================================*/

	static public function ctrMostrarRubroEgresos($item, $valor){

		$tabla = "rubroegresos";

		$respuesta = ModeloRubroEgresos::mdlMostrarRubroEgresos($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR RUBROS DE EGRESOS
	=============================================*/

	static public function ctrEditarRubroEgresos(){

		if(isset($_POST["editarRubroEgresos"])){

			if(preg_match('/^[-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarRubroEgresos"])){

				$tabla = "rubroegresos";

				$datos = array("rubroegresos"=>$_POST["editarRubroEgresos"],
							   "id"=>$_POST["idRubroEgresos"]);

				$respuesta = ModeloRubroEgresos::mdlEditarRubroEgresos($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "rubroegresos";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "rubroegresos";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function ctrBorrarRuboEgresos(){

		if(isset($_GET["idRubroEgresos"])){

			$tabla ="rubroEgresos";
			$datos = $_GET["idRubroEgresos"];

			$respuesta = ModeloRubroEgresos::mdlBorrarRubroEgresos($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido borrada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "rubroegresos";

									}
								})

					</script>';
			}
		}
		
	}
}
