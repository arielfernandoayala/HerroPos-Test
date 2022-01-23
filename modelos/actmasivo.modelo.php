<?php

require_once "conexion.php";

class ModeloActMasiva{



	/*=============================================
	GUARDAR
	=============================================*/

	static public function mdlEditarActMasiva($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  coeficiente = :coeficiente WHERE id_proveedor = :id_proveedor");

		$stmt -> bindParam(":coeficiente", $datos["coeficiente"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_proveedor", $datos["id_proveedor"], PDO::PARAM_INT);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}



}

