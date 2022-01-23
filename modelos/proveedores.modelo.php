<?php

require_once "conexion.php";

class ModeloProveedores{

	/*=============================================
	CREAR PROVEEDOR
	=============================================*/

	static public function mdlIngresarProveedor($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(razon_social, cuit, cp, domicilio, ciudad, provincia, tel, referente, web, email) VALUES (:razon_social, :cuit, :cp, :domicilio, :ciudad, :provincia, :tel, :referente, :web, :email)");

        
        $stmt->bindParam(":razon_social", $datos["razon_social"], PDO::PARAM_STR);
        $stmt->bindParam(":cp", $datos["cp"], PDO::PARAM_INT);
        $stmt->bindParam(":cuit", $datos["cuit"], PDO::PARAM_STR);
        $stmt->bindParam(":domicilio", $datos["domicilio"], PDO::PARAM_STR);
        $stmt->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
        $stmt->bindParam(":provincia", $datos["provincia"], PDO::PARAM_STR);
        $stmt->bindParam(":tel", $datos["tel"], PDO::PARAM_STR);
        $stmt->bindParam(":referente", $datos["referente"], PDO::PARAM_STR);
        $stmt->bindParam(":web", $datos["web"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR PROVEEDOR
	=============================================*/

	static public function mdlMostrarProveedores($tabla, $item, $valor){

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
	EDITAR PROVEEDOR
	=============================================*/

	static public function mdlEditarProveedor($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET razon_social = :razon_social, cuit = :cuit, cp = :cp, domicilio = :domicilio, ciudad = :ciudad, provincia = :provincia, tel = :tel, referente = :referente, web = :web, email = :email WHERE id = :id");

        $stmt->bindParam(":razon_social", $datos["razon_social"], PDO::PARAM_STR);
        $stmt->bindParam(":cp", $datos["cp"], PDO::PARAM_INT);
        $stmt->bindParam(":cuit", $datos["cuit"], PDO::PARAM_STR);
        $stmt->bindParam(":domicilio", $datos["domicilio"], PDO::PARAM_STR);
        $stmt->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
        $stmt->bindParam(":provincia", $datos["provincia"], PDO::PARAM_STR);
        $stmt->bindParam(":tel", $datos["tel"], PDO::PARAM_STR);
        $stmt->bindParam(":referente", $datos["referente"], PDO::PARAM_STR);
        $stmt->bindParam(":web", $datos["web"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
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
	BORRAR PROVEEDOR
	=============================================*/

	static public function mdlBorrarProveedor($tabla, $datos){

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

