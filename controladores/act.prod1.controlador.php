<?php

class ControladorActProd1{



	/*=============================================
	MOSTRAR ACTMOD1
	=============================================*/

	static public function ctrMostrarActProd1($item, $valor){

		$tabla = "productos";

		$respuesta = ModeloActProd1::mdlMostrarActProd1($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR ACTPROD1
	=============================================

	static public function ctrEditarActProd1(){




			$tabla = "productos";

			$datos = array("stock"=>$_POST["actProd1Stock"],
						   "id"=>$_POST["inputActProd1"]);

			$respuesta = ModeloActProd1::mdlEditarActProd1($tabla, $datos);

			//echo "<script>console.log('Debug Objects: " . $respuesta . "' );</script>";

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "Los datos se acutalizaron correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "actprod1";

								}
							})

				</script>';

			}else if ($respuesta == "error"){

				echo'<script>

					swal({
						  type: "error",
						  title: "Error, act.prod1.controaldor dice : '.$respuesta.' ",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "actprod1";

							}
						})

			  	</script>';
			}

		

	} /**/

	static public function ctrEditarActProd1(){

		if(isset($_POST["actProd1Descripcion"])){

			

			$tabla = "productos";

			$datos = array("stock"=>$_POST["actProd1Stock"],
							"id_ubicacion"=>$_POST["actProd1Ubicacion"],
						   "id"=>$_POST["idActProd1"]);

			echo "<script>console.log('El valor de la *respuesta* es: " . $datos["ubicacion"] . "' );</script>";

			$respuesta = ModeloActProd1::mdlEditarActProd1($tabla, $datos);


			if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Los datos se acutalizaron correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "actprod1";

									}
								})

					</script>';

			}


			else{

				echo'<script>

					swal({
						  type: "error",
						  title: "Error, no ejecuto correctamente acr.prod1.controlador ",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "actprod1";

							}
						})

			  	</script>';

			}

		}

	}

	static public function ctrActLista(){		

		$tabla = "productos";

		$datos = array("precio_lista"=>$_POST["actProd1Stock"],
					   "id"=>$_POST["idActProd1"]);

		//echo "<script>console.log('El valor de la *respuesta* es: " . $datos["ubicacion"] . "' );</script>";

		$respuesta = ModeloActProd1::mdlEditarActProd1($tabla, $datos);


	}



}
