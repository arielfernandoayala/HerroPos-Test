<?php

class ControladorChequera{

	/*=============================================
	CREAR CHEQUE
	=============================================*/

	static public function ctrCrearCheque(){

		if(isset($_POST["nvoChqBco"])){

			

				$tabla = "chequera";

				$datos = array("cuit_emisor"=>$_POST["nvoChqCuit"],
							   "razon_soc_emisor"=>$_POST["nvoChqRazonSoc"],
							   "banco_chq"=>$_POST["nvoChqBco"],
							   "nro_chq"=>$_POST["nvoChqNro"],
							   "importe"=>$_POST["ncoChqImporte"],
							   "fecha_ven_chq"=>$_POST["nvoChqFecha"],
							   "comentario"=>$_POST["nvoChqComentario"]);

				$respuesta = ModeloCheques::mdlIngresarCheque($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Cheque guardado",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "chequera";

									}
								})

					</script>';

				}


			else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡Eerror '.$respuesta.'!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "chequera";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	MOSTRAR CHEQUES EN CHEQUERA
	=============================================*/

	static public function ctrMostrarCheques($item, $valor){

		$tabla = "chequera";

		$respuesta = ModeloCheques::mdlMostrarCheque($tabla, $item, $valor);

		
		//echo(json_encode($respuesta));

		return $respuesta;
	
	}

	/*=============================================
	MOSTRAR CHEQUE EN EDICION
	=============================================*/

	static public function ctrMostrarChequesEdit($item, $valor){

		$tabla = "chequera";

		$respuesta = ModeloCheques::mdlMostrarChequeEdit($tabla, $item, $valor);

		
		//echo(json_encode($respuesta));

		return $respuesta;
	
	}

	/*=============================================
	EDITAR CATEGORIA
	=============================================*/

	static public function ctrEditarCheque(){

		if(isset($_POST["editChqCuit"])){

				$tabla = "chequera";

				$datos = array("cuit_emisor"=>$_POST["editChqCuit"],
							   "razon_soc_emisor"=>$_POST["editChqRazonSoc"],
							   "banco_chq"=>$_POST["editChqBco"],
							   "nro_chq"=>$_POST["editChqNro"],
							   "importe"=>$_POST["editChqImporte"],
							   "fecha_ven_chq"=>$_POST["editChqFecha"],
							   "comentario"=>$_POST["editChqComentario"],
							   "id"=>$_POST["editIdchq"]);

				echo($datos);

				$respuesta = ModeloCheques::mdlEditarCheque($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Cheque editado",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "chequera";

									}
								})

					</script>';

				}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡Error al editar, '.$respuesta.'!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "chequera";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR CHEQUE
	=============================================*/

	static public function ctrBorrarCheque(){

		if(isset($_GET["idCheque"])){

			$tabla ="chequera";
			$datos = $_GET["idCheque"];

			$respuesta = ModeloCheques::mdlBorrarCheque($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "El cheque se eliminó",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "chequera";

									}
								})

					</script>';
			}
		}
		
	}
}
