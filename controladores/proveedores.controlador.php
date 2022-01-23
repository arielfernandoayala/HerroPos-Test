<?php

class ControladorProveedores{

	/*=============================================
	CREAR PROVEEDOR
	=============================================*/

	static public function ctrCrearProveedor(){

		if(isset($_POST["nuevoProveedor"])){

            $tabla = "proveedores";

            $datos = array("razon_social"=>$_POST["nuevoProveedor"],
                            "cuit"=>$_POST["nuevaCuitProveedor"],
                            "domicilio"=>$_POST["nuevoDomicilioProveedor"],
                            "cp"=>$_POST["nuevoCpProveedor"],
                            "ciudad"=>$_POST["nuevaCuidadProveedor"],
                            "provincia"=>$_POST["nuevaProvinciaProveedor"],
                            "tel"=>$_POST["nuevoTelefonoProveedor"],
                            "referente"=>$_POST["nuevoReferenteProveedor"],
                            "web"=>$_POST["nuevaWebProveedor"],
                            "email"=>$_POST["nuevoEmailProveeedor"]);
            var_dump($datos);

            $respuesta = ModeloProveedores::mdlIngresarProveedor($tabla, $datos);


            if($respuesta == "ok"){

                echo'<script>

                swal({
                        type: "success",
                        title: "Se guardó el proveedor",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        }).then(function(result){
                                if (result.value) {

                                window.location = "proveedores";

                                }
                            })

                </script>';

            }


            else{

                echo'<script>

                    swal({
                            type: "error",
                            title: "proveedores.controlador dice'.$respuesta.'",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                            }).then(function(result){
                            if (result.value) {

                            window.location = "proveedores";

                            }
                        })

                </script>';
            }

        }

	}

	

	/*=============================================
	MOSTRAR PROVEEDORES
	=============================================*/

	static public function ctrMostrarProveedores($item, $valor){

		$tabla = "proveedores";

		$respuesta = ModeloProveedores::mdlMostrarProveedores($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR PROVEEDOR
	=============================================*/

	static public function ctrEditarProveedor(){

		if(isset($_POST["editarProveedor"])){

				$tabla = "proveedores";

                $datos = array("razon_social"=>$_POST["editarProveedor"],
                                "cuit"=>$_POST["editarCuitProveedor"],
                                "domicilio"=>$_POST["editarDomicilioProveedor"],
                                "cp"=>$_POST["editarCpProveedor"],
                                "ciudad"=>$_POST["editarCuidadProveedor"],
                                "provincia"=>$_POST["editarProvinciaProveedor"],
                                "tel"=>$_POST["editarTelefonoProveedor"],
                                "referente"=>$_POST["editarReferenteProveedor"],
                                "web"=>$_POST["editarWebProveedor"],
                                "email"=>$_POST["editarEmailProveeedor"],           
                			    "id"=>$_POST["idProveedor"]);

				$respuesta = ModeloProveedores::mdlEditarProveedor($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Datos modificados correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "proveedores";

									}
								})

					</script>';

				}


			else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡546547654!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "proveedores";

							}
						})

			  	</script>';

			}

        }

	}

	/*=============================================
	BORRAR PROVEEDOR
	=============================================*/

	static public function ctrBorrarProveedor(){

		if(isset($_GET["idProveedor"])){

			$tabla ="proveedores";
			$datos = $_GET["idProveedor"];

			$respuesta = ModeloProveedores::mdlBorrarProveedor($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "Se borró el proveedor",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "proveedores";

									}
								})

					</script>';
			}
		}
		
	}
}
