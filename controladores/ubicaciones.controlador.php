<?php

class ControladorUbicaciones{

	/*=============================================
	CREAR UBICACION
	=============================================*/

	static public function ctrCrearUbicaciones(){

		if(isset($_POST["nuevoUbicaciones"])){ //la variable es crearUbicaciones "nuevoUbicaciones" es el input

			if(preg_match('/^[-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoUbicaciones"])){

				$tabla = "ubicaciones";

				$datos = $_POST["nuevoUbicaciones"];

				$respuesta = ModeloUbicaciones::mdlIngresarUbicaciones($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Guardado",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "ubicaciones";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La ubicación no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "ubicaciones";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	MOSTRAR UBICACIONES
	=============================================*/

	static public function ctrMostrarUbicaciones($item, $valor){

		$tabla = "ubicaciones";

		$respuesta = ModeloUbicaciones::mdlMostrarUbicaciones($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR RUBROS DE EGRESOS
	=============================================*/

	static public function ctrEditarUbicaciones(){

		if(isset($_POST["editarUbicaciones"])){

			if(preg_match('/^[-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarUbicaciones"])){

				$tabla = "ubicaciones";

				$datos = array("ubicaciones"=>$_POST["editarUbicaciones"],
							   "id"=>$_POST["idUbicaciones"]);

				$respuesta = ModeloUbicaciones::mdlEditarUbicaciones($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Se guardó!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "ubicaciones";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La ubicación no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "ubicaciones";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function ctrBorrarUbicaciones(){

		if(isset($_GET["idUbicaciones"])){

			$tabla ="ubicaciones";
			$datos = $_GET["idUbicaciones"];

			$respuesta = ModeloUbicaciones::mdlBorrarUbicaciones($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "La ubicación ha sido borrada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "ubicaciones";

									}
								})

					</script>';
			}
		}
		
	}
}
