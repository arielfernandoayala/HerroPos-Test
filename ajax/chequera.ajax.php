<?php

require_once "../controladores/chequera.controlador.php";
require_once "../modelos/chequera.modelo.php";



//Cargamos las funciones creadas en el modelo y el controlador


class AjaxCobranzaChequera{

	public $idChq;
	public $id_chq;
	public $traerCheques;

	public function ajaxEditarChq(){

		$item = "id";
		$valor = $this->idChq;
		//Guarde el id del cheque

		$respuesta = ControladorChequera::ctrMostrarChequesEdit($item,$valor);

		 //echo("<script>console.log('Respuesta del cobranzaclientes.ajax.php: " . $respuesta . "' );</script>");

		echo json_encode($respuesta);

		//echo("<script>console.log('Respuesta del cobranzaclientes.ajax.php: " . json_encode($respuesta) . "' );</script>");
	}

	public function ajaxAgrearItem(){

		$item = "id";
		$valor = $this->id_chq;
		//Guarde el id del cheque

		$respuesta = ControladorChequera::ctrMostrarChequesEdit($item,$valor);

		 //echo("<script>console.log('Respuesta del cobranzaclientes.ajax.php: " . $respuesta . "' );</script>");

		echo json_encode($respuesta);

		//echo("<script>console.log('Respuesta del cobranzaclientes.ajax.php: " . json_encode($respuesta) . "' );</script>");
	}

	public function ajaxTraerCheques(){

		if($this->traerCheques == "ok"){

            $item = "doc_receptor";
            $valor = null;

            $respuesta = ControladorChequera::ctrMostrarCheques($item, $valor);

			echo json_encode($respuesta);

			//echo("<script>console.log('Respuesta del cobranzaclientes.ajax.php: " . json_encode($respuesta) . "' );</script>");
		}
	}

	public function ajaxCapturarCheque(){

		if($this->nroCheque != ""){

            $item = "nro_chq";
            $valor = $this->nroCheque;

            $respuesta = ControladorChequera::ctrMostrarChequesEdit($item, $valor);

			echo json_encode($respuesta);

			//echo("<script>console.log('Respuesta del cobranzaclientes.ajax.php: " . json_encode($respuesta) . "' );</script>");
		}
	}




}



/*==================================================

===================================================*/


if(isset($_POST["idCheque"])){

	$cheque = new AjaxCobranzaChequera(); //creamos el objeto de tipo
	$cheque -> idChq = $_POST["idCheque"]; 
	$cheque -> ajaxEditarChq(); //ejecutamos el metodo

}

if(isset($_POST["id_chq"])){

	$cheque = new AjaxCobranzaChequera(); //creamos el objeto de tipo
	$cheque -> id_chq = $_POST["id_chq"]; 
	$cheque -> ajaxAgrearItem(); //ejecutamos el metodo

}

if(isset($_POST["traerCheques"])){

	$cheque = new AjaxCobranzaChequera(); //creamos el objeto de tipo
	$cheque -> traerCheques = $_POST["traerCheques"]; 
	$cheque -> ajaxTraerCheques(); //ejecutamos el metodo

}

if(isset($_POST["nroCheque"])){

	$cheque = new AjaxCobranzaChequera(); //creamos el objeto de tipo
	$cheque -> nroCheque = $_POST["nroCheque"]; 
	$cheque -> ajaxCapturarCheque(); //ejecutamos el metodo

}


