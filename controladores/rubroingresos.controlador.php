<?php

class ControladorRubroIngresos{

	/*=============================================
	CREAR CATEGORIAS
	=============================================*/

	static public function ctrCrearRubroIngresos(){

		if(isset($_POST["nuevoRubroIngresos"])){

			if(preg_match('/^[-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoRubroIngresos"])){

				$tabla = "rubroingresos";

				$datos = $_POST["nuevoRubroIngresos"];

				$respuesta = ModeloRubroIngresos::mdlIngresarRubroIngresos($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "rubroingresos";

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

							window.location = "rubroingresos";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function ctrMostrarRubroIngresos($item, $valor){

		$tabla = "rubroingresos";

		$respuesta = ModeloRubroIngresos::mdlMostrarRubroIngresos($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR CATEGORIA
	=============================================*/

	static public function ctrEditarRubroIngresos(){

		if(isset($_POST["editarRubroIngresos"])){

			if(preg_match('/^[-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarRubroIngresos"])){

				$tabla = "rubroingresos";

				$datos = array("rubroingresos"=>$_POST["editarRubroIngresos"],
							   "id"=>$_POST["idRubroIngresos"]);

				$respuesta = ModeloRubroIngresos::mdlEditarRubroIngresos($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "rubroingresos";

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

							window.location = "rubroingresos";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function ctrBorrarRuboIngresos(){

		if(isset($_GET["idRubroIngresos"])){

			$tabla ="rubroingresos";
			$datos = $_GET["idRubroIngresos"];

			$respuesta = ModeloRubroIngresos::mdlBorrarRubroIngresos($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido borrada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "rubroingresos";

									}
								})

					</script>';
			}
		}
		
	}
}
