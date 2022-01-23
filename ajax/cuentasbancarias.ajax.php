<?php

require_once "../controladores/cuentasbancarias.controlador.php";
require_once "../modelos/cuentasbancarias.modelo.php";

class AjaxCuentasBancarias{

	/*=============================================
	EDITAR CUENTA
	=============================================*/	

	public $idCuentaBancaria;



	public function ajaxEditarCuentaBancaria(){

		$item = "id";
		$valor = $this->idCuentaBancaria;
		$respuesta = ControladorCuentasBancarias::ctrMostrarCuentasBancarias($item, $valor);

	

		

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR CUENTA 
=============================================*/	
if(isset($_POST["idCuentaBancaria"])){

	$rubro = new AjaxCuentasBancarias();
	$rubro -> idCuentaBancaria = $_POST["idCuentaBancaria"];
	$rubro -> ajaxEditarCuentaBancaria();
}