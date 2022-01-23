<?php

require_once "conexion.php";

class ModeloCCCliente{

	/*=============================================
	CREAR MOVIEMIENTO EN CUENTA
	=============================================*/

	static public function mdlIngresarCCCMovimiento($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(ccc_id_cliente, ccc_fecha_mov, ccc_doc_cliente, ccc_razonsoc, ccc_detalle, ccc_debe, ccc_haber, ccc_saldo) VALUES (:ccc_id_cliente, :ccc_fecha_mov, :ccc_doc_cliente, :ccc_razonsoc, :ccc_detalle, :ccc_debe, :ccc_haber, :ccc_saldo)");

		$stmt->bindParam(":ccc_id_cliente", $datos["ccc_id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":ccc_fecha_mov", $datos["ccc_fecha_mov"], PDO::PARAM_STR);
		$stmt->bindParam(":ccc_doc_cliente", $datos["ccc_doc_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":ccc_razonsoc", $datos["ccc_razonsoc"], PDO::PARAM_STR);
		$stmt->bindParam(":ccc_detalle", $datos["ccc_detalle"], PDO::PARAM_STR);
		$stmt->bindParam(":ccc_debe", $datos["ccc_debe"], PDO::PARAM_STR);
		$stmt->bindParam(":ccc_haber", $datos["ccc_haber"], PDO::PARAM_STR);
		$stmt->bindParam(":ccc_saldo", $datos["ccc_saldo"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}




	/*=============================================
	MOSTRAR CC
	=============================================*/

	static public function mdlMostrarCCCliente($tabla, $item, $valor){

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


}

