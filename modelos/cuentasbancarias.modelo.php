<?php

require_once "conexion.php";

class ModeloCuentasBancarias{

	/*=============================================
	CREAR CUENTA
	=============================================*/

	static public function mdlIngresarCuentaBancaria($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(titular, banco, tipo, numerodecuenta, cbu, alias) VALUES (:titular, :banco, :tipo, :numerodecuenta, :cbu, :alias)");

		$stmt->bindParam(":titular", $datos["titular"], PDO::PARAM_STR);
		$stmt->bindParam(":banco", $datos["banco"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":numerodecuenta", $datos["numerodecuenta"], PDO::PARAM_STR);
		$stmt->bindParam(":cbu", $datos["cbu"], PDO::PARAM_STR);
		$stmt->bindParam(":alias", $datos["alias"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function mdlMostrarCuentasBancarias($tabla, $item, $valor){

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
	EDITAR CUENTA
	=============================================*/

	static public function mdlEditarCuentaBancaria($tabla, $datos){


		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET titular = :titular, banco = :banco, tipo = :tipo, numerodecuenta = :numerodecuenta,  alias = :alias WHERE cbu = :cbu");

		$stmt->bindParam(":titular", $datos["titular"], PDO::PARAM_STR);
		$stmt->bindParam(":banco", $datos["banco"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":numerodecuenta", $datos["numerodecuenta"], PDO::PARAM_STR);
		$stmt->bindParam(":cbu", $datos["cbu"], PDO::PARAM_STR);
		$stmt->bindParam(":alias", $datos["alias"], PDO::PARAM_STR);

		//print_r($datos["id"]);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function mdlBorrarCuentaBancaria($tabla, $datos){

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

