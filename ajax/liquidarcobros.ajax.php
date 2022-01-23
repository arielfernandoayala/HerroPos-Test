<?php

require_once "../controladores/liquidarcobros.controlador.php";
require_once "../modelos/liquidarcobros.modelo.php";

class AjaxLiquidarCobros{

	/*=============================================
	REGISTRAR PAGO, CAPTURA ID DESDE JS
	=============================================*/	

	public $idRecALiquidar;

	public function ajaxrRegistraCobroRec(){

		$item = "id";
		$valor = $this->idRecALiquidar;

		$respuesta = ControladorCobrosPendientes::ctrMostrarCobropendiente($item, $valor);

		//echo($respuesta);

		echo json_encode($respuesta);

	}
}

/*=============================================
REGISTRAR COBRO, EJECUTA
=============================================*/	
if(isset($_POST["idRecALiquidar"])){

	$cobro = new AjaxLiquidarCobros();
	$cobro -> idRecALiquidar = $_POST["idRecALiquidar"];
	$cobro -> ajaxrRegistraCobroRec();
}
