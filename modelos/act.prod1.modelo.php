<?php

require_once "conexion.php";

class ModeloActProd1{



	/*=============================================
	MOSTRAR ACTPROD1
	=============================================*/



	static public function mdlMostrarActProd1($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT descripcion,stock,id_ubicacion,precio_lista,precio_venta FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	EDITAR ACTPROD1
	=============================================*/

	static public function mdlEditarActProd1($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET stock = :stock, id_ubicacion = :id_ubicacion WHERE id = :id");

		$stmt -> bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_ubicacion", $datos["id_ubicacion"], PDO::PARAM_INT);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ACT LISTA
	=============================================*/

	static public function mdlActLista($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET precio_lista = :precio_lista WHERE id = :id");

		$stmt -> bindParam(":precio_lista", $datos["precio_lista"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->execute();
		$stmt->close();
		$stmt = null;

	}



}

