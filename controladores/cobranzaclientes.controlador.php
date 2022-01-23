<?php

class ControladorCobroClientes{

	
	

	/*=============================================
	MOSTRAR CLIENTES EN LA TABLA DE COBRANZA
	=============================================*/

	static public function ctrMostrarClientesTablaCobranza($item, $valor){

		$tabla = "clientes";

		$respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR RECIBOS
	=============================================*/

	static public function ctrMostrarRecibosCobranzav1($item, $valor){

		$tabla = "recibocliente";

		$respuesta = ModeloCobranzaClientes::mdlMostrarClientesTablaCobranza($tabla, $item, $valor);

		//echo $respuesta;

		return $respuesta;

	}

	/*=============================================
	CREAR RECIBOS
	=============================================*/

	static public function ctrCrearRecibov1(){

		if(isset($_POST["docCobranzav1"])){

			$tablaClientes = "clientes";
			$item = "documento";
			$valor = $_POST["docCobranzav1"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $item, $valor);

			$item3a = "clientes_saldo";
			$valor3a = $traerCliente["clientes_saldo"]-$_POST["nuevoImporteRecibov1"];

			$saldoCliente = ModeloClientes::mdlActualizarClienteDoc($tablaClientes, $item3a, $valor3a, $valor);

			/*************** INGRESO REGISTRO A LA TABLA CCC****************/

			$tablaCCC = "cccliente";
			$id_cliente = $traerCliente["id"];
			$razon_soc = $traerCliente["nombre"];
			$detalleMov = $_POST["nuevoMetodoPagoRecibov1"]."-REC".$_POST["vtaRecibov1"];


			$datosccc = array("ccc_id_cliente"=>$id_cliente,
						   		"ccc_fecha_mov"=>$_POST["fechaRecibov1"],
						   		"ccc_doc_cliente"=>$_POST["seleccionarClienteVenta"],
						   		"ccc_razonsoc"=>$razon_soc,
						   		"ccc_detalle"=>$detalleMov,
								"ccc_haber"=>$_POST["nuevoImporteRecibov1"],
								"ccc_saldo" => $valor3a);


			$movHaberCliente = ModeloCCCliente::mdlIngresarCCCMovimiento($tablaCCC, $datosccc);

			/*******************************************************************/

				$tabla = "recibocliente";

			   //	if($_POST["nuevoMetodoPagoRecibov1"] == "TC")

			   	$datos = array("doc_cliente"=>$_POST["docCobranzav1"],
						   		"id_venta"=>$_POST["vtaRecibov1"],
						   		"importe"=>$_POST["nuevoImporteRecibov1"],
						   		"fecha"=>$_POST["fechaRecibov1"],
						   		"medio_de_pago"=>$_POST["nuevoMetodoPagoRecibov1"],
						   		"identificacion_pago" => $_POST["nuevoCodigoTransaccionRecibov1"],
								"comentario"=>$_POST["comentarioRecibov1"],
								"entidad" => $_POST["entidadRecibov1"],
								"cant_cuotas"=>$_POST["cantCuotas"],
								"razon_soc_emisor"=>$_POST["libradorChRecibov1"],
								"cuit_emisor"=>$_POST["cuitChRecibov1"],
								"banco"=>$_POST["bancoChRecibov1"],
								"nro_chq"=>$_POST["nroChRecibov1"],
								"fecha_chq"=>$_POST["fechaChqRecibov1"]);

			   	//Datos para crear el cheque en la tabla chequera


			   	$tablachq = "chequera";

			   	$datoschq = array("doc_cliente"=>$_POST["docCobranzav1"],
			   					"importe"=>$_POST["nuevoImporteRecibov1"],
			   					"fecha"=>$_POST["fechaRecibov1"],
			   					"comentario"=>$_POST["comentarioRecibov1"],
								"razon_soc_emisor"=>$_POST["libradorChRecibov1"],
								"cuit_emisor"=>$_POST["cuitChRecibov1"],
								"banco"=>$_POST["bancoChRecibov1"],
								"nro_chq"=>$_POST["nroChRecibov1"],
								"fecha_chq"=>$_POST["fechaChqRecibov1"]);


			   	

			   	//Verificamos que sea un cheque y ejecutamos el modelo

			   	if($_POST["nuevoMetodoPagoRecibov1"] == 'CH'){

			   		$respuestaChq = ModeloCobranzaClientes::mdlCrearChqRecibov1($tablachq, $datoschq);

			   		if($respuestaChq == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El cheque fue agregado a cartera",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "cobranza-clientes";

									}
								})

					</script>';

				}else{

					echo'<script>

						swal({
							  type: "error",
							  title: "¡Error '.$respuestaChq.'!",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
								if (result.value) {

								window.location = "cobranza-clientes";

								}
							})

				  	</script>';
				 }
			}

			$respuesta = ModeloCobranzaClientes::mdlCrearRecibov1($tabla, $datos);

			   	

			   	//print($respuesta);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El recibo se guardó: '.$movHaberCliente.' ",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "cobranza-clientes";

									}
								})

					</script>';

				}else{

					echo'<script>

						swal({
							  type: "error",
							  title: "¡Error '.$respuesta.'!",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
								if (result.value) {

								window.location = "cobranza-clientes";

								}
							})

				  	</script>';
				 }
			}

		}

	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function ctrMostrarClientes($item, $valor){

		$tabla = "clientes";

		$respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);

		return $respuesta;

	}


	

	

}

