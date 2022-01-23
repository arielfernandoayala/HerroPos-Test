<?php

class ControladorPublicidades{

	/*=============================================
	CREAR CUENTA BANCARIA
	=============================================*/

	static public function ctrCrearPublicidad(){

		if(isset($_POST["nuevoPublicidadFechaInicio"])){

			if(preg_match('/^[-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoPublicidadFechaInicio"])){


				$tabla = "publicidad";

				$datos = array("fecha_inicio" => $_POST["nuevoPublicidadFechaInicio"],
					           "fecha_fin" => $_POST["nuevoFechaFin"],
					           "medio" => $_POST["nuevoMedioPublicidad"],
					           "resumen" => $_POST["nuevoResumen"],
					           "costo" => $_POST["nuevoCostoPublicidad"],
					           "resultados" => $_POST["nuevoResultadosPublicidad"]);
					       		

				
				//var_dump($datos);

				$respuesta = ModeloPublicidades::mdlIngresarPublicidad($tabla, $datos);


				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Campaña guardada",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "publicidad";

									}
								})

					</script>';

				}



			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "Error, '+$respuesta+'",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "publicidad";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	MOSTRAR CUENTAS BANCARIAS
	=============================================*/

	static public function ctrMostrarPublicidades($item, $valor){

		$tabla = "publicidad";

		$respuesta = ModeloPublicidades::mdlMostrarPublicidades($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR CUENTAS BANCARIAS
	=============================================*/

	
	static public function ctrEditarPublicidad(){

		if(isset($_POST["editarFechaInicio"])){


				$tabla = "publicidad";

				$datos = array("fecha_inicio" => $_POST["editarFechaInicio"],
					           "fecha_fin" => $_POST["editarFechaFin"],
					           "medio" => $_POST["editarMedioPublicidad"],
					           "resumen" => $_POST["editarResumen"],
					           "costo" => $_POST["editarCostoPublicidad"],
					           "resultados" => $_POST["editarResultadosPublicidad"],
								"id" => $_POST["idEditarPublicidad"]);

				$respuesta = ModeloPublicidades::mdlEditarPublicidad($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Se guardaron las modificaciones",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "publicidad";

									}
								})

					</script>';

				}


			else if($respuesta == "error"){

				echo'<script>

					swal({
						  type: "error",
						  title: "Error: '+$respuesta+'",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "publicidad";

							}
						})

			  	</script>';

			}

		}

	}

}
