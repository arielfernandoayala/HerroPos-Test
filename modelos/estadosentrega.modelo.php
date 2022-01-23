<?php

require_once "conexion.php";

class ModeloEstadosEntrega{

	/*=============================================
	MOSTRAR VENTAS AOCIADAS
	=============================================*/

	static public function mdlMostrarEstadosEntrega($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		
		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR ESTADO DE ENTREGA
	=============================================*/

	static public function mdlActualizarEstadoEntrega($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado_entrega = :estado_entrega WHERE id = :id");

		$stmt -> bindParam(":estado_entrega", $datos["estado_entrega"], PDO::PARAM_STR);
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