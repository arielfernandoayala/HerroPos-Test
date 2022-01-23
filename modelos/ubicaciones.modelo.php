<?php

require_once "conexion.php";

class ModeloUbicaciones{

	/*=============================================
	CREAR CATEGORIA
	=============================================*/

	static public function mdlIngresarUbicaciones($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(ubicaciones) VALUES (:ubicaciones)");

		$stmt->bindParam(":ubicaciones", $datos, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR UBICACION
	=============================================*/

	static public function mdlMostrarUbicaciones($tabla, $item, $valor){

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
	EDITAR UBICACION
	=============================================*/

	static public function mdlEditarUbicaciones($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET ubicaciones = :ubicaciones WHERE id = :id");

		$stmt -> bindParam(":ubicaciones", $datos["ubicaciones"], PDO::PARAM_STR);
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
	BORRAR UBICACION
	=============================================*/

	static public function mdlBorrarUbicaciones($tabla, $datos){

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

