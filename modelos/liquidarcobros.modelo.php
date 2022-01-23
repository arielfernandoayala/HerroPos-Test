<?php

require_once "conexion.php";

class ModeloLiquidarCobros{



	/*=============================================
	MOSTRAR TODOS LOS RECIBOS PENDIENTES DE COBRO (la query la cree en hedi sql)
	=============================================*/

	static public function mdlMostrarCobrosPendientes(){



		$stmt = Conexion::conectar()->prepare("SELECT recibocliente.id, codigo, id_venta, nombre, medio_de_pago, identificacion_pago, entidad, cant_cuotas, fecha_cobro, total_percibido, importe, total 
FROM recibocliente, ventas, clientes 
WHERE  recibocliente.fecha_cobro IS NULL AND recibocliente.id_venta = ventas.id AND recibocliente.doc_cliente = clientes.documento AND recibocliente.medio_de_pago != 'Efectivo'   ORDER BY nombre;");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR SOLO UN RECIBO DE COBRO O CAPTURAR DATOS DEL MISMO
	=============================================*/

	static public function mdlMostrarCobroPendiente($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	REGISTRAR PAGO
	=============================================*/

	static public function mdlRegistraCobroRec($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET fecha_cobro = :fecha_cobro, total_percibido = :total_percibido WHERE id = :id");

		$stmt -> bindParam(":fecha_cobro", $datos["fecha_cobro"], PDO::PARAM_STR);
		$stmt -> bindParam(":total_percibido", $datos["total_percibido"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}




}

