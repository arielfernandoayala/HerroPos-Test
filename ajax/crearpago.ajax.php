<?php

require_once "../controladores/chequera.controlador.php";
require_once "../modelos/chequera.modelo.php";

/*=========================================================================
 MOSTRAR LA TABLA DE cheques LA PAGINA DE VENTAS PARA RELIZAR LAS MISMAS
 =======================================================================*/


class tablaChequesCrearPago{

 	/*=============================================
 	 MOSTRAR LA TABLA DE cheques EN VENTAS
  	=============================================*/ 

	public function mostaraTablaChequesCrearPago(){

		$item = null;
    	$valor = null;
    	$orden = "id";

  		$cheques = ControladorChequera::ctrMostrarCheques($item, $valor, $orden);
 		
  		if(count($cheques) == 0){

  			echo '{"data": []}';

		  	return;
  		}	
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($cheques); $i++){

		  	/*=============================================
 	 		TRAEMOS LA IMAGEN
  			=============================================*/ 

		  	//$imagen = "<img src='".$cheques[$i]["imagen"]."' width='40px'>";

		  	/*=============================================
 	 		STOCK  ||| AGREGAR COMPARADOR CONTRA STOCK MIN-MED-SUP
  			=============================================*/ 




		  	$botones =  "<div class='btn-group'><button class='btn btn-primary productoAgregarPresupuestoRapido recuperarBoton' idProducto='".$cheques[$i]["id"]."'>Agregar</button></div>"; 

		  	$datosJson .='[
		  		  "'.$cheques[$i]["codigo"].'",
			      "'.$cheques[$i]["descripcion"].'",
			      "'.$cheques[$i]["precio_lista"].'",
			      "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	}


}

/*=============================================
ACTIVAR TABLA DE cheques
=============================================*/ 
$activarCheques = new tablaChequesCrearPago();
$activarCheques -> mostaraTablaChequesCrearPago();

