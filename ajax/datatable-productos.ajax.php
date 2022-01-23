<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

require_once "../controladores/proveedores.controlador.php";
require_once "../modelos/proveedores.modelo.php";


class TablaProductos{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaProductos(){

		$item = null;
    	$valor = null;
    	$orden = "id";

  		$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);	

  		//productos trae un JSON con todos lso datos de la base 

  		if(count($productos) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($productos); $i++){

		  	/*=============================================
 	 		TRAEMOS LA IMAGEN
  			=============================================*/ 

		  	$imagen = "<img src='".$productos[$i]["imagen"]."' width='40px'>";

		  	/*=============================================
 	 		TRAEMOS LA CATEGORÍA
  			=============================================*/ 

		  	$item = "id";
		  	$valor = $productos[$i]["id_categoria"];

		  	$categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

		  	/*=============================================
 	 		TRAEMOS LOS PROVEEDORES
  			=============================================*/ 

		  	$itemP = "id";
		  	$valorP = $productos[$i]["id_proveedor"];

		  	$proveedores = ControladorProveedores::ctrMostrarProveedores($itemP, $valorP);

		  	/*=============================================
 	 		STOCK
  			=============================================*/ 

  			if(($productos[$i]["stock"] <= $productos[$i]["stock_min"])||($productos[$i]["stock"] == 0)){

  				$stock = "<button class='btn btn-danger'>".$productos[$i]["stock"]."</button>";

  			}else if($productos[$i]["stock"] > $productos[$i]["stock_min"] && $productos[$i]["stock"] <= $productos[$i]["stock_max"]){

  				$stock = "<button class='btn btn-warning'>".$productos[$i]["stock"]."</button>";

  			}else{

  				$stock = "<button class='btn btn-success'>".$productos[$i]["stock"]."</button>";

  			}

		  	/*===================================================================================
 	 		TRAEMOS LAS ACCIONES SEGUN EL TIPO DE PERFIL (viene seteado en perfilOculto por URL)
  			=====================================================================================*/ 

  			if(isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Especial"){

  				$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button></div>"; 

  			}else{

  				 $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$productos[$i]["id"]."' codigo='".$productos[$i]["codigo"]."' imagen='".$productos[$i]["imagen"]."'><i class='fa fa-times'></i></button></div>"; 

  			}

		 //Generar el JSON que se va a imprimir en el HTML, VERIFICAR LA CONICIDENCIA DE LAS COLUMNAS
		  	$datosJson .='[
			      "'.$productos[$i]["codigo"].'",
			      "'.$imagen.'",
			      "'.$productos[$i]["descripcion"].'",
			      "'.$proveedores["razon_social"].'",
			      "'.$categorias["categoria"].'",
			      "'.$stock.'",
			      "'.$productos[$i]["precio_lista"].'",
			      "'.$productos[$i]["fecha"].'",
			      "'.$botones.'"
			    ],';

		  }

		  //sbstraemos el ultimo dato del JSON en el final para eliminar laca ,

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	}


}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$activarProductos = new TablaProductos();
$activarProductos -> mostrarTablaProductos();

