<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

require_once "../controladores/proveedores.controlador.php";
require_once "../modelos/proveedores.modelo.php";


class TablaActualizarProductos{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaActualizarProductos(){

		$item = null;
    	$valor = null;
    	$orden = "id";

  		$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);	

  		//productos trae un JSON con todos loS datos de la base 


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

      /*=============================================
        ACT LISTA
      =============================================*/ 
        $precio_venta = $productos[$i]["precio_venta"];
        $incrementador = $productos[$i]["incrementador"];
        $precio_lista = $precio_venta + ($precio_venta*$incrementador)/100;


				$tablita = "productos";
        $item1 = "precio_lista";

				$valor_id = $productos[$i]["id"];

				$respuestaActualizaPventa = ModeloProductos::mdlActualizarProducto($tablita,$item1,$precio_lista,$valor_id);
        
           
  			

		 //Generar el JSON que se va a imprimir en el HTML, VERIFICAR LA CONICIDENCIA DE LAS COLUMNAS
		  	$datosJson .='[

			      "'.$imagen.'",
			      "#'.$productos[$i]["codigo"].'",
			      "'.$productos[$i]["descripcion"].'",
			      "'.$proveedores["razon_social"].'",
			      "'.$categorias["categoria"].'",
			      "'.$stock.'",
			      "'.$productos[$i]["precio_lista"].'",
			      "'.$productos[$i]["fecha"].'"
			    ],';

		  }

		  //sbstraemos el ultimo dato del JSON en el final para eliminar laca ,

		  //$datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	}


}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$activarProductos = new TablaActualizarProductos();
$activarProductos -> mostrarTablaActualizarProductos();

