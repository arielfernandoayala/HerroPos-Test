<?php

class ControladorActMasiva{

	static public function ctrEditarActMasiva(){
		//PROVEEDOR Y COEFICIENTE
		if($_POST["actMasivaProveedor"] != NULL ){

			$tabla = "productos";

			$datos = array("id_proovedor"=>$_POST["actMasivaProveedor"],
							"coeficiente"=>$_POST["actMasivaCoef"]);

			echo "<script>console.log('El valor de la *respuesta* es: " . $datos["id_proovedor"] . "' );</script>";

			$respuesta = ModeloActMasiva::mdlEditarActMasiva($tabla, $datos);


			if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Los datos se acutalizaron correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "";

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

							window.location = "";

							}
						})

			  	</script>';

			}

		}

	}

}
