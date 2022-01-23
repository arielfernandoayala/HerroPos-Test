<?php

class ControladorCobrosPendientes{


	/*=============================================
	MOSTRAR COBROS PENDIENTES
	=============================================*/

	static public function ctrMostrarCobrosPendientes(){

		$respuesta = ModeloLiquidarCobros::mdlMostrarCobrosPendientes();

		return $respuesta;
	
	}

	/*=============================================
	MOSTRAR COBRO PENDIENTE ESPECIFICO
	=============================================*/

	static public function ctrMostrarCobropendiente($item, $valor){

		$tabla = "recibocliente";		

		$respuesta = ModeloLiquidarCobros::mdlMostrarCobroPendiente($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	REGISTRAR COBRO DESDE EL MODAL
	=============================================*/

	static public function ctrRegistrarCobro(){

		if(isset($_POST["nuevoLiqRec"])){

				$tabla = "recibocliente";

				$datos = array("fecha_cobro"=>$_POST["nuevoFechaPagoRec"],
							   "total_percibido"=>$_POST["nuevoLiqRec"], 
							   "id"=>$_POST["idRecALiquidar"]);

				$respuesta = ModeloLiquidarCobros::mdlRegistraCobroRec($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Se registró la operación",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "liquidar-cobros";

									}
								})

					</script>';

				}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "Error:'.$respuesta.'",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "liquidar-cobros";

							}
						})

			  	</script>';

			}

		}

	}

}
