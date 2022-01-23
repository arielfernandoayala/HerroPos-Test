<?php

require_once "conexion.php";

class ModeloProductos{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function mdlMostrarProductos($tabla, $item, $valor, $orden){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY $orden DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	REGISTRO DE PRODUCTO
	=============================================*/
	static public function mdlIngresarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_categoria,id_codcompra, id_proveedor, id_ubicacion, codigo, descripcion, imagen, stock_min, stock_max, iva, nro_lista, coeficiente, rentabilidad, usd, stock, precio_compra, incrementador) VALUES (:id_categoria, :id_codcompra, :id_proveedor, :id_ubicacion, :codigo, :descripcion, :imagen, :stock_min, :stock_max, :iva, :nro_lista, :coeficiente, :rentabilidad, :usd, :stock, :precio_compra, :incrementador)");

		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":id_codcompra", $datos["id_codcompra"], PDO::PARAM_STR);
		$stmt->bindParam(":id_proveedor", $datos["id_proveedor"], PDO::PARAM_INT);
		$stmt->bindParam(":id_ubicacion", $datos["id_ubicacion"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":stock_min", $datos["stock_min"], PDO::PARAM_STR);
		$stmt->bindParam(":stock_max", $datos["stock_max"], PDO::PARAM_STR);
		$stmt->bindParam(":iva", $datos["iva"], PDO::PARAM_STR);
		$stmt->bindParam(":nro_lista", $datos["nro_lista"], PDO::PARAM_STR);
		$stmt->bindParam(":coeficiente", $datos["coeficiente"], PDO::PARAM_STR);
		$stmt->bindParam(":rentabilidad", $datos["rentabilidad"], PDO::PARAM_STR);
		$stmt->bindParam(":usd", $datos["usd"], PDO::PARAM_STR);

		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":incrementador", $datos["incrementador"], PDO::PARAM_STR);
		//$stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/
	static public function mdlEditarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_categoria = :id_categoria , id_proveedor = :id_proveedor, id_ubicacion = :id_ubicacion, descripcion = :descripcion, imagen = :imagen, stock_min = :stock_min, stock_max = :stock_max, iva = iva, nro_lista = :nro_lista, coeficiente = :coeficiente, rentabilidad = :rentabilidad, usd = :usd, stock = :stock, precio_compra = :precio_compra WHERE codigo = :codigo");

		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":id_proveedor", $datos["id_proveedor"], PDO::PARAM_INT);
		$stmt->bindParam(":id_ubicacion", $datos["id_ubicacion"], PDO::PARAM_INT);

		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":stock_min", $datos["stock_min"], PDO::PARAM_STR);
		$stmt->bindParam(":stock_max", $datos["stock_max"], PDO::PARAM_STR);
		$stmt->bindParam(":iva", $datos["iva"], PDO::PARAM_STR);
		$stmt->bindParam(":nro_lista", $datos["nro_lista"], PDO::PARAM_STR);
		$stmt->bindParam(":coeficiente", $datos["coeficiente"], PDO::PARAM_STR);
		$stmt->bindParam(":rentabilidad", $datos["rentabilidad"], PDO::PARAM_STR);
		$stmt->bindParam(":usd", $datos["usd"], PDO::PARAM_STR);

		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
		//$stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";
			printf("Error: %s.\n", $sentencia->error);

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR PRODUCTO
	=============================================*/

	static public function mdlEliminarProducto($tabla, $datos){

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

	/*=============================================
	ACTUALIZAR PRODUCTO
	=============================================*/

	static public function mdlActualizarProducto($tabla, $item1, $valor1, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $valor, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/	

	static public function mdlMostrarSumaVentas($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT SUM(ventas) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;
	}


}