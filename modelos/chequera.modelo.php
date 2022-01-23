<?php

require_once "conexion.php";

class ModeloCheques{



	/*=============================================
	CREAR CATEGORIA
	=============================================*/

	static public function mdlIngresarCheque($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(doc_entregador, cuit_emisor, razon_soc_emisor, banco_chq, nro_chq, importe, fecha_ven_chq, comentario) VALUES (:doc_entregador, :cuit_emisor, :razon_soc_emisor, :banco_chq, :nro_chq, :importe, :fecha_ven_chq, :comentario)");
		
		$stmt->bindParam(":doc_entregador", $datos["cuit_emisor"], PDO::PARAM_INT);
		$stmt->bindParam(":cuit_emisor", $datos["cuit_emisor"], PDO::PARAM_INT);
		$stmt->bindParam(":razon_soc_emisor", $datos["razon_soc_emisor"], PDO::PARAM_STR);
		$stmt->bindParam(":banco_chq", $datos["banco_chq"], PDO::PARAM_STR);
		$stmt->bindParam(":nro_chq", $datos["nro_chq"], PDO::PARAM_STR);
		$stmt->bindParam(":importe", $datos["importe"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_ven_chq", $datos["fecha_ven_chq"], PDO::PARAM_STR);
		$stmt->bindParam(":comentario", $datos["comentario"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR CHEQUES EN CHEQUERA
	=============================================*/

	static public function mdlMostrarCheque($tabla, $item, $valor){

		if($item != null){

			//$doc_receptor = "doc_receptor";

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item IS NULL ");

			//$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

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
	MOSTRAR CHEQUE EN EDICION
	=============================================*/

	static public function mdlMostrarChequeEdit($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

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
	EDITAR CHEQUE
	=============================================*/

	static public function mdlEditarCheque($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET doc_entregador = :doc_entregador, cuit_emisor = :cuit_emisor, razon_soc_emisor = :razon_soc_emisor, banco_chq = :banco_chq, nro_chq = :nro_chq , importe = :importe, fecha_ven_chq = :fecha_ven_chq, comentario = :comentario WHERE id = :id");

		$stmt->bindParam(":doc_entregador", $datos["cuit_emisor"], PDO::PARAM_INT);
		$stmt->bindParam(":cuit_emisor", $datos["cuit_emisor"], PDO::PARAM_INT);
		$stmt->bindParam(":razon_soc_emisor", $datos["razon_soc_emisor"], PDO::PARAM_STR);
		$stmt->bindParam(":banco_chq", $datos["banco_chq"], PDO::PARAM_STR);
		$stmt->bindParam(":nro_chq", $datos["nro_chq"], PDO::PARAM_STR);
		$stmt->bindParam(":importe", $datos["importe"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_ven_chq", $datos["fecha_ven_chq"], PDO::PARAM_STR);
		$stmt->bindParam(":comentario", $datos["comentario"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR CHEQUE
	=============================================*/

	static public function mdlBorrarCheque($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

}

