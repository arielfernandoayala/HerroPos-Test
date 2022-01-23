<?php

class ControladorImpRecibos{


	/*=============================================
	MOSTRAR CUENTAS BANCARIAS
	=============================================*/

	static public function ctrMostrarRecibos($item, $valor){

		$tabla = "recibocliente";

		$respuesta = ModeloImpRecibo::mdlMostrarRecibo($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	MOSTRAR RECIBO PDF
	=============================================*/

	static public function ctrMostrarRecibosPdf($item, $valor){

		$tabla = "recibocliente";

		$respuesta = ModeloImpRecibo::mdlMostrarReciboPdf($tabla, $item, $valor);

		return $respuesta;
	
	}
}

