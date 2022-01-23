<?php

class ControladorEstadosEntrega{

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function ctrMostrarEstadosEntrega($item, $valor){

		$tabla = "estados_entrega";

		$respuesta = ModeloEstadosEntrega::mdlMostrarEstadosEntrega($tabla, $item, $valor);

		return $respuesta;
	}


	/*=============================================
	ACTUALIAR ESTADO ENTREGA
	=============================================*/

	static public function ctrActualizarEstadoEntrega(){

		if(isset($_POST["idVtaAsoc"])){



				$tabla = "ventas";

				$datos = array("estado_entrega"=>$_POST["inputActEstEntrega"],
							   "id"=>$_POST["idVtaAsoc"]);

				$respuesta = ModeloEstadosEntrega::mdlActualizarEstadoEntrega($tabla, $datos);

				//echo $respuesta;

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El estado se actualizo ",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "estado-entregas";

									}
								})

					</script>';

				}


			else{

				echo'<script>

					swal({
						  type: "error",
						  "Error, la respuesta del modelo es:  '.$respuesta.'",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "estado-entregas";

							}
						})

			  	</script>';

			}

		}

	}


}

