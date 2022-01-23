<?php

require_once "../controladores/chequera.controlador.php";
require_once "../modelos/chequera.modelo.php";

class tablaChequesCrearPago{

 	/*=============================================
 	 MOSTRAR LA TABLA DE cheques EN VENTAS
  	=============================================*/ 

	public function mostaraTablaChequesCrearPago(){

         $item = "doc_receptor";
         $valor = null;

         $cheques = ControladorChequera::ctrMostrarCheques($item, $valor);

         //echo($cheques);
 		
  		if(count($cheques) == 0){

  			echo '{"data": []}';

		  	return;
  		}	
		
  		$datosJson = '{
		  "data": [';

		 	 for($i = 0; $i < count($cheques); $i++){

		  		$botones =  "<div class='btn-group'><button class='btn btn-primary btnAgregarChequeCrearPago recuperarBtnChq' id_chq='".$cheques[$i]["id"]."'>Agregar</button></div>"; 

			  	$datosJson .='["'.$cheques[$i]["fecha_ven_chq"].'",
							   "'.$cheques[$i]["banco_chq"].'",
							   "'.$cheques[$i]["importe"].'",
							   "'.$botones.'"],';

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

