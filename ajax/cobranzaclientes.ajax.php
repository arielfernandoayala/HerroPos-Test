<?php

require_once "../controladores/cobranzaclientes.controlador.php";
require_once "../modelos/cobranzaclientes.modelo.php";

require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

//Cargamos las funciones creadas en el modelo y el controlador


class AjaxCobranzaClientes{

	public $idCobranzav1;
	public $docCobranzav1;

	public function ajaxCrearRecibo(){

		$item = "id_cliente";
		$valor = $this->idCobranzav1;
		//Guarde el documento identificatorio del cliente

		$respuesta = ControladorVentas::ctrMostrarVentasAsociadas($item,$valor);

		//echo "<script>console.log('Respuesta del cobranzaclientes.ajax.php: " . $respuesta . "' );</script>";

		echo json_encode($respuesta);

		//echo "<script>console.log('Respuesta del cobranzaclientes.ajax.php: " . $respuesta . "' );</script>";
	}

	public function ajaxVerSaldoCliente(){

		$item = "documento";
		$valor = $this->docCobranzav1;
		//Guarde el documento identificatorio del cliente

		$respuestaCliente = ControladorClientes::ctrMostrarClientes($item,$valor);

		//echo "<script>console.log('Respuesta del cobranzaclientes.ajax.php: " . $respuesta . "' );</script>";

		echo json_encode($respuestaCliente);

		//echo "<script>console.log('Respuesta del cobranzaclientes.ajax.php: " . $respuestaCliente . "' );</script>";
	}




}


/*==================================================

===================================================*/

if(isset($_POST["idCobranzav1"])){

	$recibo = new AjaxCobranzaClientes(); //creamos el objeto de tipo
	$recibo -> idCobranzav1 = $_POST["idCobranzav1"]; // en la propiedad $docClientes le asiganmos lo que viene por post en idCobranzav1
	$recibo -> ajaxCrearRecibo(); //ejecutamos el metodo

}

/*==================================================

===================================================*/
if(isset($_POST["docCobranzav1"])){

	$saldo = new AjaxCobranzaClientes(); //creamos el objeto de tipo
	$saldo -> docCobranzav1 = $_POST["docCobranzav1"]; // en la propiedad $docClientes le asiganmos lo que viene por post en docCobranzav1
	$saldo -> ajaxVerSaldoCliente(); //ejecutamos el metodo

}