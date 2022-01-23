<?php

require_once "conexion.php";

class ModeloCobranzaClientes{

	

	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function mdlMostrarClientesTablaCobranza($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function mdlMostrarrReciboCobranzav1($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	
	static public function mdlCrearRecibov1($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(doc_cliente, id_venta, importe, fecha, medio_de_pago, identificacion_pago, comentario, entidad, cant_cuotas, razon_soc_emisor, cuit_emisor ,banco, nro_chq, fecha_chq) VALUES (:doc_cliente, :id_venta, :importe, :fecha, :medio_de_pago, :identificacion_pago, :comentario, :entidad, :cant_cuotas, :razon_soc_emisor, :cuit_emisor , :banco, :nro_chq, :fecha_chq)");

		$stmt->bindParam(":doc_cliente", $datos["doc_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_venta", $datos["id_venta"], PDO::PARAM_INT);
		$stmt->bindParam(":importe", $datos["importe"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":medio_de_pago", $datos["medio_de_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":identificacion_pago", $datos["identificacion_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":comentario", $datos["comentario"], PDO::PARAM_STR);
		$stmt->bindParam(":entidad", $datos["entidad"], PDO::PARAM_STR);
		$stmt->bindParam(":cant_cuotas", $datos["cant_cuotas"], PDO::PARAM_INT);
		$stmt->bindParam(":razon_soc_emisor", $datos["razon_soc_emisor"], PDO::PARAM_STR);
		$stmt->bindParam(":cuit_emisor", $datos["cuit_emisor"], PDO::PARAM_STR);
		$stmt->bindParam(":banco", $datos["banco"], PDO::PARAM_STR);
		$stmt->bindParam(":nro_chq", $datos["nro_chq"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_chq", $datos["fecha_chq"], PDO::PARAM_STR);
		


		if($stmt->execute()){

			return "ok";

		}else{
			
			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	//Este método guarda los datos ingresados en el recibo en la chequera en el caso de que el método de pago corresponda

	static public function mdlCrearChqRecibov1($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(doc_entregador, importe, fecha_recep, comentario, razon_soc_emisor, cuit_emisor ,banco_chq, nro_chq, fecha_ven_chq) VALUES (:doc_entregador, :importe, :fecha_recep, :comentario, :razon_soc_emisor, :cuit_emisor , :banco_chq, :nro_chq, :fecha_ven_chq)");

		$stmt->bindParam(":doc_entregador", $datos["doc_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":importe", $datos["importe"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha_recep", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":comentario", $datos["comentario"], PDO::PARAM_STR);
		$stmt->bindParam(":razon_soc_emisor", $datos["razon_soc_emisor"], PDO::PARAM_STR);
		$stmt->bindParam(":cuit_emisor", $datos["cuit_emisor"], PDO::PARAM_STR);
		$stmt->bindParam(":banco_chq", $datos["banco"], PDO::PARAM_STR);
		$stmt->bindParam(":nro_chq", $datos["nro_chq"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_ven_chq", $datos["fecha_chq"], PDO::PARAM_STR);
		


		if($stmt->execute()){

			return "ok";

		}else{
			
			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	

}